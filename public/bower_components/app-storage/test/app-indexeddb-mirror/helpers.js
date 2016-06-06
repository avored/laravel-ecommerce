/**
@license
Copyright (c) 2016 The Polymer Project Authors. All rights reserved.
This code may only be used under the BSD style license found at http://polymer.github.io/LICENSE.txt
The complete set of authors may be found at http://polymer.github.io/AUTHORS.txt
The complete set of contributors may be found at http://polymer.github.io/CONTRIBUTORS.txt
Code distributed by Google as part of the polymer project is also
subject to an additional IP rights grant found at http://polymer.github.io/PATENTS.txt
*/
(function() {

  var navigatorOnLineDescriptor =
      Object.getOwnPropertyDescriptor(Navigator.prototype, 'onLine');
  var hasNativePrototype = navigatorOnLineDescriptor != null;

  if (!hasNativePrototype) {
    navigatorOnLineDescriptor = Object.getOwnPropertyDescriptor(navigator, 'onLine');
  }

  function restoreNavigatorOnLine() {
    var target = hasNativePrototype ? Navigator.prototype : navigator;
    Object.defineProperty(target, 'onLine', navigatorOnLineDescriptor);
    if (window.navigator.onLine) {
      window.dispatchEvent(new CustomEvent('online'));
    }
  }

  function goOffline() {
    var target = hasNativePrototype ? Navigator.prototype : navigator;
    Object.defineProperty(
        target, 'onLine', { value: false });
    window.dispatchEvent(new CustomEvent('offline'));
  }

  function getIdbObjectStoreValue(dbName, dbVersion, storeName, key) {
    return new Promise(function(resolve, reject) {
      var request = indexedDB.open(dbName, dbVersion);
      request.onerror = reject;
      request.onsuccess = function() {
        var db = request.result;
        var transaction = db.transaction(storeName, 'readonly');
        var store = transaction.objectStore(storeName);

        request = store.get(key);

        transaction.oncomplete = function() {
          resolve(request.result);
          db.close();
        };
        transaction.onabort = transaction.onerror = function(e) {
          reject(e);
          db.close();
        };
      };
    });
  }

  function setIdbObjectStoreValue(dbName, dbVersion, storeName, key, value) {
    return new Promise(function(resolve, reject) {
      var request = indexedDB.open(dbName, dbVersion);
      request.onerror = reject;
      request.onsuccess = function() {
        var db = request.result;
        var transaction = db.transaction(storeName, 'readwrite');
        var store = transaction.objectStore(storeName);

        request = store.put(value, key);

        transaction.oncomplete = function() {
          resolve(request.result);
          db.close();
        };
        transaction.onabort = transaction.onerror = function(e) {
          reject(e);
          db.close();
        };
      };
    });
  }

  function deleteIdbDatabase(dbName) {
    return new Promise(function(resolve, reject) {
      var request = indexedDB.deleteDatabase(dbName);
      request.onsuccess = resolve;
      request.onerror = reject;
      request.onblocked = function() {
        console.warn('Deleting database blocked. Is there a connection leak?');
        resolve();
      };
    });
  }

  window.appStorageTestHelpers = {
    restoreNavigatorOnLine: restoreNavigatorOnLine,
    goOffline: goOffline,
    getIdbObjectStoreValue: getIdbObjectStoreValue,
    setIdbObjectStoreValue: setIdbObjectStoreValue,
    deleteIdbDatabase: deleteIdbDatabase
  };
})();
