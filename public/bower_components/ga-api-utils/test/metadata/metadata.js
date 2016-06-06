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


/* global describe, it */

require('native-promise-only');
require('./stubs/gapi');

var Metadata = require('../../lib/metadata/metadata');
var assert = require('assert');

var columns = require('./fixtures/columns.json').items;
var metrics = columns.filter(function(column) {
  return column.attributes.type == 'METRIC';
});
var publicMetrics = metrics.filter(function(metric) {
  return metric.attributes.status == 'PUBLIC';
});
var deprecatedMetrics = metrics.filter(function(metric) {
  return metric.attributes.status == 'DEPRECATED';
});
var dimensions = columns.filter(function(column) {
  return column.attributes.type == 'DIMENSION';
});
var publicDimensions = dimensions.filter(function(dimension) {
  return dimension.attributes.status == 'PUBLIC';
});
var deprecatedDimensions = dimensions.filter(function(dimension) {
  return dimension.attributes.status == 'DEPRECATED';
});


describe('Metadata', function() {

  var metadata = new Metadata(columns);

  describe('#all', function() {
    it('returns the full list of columns.', function() {
      assert.deepEqual(metadata.all(), columns);
    });
  });

  describe('#allMetrics', function() {
    it('gets only the columns that are metrics, optionally filtered' +
        'by a status parameter.', function() {

      assert.deepEqual(metadata.allMetrics(), metrics);
      assert.deepEqual(metadata.allMetrics('public'), publicMetrics);
      assert.deepEqual(metadata.allMetrics('deprecated'), deprecatedMetrics);
    });
  });

  describe('#allDimensions', function() {
    it('gets only the columns that are dimensions, optionally filtered' +
        'by a status parameter.', function() {

      assert.deepEqual(metadata.allDimensions(), dimensions);
      assert.deepEqual(metadata.allDimensions('public'), publicDimensions);
      assert.deepEqual(metadata.allDimensions('deprecated'),
          deprecatedDimensions);
    });
  });

  describe('#get', function() {
    it('gets the attributes object of a column given an ID.', function() {
      assert.deepEqual(metadata.get('ga:users'), columns[7].attributes);
    });
  });

});
