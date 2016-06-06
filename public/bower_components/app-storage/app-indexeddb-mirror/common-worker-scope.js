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

  /**
   * This file is a light-weight shim around the current Worker scope. It is
   * assumed that this file is only ever loaded in a standard WebWorker scope.
   * The location of the current worker is parsed, and the query string value
   * is treated as the URL for a secondary script payload to import into the
   * current scope.
   *
   * The shim listens for messages, and if it receives one with data of the form
   * `{"type":"common-worker-connect"}`, it dispatches a global "connect" event
   * (intended to be semantically similar to the same event in a `SharedWorker`
   * scope), echoing the original `MessageEvent`'s ports.
   *
   * This allows a category of worker scripts that would ordinarilly expect to
   * be running in a `SharedWorker` scope to run with similar expectations
   * inside of a normal `WebWorker` scope.
   */
  var workerScript = self.location.search.slice(1);

  if (!workerScript) {
    return;
  }

  self.addEventListener('message', function(event) {
    var data = event.data;

    if (data && data.type === 'common-worker-connect') {
      var EventConstructor =
          self.CustomEvent ||
          self.Event ||
          // NOTE(cdata): Have mercy on my soul..
          event.__proto__.__proto__.constructor;
      var connectEvent = new EventConstructor('connect');

      connectEvent.ports = event.ports;
      self.dispatchEvent(connectEvent);
    }
  }.bind(this));

  self.importScripts([workerScript]);
})();
