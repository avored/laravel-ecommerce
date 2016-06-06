// Copyright 2015 Google Inc. All rights reserved.
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//     http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.


/* global gapi */

var Metadata = require('./metadata');


/**
 * Store the metadata result in a promise so the API isn't
 * queried unneccesarily.
 */
var cache;


/**
 * Make a request to the Metadata API's columns#list method.
 * @return {goog.Promise} A promise that will be resolved with a
 *     Metadata object.
 */
function requestMetadata() {

  var promise = gapi.client.analytics.metadata.columns.list({reportType: 'ga'})
      // An extra `then` is needed here because `.list` doesn't return a
      // "real" promise, just a thenable. Calling `.then` gets us access
      // to the underlying goog.Promise instance and thus its constructor.
      .then(function(resp) { return resp; });

  return new promise.constructor(function(resolve, reject) {

    promise.then(function(resp) {
      resolve(new Metadata(resp.result.items));
    })
    // Reject the promise if there are any uncaught errors;
    .then(null, reject);
  });
}


/**
 * @module metadata
 *
 * This module requires the `gapi.client.analytics` library to be installed
 * and the user to be authenticated.
 */
module.exports = {

  /**
   * Return the `requestMetadata` promise. If the promise exists,
   * return it to avoid multiple requests. If the promise does not exist,
   * initiate the request and cache the promise.
   *
   * @param {boolean} noCache When true make a request no matter what.
   * @return {Promise} A promise fulfilled with a Metadata instance.
   */
  get: function(noCache) {
    if (noCache) cache = null;
    return cache || (cache = requestMetadata());
  }
};
