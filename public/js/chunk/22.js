(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[22],{

/***/ "./node_modules/ant-design-vue/lib/col/index.js":
/*!******************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/col/index.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _grid = __webpack_require__(/*! ../grid */ "./node_modules/ant-design-vue/lib/grid/index.js");

/* istanbul ignore next */
_grid.Col.install = function (Vue) {
  Vue.component(_grid.Col.name, _grid.Col);
};

exports['default'] = _grid.Col;

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/grid/index.js":
/*!*******************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/grid/index.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.Col = exports.Row = undefined;

var _Row = __webpack_require__(/*! ./Row */ "./node_modules/ant-design-vue/lib/grid/Row.js");

var _Row2 = _interopRequireDefault(_Row);

var _Col = __webpack_require__(/*! ./Col */ "./node_modules/ant-design-vue/lib/grid/Col.js");

var _Col2 = _interopRequireDefault(_Col);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports.Row = _Row2['default'];
exports.Col = _Col2['default'];

/***/ })

}]);