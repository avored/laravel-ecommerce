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

var accountSummaries = require('../../lib/account-summaries');
var assert = require('assert');
var fixtures = require('./fixtures');
var sinon = require('sinon');

require('./stubs/gapi');

describe('accountSummaries', function() {

  describe('.get', function() {

    it('returns a "thenable" that is resolved with an account summaries array.',
        function(done) {

      var returnValue = accountSummaries.get();
      assert('then' in returnValue);

      returnValue.then(function(summaries) {
        assert.deepEqual(summaries.all(), fixtures.get().items);
        done();
      })
      .catch(done);

    });

    it('does not query the API more than once, even with multiple calls.',
        function(done) {

      var listSpy =
          sinon.spy(gapi.client.analytics.management.accountSummaries, 'list');

      accountSummaries.get().then(function(summaries1) {
        accountSummaries.get().then(function(summaries2) {
          accountSummaries.get().then(function(summaries3) {

            assert(listSpy.callCount === 0);
            assert.equal(summaries1, summaries2);
            assert.equal(summaries2, summaries3);
            assert.deepEqual(summaries3.all(), fixtures.get().items);

            listSpy.restore();
            done();
          })
          .catch(done);
        });
      });
    });

    it('accepts an optional parameter to clear the cache.', function(done) {

      var listSpy =
          sinon.spy(gapi.client.analytics.management.accountSummaries, 'list');

      accountSummaries.get(true).then(function(summaries1) {
        accountSummaries.get(true).then(function(summaries2) {
          accountSummaries.get(true).then(function(summaries3) {
            assert.equal(listSpy.callCount, 3);

            // When clearing the cache these should be deepEqual but
            // not the same object.
            assert.notEqual(summaries1, summaries2);
            assert.notEqual(summaries2, summaries3);
            assert.deepEqual(summaries1, summaries2);
            assert.deepEqual(summaries2, summaries3);

            assert.deepEqual(summaries3.all(), fixtures.get().items);

            listSpy.restore();
            done();
          })
          .catch(done);
        });
      });

    });

    it('returns the full account summaries list, not a paginatated one.',
        function(done) {

      var originalListMethod =
          gapi.client.analytics.management.accountSummaries.list;

      var listStub = sinon.stub(
          gapi.client.analytics.management.accountSummaries, 'list',
          function(options) {
            options = options || {};
            // Add `max-results: 2` to force pagination.
            options['max-results'] = 2;
            return originalListMethod(options);
          });

      accountSummaries.get(true).then(function(summaries) {
        assert.equal(listStub.callCount, 3);
        assert.deepEqual(summaries.all(), fixtures.get().items);

        listStub.restore();
        done();
      })
      .catch(done);

    });

    it('throws if the user requesting the summares does not have any ' +
        'Google Analytics accounts.', function(done) {

      fixtures.set('without-account');

      accountSummaries.get(true).catch(function(err) {
        assert.equal(err.message, 'You do not have any Google Analytics ' +
            'accounts. Go to http://google.com/analytics to sign up.');

        // Restore the original fixtures.
        fixtures.set('with-account');
        done();
      });
    });

  });

});
