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


/**
 * @constuctor Metadata
 *
 * Takes an array of metadata columns...

 * @param {Array} columns A list of columns in the format returned by the
 *     metadata API's column#list method.
 * @returns {AccountSummaries}
 */
function Metadata(columns) {
  this._columns = columns;

  this._metrics = [];
  this._dimensions = [];
  this._ids = {};

  this._columns.forEach(function(column) {
    this._ids[column.id] = column.attributes;

    if (column.attributes.type == 'METRIC') {
      this._metrics.push(column);
    }
    else if (column.attributes.type == 'DIMENSION') {
      this._dimensions.push(column);
    }
  }.bind(this));
}


/**
 * Get an array of all columns, optionally filtering by status.
 * @param {string|undefined} status The status to filter by. The status options
 *     are 'public' or 'deprecated'. Not setting a status returns all coluns.
 * @return {Array} A list of column passing the status filter.
 */
Metadata.prototype.all = function(status) {
  return !status ? this._columns : this._columns.filter(function(column) {
    return column.attributes.status.toLowerCase() === status.toLowerCase();
  });
};


/**
 * Get an array of all metrics, optionally filtering by status.
 * @param {string|undefined} status The status to filter by. The status
 *     options are 'public' or 'deprecated'. Not setting a status returns all
 *     metrics.
 * @return {Array} A list of column passing the status filter.
 */
Metadata.prototype.allMetrics = function(status) {
  return !status ? this._metrics : this._metrics.filter(function(metric) {
    return metric.attributes.status.toLowerCase() === status.toLowerCase();
  });
};


/**
 * Get an array of all dimensions, optionally filtering by status.
 * @param {string|undefined} status The status to filter by. The status
 *     options are 'public' or 'deprecated'. Not setting a status returns all
 *     dimensions.
 * @return {Array} A list of column passing the status filter.
 */
Metadata.prototype.allDimensions = function(status) {
  return !status ?
      this._dimensions : this._dimensions.filter(function(dimension) {
    return dimension.attributes.status.toLowerCase() === status.toLowerCase();
  });
};


/**
 * Get the attributs object of a column given the passed ID.
 * @param {string} id The column ID.
 * @return {Object} The column attributes object.
 */
Metadata.prototype.get = function(id) {
  return this._ids[id];
};


module.exports = Metadata;
