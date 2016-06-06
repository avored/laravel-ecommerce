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

var AccountSummaries = require('./account-summaries');


/**
 * Store the accountSummaries result in a promise so the API isn't
 * queried unneccesarily.
 */
var cache;


/**
 * Make a request to the Management API's accountSummaries#list method.
 * If the requests returns a partial, paginated response, query again
 * until the full summaries are retrieved.
 * @return {goog.Promise} A promise that will be resolved with an
 *     AccountSummaries object.
 */
function requestAccountSummaries() {

  var promise = gapi.client.analytics.management.accountSummaries.list()
      // An extra `then` is needed here because `.list` doesn't return a
      // "real" promise, just a thenable. Calling `.then` gets us access
      // to the underlying goog.Promise instance and thus its constructor.
      .then(function(resp) { return resp; });

  return new promise.constructor(function(resolve, reject) {

    // Store the summaries array in the closure so multiple requests can
    // concat to it.
    var summaries = [];

    promise.then(function fn(resp) {
      var result = resp.result;
      if (result.items) {
        summaries = summaries.concat(result.items);
      }
      else {
        reject(new Error('You do not have any Google Analytics accounts. ' +
            'Go to http://google.com/analytics to sign up.'));
      }

      if (result.startIndex + result.itemsPerPage <= result.totalResults) {
        gapi.client.analytics.management.accountSummaries
            .list({'start-index': result.startIndex + result.itemsPerPage})
            // Recursively call this function until the full results are in.
            .then(fn);
      }
      else {
        resolve(new AccountSummaries(summaries));
      }
    })
    // Reject the promise if there are any uncaught errors;
    .then(null, reject);
  });
}


/**
 * @module accountSummaries
 *
 * This module requires the `gapi.client.analytics` library to be installed
 * and the user to be authenticated.
 */
module.exports = {

  /**
   * Return the `requestAccountSummaries` promise. If the promise exists,
   * return it to avoid multiple requests. If the promise does not exist,
   * initiate the request and cache the promise.
   *
   * @param {boolean} noCache When true make a request no matter what.
   * @return {Promise} A promise fulfilled with an AccountSummaries instance.
   */
  get: function(noCache) {
    if (noCache) cache = null;
    return cache || (cache = requestAccountSummaries());
  }
};
