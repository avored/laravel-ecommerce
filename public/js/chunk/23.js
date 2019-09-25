(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[23],{

/***/ "./node_modules/ant-design-vue/lib/divider/index.js":
/*!**********************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/divider/index.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _defineProperty2 = __webpack_require__(/*! babel-runtime/helpers/defineProperty */ "./node_modules/babel-runtime/helpers/defineProperty.js");

var _defineProperty3 = _interopRequireDefault(_defineProperty2);

var _vueTypes = __webpack_require__(/*! ../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var Divider = {
  name: 'ADivider',
  props: {
    prefixCls: _vueTypes2['default'].string.def('ant'),
    type: _vueTypes2['default'].oneOf(['horizontal', 'vertical', '']).def('horizontal'),
    dashed: _vueTypes2['default'].bool,
    orientation: _vueTypes2['default'].oneOf(['left', 'right'])
  },
  computed: {
    classString: function classString() {
      var _ref;

      var prefixCls = this.prefixCls,
          type = this.type,
          $slots = this.$slots,
          dashed = this.dashed,
          _orientation = this.orientation,
          orientation = _orientation === undefined ? '' : _orientation;

      var orientationPrefix = orientation.length > 0 ? '-' + orientation : orientation;

      return _ref = {}, (0, _defineProperty3['default'])(_ref, prefixCls + '-divider', true), (0, _defineProperty3['default'])(_ref, prefixCls + '-divider-' + type, true), (0, _defineProperty3['default'])(_ref, prefixCls + '-divider-with-text' + orientationPrefix, $slots['default']), (0, _defineProperty3['default'])(_ref, prefixCls + '-divider-dashed', !!dashed), _ref;
    }
  },
  render: function render() {
    var h = arguments[0];
    var classString = this.classString,
        prefixCls = this.prefixCls,
        $slots = this.$slots;

    return h(
      'div',
      { 'class': classString },
      [$slots['default'] && h(
        'span',
        { 'class': prefixCls + '-divider-inner-text' },
        [$slots['default']]
      )]
    );
  }
};

/* istanbul ignore next */
Divider.install = function (Vue) {
  Vue.component(Divider.name, Divider);
};

exports['default'] = Divider;

/***/ })

}]);