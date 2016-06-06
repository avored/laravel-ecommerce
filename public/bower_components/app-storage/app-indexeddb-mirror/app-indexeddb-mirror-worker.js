/**
 * @license
 * Copyright (c) 2016 The Polymer Project Authors. All rights reserved.
 * This code may only be used under the BSD style license found at http://polymer.github.io/LICENSE.txt
 * The complete set of authors may be found at http://polymer.github.io/AUTHORS.txt
 * The complete set of contributors may be found at http://polymer.github.io/CONTRIBUTORS.txt
 * Code distributed by Google as part of the polymer project is also
 * subject to an additional IP rights grant found at http://polymer.github.io/PATENTS.txt
 */

(function() {
  'use strict';

  var INTERNAL_STORE_NAME = 'internal';
  var DB_VERSION = 2;

  var CLIENT_PORTS = '__clientPorts';
  var DB_NAME = '__dbName';
  var STORE_NAME = '__storeName';
  var DB_OPENS = '__dbOpens';

  var MIGRATIONS = [
    // v1
    function(context) {
      context.database.createObjectStore(context.storeName);
    },
    // v2
    function(context) {
      context.database.createObjectStore(INTERNAL_STORE_NAME);
    }
  ];

  /**
   * Class that implements a worker process negotiates connections from clients
   * in other threads, and operates on an IndexedDB database object store.
   *
   * @param {string} _dbName The name of the IndexedDB database to create and
   * open.
   * @param {string} _storeName The name of the IndexedDB object store to use
   * for storing values.
   */
  function AppIndexedDBMirrorWorker(_dbName, _storeName) {
    _dbName = _dbName || 'app-mirror';
    _storeName = _storeName || 'mirrored_data';

    this[DB_NAME] = _dbName;
    this[STORE_NAME] = _storeName;
    // Maybe useful in case we want to notify clients of changes..
    this[CLIENT_PORTS] = new Array;
    this[DB_OPENS] = null;

    this.openDb();

    self.addEventListener(
        'unhandledrejection', function(error){ console.error(error); });
    self.addEventListener(
        'error', function(error) { console.error(error); });

    this.supportsIndexedDB = self.indexedDB != null;
    console.log('AppIndexedDBMirrorWorker started...');
  };

  AppIndexedDBMirrorWorker.prototype = {

    openDb: function() {
      this.__dbOpens = this.__dbOpens || new Promise(function(resolve, reject) {
        console.log('Opening database..');

        var request = indexedDB.open(this[DB_NAME], DB_VERSION);

        request.onupgradeneeded = function(event) {
          console.log('Upgrade needed:', event.oldVersion, '=>', event.newVersion);
          var context = {
            database: request.result,
            storeName: this[STORE_NAME],
            dbName: this[DB_NAME]
          };

          for (var i = event.oldVersion; i < event.newVersion; ++i) {
            MIGRATIONS[i] && MIGRATIONS[i].call(this, context);
          }
        }.bind(this);

        request.onsuccess = function() {
          console.log('Database opened.');
          resolve(request.result);
        };
        request.onerror = function() {
          reject(request.error);
        };
      }.bind(this));

      return this.__dbOpens;
    },

    closeDb: function() {
      if (this.__dbOpens == null) {
        return Promise.resolve();
      }

      return this.openDb().then(function(db) {
        this.__dbOpens = null;
        console.log('Closing database..');
        db.close();
      }.bind(this));
    },

    /**
     * Perform a transaction on an IndexedDB object store.
     *
     * @param {string} operation The name of the method to call on the object
     * store instance.
     * @param {string} storeName The name of the object store to operate on.
     * @param {string} mode The mode of the transaction that will be performed.
     * @param {...} operationArg The arguments to call the method named by
     * the operation parameter.
     * @return {Promise} A promise that resolves when the transaction completes,
     * with the result of the transaction, or rejects if the transaction fails
     * with the error reported by the transaction.
     */
    operateOnStore: function(operation, storeName, mode) {
      var operationArgs = Array.from(arguments).slice(3);

      return this.openDb().then(function(db) {

        console.log('Store operation:', operation, storeName, mode, operationArgs);

        return new Promise(function(resolve, reject) {
          try {
            var transaction = db.transaction(storeName, mode);
            var store = transaction.objectStore(storeName);
            var request = store[operation].apply(store, operationArgs);
          } catch (e) {
            return reject(e);
          }

          transaction.oncomplete = function() { resolve(request.result); };
          transaction.onabort = function() { reject(transaction.error); };
        });
      });
    },

    /**
     * Perform a "get" operation on an IndexedDB object store.
     *
     * @param {string} storeName The name of the object store to operate on.
     * @param {string} key The key in the object store that corresponds to the
     * value that should be got.
     * @return {Promise} A promise that resolves with the outcome of the
     * operation.
     */
    get: function(storeName, key) {
      return this.operateOnStore('get', storeName, 'readonly', key);
    },

    /**
     * Perform a "put" operation on an IndexedDB object store.
     *
     * @param {string} storeName The name of the object store to operate on.
     * @param {string} key The key in the object store that corresponds to the
     * value that should be put.
     * @param {} value The value to be put in the object store at the given key.
     * @return {Promise} A promise that resolves with the outcome of the
     * operation.
     */
    set: function(storeName, key, value) {
      return this.operateOnStore('put', storeName, 'readwrite', value, key);
    },

    /**
     * Perform a "clear" operation on an IndexedDB object store.
     *
     * @param {string} storeName The name of the object store to operate on.
     * @return {Promise} A promise that resolves with the outcome of the
     * operation.
     */
    clear: function(storeName) {
      return this.operateOnStore('clear', storeName, 'readwrite');
    },

    /**
     * Performs a transaction (in the parlance of the the client).
     *
     * @param {string} method The method of the transaction. Supported methods
     * are `"get"` and `"set"`.
     * @param {string} key The key to get or set.
     * @param {=} value The value to set, when the method is `"set"`.
     * @return {Promise} A promise that resolves with the outcome of the
     * transaction, or rejects if an unsupported method is attempted.
     */
    transaction: function(method, key, value) {
      value = value || null;

      switch(method) {
        case 'get':
          return this.get(this[STORE_NAME], key);
        case 'set':
          return this.set(this[STORE_NAME], key, value);
      }

      return Promise.reject(new Error('Method not supported: ' + method));
    },

    /**
     * Compares the currently stored session value to a provided session. If
     * the provided session does not match the current session, the database
     * is cleared and the provided session becomes the current session.
     *
     * @param {string} session A session to compare to the current session.
     * @return {Promise} A promise that resolves with the validation process
     * has completed and the session has been updated (if necessary).
     */
    validateSession: function(session) {
      return Promise.all([
        this.openDb(),
        this.get(INTERNAL_STORE_NAME, 'session')
      ]).then(function(results) {
        var db = results[0];
        var currentSession = results[1];
        var operations = [];

        if (session !== currentSession) {
          if (currentSession != null) {
            operations.push(this.clear(this[STORE_NAME]));
          }

          operations.push(this.set(INTERNAL_STORE_NAME, 'session', session));
        }
      }.bind(this));
    },

    /**
     * Registers a client, represented by a MessagePort. The port is
     * presumed to be a direct, unshared channel to the client being registerd.
     *
     * @param {MessagePort} port The port that represents the client being
     * registered.
     */
    registerClient: function(port) {
      port.addEventListener('message', function(event) {
        this.handleClientMessage(event, port)
      }.bind(this));

      if (!port in this[CLIENT_PORTS]) {
        this[CLIENT_PORTS].push(port);
      }

      port.start();
      port.postMessage({
        type: 'app-mirror-connected',
        supportsIndexedDB: this.supportsIndexedDB
      });

      console.log('New client connected.');
    },

    /**
     * Triages messages received from a specific client, dispatches their
     * data to the appropriate methods and responds to the client if applicable.
     *
     * @param {MessageEvent} event The event that contains the message sent by
     * the client.
     * @param {MessagePort} port The port the represents the client the sent the
     * message.
     */
    handleClientMessage: function(event, port) {
      if (!event.data) {
        return;
      }

      var id = event.data.id;

      switch(event.data.type) {
        case 'app-mirror-close-db':
          this.closeDb().then(function() {
            port.postMessage({
              type: 'app-mirror-db-closed',
              id: id
            });
          });
        case 'app-mirror-validate-session':
          this.validateSession(event.data.session).then(function() {
            port.postMessage({
              type: 'app-mirror-session-validated',
              id: id
            });
          });
          break;
        case 'app-mirror-transaction':
          this.transaction(event.data.method, event.data.key, event.data.value)
              .then(function(result) {
                port.postMessage({
                  type: 'app-mirror-transaction-result',
                  id: id,
                  result: result
                });
              });
          break;
        case 'app-mirror-disconnect':
          var index = this[CLIENT_PORTS].indexOf(port);

          if (index !== -1) {
            this[CLIENT_PORTS].splice(index, 1);
          }
          break;
      }
    }
  };

  self.appIndexedDBMirrorWorker = new AppIndexedDBMirrorWorker();

  self.addEventListener('connect', function(event) {
    appIndexedDBMirrorWorker.registerClient(event.ports[0])
  });
})();
