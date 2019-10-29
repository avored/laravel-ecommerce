(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[37],{

/***/ "./node_modules/ant-design-vue/lib/tag/CheckableTag.js":
/*!*************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/tag/CheckableTag.js ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _defineProperty2 = __webpack_require__(/*! babel-runtime/helpers/defineProperty */ "./node_modules/babel-runtime/helpers/defineProperty.js");

var _defineProperty3 = _interopRequireDefault(_defineProperty2);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports['default'] = {
  name: 'ACheckableTag',
  model: {
    prop: 'checked'
  },
  props: {
    prefixCls: {
      'default': 'ant-tag',
      type: String
    },
    checked: Boolean
  },
  computed: {
    classes: function classes() {
      var _ref;

      var prefixCls = this.prefixCls,
          checked = this.checked;

      return _ref = {}, (0, _defineProperty3['default'])(_ref, '' + prefixCls, true), (0, _defineProperty3['default'])(_ref, prefixCls + '-checkable', true), (0, _defineProperty3['default'])(_ref, prefixCls + '-checkable-checked', checked), _ref;
    }
  },
  methods: {
    handleClick: function handleClick() {
      var checked = this.checked;

      this.$emit('input', !checked);
      this.$emit('change', !checked);
    }
  },
  render: function render() {
    var h = arguments[0];
    var classes = this.classes,
        handleClick = this.handleClick,
        $slots = this.$slots;

    return h(
      'div',
      { 'class': classes, on: {
          'click': handleClick
        }
      },
      [$slots['default']]
    );
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/tag/Tag.js":
/*!****************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/tag/Tag.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _babelHelperVueJsxMergeProps = __webpack_require__(/*! babel-helper-vue-jsx-merge-props */ "./node_modules/babel-helper-vue-jsx-merge-props/index.js");

var _babelHelperVueJsxMergeProps2 = _interopRequireDefault(_babelHelperVueJsxMergeProps);

var _defineProperty2 = __webpack_require__(/*! babel-runtime/helpers/defineProperty */ "./node_modules/babel-runtime/helpers/defineProperty.js");

var _defineProperty3 = _interopRequireDefault(_defineProperty2);

var _vueTypes = __webpack_require__(/*! ../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _icon = __webpack_require__(/*! ../icon */ "./node_modules/ant-design-vue/lib/icon/index.js");

var _icon2 = _interopRequireDefault(_icon);

var _getTransitionProps = __webpack_require__(/*! ../_util/getTransitionProps */ "./node_modules/ant-design-vue/lib/_util/getTransitionProps.js");

var _getTransitionProps2 = _interopRequireDefault(_getTransitionProps);

var _omit = __webpack_require__(/*! omit.js */ "./node_modules/omit.js/es/index.js");

var _omit2 = _interopRequireDefault(_omit);

var _wave = __webpack_require__(/*! ../_util/wave */ "./node_modules/ant-design-vue/lib/_util/wave.js");

var _wave2 = _interopRequireDefault(_wave);

var _propsUtil = __webpack_require__(/*! ../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

var _BaseMixin = __webpack_require__(/*! ../_util/BaseMixin */ "./node_modules/ant-design-vue/lib/_util/BaseMixin.js");

var _BaseMixin2 = _interopRequireDefault(_BaseMixin);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports['default'] = {
  name: 'ATag',
  mixins: [_BaseMixin2['default']],
  model: {
    prop: 'visible',
    event: 'close.visible'
  },
  props: {
    prefixCls: _vueTypes2['default'].string.def('ant-tag'),
    color: _vueTypes2['default'].string,
    closable: _vueTypes2['default'].bool.def(false),
    visible: _vueTypes2['default'].bool,
    afterClose: _vueTypes2['default'].func
  },
  data: function data() {
    var _visible = true;
    if ((0, _propsUtil.hasProp)(this, 'visible')) {
      _visible = this.visible;
    }
    return {
      _visible: _visible
    };
  },

  watch: {
    visible: function visible(val) {
      this.setState({
        _visible: val
      });
    }
  },
  methods: {
    setVisible: function setVisible(visible, e) {
      this.$emit('close', e);
      this.$emit('close.visible', false);
      if (e.defaultPrevented) {
        return;
      }
      if (!(0, _propsUtil.hasProp)(this, 'visible')) {
        this.setState({ _visible: visible });
      }
    },
    handleIconClick: function handleIconClick(e) {
      this.setVisible(false, e);
    },
    animationEnd: function animationEnd() {
      var afterClose = this.afterClose;
      if (afterClose) {
        afterClose();
      }
    },
    isPresetColor: function isPresetColor(color) {
      if (!color) {
        return false;
      }
      return (/^(pink|red|yellow|orange|cyan|green|blue|purple|geekblue|magenta|volcano|gold|lime)(-inverse)?$/.test(color)
      );
    },
    getTagStyle: function getTagStyle() {
      var color = this.$props.color;

      var isPresetColor = this.isPresetColor(color);
      return {
        backgroundColor: color && !isPresetColor ? color : undefined
      };
    },
    getTagClassName: function getTagClassName() {
      var _ref;

      var _$props = this.$props,
          prefixCls = _$props.prefixCls,
          color = _$props.color;

      var isPresetColor = this.isPresetColor(color);
      return _ref = {}, (0, _defineProperty3['default'])(_ref, prefixCls, true), (0, _defineProperty3['default'])(_ref, prefixCls + '-' + color, isPresetColor), (0, _defineProperty3['default'])(_ref, prefixCls + '-has-color', color && !isPresetColor), _ref;
    },
    renderCloseIcon: function renderCloseIcon() {
      var h = this.$createElement;
      var closable = this.$props.closable;

      return closable ? h(_icon2['default'], {
        attrs: { type: 'close' },
        on: {
          'click': this.handleIconClick
        }
      }) : null;
    }
  },

  render: function render() {
    var h = arguments[0];
    var prefixCls = this.$props.prefixCls;
    var visible = this.$data._visible;

    var tag = h(
      'div',
      (0, _babelHelperVueJsxMergeProps2['default'])([{
        directives: [{
          name: 'show',
          value: visible
        }]
      }, { on: (0, _omit2['default'])(this.$listeners, ['close']) }, {
        'class': this.getTagClassName(),
        style: this.getTagStyle()
      }]),
      [this.$slots['default'], this.renderCloseIcon()]
    );
    var transitionProps = (0, _getTransitionProps2['default'])(prefixCls + '-zoom', {
      appear: false,
      afterLeave: this.animationEnd
    });
    return h(_wave2['default'], [h(
      'transition',
      transitionProps,
      [tag]
    )]);
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/tag/index.js":
/*!******************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/tag/index.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _Tag = __webpack_require__(/*! ./Tag */ "./node_modules/ant-design-vue/lib/tag/Tag.js");

var _Tag2 = _interopRequireDefault(_Tag);

var _CheckableTag = __webpack_require__(/*! ./CheckableTag */ "./node_modules/ant-design-vue/lib/tag/CheckableTag.js");

var _CheckableTag2 = _interopRequireDefault(_CheckableTag);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

_Tag2['default'].CheckableTag = _CheckableTag2['default'];

/* istanbul ignore next */
_Tag2['default'].install = function (Vue) {
  Vue.component(_Tag2['default'].name, _Tag2['default']);
  Vue.component(_Tag2['default'].CheckableTag.name, _Tag2['default'].CheckableTag);
};

exports['default'] = _Tag2['default'];

/***/ })

}]);