(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[10],{

/***/ "./node_modules/ant-design-vue/lib/switch/index.js":
/*!*********************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/switch/index.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _defineProperty2 = __webpack_require__(/*! babel-runtime/helpers/defineProperty */ "./node_modules/babel-runtime/helpers/defineProperty.js");

var _defineProperty3 = _interopRequireDefault(_defineProperty2);

var _objectWithoutProperties2 = __webpack_require__(/*! babel-runtime/helpers/objectWithoutProperties */ "./node_modules/babel-runtime/helpers/objectWithoutProperties.js");

var _objectWithoutProperties3 = _interopRequireDefault(_objectWithoutProperties2);

var _vueTypes = __webpack_require__(/*! ../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _propsUtil = __webpack_require__(/*! ../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

var _vcSwitch = __webpack_require__(/*! ../vc-switch */ "./node_modules/ant-design-vue/lib/vc-switch/index.js");

var _vcSwitch2 = _interopRequireDefault(_vcSwitch);

var _wave = __webpack_require__(/*! ../_util/wave */ "./node_modules/ant-design-vue/lib/_util/wave.js");

var _wave2 = _interopRequireDefault(_wave);

var _icon = __webpack_require__(/*! ../icon */ "./node_modules/ant-design-vue/lib/icon/index.js");

var _icon2 = _interopRequireDefault(_icon);

var _configProvider = __webpack_require__(/*! ../config-provider */ "./node_modules/ant-design-vue/lib/config-provider/index.js");

var _base = __webpack_require__(/*! ../base */ "./node_modules/ant-design-vue/lib/base/index.js");

var _base2 = _interopRequireDefault(_base);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var Switch = {
  name: 'ASwitch',
  model: {
    prop: 'checked',
    event: 'change'
  },
  props: {
    prefixCls: _vueTypes2['default'].string,
    // size=default and size=large are the same
    size: _vueTypes2['default'].oneOf(['small', 'default', 'large']),
    disabled: _vueTypes2['default'].bool,
    checkedChildren: _vueTypes2['default'].any,
    unCheckedChildren: _vueTypes2['default'].any,
    tabIndex: _vueTypes2['default'].oneOfType([_vueTypes2['default'].string, _vueTypes2['default'].number]),
    checked: _vueTypes2['default'].bool,
    defaultChecked: _vueTypes2['default'].bool,
    autoFocus: _vueTypes2['default'].bool,
    loading: _vueTypes2['default'].bool
  },
  inject: {
    configProvider: { 'default': function _default() {
        return _configProvider.ConfigConsumerProps;
      } }
  },
  methods: {
    focus: function focus() {
      this.$refs.refSwitchNode.focus();
    },
    blur: function blur() {
      this.$refs.refSwitchNode.blur();
    }
  },

  render: function render() {
    var _classes;

    var h = arguments[0];

    var _getOptionProps = (0, _propsUtil.getOptionProps)(this),
        customizePrefixCls = _getOptionProps.prefixCls,
        size = _getOptionProps.size,
        loading = _getOptionProps.loading,
        disabled = _getOptionProps.disabled,
        restProps = (0, _objectWithoutProperties3['default'])(_getOptionProps, ['prefixCls', 'size', 'loading', 'disabled']);

    var getPrefixCls = this.configProvider.getPrefixCls;
    var prefixCls = getPrefixCls('switch', customizePrefixCls);

    var classes = (_classes = {}, (0, _defineProperty3['default'])(_classes, prefixCls + '-small', size === 'small'), (0, _defineProperty3['default'])(_classes, prefixCls + '-loading', loading), _classes);
    var loadingIcon = loading ? h(_icon2['default'], {
      attrs: { type: 'loading' },
      'class': prefixCls + '-loading-icon' }) : null;
    var switchProps = {
      props: (0, _extends3['default'])({}, restProps, {
        prefixCls: prefixCls,
        loadingIcon: loadingIcon,
        checkedChildren: (0, _propsUtil.getComponentFromProp)(this, 'checkedChildren'),
        unCheckedChildren: (0, _propsUtil.getComponentFromProp)(this, 'unCheckedChildren'),
        disabled: disabled || loading
      }),
      on: this.$listeners,
      'class': classes,
      ref: 'refSwitchNode'
    };
    return h(
      _wave2['default'],
      {
        attrs: { insertExtraNode: true }
      },
      [h(_vcSwitch2['default'], switchProps)]
    );
  }
};

/* istanbul ignore next */
Switch.install = function (Vue) {
  Vue.use(_base2['default']);
  Vue.component(Switch.name, Switch);
};

exports['default'] = Switch;

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-switch/PropTypes.js":
/*!****************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-switch/PropTypes.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.switchPropTypes = undefined;

var _vueTypes = __webpack_require__(/*! ../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var switchPropTypes = exports.switchPropTypes = {
  prefixCls: _vueTypes2['default'].string,
  disabled: _vueTypes2['default'].bool.def(false),
  checkedChildren: _vueTypes2['default'].any,
  unCheckedChildren: _vueTypes2['default'].any,
  // onChange: PropTypes.func,
  // onMouseUp: PropTypes.func,
  // onClick: PropTypes.func,
  tabIndex: _vueTypes2['default'].oneOfType([_vueTypes2['default'].string, _vueTypes2['default'].number]),
  checked: _vueTypes2['default'].bool.def(false),
  defaultChecked: _vueTypes2['default'].bool.def(false),
  autoFocus: _vueTypes2['default'].bool.def(false),
  loadingIcon: _vueTypes2['default'].any
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-switch/Switch.js":
/*!*************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-switch/Switch.js ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _defineProperty2 = __webpack_require__(/*! babel-runtime/helpers/defineProperty */ "./node_modules/babel-runtime/helpers/defineProperty.js");

