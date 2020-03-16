(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[27],{

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

var _configProvider = __webpack_require__(/*! ../config-provider */ "./node_modules/ant-design-vue/lib/config-provider/index.js");

var _base = __webpack_require__(/*! ../base */ "./node_modules/ant-design-vue/lib/base/index.js");

var _base2 = _interopRequireDefault(_base);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var Divider = {
  name: 'ADivider',
  props: {
    prefixCls: _vueTypes2['default'].string,
    type: _vueTypes2['default'].oneOf(['horizontal', 'vertical', '']).def('horizontal'),
    dashed: _vueTypes2['default'].bool,
    orientation: _vueTypes2['default'].oneOf(['left', 'right'])
  },
  inject: {
    configProvider: { 'default': function _default() {
        return _configProvider.ConfigConsumerProps;
      } }
  },
  render: function render() {
    var _classString;

    var h = arguments[0];
    var customizePrefixCls = this.prefixCls,
        type = this.type,
        $slots = this.$slots,
        dashed = this.dashed,
        _orientation = this.orientation,
        orientation = _orientation === undefined ? '' : _orientation;

    var getPrefixCls = this.configProvider.getPrefixCls;
    var prefixCls = getPrefixCls('divider', customizePrefixCls);
    var orientationPrefix = orientation.length > 0 ? '-' + orientation : orientation;

    var classString = (_classString = {}, (0, _defineProperty3['default'])(_classString, prefixCls, true), (0, _defineProperty3['default'])(_classString, prefixCls + '-' + type, true), (0, _defineProperty3['default'])(_classString, prefixCls + '-with-text' + orientationPrefix, $slots['default']), (0, _defineProperty3['default'])(_classString, prefixCls + '-dashed', !!dashed), _classString);

    return h(
      'div',
      { 'class': classString },
      [$slots['default'] && h(
        'span',
        { 'class': prefixCls + '-inner-text' },
        [$slots['default']]
      )]
    );
  }
};

/* istanbul ignore next */
Divider.install = function (Vue) {
  Vue.use(_base2['default']);
  Vue.component(Divider.name, Divider);
};

exports['default'] = Divider;

/***/ })

}]);