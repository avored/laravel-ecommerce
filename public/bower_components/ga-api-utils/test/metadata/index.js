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


/* global describe, gapi, it */

var metadata = require('../../lib/metadata');
var assert = require('assert');
var fixtures = require('./fixtures/columns.json');
var sinon = require('sinon');

require('./stubs/gapi');

describe('metadata', function() {

  describe('.get', function() {

    it('returns a "thenable" that is resolved with an account summaries array.',
        function(done) {

      var returnValue = metadata.get();
      assert('then' in returnValue);

      returnValue.then(function(metadata) {
        assert.deepEqual(metadata.all(), fixtures.items);
        done();
      })
      .catch(done);

    });

    it('does not query the API more than once, even with multiple calls.',
        function(done) {

      var listSpy =
          sinon.spy(gapi.client.analytics.metadata.columns, 'list');

      metadata.get().then(function(metadata1) {
        metadata.get().then(function(metadata2) {
          metadata.get().then(function(metadata3) {

            assert(listSpy.callCount === 0);
            assert.equal(metadata1, metadata2);
            assert.equal(metadata2, metadata3);
            assert.deepEqual(metadata3.all(), fixtures.items);

            listSpy.restore();
            done();
          })
          .catch(done);
        });
      });
    });

    it('accepts an optional parameter to clear the cache.', function(done) {

      var listSpy =
          sinon.spy(gapi.client.analytics.metadata.columns, 'list');

      metadata.get(true).then(function(metadata1) {
        metadata.get(true).then(function(metadata2) {
          metadata.get(true).then(function(metadata3) {
            assert.equal(listSpy.callCount, 3);

            // When clearing the cache these should be deepEqual but
            // not the same object.
            assert.notEqual(metadata1, metadata2);
            assert.notEqual(metadata2, metadata3);
            assert.deepEqual(metadata1, metadata2);
            assert.deepEqual(metadata2, metadata3);

            assert.deepEqual(metadata3.all(), fixtures.items);

            listSpy.restore();
            done();
          })
          .catch(done);
        });
      });

    });

  });

});