var _defineProperty3 = _interopRequireDefault(_defineProperty2);

var _objectWithoutProperties2 = __webpack_require__(/*! babel-runtime/helpers/objectWithoutProperties */ "./node_modules/babel-runtime/helpers/objectWithoutProperties.js");

var _objectWithoutProperties3 = _interopRequireDefault(_objectWithoutProperties2);

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _PropTypes = __webpack_require__(/*! ./PropTypes */ "./node_modules/ant-design-vue/lib/vc-switch/PropTypes.js");

var _BaseMixin = __webpack_require__(/*! ../_util/BaseMixin */ "./node_modules/ant-design-vue/lib/_util/BaseMixin.js");

var _BaseMixin2 = _interopRequireDefault(_BaseMixin);

var _propsUtil = __webpack_require__(/*! ../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

// function noop () {
// }
exports['default'] = {
  name: 'VcSwitch',
  mixins: [_BaseMixin2['default']],
  model: {
    prop: 'checked',
    event: 'change'
  },
  props: (0, _extends3['default'])({}, _PropTypes.switchPropTypes, {
    prefixCls: _PropTypes.switchPropTypes.prefixCls.def('rc-switch')
    // onChange: switchPropTypes.onChange.def(noop),
    // onClick: switchPropTypes.onClick.def(noop),
  }),
  data: function data() {
    var checked = false;
    if ((0, _propsUtil.hasProp)(this, 'checked')) {
      checked = !!this.checked;
    } else {
      checked = !!this.defaultChecked;
    }
    return {
      stateChecked: checked
    };
  },

  watch: {
    checked: function checked(val) {
      this.stateChecked = val;
    }
  },
  mounted: function mounted() {
    var _this = this;

    this.$nextTick(function () {
      var autoFocus = _this.autoFocus,
          disabled = _this.disabled;

      if (autoFocus && !disabled) {
        _this.focus();
      }
    });
  },

  methods: {
    setChecked: function setChecked(checked, e) {
      if (this.disabled) {
        return;
      }
      if (!(0, _propsUtil.hasProp)(this, 'checked')) {
        this.stateChecked = checked;
      }
      this.$emit('change', checked, e);
    },
    handleClick: function handleClick(e) {
      var checked = !this.stateChecked;
      this.setChecked(checked, e);
      this.$emit('click', checked, e);
    },
    handleKeyDown: function handleKeyDown(e) {
      if (e.keyCode === 37) {
        // Left
        this.setChecked(false, e);
      } else if (e.keyCode === 39) {
        // Right
        this.setChecked(true, e);
      }
    },
    handleMouseUp: function handleMouseUp(e) {
      if (this.$refs.refSwitchNode) {
        this.$refs.refSwitchNode.blur();
      }
      this.$emit('mouseup', e);
    },
    focus: function focus() {
      this.$refs.refSwitchNode.focus();
    },
    blur: function blur() {
      this.$refs.refSwitchNode.blur();
    }
  },
  render: function render() {
    var _switchClassName;

    var h = arguments[0];

    var _getOptionProps = (0, _propsUtil.getOptionProps)(this),
        prefixCls = _getOptionProps.prefixCls,
        disabled = _getOptionProps.disabled,
        loadingIcon = _getOptionProps.loadingIcon,
        tabIndex = _getOptionProps.tabIndex,
        restProps = (0, _objectWithoutProperties3['default'])(_getOptionProps, ['prefixCls', 'disabled', 'loadingIcon', 'tabIndex']);

    var checked = this.stateChecked;
    var switchClassName = (_switchClassName = {}, (0, _defineProperty3['default'])(_switchClassName, prefixCls, true), (0, _defineProperty3['default'])(_switchClassName, prefixCls + '-checked', checked), (0, _defineProperty3['default'])(_switchClassName, prefixCls + '-disabled', disabled), _switchClassName);
    var spanProps = {
      props: (0, _extends3['default'])({}, restProps),
      on: (0, _extends3['default'])({}, this.$listeners, {
        keydown: this.handleKeyDown,
        click: this.handleClick,
        mouseup: this.handleMouseUp
      }),
      attrs: {
        type: 'button',
        role: 'switch',
        'aria-checked': checked,
        disabled: disabled,
        tabIndex: tabIndex
      },
      'class': switchClassName,
      ref: 'refSwitchNode'
    };
    return h(
      'button',
      spanProps,
      [loadingIcon, h(
        'span',
        { 'class': prefixCls + '-inner' },
        [checked ? (0, _propsUtil.getComponentFromProp)(this, 'checkedChildren') : (0, _propsUtil.getComponentFromProp)(this, 'unCheckedChildren')]
      )]
    );
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-switch/index.js":
/*!************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-switch/index.js ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _Switch = __webpack_require__(/*! ./Switch */ "./node_modules/ant-design-vue/lib/vc-switch/Switch.js");

var _Switch2 = _interopRequireDefault(_Switch);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports['default'] = _Switch2['default']; // base rc-switch 1.9.0

/***/ })

}]);