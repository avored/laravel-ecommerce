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


/* global gapi:true, Promise:true */

var fixtures = require('../fixtures/columns.json');
var namespace = require('mout/object/namespace');

// Polyfill Promises for node.
Promise = require('native-promise-only');

// Assign this globally because that's how it is IRL.
namespace(global, 'gapi.client.analytics.metadata.columns');

gapi.client.analytics.metadata.columns.list = function() {

  var response = { result: fixtures };

  return {
    then: function(fn) {
      return Promise.resolve(fn(response));
    }
  };
};
