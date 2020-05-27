(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[4],{

/***/ "./node_modules/ant-design-vue/lib/_util/easings.js":
/*!**********************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/_util/easings.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.easeInOutCubic = easeInOutCubic;
function easeInOutCubic(t, b, c, d) {
  var cc = c - b;
  t /= d / 2;
  if (t < 1) {
    return cc / 2 * t * t * t + b;
  }
  return cc / 2 * ((t -= 2) * t * t + 2) + b;
}

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/_util/getScroll.js":
/*!************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/_util/getScroll.js ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports['default'] = getScroll;
function getScroll(target, top) {
  if (typeof window === 'undefined') {
    return 0;
  }

  var prop = top ? 'pageYOffset' : 'pageXOffset';
  var method = top ? 'scrollTop' : 'scrollLeft';
  var isWindow = target === window;

  var ret = isWindow ? target[prop] : target[method];
  // ie6,7,8 standard mode
  if (isWindow && typeof ret !== 'number') {
    ret = window.document.documentElement[method];
  }

  return ret;
}

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/_util/scrollTo.js":
/*!***********************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/_util/scrollTo.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports['default'] = scrollTo;

var _raf = __webpack_require__(/*! raf */ "./node_modules/raf/index.js");

var _raf2 = _interopRequireDefault(_raf);

var _getScroll = __webpack_require__(/*! ./getScroll */ "./node_modules/ant-design-vue/lib/_util/getScroll.js");

var _getScroll2 = _interopRequireDefault(_getScroll);

var _easings = __webpack_require__(/*! ./easings */ "./node_modules/ant-design-vue/lib/_util/easings.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

// interface ScrollToOptions {
//   /** Scroll container, default as window */
//   getContainer?: () => HTMLElement | Window;
//   /** Scroll end callback */
//   callback?: () => any;
//   /** Animation duration, default as 450 */
//   duration?: number;
// }

function scrollTo(y) {
  var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
  var _options$getContainer = options.getContainer,
      getContainer = _options$getContainer === undefined ? function () {
    return window;
  } : _options$getContainer,
      callback = options.callback,
      _options$duration = options.duration,
      duration = _options$duration === undefined ? 450 : _options$duration;


  var container = getContainer();
  var scrollTop = (0, _getScroll2['default'])(container, true);
  var startTime = Date.now();

  var frameFunc = function frameFunc() {
    var timestamp = Date.now();
    var time = timestamp - startTime;
    var nextScrollTop = (0, _easings.easeInOutCubic)(time > duration ? duration : time, scrollTop, y, duration);
    if (container === window) {
      window.scrollTo(window.pageXOffset, nextScrollTop);
    } else {
      container.scrollTop = nextScrollTop;
    }
    if (time < duration) {
      (0, _raf2['default'])(frameFunc);
    } else if (typeof callback === 'function') {
      callback();
    }
  };
  (0, _raf2['default'])(frameFunc);
}

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/_util/transButton.js":
/*!**************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/_util/transButton.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _babelHelperVueJsxMergeProps = __webpack_require__(/*! babel-helper-vue-jsx-merge-props */ "./node_modules/babel-helper-vue-jsx-merge-props/index.js");

var _babelHelperVueJsxMergeProps2 = _interopRequireDefault(_babelHelperVueJsxMergeProps);

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _KeyCode = __webpack_require__(/*! ./KeyCode */ "./node_modules/ant-design-vue/lib/_util/KeyCode.js");

var _KeyCode2 = _interopRequireDefault(_KeyCode);

var _vueTypes = __webpack_require__(/*! ./vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

/**
 * Wrap of sub component which need use as Button capacity (like Icon component).
 * This helps accessibility reader to tread as a interactive button to operation.
 */
var inlineStyle = {
  border: 0,
  background: 'transparent',
  padding: 0,
  lineHeight: 'inherit',
  display: 'inline-block'
};

var TransButton = {
  props: {
    noStyle: _vueTypes2['default'].bool
  },

  methods: {
    onKeyDown: function onKeyDown(event) {
      var keyCode = event.keyCode;

      if (keyCode === _KeyCode2['default'].ENTER) {
        event.preventDefault();
      }
    },
    onKeyUp: function onKeyUp(event) {
      var keyCode = event.keyCode;

      if (keyCode === _KeyCode2['default'].ENTER) {
        this.$emit('click', event);
      }
    },
    setRef: function setRef(btn) {
      this.div = btn;
    },
    focus: function focus() {
      if (this.div) {
        this.div.focus();
      }
    },
    blur: function blur() {
      if (this.div) {
        this.div.blur();
      }
    }
  },

  render: function render() {
    var h = arguments[0];
    var noStyle = this.$props.noStyle;


    return h(
      'div',
      (0, _babelHelperVueJsxMergeProps2['default'])([{
        attrs: {
          role: 'button',
          tabIndex: 0
        }
      }, {
        directives: [{
          name: 'ant-ref',
          value: this.setRef
        }],
        on: (0, _extends3['default'])({}, this.$listeners, {
          keydown: this.onKeyDown,
          keyup: this.onKeyUp
        })
      }, {
        style: (0, _extends3['default'])({}, !noStyle ? inlineStyle : null)
      }]),
      [this.$slots['default']]
    );
  }
};

exports['default'] = TransButton;

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/pagination/MiniSelect.js":
/*!******************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/pagination/MiniSelect.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _select = __webpack_require__(/*! ../select */ "./node_modules/ant-design-vue/lib/select/index.js");

var _select2 = _interopRequireDefault(_select);

var _propsUtil = __webpack_require__(/*! ../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports['default'] = {
  props: (0, _extends3['default'])({}, _select.SelectProps),
  Option: _select2['default'].Option,
  render: function render() {
    var h = arguments[0];

    var selectOptionsProps = (0, _propsUtil.getOptionProps)(this);
    var selelctProps = {
      props: (0, _extends3['default'])({}, selectOptionsProps, {
        size: 'small'
      }),
      on: (0, _propsUtil.getListeners)(this)
    };
    return h(
      _select2['default'],
      selelctProps,
      [(0, _propsUtil.filterEmpty)(this.$slots['default'])]
    );
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/pagination/Pagination.js":
/*!******************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/pagination/Pagination.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.PaginationConfig = exports.PaginationProps = undefined;

var _objectWithoutProperties2 = __webpack_require__(/*! babel-runtime/helpers/objectWithoutProperties */ "./node_modules/babel-runtime/helpers/objectWithoutProperties.js");

var _objectWithoutProperties3 = _interopRequireDefault(_objectWithoutProperties2);

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _vueTypes = __webpack_require__(/*! ../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _select = __webpack_require__(/*! ../select */ "./node_modules/ant-design-vue/lib/select/index.js");

var _select2 = _interopRequireDefault(_select);

var _MiniSelect = __webpack_require__(/*! ./MiniSelect */ "./node_modules/ant-design-vue/lib/pagination/MiniSelect.js");

var _MiniSelect2 = _interopRequireDefault(_MiniSelect);

var _LocaleReceiver = __webpack_require__(/*! ../locale-provider/LocaleReceiver */ "./node_modules/ant-design-vue/lib/locale-provider/LocaleReceiver.js");

var _LocaleReceiver2 = _interopRequireDefault(_LocaleReceiver);

var _propsUtil = __webpack_require__(/*! ../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

var _vcPagination = __webpack_require__(/*! ../vc-pagination */ "./node_modules/ant-design-vue/lib/vc-pagination/index.js");

var _vcPagination2 = _interopRequireDefault(_vcPagination);

var _en_US = __webpack_require__(/*! ../vc-pagination/locale/en_US */ "./node_modules/ant-design-vue/lib/vc-pagination/locale/en_US.js");

var _en_US2 = _interopRequireDefault(_en_US);

var _icon = __webpack_require__(/*! ../icon */ "./node_modules/ant-design-vue/lib/icon/index.js");

var _icon2 = _interopRequireDefault(_icon);

var _configProvider = __webpack_require__(/*! ../config-provider */ "./node_modules/ant-design-vue/lib/config-provider/index.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var PaginationProps = exports.PaginationProps = function PaginationProps() {
  return {
    total: _vueTypes2['default'].number,
    defaultCurrent: _vueTypes2['default'].number,
    disabled: _vueTypes2['default'].bool,
    current: _vueTypes2['default'].number,
    defaultPageSize: _vueTypes2['default'].number,
    pageSize: _vueTypes2['default'].number,
    hideOnSinglePage: _vueTypes2['default'].bool,
    showSizeChanger: _vueTypes2['default'].bool,
    pageSizeOptions: _vueTypes2['default'].arrayOf(_vueTypes2['default'].oneOfType([_vueTypes2['default'].number, _vueTypes2['default'].string])),
    buildOptionText: _vueTypes2['default'].func,
    showSizeChange: _vueTypes2['default'].func,
    showQuickJumper: _vueTypes2['default'].oneOfType([_vueTypes2['default'].bool, _vueTypes2['default'].object]),
    showTotal: _vueTypes2['default'].any,
    size: _vueTypes2['default'].string,
    simple: _vueTypes2['default'].bool,
    locale: _vueTypes2['default'].object,
    prefixCls: _vueTypes2['default'].string,
    selectPrefixCls: _vueTypes2['default'].string,
    itemRender: _vueTypes2['default'].any,
    role: _vueTypes2['default'].string,
    showLessItems: _vueTypes2['default'].bool
  };
};

var PaginationConfig = exports.PaginationConfig = function PaginationConfig() {
  return (0, _extends3['default'])({}, PaginationProps(), {
    position: _vueTypes2['default'].oneOf(['top', 'bottom', 'both'])
  });
};

exports['default'] = {
  name: 'APagination',
  model: {
    prop: 'current',
    event: 'change.current'
  },
  props: (0, _extends3['default'])({}, PaginationProps()),
  inject: {
    configProvider: { 'default': function _default() {
        return _configProvider.ConfigConsumerProps;
      } }
  },
  methods: {
    getIconsProps: function getIconsProps(prefixCls) {
      var h = this.$createElement;

      var prevIcon = h(
        'a',
        { 'class': prefixCls + '-item-link' },
        [h(_icon2['default'], {
          attrs: { type: 'left' }
        })]
      );
      var nextIcon = h(
        'a',
        { 'class': prefixCls + '-item-link' },
        [h(_icon2['default'], {
          attrs: { type: 'right' }
        })]
      );
      var jumpPrevIcon = h(
        'a',
        { 'class': prefixCls + '-item-link' },
        [h(
          'div',
          { 'class': prefixCls + '-item-container' },
          [h(_icon2['default'], { 'class': prefixCls + '-item-link-icon', attrs: { type: 'double-left' }
          }), h(
            'span',
            { 'class': prefixCls + '-item-ellipsis' },
            ['\u2022\u2022\u2022']
          )]
        )]
      );
      var jumpNextIcon = h(
        'a',
        { 'class': prefixCls + '-item-link' },
        [h(
          'div',
          { 'class': prefixCls + '-item-container' },
          [h(_icon2['default'], { 'class': prefixCls + '-item-link-icon', attrs: { type: 'double-right' }
          }), h(
            'span',
            { 'class': prefixCls + '-item-ellipsis' },
            ['\u2022\u2022\u2022']
          )]
        )]
      );
      return {
        prevIcon: prevIcon,
        nextIcon: nextIcon,
        jumpPrevIcon: jumpPrevIcon,
        jumpNextIcon: jumpNextIcon
      };
    },
    renderPagination: function renderPagination(contextLocale) {
      var h = this.$createElement;

      var _getOptionProps = (0, _propsUtil.getOptionProps)(this),
          customizePrefixCls = _getOptionProps.prefixCls,
          customizeSelectPrefixCls = _getOptionProps.selectPrefixCls,
          buildOptionText = _getOptionProps.buildOptionText,
          size = _getOptionProps.size,
          customLocale = _getOptionProps.locale,
          restProps = (0, _objectWithoutProperties3['default'])(_getOptionProps, ['prefixCls', 'selectPrefixCls', 'buildOptionText', 'size', 'locale']);

      var getPrefixCls = this.configProvider.getPrefixCls;
      var prefixCls = getPrefixCls('pagination', customizePrefixCls);
      var selectPrefixCls = getPrefixCls('select', customizeSelectPrefixCls);

      var isSmall = size === 'small';
      var paginationProps = {
        props: (0, _extends3['default'])({
          prefixCls: prefixCls,
          selectPrefixCls: selectPrefixCls
        }, restProps, this.getIconsProps(prefixCls), {
          selectComponentClass: isSmall ? _MiniSelect2['default'] : _select2['default'],
          locale: (0, _extends3['default'])({}, contextLocale, customLocale),
          buildOptionText: buildOptionText || this.$scopedSlots.buildOptionText
        }),
        'class': {
          mini: isSmall
        },
        on: (0, _propsUtil.getListeners)(this)
      };

      return h(_vcPagination2['default'], paginationProps);
    }
  },
  render: function render() {
    var h = arguments[0];

    return h(_LocaleReceiver2['default'], {
      attrs: {
        componentName: 'Pagination',
        defaultLocale: _en_US2['default']
      },
      scopedSlots: { 'default': this.renderPagination }
    });
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/pagination/index.js":
/*!*************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/pagination/index.js ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.PaginationConfig = exports.PaginationProps = undefined;

var _Pagination = __webpack_require__(/*! ./Pagination */ "./node_modules/ant-design-vue/lib/pagination/Pagination.js");

Object.defineProperty(exports, 'PaginationProps', {
  enumerable: true,
  get: function get() {
    return _Pagination.PaginationProps;
  }
});
Object.defineProperty(exports, 'PaginationConfig', {
  enumerable: true,
  get: function get() {
    return _Pagination.PaginationConfig;
  }
});

var _Pagination2 = _interopRequireDefault(_Pagination);

var _base = __webpack_require__(/*! ../base */ "./node_modules/ant-design-vue/lib/base/index.js");

var _base2 = _interopRequireDefault(_base);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

/* istanbul ignore next */
_Pagination2['default'].install = function (Vue) {
  Vue.use(_base2['default']);
  Vue.component(_Pagination2['default'].name, _Pagination2['default']);
};

exports['default'] = _Pagination2['default'];

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/spin/Spin.js":
/*!******************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/spin/Spin.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.SpinProps = exports.SpinSize = undefined;

var _babelHelperVueJsxMergeProps = __webpack_require__(/*! babel-helper-vue-jsx-merge-props */ "./node_modules/babel-helper-vue-jsx-merge-props/index.js");

var _babelHelperVueJsxMergeProps2 = _interopRequireDefault(_babelHelperVueJsxMergeProps);

var _defineProperty2 = __webpack_require__(/*! babel-runtime/helpers/defineProperty */ "./node_modules/babel-runtime/helpers/defineProperty.js");

var _defineProperty3 = _interopRequireDefault(_defineProperty2);

var _objectWithoutProperties2 = __webpack_require__(/*! babel-runtime/helpers/objectWithoutProperties */ "./node_modules/babel-runtime/helpers/objectWithoutProperties.js");

var _objectWithoutProperties3 = _interopRequireDefault(_objectWithoutProperties2);

exports.setDefaultIndicator = setDefaultIndicator;

var _debounce = __webpack_require__(/*! lodash/debounce */ "./node_modules/lodash/debounce.js");

var _debounce2 = _interopRequireDefault(_debounce);

var _vueTypes = __webpack_require__(/*! ../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _BaseMixin = __webpack_require__(/*! ../_util/BaseMixin */ "./node_modules/ant-design-vue/lib/_util/BaseMixin.js");

var _BaseMixin2 = _interopRequireDefault(_BaseMixin);

var _propsUtil = __webpack_require__(/*! ../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

var _vnode = __webpack_require__(/*! ../_util/vnode */ "./node_modules/ant-design-vue/lib/_util/vnode.js");

var _configProvider = __webpack_require__(/*! ../config-provider */ "./node_modules/ant-design-vue/lib/config-provider/index.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var SpinSize = exports.SpinSize = _vueTypes2['default'].oneOf(['small', 'default', 'large']);

var SpinProps = exports.SpinProps = function SpinProps() {
  return {
    prefixCls: _vueTypes2['default'].string,
    spinning: _vueTypes2['default'].bool,
    size: SpinSize,
    wrapperClassName: _vueTypes2['default'].string,
    tip: _vueTypes2['default'].string,
    delay: _vueTypes2['default'].number,
    indicator: _vueTypes2['default'].any
  };
};

// Render indicator
var defaultIndicator = void 0;

function shouldDelay(spinning, delay) {
  return !!spinning && !!delay && !isNaN(Number(delay));
}

function setDefaultIndicator(Content) {
  defaultIndicator = typeof Content.indicator === 'function' ? Content.indicator : function (h) {
    return h(Content.indicator);
  };
}

exports['default'] = {
  name: 'ASpin',
  mixins: [_BaseMixin2['default']],
  props: (0, _propsUtil.initDefaultProps)(SpinProps(), {
    size: 'default',
    spinning: true,
    wrapperClassName: ''
  }),
  inject: {
    configProvider: { 'default': function _default() {
        return _configProvider.ConfigConsumerProps;
      } }
  },
  data: function data() {
    var spinning = this.spinning,
        delay = this.delay;

    var shouldBeDelayed = shouldDelay(spinning, delay);
    this.originalUpdateSpinning = this.updateSpinning;
    this.debouncifyUpdateSpinning(this.$props);
    return {
      sSpinning: spinning && !shouldBeDelayed
    };
  },
  mounted: function mounted() {
    this.updateSpinning();
  },
  updated: function updated() {
    var _this = this;

    this.$nextTick(function () {
      _this.debouncifyUpdateSpinning();
      _this.updateSpinning();
    });
  },
  beforeDestroy: function beforeDestroy() {
    this.cancelExistingSpin();
  },

  methods: {
    debouncifyUpdateSpinning: function debouncifyUpdateSpinning(props) {
      var _ref = props || this.$props,
          delay = _ref.delay;

      if (delay) {
        this.cancelExistingSpin();
        this.updateSpinning = (0, _debounce2['default'])(this.originalUpdateSpinning, delay);
      }
    },
    updateSpinning: function updateSpinning() {
      var spinning = this.spinning,
          sSpinning = this.sSpinning;

      if (sSpinning !== spinning) {
        this.setState({ sSpinning: spinning });
      }
    },
    cancelExistingSpin: function cancelExistingSpin() {
      var updateSpinning = this.updateSpinning;

      if (updateSpinning && updateSpinning.cancel) {
        updateSpinning.cancel();
      }
    },
    getChildren: function getChildren() {
      if (this.$slots && this.$slots['default']) {
        return (0, _propsUtil.filterEmpty)(this.$slots['default']);
      }
      return null;
    },
    renderIndicator: function renderIndicator(h, prefixCls) {
      // const h = this.$createElement
      var dotClassName = prefixCls + '-dot';
      var indicator = (0, _propsUtil.getComponentFromProp)(this, 'indicator');
      // should not be render default indicator when indicator value is null
      if (indicator === null) {
        return null;
      }
      if (Array.isArray(indicator)) {
        indicator = (0, _propsUtil.filterEmpty)(indicator);
        indicator = indicator.length === 1 ? indicator[0] : indicator;
      }
      if ((0, _propsUtil.isValidElement)(indicator)) {
        return (0, _vnode.cloneElement)(indicator, { 'class': dotClassName });
      }

      if (defaultIndicator && (0, _propsUtil.isValidElement)(defaultIndicator(h))) {
        return (0, _vnode.cloneElement)(defaultIndicator(h), { 'class': dotClassName });
      }

      return h(
        'span',
        { 'class': dotClassName + ' ' + prefixCls + '-dot-spin' },
        [h('i', { 'class': prefixCls + '-dot-item' }), h('i', { 'class': prefixCls + '-dot-item' }), h('i', { 'class': prefixCls + '-dot-item' }), h('i', { 'class': prefixCls + '-dot-item' })]
      );
    }
  },
  render: function render(h) {
    var _spinClassName;

    var _$props = this.$props,
        size = _$props.size,
        customizePrefixCls = _$props.prefixCls,
        tip = _$props.tip,
        wrapperClassName = _$props.wrapperClassName,
        restProps = (0, _objectWithoutProperties3['default'])(_$props, ['size', 'prefixCls', 'tip', 'wrapperClassName']);

    var getPrefixCls = this.configProvider.getPrefixCls;
    var prefixCls = getPrefixCls('spin', customizePrefixCls);

    var sSpinning = this.sSpinning;

    var spinClassName = (_spinClassName = {}, (0, _defineProperty3['default'])(_spinClassName, prefixCls, true), (0, _defineProperty3['default'])(_spinClassName, prefixCls + '-sm', size === 'small'), (0, _defineProperty3['default'])(_spinClassName, prefixCls + '-lg', size === 'large'), (0, _defineProperty3['default'])(_spinClassName, prefixCls + '-spinning', sSpinning), (0, _defineProperty3['default'])(_spinClassName, prefixCls + '-show-text', !!tip), _spinClassName);

    var spinElement = h(
      'div',
      (0, _babelHelperVueJsxMergeProps2['default'])([restProps, { 'class': spinClassName }]),
      [this.renderIndicator(h, prefixCls), tip ? h(
        'div',
        { 'class': prefixCls + '-text' },
        [tip]
      ) : null]
    );
    var children = this.getChildren();
    if (children) {
      var _containerClassName;

      var containerClassName = (_containerClassName = {}, (0, _defineProperty3['default'])(_containerClassName, prefixCls + '-container', true), (0, _defineProperty3['default'])(_containerClassName, prefixCls + '-blur', sSpinning), _containerClassName);

      return h(
        'div',
        (0, _babelHelperVueJsxMergeProps2['default'])([{ on: (0, _propsUtil.getListeners)(this) }, {
          'class': [prefixCls + '-nested-loading', wrapperClassName]
        }]),
        [sSpinning && h(
          'div',
          { key: 'loading' },
          [spinElement]
        ), h(
          'div',
          { 'class': containerClassName, key: 'container' },
          [children]
        )]
      );
    }
    return spinElement;
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/spin/index.js":
/*!*******************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/spin/index.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.SpinProps = undefined;

var _Spin = __webpack_require__(/*! ./Spin */ "./node_modules/ant-design-vue/lib/spin/Spin.js");

Object.defineProperty(exports, 'SpinProps', {
  enumerable: true,
  get: function get() {
    return _Spin.SpinProps;
  }
});

var _Spin2 = _interopRequireDefault(_Spin);

var _base = __webpack_require__(/*! ../base */ "./node_modules/ant-design-vue/lib/base/index.js");

var _base2 = _interopRequireDefault(_base);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

_Spin2['default'].setDefaultIndicator = _Spin.setDefaultIndicator;

/* istanbul ignore next */
_Spin2['default'].install = function (Vue) {
  Vue.use(_base2['default']);
  Vue.component(_Spin2['default'].name, _Spin2['default']);
};

exports['default'] = _Spin2['default'];

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/table/Column.js":
/*!*********************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/table/Column.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _interface = __webpack_require__(/*! ./interface */ "./node_modules/ant-design-vue/lib/table/interface.js");

exports['default'] = {
  name: 'ATableColumn',
  props: _interface.ColumnProps
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/table/ColumnGroup.js":
/*!**************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/table/ColumnGroup.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _vueTypes = __webpack_require__(/*! ../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports['default'] = {
  name: 'ATableColumnGroup',
  props: {
    title: _vueTypes2['default'].any
  },
  __ANT_TABLE_COLUMN_GROUP: true
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/table/FilterDropdownMenuWrapper.js":
/*!****************************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/table/FilterDropdownMenuWrapper.js ***!
  \****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports['default'] = {
  name: 'FilterDropdownMenuWrapper',
  methods: {
    handelClick: function handelClick(e) {
      e.stopPropagation();
      //this.$emit('click', e);
    }
  },
  render: function render() {
    var h = arguments[0];
    var $slots = this.$slots,
        handelClick = this.handelClick;

    return h(
      'div',
      {
        on: {
          'click': handelClick
        }
      },
      [$slots['default']]
    );
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/table/SelectionBox.js":
/*!***************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/table/SelectionBox.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _objectWithoutProperties2 = __webpack_require__(/*! babel-runtime/helpers/objectWithoutProperties */ "./node_modules/babel-runtime/helpers/objectWithoutProperties.js");

var _objectWithoutProperties3 = _interopRequireDefault(_objectWithoutProperties2);

var _checkbox = __webpack_require__(/*! ../checkbox */ "./node_modules/ant-design-vue/lib/checkbox/index.js");

var _checkbox2 = _interopRequireDefault(_checkbox);

var _radio = __webpack_require__(/*! ../radio */ "./node_modules/ant-design-vue/lib/radio/index.js");

var _radio2 = _interopRequireDefault(_radio);

var _interface = __webpack_require__(/*! ./interface */ "./node_modules/ant-design-vue/lib/table/interface.js");

var _BaseMixin = __webpack_require__(/*! ../_util/BaseMixin */ "./node_modules/ant-design-vue/lib/_util/BaseMixin.js");

var _BaseMixin2 = _interopRequireDefault(_BaseMixin);

var _propsUtil = __webpack_require__(/*! ../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports['default'] = {
  name: 'SelectionBox',
  mixins: [_BaseMixin2['default']],
  props: _interface.SelectionBoxProps,
  data: function data() {
    return {
      checked: this.getCheckState(this.$props)
    };
  },
  mounted: function mounted() {
    this.subscribe();
  },
  beforeDestroy: function beforeDestroy() {
    if (this.unsubscribe) {
      this.unsubscribe();
    }
  },

  methods: {
    getCheckState: function getCheckState(props) {
      var store = props.store,
          defaultSelection = props.defaultSelection,
          rowIndex = props.rowIndex;

      var checked = false;
      if (store.getState().selectionDirty) {
        checked = store.getState().selectedRowKeys.indexOf(rowIndex) >= 0;
      } else {
        checked = store.getState().selectedRowKeys.indexOf(rowIndex) >= 0 || defaultSelection.indexOf(rowIndex) >= 0;
      }
      return checked;
    },
    subscribe: function subscribe() {
      var _this = this;

      var store = this.store;

      this.unsubscribe = store.subscribe(function () {
        var checked = _this.getCheckState(_this.$props);
        _this.setState({ checked: checked });
      });
    }
  },

  render: function render() {
    var h = arguments[0];

    var _getOptionProps = (0, _propsUtil.getOptionProps)(this),
        type = _getOptionProps.type,
        rowIndex = _getOptionProps.rowIndex,
        rest = (0, _objectWithoutProperties3['default'])(_getOptionProps, ['type', 'rowIndex']);

    var checked = this.checked;

    var checkboxProps = {
      props: (0, _extends3['default'])({
        checked: checked
      }, rest),
      on: (0, _propsUtil.getListeners)(this)
    };
    if (type === 'radio') {
      checkboxProps.props.value = rowIndex;
      return h(_radio2['default'], checkboxProps);
    }
    return h(_checkbox2['default'], checkboxProps);
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/table/SelectionCheckboxAll.js":
/*!***********************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/table/SelectionCheckboxAll.js ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _defineProperty2 = __webpack_require__(/*! babel-runtime/helpers/defineProperty */ "./node_modules/babel-runtime/helpers/defineProperty.js");

var _defineProperty3 = _interopRequireDefault(_defineProperty2);

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _checkbox = __webpack_require__(/*! ../checkbox */ "./node_modules/ant-design-vue/lib/checkbox/index.js");

var _checkbox2 = _interopRequireDefault(_checkbox);

var _dropdown = __webpack_require__(/*! ../dropdown */ "./node_modules/ant-design-vue/lib/dropdown/index.js");

var _dropdown2 = _interopRequireDefault(_dropdown);

var _menu = __webpack_require__(/*! ../menu */ "./node_modules/ant-design-vue/lib/menu/index.js");

var _menu2 = _interopRequireDefault(_menu);

var _icon = __webpack_require__(/*! ../icon */ "./node_modules/ant-design-vue/lib/icon/index.js");

var _icon2 = _interopRequireDefault(_icon);

var _classnames = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");

var _classnames2 = _interopRequireDefault(_classnames);

var _interface = __webpack_require__(/*! ./interface */ "./node_modules/ant-design-vue/lib/table/interface.js");

var _BaseMixin = __webpack_require__(/*! ../_util/BaseMixin */ "./node_modules/ant-design-vue/lib/_util/BaseMixin.js");

var _BaseMixin2 = _interopRequireDefault(_BaseMixin);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

function checkSelection(_ref) {
  var store = _ref.store,
      getCheckboxPropsByItem = _ref.getCheckboxPropsByItem,
      getRecordKey = _ref.getRecordKey,
      data = _ref.data,
      type = _ref.type,
      byDefaultChecked = _ref.byDefaultChecked;

  return byDefaultChecked ? data[type](function (item, i) {
    return getCheckboxPropsByItem(item, i).defaultChecked;
  }) : data[type](function (item, i) {
    return store.getState().selectedRowKeys.indexOf(getRecordKey(item, i)) >= 0;
  });
}

function getIndeterminateState(props) {
  var store = props.store,
      data = props.data;

  if (!data.length) {
    return false;
  }

  var someCheckedNotByDefaultChecked = checkSelection((0, _extends3['default'])({}, props, {
    data: data,
    type: 'some',
    byDefaultChecked: false
  })) && !checkSelection((0, _extends3['default'])({}, props, {
    data: data,
    type: 'every',
    byDefaultChecked: false
  }));
  var someCheckedByDefaultChecked = checkSelection((0, _extends3['default'])({}, props, {
    data: data,
    type: 'some',
    byDefaultChecked: true
  })) && !checkSelection((0, _extends3['default'])({}, props, {
    data: data,
    type: 'every',
    byDefaultChecked: true
  }));

  if (store.getState().selectionDirty) {
    return someCheckedNotByDefaultChecked;
  }
  return someCheckedNotByDefaultChecked || someCheckedByDefaultChecked;
}

function getCheckState(props) {
  var store = props.store,
      data = props.data;

  if (!data.length) {
    return false;
  }
  if (store.getState().selectionDirty) {
    return checkSelection((0, _extends3['default'])({}, props, {
      data: data,
      type: 'every',
      byDefaultChecked: false
    }));
  }
  return checkSelection((0, _extends3['default'])({}, props, {
    data: data,
    type: 'every',
    byDefaultChecked: false
  })) || checkSelection((0, _extends3['default'])({}, props, {
    data: data,
    type: 'every',
    byDefaultChecked: true
  }));
}

exports['default'] = {
  name: 'SelectionCheckboxAll',
  mixins: [_BaseMixin2['default']],
  props: _interface.SelectionCheckboxAllProps,
  data: function data() {
    var props = this.$props;

    this.defaultSelections = props.hideDefaultSelections ? [] : [{
      key: 'all',
      text: props.locale.selectAll
    }, {
      key: 'invert',
      text: props.locale.selectInvert
    }];

    return {
      checked: getCheckState(props),
      indeterminate: getIndeterminateState(props)
    };
  },


  watch: {
    $props: {
      handler: function handler() {
        this.setCheckState(this.$props);
      },

      deep: true
    }
  },

  mounted: function mounted() {
    this.subscribe();
  },
  beforeDestroy: function beforeDestroy() {
    if (this.unsubscribe) {
      this.unsubscribe();
    }
  },

  methods: {
    checkSelection: function checkSelection(props, data, type, byDefaultChecked) {
      var _ref2 = props || this.$props,
          store = _ref2.store,
          getCheckboxPropsByItem = _ref2.getCheckboxPropsByItem,
          getRecordKey = _ref2.getRecordKey;
      // type should be 'every' | 'some'


      if (type === 'every' || type === 'some') {
        return byDefaultChecked ? data[type](function (item, i) {
          return getCheckboxPropsByItem(item, i).props.defaultChecked;
        }) : data[type](function (item, i) {
          return store.getState().selectedRowKeys.indexOf(getRecordKey(item, i)) >= 0;
        });
      }
      return false;
    },
    setCheckState: function setCheckState(props) {
      var checked = getCheckState(props);
      var indeterminate = getIndeterminateState(props);
      this.setState(function (prevState) {
        var newState = {};
        if (indeterminate !== prevState.indeterminate) {
          newState.indeterminate = indeterminate;
        }
        if (checked !== prevState.checked) {
          newState.checked = checked;
        }
        return newState;
      });
    },
    handleSelectAllChange: function handleSelectAllChange(e) {
      var checked = e.target.checked;

      this.$emit('select', checked ? 'all' : 'removeAll', 0, null);
    },
    subscribe: function subscribe() {
      var _this = this;

      var store = this.store;

      this.unsubscribe = store.subscribe(function () {
        _this.setCheckState(_this.$props);
      });
    },
    renderMenus: function renderMenus(selections) {
      var _this2 = this;

      var h = this.$createElement;

      return selections.map(function (selection, index) {
        return h(
          _menu2['default'].Item,
          { key: selection.key || index },
          [h(
            'div',
            {
              on: {
                'click': function click() {
                  _this2.$emit('select', selection.key, index, selection.onSelect);
                }
              }
            },
            [selection.text]
          )]
        );
      });
    }
  },

  render: function render() {
    var h = arguments[0];
    var disabled = this.disabled,
        prefixCls = this.prefixCls,
        selections = this.selections,
        getPopupContainer = this.getPopupContainer,
        checked = this.checked,
        indeterminate = this.indeterminate;


    var selectionPrefixCls = prefixCls + '-selection';

    var customSelections = null;

    if (selections) {
      var newSelections = Array.isArray(selections) ? this.defaultSelections.concat(selections) : this.defaultSelections;

      var menu = h(
        _menu2['default'],
        { 'class': selectionPrefixCls + '-menu', attrs: { selectedKeys: [] }
        },
        [this.renderMenus(newSelections)]
      );

      customSelections = newSelections.length > 0 ? h(
        _dropdown2['default'],
        {
          attrs: { getPopupContainer: getPopupContainer }
        },
        [h(
          'template',
          { slot: 'overlay' },
          [menu]
        ), h(
          'div',
          { 'class': selectionPrefixCls + '-down' },
          [h(_icon2['default'], {
            attrs: { type: 'down' }
          })]
        )]
      ) : null;
    }

    return h(
      'div',
      { 'class': selectionPrefixCls },
      [h(_checkbox2['default'], {
        'class': (0, _classnames2['default'])((0, _defineProperty3['default'])({}, selectionPrefixCls + '-select-all-custom', customSelections)),
        attrs: { checked: checked,
          indeterminate: indeterminate,
          disabled: disabled
        },
        on: {
          'change': this.handleSelectAllChange
        }
      }), customSelections]
    );
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/table/Table.js":
/*!********************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/table/Table.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _objectWithoutProperties2 = __webpack_require__(/*! babel-runtime/helpers/objectWithoutProperties */ "./node_modules/babel-runtime/helpers/objectWithoutProperties.js");

var _objectWithoutProperties3 = _interopRequireDefault(_objectWithoutProperties2);

var _defineProperty2 = __webpack_require__(/*! babel-runtime/helpers/defineProperty */ "./node_modules/babel-runtime/helpers/defineProperty.js");

var _defineProperty3 = _interopRequireDefault(_defineProperty2);

var _toConsumableArray2 = __webpack_require__(/*! babel-runtime/helpers/toConsumableArray */ "./node_modules/babel-runtime/helpers/toConsumableArray.js");

var _toConsumableArray3 = _interopRequireDefault(_toConsumableArray2);

var _typeof2 = __webpack_require__(/*! babel-runtime/helpers/typeof */ "./node_modules/babel-runtime/helpers/typeof.js");

var _typeof3 = _interopRequireDefault(_typeof2);

var _extends4 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends5 = _interopRequireDefault(_extends4);

var _vcTable = __webpack_require__(/*! ../vc-table */ "./node_modules/ant-design-vue/lib/vc-table/index.js");

var _vcTable2 = _interopRequireDefault(_vcTable);

var _classnames = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");

var _classnames2 = _interopRequireDefault(_classnames);

var _shallowequal = __webpack_require__(/*! shallowequal */ "./node_modules/shallowequal/index.js");

var _shallowequal2 = _interopRequireDefault(_shallowequal);

var _filterDropdown = __webpack_require__(/*! ./filterDropdown */ "./node_modules/ant-design-vue/lib/table/filterDropdown.js");

var _filterDropdown2 = _interopRequireDefault(_filterDropdown);

var _createStore = __webpack_require__(/*! ./createStore */ "./node_modules/ant-design-vue/lib/table/createStore.js");

var _createStore2 = _interopRequireDefault(_createStore);

var _SelectionBox = __webpack_require__(/*! ./SelectionBox */ "./node_modules/ant-design-vue/lib/table/SelectionBox.js");

var _SelectionBox2 = _interopRequireDefault(_SelectionBox);

var _SelectionCheckboxAll = __webpack_require__(/*! ./SelectionCheckboxAll */ "./node_modules/ant-design-vue/lib/table/SelectionCheckboxAll.js");

var _SelectionCheckboxAll2 = _interopRequireDefault(_SelectionCheckboxAll);

var _Column = __webpack_require__(/*! ./Column */ "./node_modules/ant-design-vue/lib/table/Column.js");

var _Column2 = _interopRequireDefault(_Column);

var _ColumnGroup = __webpack_require__(/*! ./ColumnGroup */ "./node_modules/ant-design-vue/lib/table/ColumnGroup.js");

var _ColumnGroup2 = _interopRequireDefault(_ColumnGroup);

var _createBodyRow = __webpack_require__(/*! ./createBodyRow */ "./node_modules/ant-design-vue/lib/table/createBodyRow.js");

var _createBodyRow2 = _interopRequireDefault(_createBodyRow);

var _util = __webpack_require__(/*! ./util */ "./node_modules/ant-design-vue/lib/table/util.js");

var _propsUtil = __webpack_require__(/*! ../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

var _BaseMixin = __webpack_require__(/*! ../_util/BaseMixin */ "./node_modules/ant-design-vue/lib/_util/BaseMixin.js");

var _BaseMixin2 = _interopRequireDefault(_BaseMixin);

var _configProvider2 = __webpack_require__(/*! ../config-provider */ "./node_modules/ant-design-vue/lib/config-provider/index.js");

var _interface = __webpack_require__(/*! ./interface */ "./node_modules/ant-design-vue/lib/table/interface.js");

var _pagination = __webpack_require__(/*! ../pagination */ "./node_modules/ant-design-vue/lib/pagination/index.js");

var _pagination2 = _interopRequireDefault(_pagination);

var _icon = __webpack_require__(/*! ../icon */ "./node_modules/ant-design-vue/lib/icon/index.js");

var _icon2 = _interopRequireDefault(_icon);

var _spin = __webpack_require__(/*! ../spin */ "./node_modules/ant-design-vue/lib/spin/index.js");

var _spin2 = _interopRequireDefault(_spin);

var _LocaleReceiver = __webpack_require__(/*! ../locale-provider/LocaleReceiver */ "./node_modules/ant-design-vue/lib/locale-provider/LocaleReceiver.js");

var _LocaleReceiver2 = _interopRequireDefault(_LocaleReceiver);

var _default2 = __webpack_require__(/*! ../locale-provider/default */ "./node_modules/ant-design-vue/lib/locale-provider/default.js");

var _default3 = _interopRequireDefault(_default2);

var _warning = __webpack_require__(/*! ../_util/warning */ "./node_modules/ant-design-vue/lib/_util/warning.js");

var _warning2 = _interopRequireDefault(_warning);

var _scrollTo = __webpack_require__(/*! ../_util/scrollTo */ "./node_modules/ant-design-vue/lib/_util/scrollTo.js");

var _scrollTo2 = _interopRequireDefault(_scrollTo);

var _transButton = __webpack_require__(/*! ../_util/transButton */ "./node_modules/ant-design-vue/lib/_util/transButton.js");

var _transButton2 = _interopRequireDefault(_transButton);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

function noop() {}

function stopPropagation(e) {
  e.stopPropagation();
}

function getRowSelection(props) {
  return props.rowSelection || {};
}

function getColumnKey(column, index) {
  return column.key || column.dataIndex || index;
}

function isSameColumn(a, b) {
  if (a && b && a.key && a.key === b.key) {
    return true;
  }
  return a === b || (0, _shallowequal2['default'])(a, b, function (value, other) {
    // https://github.com/ant-design/ant-design/issues/12737
    if (typeof value === 'function' && typeof other === 'function') {
      return value === other || value.toString() === other.toString();
    }
    // https://github.com/ant-design/ant-design/issues/19398
    if (Array.isArray(value) && Array.isArray(other)) {
      return value === other || (0, _shallowequal2['default'])(value, other);
    }
  });
}

var defaultPagination = {
  onChange: noop,
  onShowSizeChange: noop
};

/**
 * Avoid creating new object, so that parent component's shouldComponentUpdate
 * can works appropriately。
 */
var emptyObject = {};

var createComponents = function createComponents() {
  var components = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

  var bodyRow = components && components.body && components.body.row;
  return (0, _extends5['default'])({}, components, {
    body: (0, _extends5['default'])({}, components.body, {
      row: (0, _createBodyRow2['default'])(bodyRow)
    })
  });
};

function isTheSameComponents() {
  var components1 = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
  var components2 = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

  return components1 === components2 || ['table', 'header', 'body'].every(function (key) {
    return (0, _shallowequal2['default'])(components1[key], components2[key]);
  });
}

function getFilteredValueColumns(state, columns) {
  return (0, _util.flatFilter)(columns || (state || {}).columns || [], function (column) {
    return typeof column.filteredValue !== 'undefined';
  });
}

function getFiltersFromColumns(state, columns) {
  var filters = {};
  getFilteredValueColumns(state, columns).forEach(function (col) {
    var colKey = getColumnKey(col);
    filters[colKey] = col.filteredValue;
  });
  return filters;
}

function isFiltersChanged(state, filters) {
  if (Object.keys(filters).length !== Object.keys(state.filters).length) {
    return true;
  }
  return Object.keys(filters).some(function (columnKey) {
    return filters[columnKey] !== state.filters[columnKey];
  });
}

exports['default'] = {
  name: 'Table',
  Column: _Column2['default'],
  ColumnGroup: _ColumnGroup2['default'],
  mixins: [_BaseMixin2['default']],
  props: (0, _propsUtil.initDefaultProps)(_interface.TableProps, {
    dataSource: [],
    useFixedHeader: false,
    // rowSelection: null,
    size: 'default',
    loading: false,
    bordered: false,
    indentSize: 20,
    locale: {},
    rowKey: 'key',
    showHeader: true,
    sortDirections: ['ascend', 'descend'],
    childrenColumnName: 'children'
  }),

  inject: {
    configProvider: { 'default': function _default() {
        return _configProvider2.ConfigConsumerProps;
      } }
  },
  // CheckboxPropsCache: {
  //   [key: string]: any;
  // };
  // store: Store;
  // columns: ColumnProps<T>[];
  // components: TableComponents;

  data: function data() {
    // this.columns = props.columns || normalizeColumns(props.children)
    var props = (0, _propsUtil.getOptionProps)(this);
    (0, _warning2['default'])(!props.expandedRowRender || !('scroll' in props), '`expandedRowRender` and `scroll` are not compatible. Please use one of them at one time.');
    this.CheckboxPropsCache = {};

    this.store = (0, _createStore2['default'])({
      selectedRowKeys: getRowSelection(this.$props).selectedRowKeys || [],
      selectionDirty: false
    });
    return (0, _extends5['default'])({}, this.getDefaultSortOrder(props.columns || []), {
      // 减少状态
      sFilters: this.getDefaultFilters(props.columns),
      sPagination: this.getDefaultPagination(this.$props),
      pivot: undefined,
      sComponents: createComponents(this.components),
      filterDataCnt: 0
    });
  },

  watch: {
    pagination: {
      handler: function handler(val) {
        this.setState(function (previousState) {
          var newPagination = (0, _extends5['default'])({}, defaultPagination, previousState.sPagination, val);
          newPagination.current = newPagination.current || 1;
          newPagination.pageSize = newPagination.pageSize || 10;
          return { sPagination: val !== false ? newPagination : emptyObject };
        });
      },

      deep: true
    },
    rowSelection: {
      handler: function handler(val, oldVal) {
        if (val && 'selectedRowKeys' in val) {
          this.store.setState({
            selectedRowKeys: val.selectedRowKeys || []
          });
          var rowSelection = this.rowSelection;

          if (rowSelection && val.getCheckboxProps !== rowSelection.getCheckboxProps) {
            this.CheckboxPropsCache = {};
          }
        } else if (oldVal && !val) {
          this.store.setState({
            selectedRowKeys: []
          });
        }
      },

      deep: true
    },

    dataSource: function dataSource() {
      this.store.setState({
        selectionDirty: false
      });
      this.CheckboxPropsCache = {};
    },
    columns: function columns(val) {
      var filteredValueColumns = getFilteredValueColumns({ columns: val }, val);
      if (filteredValueColumns.length > 0) {
        var filtersFromColumns = getFiltersFromColumns({ columns: val }, val);
        var newFilters = (0, _extends5['default'])({}, this.sFilters);
        Object.keys(filtersFromColumns).forEach(function (key) {
          newFilters[key] = filtersFromColumns[key];
        });
        if (isFiltersChanged({ filters: this.sFilters }, newFilters)) {
          this.setState({ sFilters: newFilters });
        }
      }
    },

    components: {
      handler: function handler(val, oldVal) {
        if (!isTheSameComponents(val, oldVal)) {
          var components = createComponents(val);
          this.setState({ sComponents: components });
        }
      },

      deep: true
    }
  },
  updated: function updated() {
    var columns = this.columns,
        sortColumn = this.sSortColumn,
        sortOrder = this.sSortOrder;

    if (this.getSortOrderColumns(columns).length > 0) {
      var sortState = this.getSortStateFromColumns(columns);
      if (!isSameColumn(sortState.sSortColumn, sortColumn) || sortState.sSortOrder !== sortOrder) {
        this.setState(sortState);
      }
    }
  },

  methods: {
    getCheckboxPropsByItem: function getCheckboxPropsByItem(item, index) {
      var rowSelection = getRowSelection(this.$props);
      if (!rowSelection.getCheckboxProps) {
        return { props: {} };
      }
      var key = this.getRecordKey(item, index);
      // Cache checkboxProps
      if (!this.CheckboxPropsCache[key]) {
        this.CheckboxPropsCache[key] = rowSelection.getCheckboxProps(item);
      }
      this.CheckboxPropsCache[key].props = this.CheckboxPropsCache[key].props || {};
      return this.CheckboxPropsCache[key];
    },
    getDefaultSelection: function getDefaultSelection() {
      var _this = this;

      var rowSelection = getRowSelection(this.$props);
      if (!rowSelection.getCheckboxProps) {
        return [];
      }
      return this.getFlatData().filter(function (item, rowIndex) {
        return _this.getCheckboxPropsByItem(item, rowIndex).props.defaultChecked;
      }).map(function (record, rowIndex) {
        return _this.getRecordKey(record, rowIndex);
      });
    },
    getDefaultPagination: function getDefaultPagination(props) {
      var pagination = (0, _typeof3['default'])(props.pagination) === 'object' ? props.pagination : {};
      var current = void 0;
      if ('current' in pagination) {
        current = pagination.current;
      } else if ('defaultCurrent' in pagination) {
        current = pagination.defaultCurrent;
      }
      var pageSize = void 0;
      if ('pageSize' in pagination) {
        pageSize = pagination.pageSize;
      } else if ('defaultPageSize' in pagination) {
        pageSize = pagination.defaultPageSize;
      }
      return this.hasPagination(props) ? (0, _extends5['default'])({}, defaultPagination, pagination, {
        current: current || 1,
        pageSize: pageSize || 10
      }) : {};
    },
    getSortOrderColumns: function getSortOrderColumns(columns) {
      return (0, _util.flatFilter)(columns || this.columns || [], function (column) {
        return 'sortOrder' in column;
      });
    },
    getDefaultFilters: function getDefaultFilters(columns) {
      var definedFilters = getFiltersFromColumns({ columns: this.columns }, columns);

      var defaultFilteredValueColumns = (0, _util.flatFilter)(columns || [], function (column) {
        return typeof column.defaultFilteredValue !== 'undefined';
      });

      var defaultFilters = defaultFilteredValueColumns.reduce(function (soFar, col) {
        var colKey = getColumnKey(col);
        soFar[colKey] = col.defaultFilteredValue;
        return soFar;
      }, {});

      return (0, _extends5['default'])({}, defaultFilters, definedFilters);
    },
    getDefaultSortOrder: function getDefaultSortOrder(columns) {
      var definedSortState = this.getSortStateFromColumns(columns);

      var defaultSortedColumn = (0, _util.flatFilter)(columns || [], function (column) {
        return column.defaultSortOrder != null;
      })[0];

      if (defaultSortedColumn && !definedSortState.sortColumn) {
        return {
          sSortColumn: defaultSortedColumn,
          sSortOrder: defaultSortedColumn.defaultSortOrder
        };
      }

      return definedSortState;
    },
    getSortStateFromColumns: function getSortStateFromColumns(columns) {
      // return first column which sortOrder is not falsy
      var sortedColumn = this.getSortOrderColumns(columns).filter(function (col) {
        return col.sortOrder;
      })[0];

      if (sortedColumn) {
        return {
          sSortColumn: sortedColumn,
          sSortOrder: sortedColumn.sortOrder
        };
      }

      return {
        sSortColumn: null,
        sSortOrder: null
      };
    },
    getMaxCurrent: function getMaxCurrent(total) {
      var _sPagination = this.sPagination,
          current = _sPagination.current,
          pageSize = _sPagination.pageSize;

      if ((current - 1) * pageSize >= total) {
        return Math.floor((total - 1) / pageSize) + 1;
      }
      return current;
    },
    getRecordKey: function getRecordKey(record, index) {
      var rowKey = this.rowKey;

      var recordKey = typeof rowKey === 'function' ? rowKey(record, index) : record[rowKey];
      (0, _warning2['default'])(recordKey !== undefined, 'Table', 'Each record in dataSource of table should have a unique `key` prop, ' + 'or set `rowKey` of Table to an unique primary key, ');
      return recordKey === undefined ? index : recordKey;
    },
    getSorterFn: function getSorterFn(state) {
      var _ref = state || this.$data,
          sortOrder = _ref.sSortOrder,
          sortColumn = _ref.sSortColumn;

      if (!sortOrder || !sortColumn || typeof sortColumn.sorter !== 'function') {
        return;
      }

      return function (a, b) {
        var result = sortColumn.sorter(a, b, sortOrder);
        if (result !== 0) {
          return sortOrder === 'descend' ? -result : result;
        }
        return 0;
      };
    },
    getCurrentPageData: function getCurrentPageData() {
      var data = this.getLocalData();
      this.filterDataCnt = data.length;
      var current = void 0;
      var pageSize = void 0;
      var sPagination = this.sPagination;
      // 如果没有分页的话，默认全部展示
      if (!this.hasPagination()) {
        pageSize = Number.MAX_VALUE;
        current = 1;
      } else {
        pageSize = sPagination.pageSize;
        current = this.getMaxCurrent(sPagination.total || data.length);
      }

      // 分页
      // ---
      // 当数据量少于等于每页数量时，直接设置数据
      // 否则进行读取分页数据
      if (data.length > pageSize || pageSize === Number.MAX_VALUE) {
        data = data.slice((current - 1) * pageSize, current * pageSize);
      }
      return data;
    },
    getFlatData: function getFlatData() {
      var childrenColumnName = this.$props.childrenColumnName;

      return (0, _util.flatArray)(this.getLocalData(null, false), childrenColumnName);
    },
    getFlatCurrentPageData: function getFlatCurrentPageData() {
      var childrenColumnName = this.$props.childrenColumnName;

      return (0, _util.flatArray)(this.getCurrentPageData(), childrenColumnName);
    },
    getLocalData: function getLocalData(state) {
      var _this2 = this;

      var filter = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;

      var currentState = state || this.$data;
      var filters = currentState.sFilters;
      var dataSource = this.$props.dataSource;

      var data = dataSource || [];
      // 优化本地排序
      data = data.slice(0);
      var sorterFn = this.getSorterFn(currentState);
      if (sorterFn) {
        // 使用新数组，避免改变原数组导致无限循环更新
        // https://github.com/vueComponent/ant-design-vue/issues/2270
        data = this.recursiveSort([].concat((0, _toConsumableArray3['default'])(data)), sorterFn);
      }
      // 筛选
      if (filter && filters) {
        Object.keys(filters).forEach(function (columnKey) {
          var col = _this2.findColumn(columnKey);
          if (!col) {
            return;
          }
          var values = filters[columnKey] || [];
          if (values.length === 0) {
            return;
          }
          var onFilter = col.onFilter;
          data = onFilter ? data.filter(function (record) {
            return values.some(function (v) {
              return onFilter(v, record);
            });
          }) : data;
        });
      }
      return data;
    },
    onRow: function onRow(prefixCls, record, index) {
      var customRow = this.customRow;

      var custom = customRow ? customRow(record, index) : {};
      return (0, _propsUtil.mergeProps)(custom, {
        props: {
          prefixCls: prefixCls,
          store: this.store,
          rowKey: this.getRecordKey(record, index)
        }
      });
    },
    setSelectedRowKeys: function setSelectedRowKeys(selectedRowKeys, selectionInfo) {
      var _this3 = this;

      var selectWay = selectionInfo.selectWay,
          record = selectionInfo.record,
          checked = selectionInfo.checked,
          changeRowKeys = selectionInfo.changeRowKeys,
          nativeEvent = selectionInfo.nativeEvent;

      var rowSelection = getRowSelection(this.$props);
      if (rowSelection && !('selectedRowKeys' in rowSelection)) {
        this.store.setState({ selectedRowKeys: selectedRowKeys });
      }
      var data = this.getFlatData();
      if (!rowSelection.onChange && !rowSelection[selectWay]) {
        return;
      }
      var selectedRows = data.filter(function (row, i) {
        return selectedRowKeys.indexOf(_this3.getRecordKey(row, i)) >= 0;
      });
      if (rowSelection.onChange) {
        rowSelection.onChange(selectedRowKeys, selectedRows);
      }
      if (selectWay === 'onSelect' && rowSelection.onSelect) {
        rowSelection.onSelect(record, checked, selectedRows, nativeEvent);
      } else if (selectWay === 'onSelectMultiple' && rowSelection.onSelectMultiple) {
        var changeRows = data.filter(function (row, i) {
          return changeRowKeys.indexOf(_this3.getRecordKey(row, i)) >= 0;
        });
        rowSelection.onSelectMultiple(checked, selectedRows, changeRows);
      } else if (selectWay === 'onSelectAll' && rowSelection.onSelectAll) {
        var _changeRows = data.filter(function (row, i) {
          return changeRowKeys.indexOf(_this3.getRecordKey(row, i)) >= 0;
        });
        rowSelection.onSelectAll(checked, selectedRows, _changeRows);
      } else if (selectWay === 'onSelectInvert' && rowSelection.onSelectInvert) {
        rowSelection.onSelectInvert(selectedRowKeys);
      }
    },
    generatePopupContainerFunc: function generatePopupContainerFunc(getPopupContainer) {
      var scroll = this.$props.scroll;

      var table = this.$refs.vcTable;
      if (getPopupContainer) {
        return getPopupContainer;
      }
      // Use undefined to let rc component use default logic.
      return scroll && table ? function () {
        return table.getTableNode();
      } : undefined;
    },
    scrollToFirstRow: function scrollToFirstRow() {
      var _this4 = this;

      var scroll = this.$props.scroll;

      if (scroll && scroll.scrollToFirstRowOnChange !== false) {
        (0, _scrollTo2['default'])(0, {
          getContainer: function getContainer() {
            return _this4.$refs.vcTable.getBodyTable();
          }
        });
      }
    },
    isSameColumn: function isSameColumn(a, b) {
      if (a && b && a.key && a.key === b.key) {
        return true;
      }
      return a === b || (0, _shallowequal2['default'])(a, b, function (value, other) {
        if (typeof value === 'function' && typeof other === 'function') {
          return value === other || value.toString() === other.toString();
        }
      });
    },
    handleFilter: function handleFilter(column, nextFilters) {
      var _this5 = this;

      var props = this.$props;
      var pagination = (0, _extends5['default'])({}, this.sPagination);
      var filters = (0, _extends5['default'])({}, this.sFilters, (0, _defineProperty3['default'])({}, getColumnKey(column), nextFilters));
      // Remove filters not in current columns
      var currentColumnKeys = [];
      (0, _util.treeMap)(this.columns, function (c) {
        if (!c.children) {
          currentColumnKeys.push(getColumnKey(c));
        }
      });
      Object.keys(filters).forEach(function (columnKey) {
        if (currentColumnKeys.indexOf(columnKey) < 0) {
          delete filters[columnKey];
        }
      });

      if (props.pagination) {
        // Reset current prop
        pagination.current = 1;
        pagination.onChange(pagination.current);
      }

      var newState = {
        sPagination: pagination,
        sFilters: {}
      };
      var filtersToSetState = (0, _extends5['default'])({}, filters);
      // Remove filters which is controlled
      getFilteredValueColumns({ columns: props.columns }).forEach(function (col) {
        var columnKey = getColumnKey(col);
        if (columnKey) {
          delete filtersToSetState[columnKey];
        }
      });
      if (Object.keys(filtersToSetState).length > 0) {
        newState.sFilters = filtersToSetState;
      }

      // Controlled current prop will not respond user interaction
      if ((0, _typeof3['default'])(props.pagination) === 'object' && 'current' in props.pagination) {
        newState.sPagination = (0, _extends5['default'])({}, pagination, {
          current: this.sPagination.current
        });
      }

      this.setState(newState, function () {
        _this5.scrollToFirstRow();
        _this5.store.setState({
          selectionDirty: false
        });
        _this5.$emit.apply(_this5, ['change'].concat((0, _toConsumableArray3['default'])(_this5.prepareParamsArguments((0, _extends5['default'])({}, _this5.$data, {
          sSelectionDirty: false,
          sFilters: filters,
          sPagination: pagination
        })))));
      });
    },
    handleSelect: function handleSelect(record, rowIndex, e) {
      var _this6 = this;

      var checked = e.target.checked;
      var nativeEvent = e.nativeEvent;
      var defaultSelection = this.store.getState().selectionDirty ? [] : this.getDefaultSelection();
      var selectedRowKeys = this.store.getState().selectedRowKeys.concat(defaultSelection);
      var key = this.getRecordKey(record, rowIndex);
      var pivot = this.$data.pivot;

      var rows = this.getFlatCurrentPageData();
      var realIndex = rowIndex;
      if (this.$props.expandedRowRender) {
        realIndex = rows.findIndex(function (row) {
          return _this6.getRecordKey(row, rowIndex) === key;
        });
      }
      if (nativeEvent.shiftKey && pivot !== undefined && realIndex !== pivot) {
        var changeRowKeys = [];
        var direction = Math.sign(pivot - realIndex);
        var dist = Math.abs(pivot - realIndex);
        var step = 0;

        var _loop = function _loop() {
          var i = realIndex + step * direction;
          step += 1;
          var row = rows[i];
          var rowKey = _this6.getRecordKey(row, i);
          var checkboxProps = _this6.getCheckboxPropsByItem(row, i);
          if (!checkboxProps.disabled) {
            if (selectedRowKeys.includes(rowKey)) {
              if (!checked) {
                selectedRowKeys = selectedRowKeys.filter(function (j) {
                  return rowKey !== j;
                });
                changeRowKeys.push(rowKey);
              }
            } else if (checked) {
              selectedRowKeys.push(rowKey);
              changeRowKeys.push(rowKey);
            }
          }
        };

        while (step <= dist) {
          _loop();
        }

        this.setState({ pivot: realIndex });
        this.store.setState({
          selectionDirty: true
        });
        this.setSelectedRowKeys(selectedRowKeys, {
          selectWay: 'onSelectMultiple',
          record: record,
          checked: checked,
          changeRowKeys: changeRowKeys,
          nativeEvent: nativeEvent
        });
      } else {
        if (checked) {
          selectedRowKeys.push(this.getRecordKey(record, realIndex));
        } else {
          selectedRowKeys = selectedRowKeys.filter(function (i) {
            return key !== i;
          });
        }
        this.setState({ pivot: realIndex });
        this.store.setState({
          selectionDirty: true
        });
        this.setSelectedRowKeys(selectedRowKeys, {
          selectWay: 'onSelect',
          record: record,
          checked: checked,
          changeRowKeys: undefined,
          nativeEvent: nativeEvent
        });
      }
    },
    handleRadioSelect: function handleRadioSelect(record, rowIndex, e) {
      var checked = e.target.checked;
      var nativeEvent = e.nativeEvent;
      var key = this.getRecordKey(record, rowIndex);
      var selectedRowKeys = [key];
      this.store.setState({
        selectionDirty: true
      });
      this.setSelectedRowKeys(selectedRowKeys, {
        selectWay: 'onSelect',
        record: record,
        checked: checked,
        changeRowKeys: undefined,
        nativeEvent: nativeEvent
      });
    },
    handleSelectRow: function handleSelectRow(selectionKey, index, onSelectFunc) {
      var _this7 = this;

      var data = this.getFlatCurrentPageData();
      var defaultSelection = this.store.getState().selectionDirty ? [] : this.getDefaultSelection();
      var selectedRowKeys = this.store.getState().selectedRowKeys.concat(defaultSelection);
      var changeableRowKeys = data.filter(function (item, i) {
        return !_this7.getCheckboxPropsByItem(item, i).props.disabled;
      }).map(function (item, i) {
        return _this7.getRecordKey(item, i);
      });

      var changeRowKeys = [];
      var selectWay = 'onSelectAll';
      var checked = void 0;
      // handle default selection
      switch (selectionKey) {
        case 'all':
          changeableRowKeys.forEach(function (key) {
            if (selectedRowKeys.indexOf(key) < 0) {
              selectedRowKeys.push(key);
              changeRowKeys.push(key);
            }
          });
          selectWay = 'onSelectAll';
          checked = true;
          break;
        case 'removeAll':
          changeableRowKeys.forEach(function (key) {
            if (selectedRowKeys.indexOf(key) >= 0) {
              selectedRowKeys.splice(selectedRowKeys.indexOf(key), 1);
              changeRowKeys.push(key);
            }
          });
          selectWay = 'onSelectAll';
          checked = false;
          break;
        case 'invert':
          changeableRowKeys.forEach(function (key) {
            if (selectedRowKeys.indexOf(key) < 0) {
              selectedRowKeys.push(key);
            } else {
              selectedRowKeys.splice(selectedRowKeys.indexOf(key), 1);
            }
            changeRowKeys.push(key);
            selectWay = 'onSelectInvert';
          });
          break;
        default:
          break;
      }

      this.store.setState({
        selectionDirty: true
      });
      // when select custom selection, callback selections[n].onSelect
      var rowSelection = this.rowSelection;

      var customSelectionStartIndex = 2;
      if (rowSelection && rowSelection.hideDefaultSelections) {
        customSelectionStartIndex = 0;
      }
      if (index >= customSelectionStartIndex && typeof onSelectFunc === 'function') {
        return onSelectFunc(changeableRowKeys);
      }
      this.setSelectedRowKeys(selectedRowKeys, {
        selectWay: selectWay,
        checked: checked,
        changeRowKeys: changeRowKeys
      });
    },
    handlePageChange: function handlePageChange(current) {
      var props = this.$props;
      var pagination = (0, _extends5['default'])({}, this.sPagination);
      if (current) {
        pagination.current = current;
      } else {
        pagination.current = pagination.current || 1;
      }

      for (var _len = arguments.length, otherArguments = Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
        otherArguments[_key - 1] = arguments[_key];
      }

      pagination.onChange.apply(pagination, [pagination.current].concat((0, _toConsumableArray3['default'])(otherArguments)));

      var newState = {
        sPagination: pagination
      };
      // Controlled current prop will not respond user interaction
      if (props.pagination && (0, _typeof3['default'])(props.pagination) === 'object' && 'current' in props.pagination) {
        newState.sPagination = (0, _extends5['default'])({}, pagination, {
          current: this.sPagination.current
        });
      }
      this.setState(newState, this.scrollToFirstRow);

      this.store.setState({
        selectionDirty: false
      });
      this.$emit.apply(this, ['change'].concat((0, _toConsumableArray3['default'])(this.prepareParamsArguments((0, _extends5['default'])({}, this.$data, {
        sSelectionDirty: false,
        sPagination: pagination
      })))));
    },
    handleShowSizeChange: function handleShowSizeChange(current, pageSize) {
      var pagination = this.sPagination;
      pagination.onShowSizeChange(current, pageSize);
      var nextPagination = (0, _extends5['default'])({}, pagination, {
        pageSize: pageSize,
        current: current
      });
      this.setState({ sPagination: nextPagination }, this.scrollToFirstRow);
      this.$emit.apply(this, ['change'].concat((0, _toConsumableArray3['default'])(this.prepareParamsArguments((0, _extends5['default'])({}, this.$data, {
        sPagination: nextPagination
      })))));
    },
    toggleSortOrder: function toggleSortOrder(column) {
      var sortDirections = column.sortDirections || this.sortDirections;
      var sortOrder = this.sSortOrder,
          sortColumn = this.sSortColumn;
      // 只同时允许一列进行排序，否则会导致排序顺序的逻辑问题

      var newSortOrder = void 0;
      // 切换另一列时，丢弃 sortOrder 的状态
      if (isSameColumn(sortColumn, column) && sortOrder !== undefined) {
        // 按照sortDirections的内容依次切换排序状态
        var methodIndex = sortDirections.indexOf(sortOrder) + 1;
        newSortOrder = methodIndex === sortDirections.length ? undefined : sortDirections[methodIndex];
      } else {
        newSortOrder = sortDirections[0];
      }
      var newState = {
        sSortOrder: newSortOrder,
        sSortColumn: newSortOrder ? column : null
      };

      // Controlled
      if (this.getSortOrderColumns().length === 0) {
        this.setState(newState, this.scrollToFirstRow);
      }
      this.$emit.apply(this, ['change'].concat((0, _toConsumableArray3['default'])(this.prepareParamsArguments((0, _extends5['default'])({}, this.$data, newState), column))));
    },
    hasPagination: function hasPagination(props) {
      return (props || this.$props).pagination !== false;
    },
    isSortColumn: function isSortColumn(column) {
      var sortColumn = this.sSortColumn;

      if (!column || !sortColumn) {
        return false;
      }
      return getColumnKey(sortColumn) === getColumnKey(column);
    },


    // Get pagination, filters, sorter
    prepareParamsArguments: function prepareParamsArguments(state, column) {
      var pagination = (0, _extends5['default'])({}, state.sPagination);
      // remove useless handle function in Table.onChange
      delete pagination.onChange;
      delete pagination.onShowSizeChange;
      var filters = state.sFilters;
      var sorter = {};
      var currentColumn = column;
      if (state.sSortColumn && state.sSortOrder) {
        currentColumn = state.sSortColumn;
        sorter.column = state.sSortColumn;
        sorter.order = state.sSortOrder;
      }

      if (currentColumn) {
        sorter.field = currentColumn.dataIndex;
        sorter.columnKey = getColumnKey(currentColumn);
      }

      var extra = {
        currentDataSource: this.getLocalData(state)
      };

      return [pagination, filters, sorter, extra];
    },
    findColumn: function findColumn(myKey) {
      var column = void 0;
      (0, _util.treeMap)(this.columns, function (c) {
        if (getColumnKey(c) === myKey) {
          column = c;
        }
      });
      return column;
    },
    recursiveSort: function recursiveSort(data, sorterFn) {
      var _this8 = this;

      var _childrenColumnName = this.childrenColumnName,
          childrenColumnName = _childrenColumnName === undefined ? 'children' : _childrenColumnName;

      return data.sort(sorterFn).map(function (item) {
        return item[childrenColumnName] ? (0, _extends5['default'])({}, item, (0, _defineProperty3['default'])({}, childrenColumnName, _this8.recursiveSort([].concat((0, _toConsumableArray3['default'])(item[childrenColumnName])), sorterFn))) : item;
      });
    },
    renderExpandIcon: function renderExpandIcon(prefixCls) {
      var h = this.$createElement;

      return function (_ref2) {
        var expandable = _ref2.expandable,
            expanded = _ref2.expanded,
            needIndentSpaced = _ref2.needIndentSpaced,
            record = _ref2.record,
            onExpand = _ref2.onExpand;

        if (expandable) {
          return h(
            _LocaleReceiver2['default'],
            {
              attrs: { componentName: 'Table', defaultLocale: _default3['default'].Table }
            },
            [function (locale) {
              var _classNames;

              return h(_transButton2['default'], {
                'class': (0, _classnames2['default'])(prefixCls + '-row-expand-icon', (_classNames = {}, (0, _defineProperty3['default'])(_classNames, prefixCls + '-row-collapsed', !expanded), (0, _defineProperty3['default'])(_classNames, prefixCls + '-row-expanded', expanded), _classNames)),
                on: {
                  'click': function click(event) {
                    onExpand(record, event);
                  }
                },
                attrs: {
                  'aria-label': expanded ? locale.collapse : locale.expand,
                  noStyle: true
                }
              });
            }]
          );
        }

        if (needIndentSpaced) {
          return h('span', { 'class': prefixCls + '-row-expand-icon ' + prefixCls + '-row-spaced' });
        }

        return null;
      };
    },
    renderPagination: function renderPagination(prefixCls, paginationPosition) {
      var h = this.$createElement;

      // 强制不需要分页
      if (!this.hasPagination()) {
        return null;
      }
      var size = 'default';
      var pagination = this.sPagination;

      if (pagination.size) {
        size = pagination.size;
      } else if (this.size === 'middle' || this.size === 'small') {
        size = 'small';
      }
      var position = pagination.position || 'bottom';
      var total = pagination.total || this.filterDataCnt;
      var cls = pagination['class'],
          style = pagination.style,
          onChange = pagination.onChange,
          onShowSizeChange = pagination.onShowSizeChange,
          restProps = (0, _objectWithoutProperties3['default'])(pagination, ['class', 'style', 'onChange', 'onShowSizeChange']); // eslint-disable-line

      var paginationProps = (0, _propsUtil.mergeProps)({
        key: 'pagination-' + paginationPosition,
        'class': (0, _classnames2['default'])(cls, prefixCls + '-pagination'),
        props: (0, _extends5['default'])({}, restProps, {
          total: total,
          size: size,
          current: this.getMaxCurrent(total)
        }),
        style: style,
        on: {
          change: this.handlePageChange,
          showSizeChange: this.handleShowSizeChange
        }
      });
      return total > 0 && (position === paginationPosition || position === 'both') ? h(_pagination2['default'], paginationProps) : null;
    },
    renderSelectionBox: function renderSelectionBox(type) {
      var _this9 = this;

      var h = this.$createElement;

      return function (_, record, index) {
        var rowKey = _this9.getRecordKey(record, index); // 从 1 开始
        var props = _this9.getCheckboxPropsByItem(record, index);
        var handleChange = function handleChange(e) {
          type === 'radio' ? _this9.handleRadioSelect(record, index, e) : _this9.handleSelect(record, index, e);
        };
        var selectionBoxProps = (0, _propsUtil.mergeProps)({
          props: {
            type: type,
            store: _this9.store,
            rowIndex: rowKey,
            defaultSelection: _this9.getDefaultSelection()
          },
          on: {
            change: handleChange
          }
        }, props);

        return h(
          'span',
          {
            on: {
              'click': stopPropagation
            }
          },
          [h(_SelectionBox2['default'], selectionBoxProps)]
        );
      };
    },
    renderRowSelection: function renderRowSelection(_ref3) {
      var _this10 = this;

      var prefixCls = _ref3.prefixCls,
          locale = _ref3.locale,
          getPopupContainer = _ref3.getPopupContainer;
      var h = this.$createElement;
      var rowSelection = this.rowSelection;

      var columns = this.columns.concat();
      if (rowSelection) {
        var data = this.getFlatCurrentPageData().filter(function (item, index) {
          if (rowSelection.getCheckboxProps) {
            return !_this10.getCheckboxPropsByItem(item, index).props.disabled;
          }
          return true;
        });
        var selectionColumnClass = (0, _classnames2['default'])(prefixCls + '-selection-column', (0, _defineProperty3['default'])({}, prefixCls + '-selection-column-custom', rowSelection.selections));
        var selectionColumn = (0, _defineProperty3['default'])({
          key: 'selection-column',
          customRender: this.renderSelectionBox(rowSelection.type),
          className: selectionColumnClass,
          fixed: rowSelection.fixed,
          width: rowSelection.columnWidth,
          title: rowSelection.columnTitle
        }, _vcTable.INTERNAL_COL_DEFINE, {
          'class': prefixCls + '-selection-col'
        });
        if (rowSelection.type !== 'radio') {
          var checkboxAllDisabled = data.every(function (item, index) {
            return _this10.getCheckboxPropsByItem(item, index).props.disabled;
          });
          selectionColumn.title = selectionColumn.title || h(_SelectionCheckboxAll2['default'], {
            attrs: {
              store: this.store,
              locale: locale,
              data: data,
              getCheckboxPropsByItem: this.getCheckboxPropsByItem,
              getRecordKey: this.getRecordKey,
              disabled: checkboxAllDisabled,
              prefixCls: prefixCls,

              selections: rowSelection.selections,
              hideDefaultSelections: rowSelection.hideDefaultSelections,
              getPopupContainer: this.generatePopupContainerFunc(getPopupContainer)
            },
            on: {
              'select': this.handleSelectRow
            }
          });
        }
        if ('fixed' in rowSelection) {
          selectionColumn.fixed = rowSelection.fixed;
        } else if (columns.some(function (column) {
          return column.fixed === 'left' || column.fixed === true;
        })) {
          selectionColumn.fixed = 'left';
        }
        if (columns[0] && columns[0].key === 'selection-column') {
          columns[0] = selectionColumn;
        } else {
          columns.unshift(selectionColumn);
        }
      }
      return columns;
    },
    renderColumnsDropdown: function renderColumnsDropdown(_ref4) {
      var _this11 = this;

      var prefixCls = _ref4.prefixCls,
          dropdownPrefixCls = _ref4.dropdownPrefixCls,
          columns = _ref4.columns,
          locale = _ref4.locale,
          getPopupContainer = _ref4.getPopupContainer;
      var h = this.$createElement;
      var sortOrder = this.sSortOrder,
          filters = this.sFilters;

      return (0, _util.treeMap)(columns, function (column, i) {
        var _classNames3;

        var key = getColumnKey(column, i);
        var filterDropdown = void 0;
        var sortButton = void 0;
        var customHeaderCell = column.customHeaderCell;
        var isSortColumn = _this11.isSortColumn(column);
        if (column.filters && column.filters.length > 0 || column.filterDropdown) {
          var colFilters = key in filters ? filters[key] : [];
          filterDropdown = h(_filterDropdown2['default'], {
            attrs: {
              _propsSymbol: Symbol(),
              locale: locale,
              column: column,
              selectedKeys: colFilters,
              confirmFilter: _this11.handleFilter,
              prefixCls: prefixCls + '-filter',
              dropdownPrefixCls: dropdownPrefixCls || 'ant-dropdown',
              getPopupContainer: _this11.generatePopupContainerFunc(getPopupContainer)
            },
            key: 'filter-dropdown'
          });
        }
        if (column.sorter) {
          var sortDirections = column.sortDirections || _this11.sortDirections;
          var isAscend = isSortColumn && sortOrder === 'ascend';
          var isDescend = isSortColumn && sortOrder === 'descend';
          var ascend = sortDirections.indexOf('ascend') !== -1 && h(_icon2['default'], {
            'class': prefixCls + '-column-sorter-up ' + (isAscend ? 'on' : 'off'),
            attrs: { type: 'caret-up',
              theme: 'filled'
            },
            key: 'caret-up'
          });

          var descend = sortDirections.indexOf('descend') !== -1 && h(_icon2['default'], {
            'class': prefixCls + '-column-sorter-down ' + (isDescend ? 'on' : 'off'),
            attrs: { type: 'caret-down',
              theme: 'filled'
            },
            key: 'caret-down'
          });

          sortButton = h(
            'div',
            {
              attrs: {
                title: locale.sortTitle
              },
              'class': (0, _classnames2['default'])(prefixCls + '-column-sorter-inner', ascend && descend && prefixCls + '-column-sorter-inner-full'),
              key: 'sorter'
            },
            [ascend, descend]
          );
          customHeaderCell = function customHeaderCell(col) {
            var colProps = {};
            // Get original first
            if (column.customHeaderCell) {
              colProps = (0, _extends5['default'])({}, column.customHeaderCell(col));
            }
            colProps.on = colProps.on || {};
            // Add sorter logic
            var onHeaderCellClick = colProps.on.click;
            colProps.on.click = function () {
              _this11.toggleSortOrder(column);
              if (onHeaderCellClick) {
                onHeaderCellClick.apply(undefined, arguments);
              }
            };
            return colProps;
          };
        }
        return (0, _extends5['default'])({}, column, {
          className: (0, _classnames2['default'])(column.className, (_classNames3 = {}, (0, _defineProperty3['default'])(_classNames3, prefixCls + '-column-has-actions', sortButton || filterDropdown), (0, _defineProperty3['default'])(_classNames3, prefixCls + '-column-has-filters', filterDropdown), (0, _defineProperty3['default'])(_classNames3, prefixCls + '-column-has-sorters', sortButton), (0, _defineProperty3['default'])(_classNames3, prefixCls + '-column-sort', isSortColumn && sortOrder), _classNames3)),
          title: [h(
            'span',
            { key: 'title', 'class': prefixCls + '-header-column' },
            [h(
              'div',
              { 'class': sortButton ? prefixCls + '-column-sorters' : undefined },
              [h(
                'span',
                { 'class': prefixCls + '-column-title' },
                [_this11.renderColumnTitle(column.title)]
              ), h(
                'span',
                { 'class': prefixCls + '-column-sorter' },
                [sortButton]
              )]
            )]
          ), filterDropdown],
          customHeaderCell: customHeaderCell
        });
      });
    },
    renderColumnTitle: function renderColumnTitle(title) {
      var _$data = this.$data,
          filters = _$data.sFilters,
          sortOrder = _$data.sSortOrder,
          sortColumn = _$data.sSortColumn;
      // https://github.com/ant-design/ant-design/issues/11246#issuecomment-405009167

      if (title instanceof Function) {
        return title({
          filters: filters,
          sortOrder: sortOrder,
          sortColumn: sortColumn
        });
      }
      return title;
    },
    renderTable: function renderTable(_ref5) {
      var _classNames4,
          _this12 = this;

      var prefixCls = _ref5.prefixCls,
          renderEmpty = _ref5.renderEmpty,
          dropdownPrefixCls = _ref5.dropdownPrefixCls,
          contextLocale = _ref5.contextLocale,
          contextGetPopupContainer = _ref5.getPopupContainer,
          transformCellText = _ref5.transformCellText;
      var h = this.$createElement;

      var _getOptionProps = (0, _propsUtil.getOptionProps)(this),
          showHeader = _getOptionProps.showHeader,
          locale = _getOptionProps.locale,
          getPopupContainer = _getOptionProps.getPopupContainer,
          restProps = (0, _objectWithoutProperties3['default'])(_getOptionProps, ['showHeader', 'locale', 'getPopupContainer']);

      var data = this.getCurrentPageData();
      var expandIconAsCell = this.expandedRowRender && this.expandIconAsCell !== false;

      // use props.getPopupContainer first
      var realGetPopupContainer = getPopupContainer || contextGetPopupContainer;

      // Merge too locales
      var mergedLocale = (0, _extends5['default'])({}, contextLocale, locale);
      if (!locale || !locale.emptyText) {
        mergedLocale.emptyText = renderEmpty(h, 'Table');
      }

      var classString = (0, _classnames2['default'])((_classNames4 = {}, (0, _defineProperty3['default'])(_classNames4, prefixCls + '-' + this.size, true), (0, _defineProperty3['default'])(_classNames4, prefixCls + '-bordered', this.bordered), (0, _defineProperty3['default'])(_classNames4, prefixCls + '-empty', !data.length), (0, _defineProperty3['default'])(_classNames4, prefixCls + '-without-column-header', !showHeader), _classNames4));

      var columnsWithRowSelection = this.renderRowSelection({
        prefixCls: prefixCls,
        locale: mergedLocale,
        getPopupContainer: realGetPopupContainer
      });
      var columns = this.renderColumnsDropdown({
        columns: columnsWithRowSelection,
        prefixCls: prefixCls,
        dropdownPrefixCls: dropdownPrefixCls,
        locale: mergedLocale,
        getPopupContainer: realGetPopupContainer
      }).map(function (column, i) {
        var newColumn = (0, _extends5['default'])({}, column);
        newColumn.key = getColumnKey(newColumn, i);
        return newColumn;
      });

      var expandIconColumnIndex = columns[0] && columns[0].key === 'selection-column' ? 1 : 0;
      if ('expandIconColumnIndex' in restProps) {
        expandIconColumnIndex = restProps.expandIconColumnIndex;
      }
      var vcTableProps = {
        key: 'table',
        props: (0, _extends5['default'])({
          expandIcon: this.renderExpandIcon(prefixCls)
        }, restProps, {
          customRow: function customRow(record, index) {
            return _this12.onRow(prefixCls, record, index);
          },
          components: this.sComponents,
          prefixCls: prefixCls,
          data: data,
          columns: columns,
          showHeader: showHeader,
          expandIconColumnIndex: expandIconColumnIndex,
          expandIconAsCell: expandIconAsCell,
          emptyText: mergedLocale.emptyText,
          transformCellText: transformCellText
        }),
        on: (0, _propsUtil.getListeners)(this),
        'class': classString,
        ref: 'vcTable'
      };
      return h(_vcTable2['default'], vcTableProps);
    }
  },

  render: function render() {
    var _this13 = this;

    var h = arguments[0];
    var customizePrefixCls = this.prefixCls,
        customizeDropdownPrefixCls = this.dropdownPrefixCls,
        customizeTransformCellText = this.transformCellText;

    var data = this.getCurrentPageData();
    var _configProvider = this.configProvider,
        getContextPopupContainer = _configProvider.getPopupContainer,
        tct = _configProvider.transformCellText;

    var getPopupContainer = this.getPopupContainer || getContextPopupContainer;
    var transformCellText = customizeTransformCellText || tct;
    var loading = this.loading;
    if (typeof loading === 'boolean') {
      loading = {
        props: {
          spinning: loading
        }
      };
    } else {
      loading = {
        props: (0, _extends5['default'])({}, loading)
      };
    }
    var getPrefixCls = this.configProvider.getPrefixCls;
    var renderEmpty = this.configProvider.renderEmpty;

    var prefixCls = getPrefixCls('table', customizePrefixCls);
    var dropdownPrefixCls = getPrefixCls('dropdown', customizeDropdownPrefixCls);

    var table = h(_LocaleReceiver2['default'], {
      attrs: {
        componentName: 'Table',
        defaultLocale: _default3['default'].Table,
        children: function children(locale) {
          return _this13.renderTable({
            prefixCls: prefixCls,
            renderEmpty: renderEmpty,
            dropdownPrefixCls: dropdownPrefixCls,
            contextLocale: locale,
            getPopupContainer: getPopupContainer,
            transformCellText: transformCellText
          });
        }
      }
    });

    // if there is no pagination or no data,
    // the height of spin should decrease by half of pagination
    var paginationPatchClass = this.hasPagination() && data && data.length !== 0 ? prefixCls + '-with-pagination' : prefixCls + '-without-pagination';
    var spinProps = (0, _extends5['default'])({}, loading, {
      'class': loading.props && loading.props.spinning ? paginationPatchClass + ' ' + prefixCls + '-spin-holder' : ''
    });
    return h(
      'div',
      { 'class': (0, _classnames2['default'])(prefixCls + '-wrapper') },
      [h(
        _spin2['default'],
        spinProps,
        [this.renderPagination(prefixCls, 'top'), table, this.renderPagination(prefixCls, 'bottom')]
      )]
    );
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/table/createBodyRow.js":
/*!****************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/table/createBodyRow.js ***!
  \****************************************************************/
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

exports['default'] = createBodyRow;

var _vueTypes = __webpack_require__(/*! ../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _createStore = __webpack_require__(/*! ./createStore */ "./node_modules/ant-design-vue/lib/table/createStore.js");

var _propsUtil = __webpack_require__(/*! ../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var BodyRowProps = {
  store: _createStore.Store,
  rowKey: _vueTypes2['default'].oneOfType([_vueTypes2['default'].string, _vueTypes2['default'].number]),
  prefixCls: _vueTypes2['default'].string
};

function createBodyRow() {
  var Component = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'tr';

  var BodyRow = {
    name: 'BodyRow',
    props: BodyRowProps,
    data: function data() {
      var _store$getState = this.store.getState(),
          selectedRowKeys = _store$getState.selectedRowKeys;

      return {
        selected: selectedRowKeys.indexOf(this.rowKey) >= 0
      };
    },
    mounted: function mounted() {
      this.subscribe();
    },
    beforeDestroy: function beforeDestroy() {
      if (this.unsubscribe) {
        this.unsubscribe();
      }
    },

    methods: {
      subscribe: function subscribe() {
        var _this = this;

        var store = this.store,
            rowKey = this.rowKey;

        this.unsubscribe = store.subscribe(function () {
          var _store$getState2 = _this.store.getState(),
              selectedRowKeys = _store$getState2.selectedRowKeys;

          var selected = selectedRowKeys.indexOf(rowKey) >= 0;
          if (selected !== _this.selected) {
            _this.selected = selected;
          }
        });
      }
    },

    render: function render() {
      var h = arguments[0];

      var className = (0, _defineProperty3['default'])({}, this.prefixCls + '-row-selected', this.selected);

      return h(
        Component,
        (0, _babelHelperVueJsxMergeProps2['default'])([{ 'class': className }, { on: (0, _propsUtil.getListeners)(this) }]),
        [this.$slots['default']]
      );
    }
  };

  return BodyRow;
}

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/table/createStore.js":
/*!**************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/table/createStore.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.Store = undefined;

var _vueTypes = __webpack_require__(/*! ../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _create = __webpack_require__(/*! ../_util/store/create */ "./node_modules/ant-design-vue/lib/_util/store/create.js");

var _create2 = _interopRequireDefault(_create);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var Store = exports.Store = _vueTypes2['default'].shape({
  setState: _vueTypes2['default'].func,
  getState: _vueTypes2['default'].func,
  subscribe: _vueTypes2['default'].func
}).loose;

var createStore = _create2['default'];

exports['default'] = createStore;

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/table/filterDropdown.js":
/*!*****************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/table/filterDropdown.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _defineProperty2 = __webpack_require__(/*! babel-runtime/helpers/defineProperty */ "./node_modules/babel-runtime/helpers/defineProperty.js");

var _defineProperty3 = _interopRequireDefault(_defineProperty2);

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _vcMenu = __webpack_require__(/*! ../vc-menu */ "./node_modules/ant-design-vue/lib/vc-menu/index.js");

var _vcMenu2 = _interopRequireDefault(_vcMenu);

var _domClosest = __webpack_require__(/*! dom-closest */ "./node_modules/dom-closest/index.js");

var _domClosest2 = _interopRequireDefault(_domClosest);

var _classnames = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");

var _classnames2 = _interopRequireDefault(_classnames);

var _shallowequal = __webpack_require__(/*! shallowequal */ "./node_modules/shallowequal/index.js");

var _shallowequal2 = _interopRequireDefault(_shallowequal);

var _dropdown = __webpack_require__(/*! ../dropdown */ "./node_modules/ant-design-vue/lib/dropdown/index.js");

var _dropdown2 = _interopRequireDefault(_dropdown);

var _icon = __webpack_require__(/*! ../icon */ "./node_modules/ant-design-vue/lib/icon/index.js");

var _icon2 = _interopRequireDefault(_icon);

var _checkbox = __webpack_require__(/*! ../checkbox */ "./node_modules/ant-design-vue/lib/checkbox/index.js");

var _checkbox2 = _interopRequireDefault(_checkbox);

var _radio = __webpack_require__(/*! ../radio */ "./node_modules/ant-design-vue/lib/radio/index.js");

var _radio2 = _interopRequireDefault(_radio);

var _FilterDropdownMenuWrapper = __webpack_require__(/*! ./FilterDropdownMenuWrapper */ "./node_modules/ant-design-vue/lib/table/FilterDropdownMenuWrapper.js");

var _FilterDropdownMenuWrapper2 = _interopRequireDefault(_FilterDropdownMenuWrapper);

var _interface = __webpack_require__(/*! ./interface */ "./node_modules/ant-design-vue/lib/table/interface.js");

var _propsUtil = __webpack_require__(/*! ../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

var _vnode = __webpack_require__(/*! ../_util/vnode */ "./node_modules/ant-design-vue/lib/_util/vnode.js");

var _BaseMixin = __webpack_require__(/*! ../_util/BaseMixin */ "./node_modules/ant-design-vue/lib/_util/BaseMixin.js");

var _BaseMixin2 = _interopRequireDefault(_BaseMixin);

var _util = __webpack_require__(/*! ./util */ "./node_modules/ant-design-vue/lib/table/util.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

function stopPropagation(e) {
  e.stopPropagation();
}

exports['default'] = {
  name: 'FilterMenu',
  mixins: [_BaseMixin2['default']],
  props: (0, _propsUtil.initDefaultProps)(_interface.FilterMenuProps, {
    handleFilter: function handleFilter() {},

    column: {}
  }),

  data: function data() {
    var visible = 'filterDropdownVisible' in this.column ? this.column.filterDropdownVisible : false;
    this.preProps = (0, _extends3['default'])({}, (0, _propsUtil.getOptionProps)(this));
    return {
      sSelectedKeys: this.selectedKeys,
      sKeyPathOfSelectedItem: {}, // 记录所有有选中子菜单的祖先菜单
      sVisible: visible,
      sValueKeys: (0, _util.generateValueMaps)(this.column.filters)
    };
  },

  watch: {
    _propsSymbol: function _propsSymbol() {
      var nextProps = (0, _propsUtil.getOptionProps)(this);
      var column = nextProps.column;

      var newState = {};

      /**
       * if the state is visible the component should ignore updates on selectedKeys prop to avoid
       * that the user selection is lost
       * this happens frequently when a table is connected on some sort of realtime data
       * Fixes https://github.com/ant-design/ant-design/issues/10289 and
       * https://github.com/ant-design/ant-design/issues/10209
       */
      if ('selectedKeys' in nextProps && !(0, _shallowequal2['default'])(this.preProps.selectedKeys, nextProps.selectedKeys)) {
        newState.sSelectedKeys = nextProps.selectedKeys;
      }
      if (!(0, _shallowequal2['default'])((this.preProps.column || {}).filters, (nextProps.column || {}).filters)) {
        newState.sValueKeys = (0, _util.generateValueMaps)(nextProps.column.filters);
      }
      if ('filterDropdownVisible' in column) {
        newState.sVisible = column.filterDropdownVisible;
      }
      if (Object.keys(newState).length > 0) {
        this.setState(newState);
      }
      this.preProps = (0, _extends3['default'])({}, nextProps);
    }
  },

  mounted: function mounted() {
    var _this = this;

    var column = this.column;

    this.$nextTick(function () {
      _this.setNeverShown(column);
    });
  },
  updated: function updated() {
    var _this2 = this;

    var column = this.column;

    this.$nextTick(function () {
      _this2.setNeverShown(column);
    });
  },

  methods: {
    getDropdownVisible: function getDropdownVisible() {
      return this.neverShown ? false : this.sVisible;
    },
    setNeverShown: function setNeverShown(column) {
      var rootNode = this.$el;
      var filterBelongToScrollBody = !!(0, _domClosest2['default'])(rootNode, '.ant-table-scroll');
      if (filterBelongToScrollBody) {
        // When fixed column have filters, there will be two dropdown menus
        // Filter dropdown menu inside scroll body should never be shown
        // To fix https://github.com/ant-design/ant-design/issues/5010 and
        // https://github.com/ant-design/ant-design/issues/7909
        this.neverShown = !!column.fixed;
      }
    },
    setSelectedKeys: function setSelectedKeys(_ref) {
      var selectedKeys = _ref.selectedKeys;

      this.setState({ sSelectedKeys: selectedKeys });
    },
    setVisible: function setVisible(visible) {
      var column = this.column;

      if (!('filterDropdownVisible' in column)) {
        this.setState({ sVisible: visible });
      }
      if (column.onFilterDropdownVisibleChange) {
        column.onFilterDropdownVisibleChange(visible);
      }
    },
    handleClearFilters: function handleClearFilters() {
      this.setState({
        sSelectedKeys: []
      }, this.handleConfirm);
    },
    handleConfirm: function handleConfirm() {
      var _this3 = this;

      this.setVisible(false);
      this.confirmFilter2();
      // Call `setSelectedKeys` & `confirm` in the same time will make filter data not up to date
      // https://github.com/ant-design/ant-design/issues/12284
      this.$forceUpdate();
      this.$nextTick(function () {
        _this3.confirmFilter;
      });
    },
    onVisibleChange: function onVisibleChange(visible) {
      this.setVisible(visible);
      var column = this.$props.column;
      // https://github.com/ant-design/ant-design/issues/17833

      if (!visible && !(column.filterDropdown instanceof Function)) {
        this.confirmFilter2();
      }
    },
    handleMenuItemClick: function handleMenuItemClick(info) {
      var selectedKeys = this.$data.sSelectedKeys;

      if (!info.keyPath || info.keyPath.length <= 1) {
        return;
      }
      var keyPathOfSelectedItem = this.$data.sKeyPathOfSelectedItem;

      if (selectedKeys && selectedKeys.indexOf(info.key) >= 0) {
        // deselect SubMenu child
        delete keyPathOfSelectedItem[info.key];
      } else {
        // select SubMenu child
        keyPathOfSelectedItem[info.key] = info.keyPath;
      }
      this.setState({ sKeyPathOfSelectedItem: keyPathOfSelectedItem });
    },
    hasSubMenu: function hasSubMenu() {
      var _column$filters = this.column.filters,
          filters = _column$filters === undefined ? [] : _column$filters;

      return filters.some(function (item) {
        return !!(item.children && item.children.length > 0);
      });
    },
    confirmFilter2: function confirmFilter2() {
      var _$props = this.$props,
          column = _$props.column,
          propSelectedKeys = _$props.selectedKeys,
          confirmFilter = _$props.confirmFilter;
      var _$data = this.$data,
          selectedKeys = _$data.sSelectedKeys,
          valueKeys = _$data.sValueKeys;
      var filterDropdown = column.filterDropdown;


      if (!(0, _shallowequal2['default'])(selectedKeys, propSelectedKeys)) {
        confirmFilter(column, filterDropdown ? selectedKeys : selectedKeys.map(function (key) {
          return valueKeys[key];
        }).filter(function (key) {
          return key !== undefined;
        }));
      }
    },
    renderMenus: function renderMenus(items) {
      var _this4 = this;

      var h = this.$createElement;
      var _$props2 = this.$props,
          dropdownPrefixCls = _$props2.dropdownPrefixCls,
          prefixCls = _$props2.prefixCls;

      return items.map(function (item) {
        if (item.children && item.children.length > 0) {
          var sKeyPathOfSelectedItem = _this4.sKeyPathOfSelectedItem;

          var containSelected = Object.keys(sKeyPathOfSelectedItem).some(function (key) {
            return sKeyPathOfSelectedItem[key].indexOf(item.value) >= 0;
          });
          var subMenuCls = (0, _classnames2['default'])(prefixCls + '-dropdown-submenu', (0, _defineProperty3['default'])({}, dropdownPrefixCls + '-submenu-contain-selected', containSelected));
          return h(
            _vcMenu.SubMenu,
            {
              attrs: { title: item.text, popupClassName: subMenuCls },
              key: item.value.toString() },
            [_this4.renderMenus(item.children)]
          );
        }
        return _this4.renderMenuItem(item);
      });
    },
    renderFilterIcon: function renderFilterIcon() {
      var _classNames2;

      var h = this.$createElement;
      var column = this.column,
          locale = this.locale,
          prefixCls = this.prefixCls,
          selectedKeys = this.selectedKeys;

      var filtered = selectedKeys && selectedKeys.length > 0;
      var filterIcon = column.filterIcon;
      if (typeof filterIcon === 'function') {
        filterIcon = filterIcon(filtered, column);
      }
      var dropdownIconClass = (0, _classnames2['default'])((_classNames2 = {}, (0, _defineProperty3['default'])(_classNames2, prefixCls + '-selected', 'filtered' in column ? column.filtered : filtered), (0, _defineProperty3['default'])(_classNames2, prefixCls + '-open', this.getDropdownVisible()), _classNames2));
      if (!filterIcon) {
        return h(_icon2['default'], {
          attrs: {
            title: locale.filterTitle,
            type: 'filter',
            theme: 'filled'
          },
          'class': dropdownIconClass,
          on: {
            'click': stopPropagation
          }
        });
      }
      if (filterIcon.length === 1 && (0, _propsUtil.isValidElement)(filterIcon[0])) {
        return (0, _vnode.cloneElement)(filterIcon[0], {
          on: {
            click: stopPropagation
          },
          'class': (0, _classnames2['default'])(prefixCls + '-icon', dropdownIconClass)
        });
      }
      return h(
        'span',
        { 'class': (0, _classnames2['default'])(prefixCls + '-icon', dropdownIconClass) },
        [filterIcon]
      );
    },
    renderMenuItem: function renderMenuItem(item) {
      var h = this.$createElement;
      var column = this.column;
      var selectedKeys = this.$data.sSelectedKeys;

      var multiple = 'filterMultiple' in column ? column.filterMultiple : true;

      // We still need trade key as string since Menu render need string
      // const internalSelectedKeys = (selectedKeys || []).map(key => key.toString());

      var input = multiple ? h(_checkbox2['default'], {
        attrs: { checked: selectedKeys && selectedKeys.indexOf(item.value.toString()) >= 0 }
      }) : h(_radio2['default'], {
        attrs: { checked: selectedKeys && selectedKeys.indexOf(item.value.toString()) >= 0 }
      });

      return h(
        _vcMenu.Item,
        { key: item.value },
        [input, h('span', [item.text])]
      );
    }
  },

  render: function render() {
    var _this5 = this;

    var h = arguments[0];
    var originSelectedKeys = this.$data.sSelectedKeys;
    var column = this.column,
        locale = this.locale,
        prefixCls = this.prefixCls,
        dropdownPrefixCls = this.dropdownPrefixCls,
        getPopupContainer = this.getPopupContainer;
    // default multiple selection in filter dropdown

    var multiple = 'filterMultiple' in column ? column.filterMultiple : true;
    var dropdownMenuClass = (0, _classnames2['default'])((0, _defineProperty3['default'])({}, dropdownPrefixCls + '-menu-without-submenu', !this.hasSubMenu()));
    var filterDropdown = column.filterDropdown;

    if (filterDropdown instanceof Function) {
      filterDropdown = filterDropdown({
        prefixCls: dropdownPrefixCls + '-custom',
        setSelectedKeys: function setSelectedKeys(selectedKeys) {
          return _this5.setSelectedKeys({ selectedKeys: selectedKeys });
        },
        selectedKeys: originSelectedKeys,
        confirm: this.handleConfirm,
        clearFilters: this.handleClearFilters,
        filters: column.filters,
        visible: this.getDropdownVisible(),
        column: column
      });
    }

    var menus = filterDropdown ? h(
      _FilterDropdownMenuWrapper2['default'],
      { 'class': prefixCls + '-dropdown' },
      [filterDropdown]
    ) : h(
      _FilterDropdownMenuWrapper2['default'],
      { 'class': prefixCls + '-dropdown' },
      [h(
        _vcMenu2['default'],
        {
          attrs: {
            multiple: multiple,

            prefixCls: dropdownPrefixCls + '-menu',

            selectedKeys: originSelectedKeys && originSelectedKeys.map(function (val) {
              return val.toString();
            }),
            getPopupContainer: getPopupContainer
          },
          on: {
            'click': this.handleMenuItemClick,
            'select': this.setSelectedKeys,
            'deselect': this.setSelectedKeys
          },
          'class': dropdownMenuClass
        },
        [this.renderMenus(column.filters)]
      ), h(
        'div',
        { 'class': prefixCls + '-dropdown-btns' },
        [h(
          'a',
          { 'class': prefixCls + '-dropdown-link confirm', on: {
              'click': this.handleConfirm
            }
          },
          [locale.filterConfirm]
        ), h(
          'a',
          { 'class': prefixCls + '-dropdown-link clear', on: {
              'click': this.handleClearFilters
            }
          },
          [locale.filterReset]
        )]
      )]
    );

    return h(
      _dropdown2['default'],
      {
        attrs: {
          trigger: ['click'],
          placement: 'bottomRight',
          visible: this.getDropdownVisible(),

          getPopupContainer: getPopupContainer,
          forceRender: true
        },
        on: {
          'visibleChange': this.onVisibleChange
        }
      },
      [h(
        'template',
        { slot: 'overlay' },
        [menus]
      ), this.renderFilterIcon()]
    );
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/table/index.js":
/*!********************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/table/index.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _objectWithoutProperties2 = __webpack_require__(/*! babel-runtime/helpers/objectWithoutProperties */ "./node_modules/babel-runtime/helpers/objectWithoutProperties.js");

var _objectWithoutProperties3 = _interopRequireDefault(_objectWithoutProperties2);

var _Table = __webpack_require__(/*! ./Table */ "./node_modules/ant-design-vue/lib/table/Table.js");

var _Table2 = _interopRequireDefault(_Table);

var _vueRef = __webpack_require__(/*! vue-ref */ "./node_modules/vue-ref/index.js");

var _vueRef2 = _interopRequireDefault(_vueRef);

var _vue = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.common.js");

var _vue2 = _interopRequireDefault(_vue);

var _propsUtil = __webpack_require__(/*! ../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

var _base = __webpack_require__(/*! ../base */ "./node_modules/ant-design-vue/lib/base/index.js");

var _base2 = _interopRequireDefault(_base);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

_vue2['default'].use(_vueRef2['default'], { name: 'ant-ref' });

var Table = {
  name: 'ATable',
  Column: _Table2['default'].Column,
  ColumnGroup: _Table2['default'].ColumnGroup,
  props: _Table2['default'].props,
  methods: {
    normalize: function normalize() {
      var _this = this;

      var elements = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : [];

      var columns = [];
      elements.forEach(function (element) {
        if (!element.tag) {
          return;
        }
        var key = (0, _propsUtil.getKey)(element);
        var style = (0, _propsUtil.getStyle)(element);
        var cls = (0, _propsUtil.getClass)(element);
        var props = (0, _propsUtil.getOptionProps)(element);
        var events = (0, _propsUtil.getEvents)(element);
        var listeners = {};
        Object.keys(events).forEach(function (e) {
          var k = 'on-' + e;
          listeners[(0, _propsUtil.camelize)(k)] = events[e];
        });

        var _getSlots = (0, _propsUtil.getSlots)(element),
            children = _getSlots['default'],
            restSlots = (0, _objectWithoutProperties3['default'])(_getSlots, ['default']);

        var column = (0, _extends3['default'])({}, restSlots, props, { style: style, 'class': cls }, listeners);
        if (key) {
          column.key = key;
        }
        if ((0, _propsUtil.getSlotOptions)(element).__ANT_TABLE_COLUMN_GROUP) {
          column.children = _this.normalize(typeof children === 'function' ? children() : children);
        } else {
          var customRender = element.data && element.data.scopedSlots && element.data.scopedSlots['default'];
          column.customRender = column.customRender || customRender;
        }
        columns.push(column);
      });
      return columns;
    },
    updateColumns: function updateColumns() {
      var _this2 = this;

      var cols = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : [];

      var columns = [];
      var $slots = this.$slots,
          $scopedSlots = this.$scopedSlots;

      cols.forEach(function (col) {
        var _col$slots = col.slots,
            slots = _col$slots === undefined ? {} : _col$slots,
            _col$scopedSlots = col.scopedSlots,
            scopedSlots = _col$scopedSlots === undefined ? {} : _col$scopedSlots,
            restProps = (0, _objectWithoutProperties3['default'])(col, ['slots', 'scopedSlots']);

        var column = (0, _extends3['default'])({}, restProps);
        Object.keys(slots).forEach(function (key) {
          var name = slots[key];
          if (column[key] === undefined && $slots[name]) {
            column[key] = $slots[name].length === 1 ? $slots[name][0] : $slots[name];
          }
        });
        Object.keys(scopedSlots).forEach(function (key) {
          var name = scopedSlots[key];
          if (column[key] === undefined && $scopedSlots[name]) {
            column[key] = $scopedSlots[name];
          }
        });
        // if (slotScopeName && $scopedSlots[slotScopeName]) {
        //   column.customRender = column.customRender || $scopedSlots[slotScopeName]
        // }
        if (col.children) {
          column.children = _this2.updateColumns(column.children);
        }
        columns.push(column);
      });
      return columns;
    }
  },
  render: function render() {
    var h = arguments[0];
    var $slots = this.$slots,
        normalize = this.normalize,
        $scopedSlots = this.$scopedSlots;

    var props = (0, _propsUtil.getOptionProps)(this);
    var columns = props.columns ? this.updateColumns(props.columns) : normalize($slots['default']);
    var title = props.title,
        footer = props.footer;
    var slotTitle = $scopedSlots.title,
        slotFooter = $scopedSlots.footer,
        _$scopedSlots$expande = $scopedSlots.expandedRowRender,
        expandedRowRender = _$scopedSlots$expande === undefined ? props.expandedRowRender : _$scopedSlots$expande;

    title = title || slotTitle;
    footer = footer || slotFooter;
    var tProps = {
      props: (0, _extends3['default'])({}, props, {
        columns: columns,
        title: title,
        footer: footer,
        expandedRowRender: expandedRowRender
      }),
      on: (0, _propsUtil.getListeners)(this)
    };
    return h(_Table2['default'], tProps);
  }
};
/* istanbul ignore next */
Table.install = function (Vue) {
  Vue.use(_base2['default']);
  Vue.component(Table.name, Table);
  Vue.component(Table.Column.name, Table.Column);
  Vue.component(Table.ColumnGroup.name, Table.ColumnGroup);
};

exports['default'] = Table;

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/table/interface.js":
/*!************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/table/interface.js ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.FilterMenuProps = exports.SelectionBoxProps = exports.SelectionCheckboxAllProps = exports.TableProps = exports.TableRowSelection = exports.RowSelectionType = exports.TableLocale = exports.ColumnProps = exports.ColumnFilterItem = undefined;

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _vueTypes = __webpack_require__(/*! ../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _pagination = __webpack_require__(/*! ../pagination */ "./node_modules/ant-design-vue/lib/pagination/index.js");

var _spin = __webpack_require__(/*! ../spin */ "./node_modules/ant-design-vue/lib/spin/index.js");

var _createStore = __webpack_require__(/*! ./createStore */ "./node_modules/ant-design-vue/lib/table/createStore.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var PaginationProps = (0, _pagination.PaginationProps)();
var SpinProps = (0, _spin.SpinProps)();

// export type CompareFn<T> = ((a: T, b: T) => number);
var ColumnFilterItem = exports.ColumnFilterItem = _vueTypes2['default'].shape({
  text: _vueTypes2['default'].string,
  value: _vueTypes2['default'].string,
  children: _vueTypes2['default'].array
}).loose;

var ColumnProps = exports.ColumnProps = {
  title: _vueTypes2['default'].any,
  // key?: React.Key;
  dataIndex: _vueTypes2['default'].string,
  customRender: _vueTypes2['default'].func,
  customCell: _vueTypes2['default'].func,
  customHeaderCell: _vueTypes2['default'].func,
  align: _vueTypes2['default'].oneOf(['left', 'right', 'center']),
  ellipsis: _vueTypes2['default'].bool,
  filters: _vueTypes2['default'].arrayOf(ColumnFilterItem),
  // onFilter: (value: any, record: T) => PropTypes.bool,
  filterMultiple: _vueTypes2['default'].bool,
  filterDropdown: _vueTypes2['default'].any,
  filterDropdownVisible: _vueTypes2['default'].bool,
  // onFilterDropdownVisibleChange?: (visible: boolean) => void;
  sorter: _vueTypes2['default'].oneOfType([_vueTypes2['default'].boolean, _vueTypes2['default'].func]),
  defaultSortOrder: _vueTypes2['default'].oneOf(['ascend', 'descend']),
  colSpan: _vueTypes2['default'].number,
  width: _vueTypes2['default'].oneOfType([_vueTypes2['default'].string, _vueTypes2['default'].number]),
  className: _vueTypes2['default'].string,
  fixed: _vueTypes2['default'].oneOfType([_vueTypes2['default'].bool, _vueTypes2['default'].oneOf(['left', 'right'])]),
  filterIcon: _vueTypes2['default'].any,
  filteredValue: _vueTypes2['default'].array,
  filtered: _vueTypes2['default'].bool,
  defaultFilteredValue: _vueTypes2['default'].array,
  sortOrder: _vueTypes2['default'].oneOfType([_vueTypes2['default'].bool, _vueTypes2['default'].oneOf(['ascend', 'descend'])]),
  sortDirections: _vueTypes2['default'].array
  // children?: ColumnProps<T>[];
  // onCellClick?: (record: T, event: any) => void;
  // onCell?: (record: T) => any;
  // onHeaderCell?: (props: ColumnProps<T>) => any;
};

// export interface TableComponents {
//   table?: any;
//   header?: {
//     wrapper?: any;
//     row?: any;
//     cell?: any;
//   };
//   body?: {
//     wrapper?: any;
//     row?: any;
//     cell?: any;
//   };
// }

var TableLocale = exports.TableLocale = _vueTypes2['default'].shape({
  filterTitle: _vueTypes2['default'].string,
  filterConfirm: _vueTypes2['default'].any,
  filterReset: _vueTypes2['default'].any,
  emptyText: _vueTypes2['default'].any,
  selectAll: _vueTypes2['default'].any,
  selectInvert: _vueTypes2['default'].any,
  sortTitle: _vueTypes2['default'].string,
  expand: _vueTypes2['default'].string,
  collapse: _vueTypes2['default'].string
}).loose;

var RowSelectionType = exports.RowSelectionType = _vueTypes2['default'].oneOf(['checkbox', 'radio']);
// export type SelectionSelectFn<T> = (record: T, selected: boolean, selectedRows: Object[]) => any;

var TableRowSelection = exports.TableRowSelection = {
  type: RowSelectionType,
  selectedRowKeys: _vueTypes2['default'].array,
  // onChange?: (selectedRowKeys: string[] | number[], selectedRows: Object[]) => any;
  getCheckboxProps: _vueTypes2['default'].func,
  // onSelect?: SelectionSelectFn<T>;
  // onSelectAll?: (selected: boolean, selectedRows: Object[], changeRows: Object[]) => any;
  // onSelectInvert?: (selectedRows: Object[]) => any;
  selections: _vueTypes2['default'].oneOfType([_vueTypes2['default'].array, _vueTypes2['default'].bool]),
  hideDefaultSelections: _vueTypes2['default'].bool,
  fixed: _vueTypes2['default'].bool,
  columnWidth: _vueTypes2['default'].oneOfType([_vueTypes2['default'].string, _vueTypes2['default'].number]),
  selectWay: _vueTypes2['default'].oneOf(['onSelect', 'onSelectMultiple', 'onSelectAll', 'onSelectInvert']),
  columnTitle: _vueTypes2['default'].any
};

var TableProps = exports.TableProps = {
  prefixCls: _vueTypes2['default'].string,
  dropdownPrefixCls: _vueTypes2['default'].string,
  rowSelection: _vueTypes2['default'].oneOfType([_vueTypes2['default'].shape(TableRowSelection).loose, null]),
  pagination: _vueTypes2['default'].oneOfType([_vueTypes2['default'].shape((0, _extends3['default'])({}, PaginationProps, {
    position: _vueTypes2['default'].oneOf(['top', 'bottom', 'both'])
  })).loose, _vueTypes2['default'].bool]),
  size: _vueTypes2['default'].oneOf(['default', 'middle', 'small', 'large']),
  dataSource: _vueTypes2['default'].array,
  components: _vueTypes2['default'].object,
  columns: _vueTypes2['default'].array,
  rowKey: _vueTypes2['default'].oneOfType([_vueTypes2['default'].string, _vueTypes2['default'].func]),
  rowClassName: _vueTypes2['default'].func,
  expandedRowRender: _vueTypes2['default'].any,
  defaultExpandAllRows: _vueTypes2['default'].bool,
  defaultExpandedRowKeys: _vueTypes2['default'].array,
  expandedRowKeys: _vueTypes2['default'].array,
  expandIconAsCell: _vueTypes2['default'].bool,
  expandIconColumnIndex: _vueTypes2['default'].number,
  expandRowByClick: _vueTypes2['default'].bool,
  // onExpandedRowsChange?: (expandedRowKeys: string[] | number[]) => void;
  //  onExpand?: (expanded: boolean, record: T) => void;
  // onChange?: (pagination: PaginationProps | boolean, filters: string[], sorter: Object) => any;
  loading: _vueTypes2['default'].oneOfType([_vueTypes2['default'].shape(SpinProps).loose, _vueTypes2['default'].bool]),
  locale: TableLocale,
  indentSize: _vueTypes2['default'].number,
  // onRowClick?: (record: T, index: number, event: Event) => any;
  customRow: _vueTypes2['default'].func,
  customHeaderRow: _vueTypes2['default'].func,
  useFixedHeader: _vueTypes2['default'].bool,
  bordered: _vueTypes2['default'].bool,
  showHeader: _vueTypes2['default'].bool,
  footer: _vueTypes2['default'].func,
  title: _vueTypes2['default'].func,
  scroll: _vueTypes2['default'].object,
  childrenColumnName: _vueTypes2['default'].oneOfType([_vueTypes2['default'].array, _vueTypes2['default'].string]),
  bodyStyle: _vueTypes2['default'].any,
  sortDirections: _vueTypes2['default'].array,
  tableLayout: _vueTypes2['default'].string,
  getPopupContainer: _vueTypes2['default'].func,
  expandIcon: _vueTypes2['default'].func,
  transformCellText: _vueTypes2['default'].func
  // className?: PropTypes.string,
  // style?: React.CSSProperties;
  // children?: React.ReactNode;
};

// export interface TableStateFilters {
//   [key: string]: string[];
// }

// export interface TableState<T> {
//   pagination: PaginationProps;
//   filters: TableStateFilters;
//   sortColumn: ColumnProps<T> | null;
//   sortOrder: PropTypes.string,
// }

// export type SelectionItemSelectFn = (key: string[]) => any;

// export interface SelectionItem {
//   key: PropTypes.string,
//   text: PropTypes.any,
//   onSelect: SelectionItemSelectFn;
// }

var SelectionCheckboxAllProps = exports.SelectionCheckboxAllProps = {
  store: _createStore.Store,
  locale: _vueTypes2['default'].any,
  disabled: _vueTypes2['default'].bool,
  getCheckboxPropsByItem: _vueTypes2['default'].func,
  getRecordKey: _vueTypes2['default'].func,
  data: _vueTypes2['default'].array,
  prefixCls: _vueTypes2['default'].string,
  // onSelect: (key: string, index: number, selectFunc: any) => void;
  hideDefaultSelections: _vueTypes2['default'].bool,
  selections: _vueTypes2['default'].oneOfType([_vueTypes2['default'].array, _vueTypes2['default'].bool]),
  getPopupContainer: _vueTypes2['default'].func
};

// export interface SelectionCheckboxAllState {
//   checked: PropTypes.bool,
//   indeterminate: PropTypes.bool,
// }

var SelectionBoxProps = exports.SelectionBoxProps = {
  store: _createStore.Store,
  type: RowSelectionType,
  defaultSelection: _vueTypes2['default'].arrayOf([_vueTypes2['default'].string, _vueTypes2['default'].number]),
  rowIndex: _vueTypes2['default'].oneOfType([_vueTypes2['default'].string, _vueTypes2['default'].number]),
  name: _vueTypes2['default'].string,
  disabled: _vueTypes2['default'].bool,
  id: _vueTypes2['default'].string
  // onChange: React.ChangeEventHandler<HTMLInputElement>;
};

// export interface SelectionBoxState {
//   checked?: PropTypes.bool,
// }

var FilterMenuProps = exports.FilterMenuProps = {
  _propsSymbol: _vueTypes2['default'].any,
  locale: TableLocale,
  selectedKeys: _vueTypes2['default'].arrayOf([_vueTypes2['default'].string, _vueTypes2['default'].number]),
  column: _vueTypes2['default'].object,
  confirmFilter: _vueTypes2['default'].func,
  prefixCls: _vueTypes2['default'].string,
  dropdownPrefixCls: _vueTypes2['default'].string,
  getPopupContainer: _vueTypes2['default'].func,
  handleFilter: _vueTypes2['default'].func
};

// export interface FilterMenuState {
//   selectedKeys: string[];
//   keyPathOfSelectedItem: { [key: string]: string };
//   visible?: PropTypes.bool,
// }

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/table/util.js":
/*!*******************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/table/util.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _toConsumableArray2 = __webpack_require__(/*! babel-runtime/helpers/toConsumableArray */ "./node_modules/babel-runtime/helpers/toConsumableArray.js");

var _toConsumableArray3 = _interopRequireDefault(_toConsumableArray2);

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

exports.flatArray = flatArray;
exports.treeMap = treeMap;
exports.flatFilter = flatFilter;
exports.generateValueMaps = generateValueMaps;

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

function flatArray() {
  var data = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : [];
  var childrenName = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'children';

  var result = [];
  var loop = function loop(array) {
    array.forEach(function (item) {
      if (item[childrenName]) {
        var newItem = (0, _extends3['default'])({}, item);
        delete newItem[childrenName];
        result.push(newItem);
        if (item[childrenName].length > 0) {
          loop(item[childrenName]);
        }
      } else {
        result.push(item);
      }
    });
  };
  loop(data);
  return result;
}

function treeMap(tree, mapper) {
  var childrenName = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'children';

  return tree.map(function (node, index) {
    var extra = {};
    if (node[childrenName]) {
      extra[childrenName] = treeMap(node[childrenName], mapper, childrenName);
    }
    return (0, _extends3['default'])({}, mapper(node, index), extra);
  });
}

function flatFilter(tree, callback) {
  return tree.reduce(function (acc, node) {
    if (callback(node)) {
      acc.push(node);
    }
    if (node.children) {
      var children = flatFilter(node.children, callback);
      acc.push.apply(acc, (0, _toConsumableArray3['default'])(children));
    }
    return acc;
  }, []);
}

// export function normalizeColumns (elements) {
//   const columns = []
//   React.Children.forEach(elements, (element) => {
//     if (!React.isValidElement(element)) {
//       return
//     }
//     const column = {
//       ...element.props,
//     }
//     if (element.key) {
//       column.key = element.key
//     }
//     if (element.type && element.type.__ANT_TABLE_COLUMN_GROUP) {
//       column.children = normalizeColumns(column.children)
//     }
//     columns.push(column)
//   })
//   return columns
// }

function generateValueMaps(items) {
  var maps = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

  (items || []).forEach(function (_ref) {
    var value = _ref.value,
        children = _ref.children;

    maps[value.toString()] = value;
    generateValueMaps(children, maps);
  });
  return maps;
}

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-pagination/KeyCode.js":
/*!******************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-pagination/KeyCode.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = {
  ZERO: 48,
  NINE: 57,

  NUMPAD_ZERO: 96,
  NUMPAD_NINE: 105,

  BACKSPACE: 8,
  DELETE: 46,
  ENTER: 13,

  ARROW_UP: 38,
  ARROW_DOWN: 40
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-pagination/Options.js":
/*!******************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-pagination/Options.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _babelHelperVueJsxMergeProps = __webpack_require__(/*! babel-helper-vue-jsx-merge-props */ "./node_modules/babel-helper-vue-jsx-merge-props/index.js");

var _babelHelperVueJsxMergeProps2 = _interopRequireDefault(_babelHelperVueJsxMergeProps);

var _vueTypes = __webpack_require__(/*! ../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _KeyCode = __webpack_require__(/*! ./KeyCode */ "./node_modules/ant-design-vue/lib/vc-pagination/KeyCode.js");

var _KeyCode2 = _interopRequireDefault(_KeyCode);

var _BaseMixin = __webpack_require__(/*! ../_util/BaseMixin */ "./node_modules/ant-design-vue/lib/_util/BaseMixin.js");

var _BaseMixin2 = _interopRequireDefault(_BaseMixin);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports['default'] = {
  mixins: [_BaseMixin2['default']],
  props: {
    disabled: _vueTypes2['default'].bool,
    changeSize: _vueTypes2['default'].func,
    quickGo: _vueTypes2['default'].func,
    selectComponentClass: _vueTypes2['default'].any,
    current: _vueTypes2['default'].number,
    pageSizeOptions: _vueTypes2['default'].array.def(['10', '20', '30', '40']),
    pageSize: _vueTypes2['default'].number,
    buildOptionText: _vueTypes2['default'].func,
    locale: _vueTypes2['default'].object,
    rootPrefixCls: _vueTypes2['default'].string,
    selectPrefixCls: _vueTypes2['default'].string,
    goButton: _vueTypes2['default'].any
  },
  data: function data() {
    return {
      goInputText: ''
    };
  },

  methods: {
    getValidValue: function getValidValue() {
      var goInputText = this.goInputText,
          current = this.current;

      return !goInputText || isNaN(goInputText) ? current : Number(goInputText);
    },
    defaultBuildOptionText: function defaultBuildOptionText(opt) {
      return opt.value + ' ' + this.locale.items_per_page;
    },
    handleChange: function handleChange(e) {
      var _e$target = e.target,
          value = _e$target.value,
          composing = _e$target.composing;

      if (e.isComposing || composing || this.goInputText === value) return;
      this.setState({
        goInputText: value
      });
    },
    handleBlur: function handleBlur(e) {
      var _$props = this.$props,
          goButton = _$props.goButton,
          quickGo = _$props.quickGo,
          rootPrefixCls = _$props.rootPrefixCls;

      if (goButton) {
        return;
      }
      if (e.relatedTarget && (e.relatedTarget.className.indexOf(rootPrefixCls + '-prev') >= 0 || e.relatedTarget.className.indexOf(rootPrefixCls + '-next') >= 0)) {
        return;
      }
      quickGo(this.getValidValue());
    },
    go: function go(e) {
      var goInputText = this.goInputText;

      if (goInputText === '') {
        return;
      }
      if (e.keyCode === _KeyCode2['default'].ENTER || e.type === 'click') {
        // https://github.com/vueComponent/ant-design-vue/issues/1316
        this.quickGo(this.getValidValue());
        this.setState({
          goInputText: ''
        });
      }
    }
  },
  render: function render() {
    var _this = this;

    var h = arguments[0];
    var rootPrefixCls = this.rootPrefixCls,
        locale = this.locale,
        changeSize = this.changeSize,
        quickGo = this.quickGo,
        goButton = this.goButton,
        Select = this.selectComponentClass,
        defaultBuildOptionText = this.defaultBuildOptionText,
        selectPrefixCls = this.selectPrefixCls,
        pageSize = this.pageSize,
        pageSizeOptions = this.pageSizeOptions,
        goInputText = this.goInputText,
        disabled = this.disabled;

    var prefixCls = rootPrefixCls + '-options';
    var changeSelect = null;
    var goInput = null;
    var gotoButton = null;

    if (!changeSize && !quickGo) {
      return null;
    }

    if (changeSize && Select) {
      var buildOptionText = this.buildOptionText || defaultBuildOptionText;
      var options = pageSizeOptions.map(function (opt, i) {
        return h(
          Select.Option,
          { key: i, attrs: { value: opt }
          },
          [buildOptionText({ value: opt })]
        );
      });

      changeSelect = h(
        Select,
        {
          attrs: {
            disabled: disabled,
            prefixCls: selectPrefixCls,
            showSearch: false,

            optionLabelProp: 'children',
            dropdownMatchSelectWidth: false,
            value: (pageSize || pageSizeOptions[0]).toString(),

            getPopupContainer: function getPopupContainer(triggerNode) {
              return triggerNode.parentNode;
            }
          },
          'class': prefixCls + '-size-changer', on: {
            'change': function change(value) {
              return _this.changeSize(Number(value));
            }
          }
        },
        [options]
      );
    }

    if (quickGo) {
      if (goButton) {
        gotoButton = typeof goButton === 'boolean' ? h(
          'button',
          {
            attrs: { type: 'button', disabled: disabled },
            on: {
              'click': this.go,
              'keyup': this.go
            }
          },
          [locale.jump_to_confirm]
        ) : h(
          'span',
          {
            on: {
              'click': this.go,
              'keyup': this.go
            }
          },
          [goButton]
        );
      }
      goInput = h(
        'div',
        { 'class': prefixCls + '-quick-jumper' },
        [locale.jump_to, h('input', (0, _babelHelperVueJsxMergeProps2['default'])([{
          attrs: {
            disabled: disabled,
            type: 'text'
          },
          domProps: {
            'value': goInputText
          },
          on: {
            'input': this.handleChange,
            'keyup': this.go,
            'blur': this.handleBlur
          }
        }, {
          directives: [{
            name: 'ant-input'
          }]
        }])), locale.page, gotoButton]
      );
    }

    return h(
      'li',
      { 'class': '' + prefixCls },
      [changeSelect, goInput]
    );
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-pagination/Pager.js":
/*!****************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-pagination/Pager.js ***!
  \****************************************************************/
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

var _classnames = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");

var _classnames2 = _interopRequireDefault(_classnames);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports['default'] = {
  name: 'Pager',
  props: {
    rootPrefixCls: _vueTypes2['default'].string,
    page: _vueTypes2['default'].number,
    active: _vueTypes2['default'].bool,
    last: _vueTypes2['default'].bool,
    locale: _vueTypes2['default'].object,
    showTitle: _vueTypes2['default'].bool,
    itemRender: {
      type: Function,
      'default': function _default() {}
    }
  },
  methods: {
    handleClick: function handleClick() {
      this.$emit('click', this.page);
    },
    handleKeyPress: function handleKeyPress(event) {
      this.$emit('keypress', event, this.handleClick, this.page);
    }
  },
  render: function render() {
    var _classNames;

    var h = arguments[0];

    var props = this.$props;
    var prefixCls = props.rootPrefixCls + '-item';
    var cls = (0, _classnames2['default'])(prefixCls, prefixCls + '-' + props.page, (_classNames = {}, (0, _defineProperty3['default'])(_classNames, prefixCls + '-active', props.active), (0, _defineProperty3['default'])(_classNames, prefixCls + '-disabled', !props.page), _classNames));

    return h(
      'li',
      {
        'class': cls,
        on: {
          'click': this.handleClick,
          'keypress': this.handleKeyPress
        },
        attrs: {
          title: this.showTitle ? this.page : null,
          tabIndex: '0'
        }
      },
      [this.itemRender(this.page, 'page', h('a', [this.page]))]
    );
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-pagination/Pagination.js":
/*!*********************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-pagination/Pagination.js ***!
  \*********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _defineProperty2 = __webpack_require__(/*! babel-runtime/helpers/defineProperty */ "./node_modules/babel-runtime/helpers/defineProperty.js");

var _defineProperty3 = _interopRequireDefault(_defineProperty2);

var _babelHelperVueJsxMergeProps = __webpack_require__(/*! babel-helper-vue-jsx-merge-props */ "./node_modules/babel-helper-vue-jsx-merge-props/index.js");

var _babelHelperVueJsxMergeProps2 = _interopRequireDefault(_babelHelperVueJsxMergeProps);

var _toConsumableArray2 = __webpack_require__(/*! babel-runtime/helpers/toConsumableArray */ "./node_modules/babel-runtime/helpers/toConsumableArray.js");

var _toConsumableArray3 = _interopRequireDefault(_toConsumableArray2);

var _vueTypes = __webpack_require__(/*! ../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _BaseMixin = __webpack_require__(/*! ../_util/BaseMixin */ "./node_modules/ant-design-vue/lib/_util/BaseMixin.js");

var _BaseMixin2 = _interopRequireDefault(_BaseMixin);

var _propsUtil = __webpack_require__(/*! ../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

var _Pager = __webpack_require__(/*! ./Pager */ "./node_modules/ant-design-vue/lib/vc-pagination/Pager.js");

var _Pager2 = _interopRequireDefault(_Pager);

var _Options = __webpack_require__(/*! ./Options */ "./node_modules/ant-design-vue/lib/vc-pagination/Options.js");

var _Options2 = _interopRequireDefault(_Options);

var _zh_CN = __webpack_require__(/*! ./locale/zh_CN */ "./node_modules/ant-design-vue/lib/vc-pagination/locale/zh_CN.js");

var _zh_CN2 = _interopRequireDefault(_zh_CN);

var _KeyCode = __webpack_require__(/*! ./KeyCode */ "./node_modules/ant-design-vue/lib/vc-pagination/KeyCode.js");

var _KeyCode2 = _interopRequireDefault(_KeyCode);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

function noop() {}

// 是否是正整数
function isInteger(value) {
  return typeof value === 'number' && isFinite(value) && Math.floor(value) === value;
}

function defaultItemRender(page, type, element) {
  return element;
}

function calculatePage(p, state, props) {
  var pageSize = p;
  if (typeof pageSize === 'undefined') {
    pageSize = state.statePageSize;
  }
  return Math.floor((props.total - 1) / pageSize) + 1;
}

exports['default'] = {
  name: 'Pagination',
  mixins: [_BaseMixin2['default']],
  model: {
    prop: 'current',
    event: 'change.current'
  },
  props: {
    disabled: _vueTypes2['default'].bool,
    prefixCls: _vueTypes2['default'].string.def('rc-pagination'),
    selectPrefixCls: _vueTypes2['default'].string.def('rc-select'),
    current: _vueTypes2['default'].number,
    defaultCurrent: _vueTypes2['default'].number.def(1),
    total: _vueTypes2['default'].number.def(0),
    pageSize: _vueTypes2['default'].number,
    defaultPageSize: _vueTypes2['default'].number.def(10),
    hideOnSinglePage: _vueTypes2['default'].bool.def(false),
    showSizeChanger: _vueTypes2['default'].bool.def(false),
    showLessItems: _vueTypes2['default'].bool.def(false),
    // showSizeChange: PropTypes.func.def(noop),
    selectComponentClass: _vueTypes2['default'].any,
    showPrevNextJumpers: _vueTypes2['default'].bool.def(true),
    showQuickJumper: _vueTypes2['default'].oneOfType([_vueTypes2['default'].bool, _vueTypes2['default'].object]).def(false),
    showTitle: _vueTypes2['default'].bool.def(true),
    pageSizeOptions: _vueTypes2['default'].arrayOf(_vueTypes2['default'].string),
    buildOptionText: _vueTypes2['default'].func,
    showTotal: _vueTypes2['default'].func,
    simple: _vueTypes2['default'].bool,
    locale: _vueTypes2['default'].object.def(_zh_CN2['default']),
    itemRender: _vueTypes2['default'].func.def(defaultItemRender),
    prevIcon: _vueTypes2['default'].any,
    nextIcon: _vueTypes2['default'].any,
    jumpPrevIcon: _vueTypes2['default'].any,
    jumpNextIcon: _vueTypes2['default'].any
  },
  data: function data() {
    var props = (0, _propsUtil.getOptionProps)(this);
    var hasOnChange = this.onChange !== noop;
    var hasCurrent = 'current' in props;
    if (hasCurrent && !hasOnChange) {
      console.warn('Warning: You provided a `current` prop to a Pagination component without an `onChange` handler. This will render a read-only component.'); // eslint-disable-line
    }
    var current = this.defaultCurrent;
    if ('current' in props) {
      current = this.current;
    }

    var pageSize = this.defaultPageSize;
    if ('pageSize' in props) {
      pageSize = this.pageSize;
    }

    current = Math.min(current, calculatePage(pageSize, undefined, props));

    return {
      stateCurrent: current,
      stateCurrentInputValue: current,
      statePageSize: pageSize
    };
  },

  watch: {
    current: function current(val) {
      this.setState({
        stateCurrent: val,
        stateCurrentInputValue: val
      });
    },
    pageSize: function pageSize(val) {
      var newState = {};
      var current = this.stateCurrent;
      var newCurrent = calculatePage(val, this.$data, this.$props);
      current = current > newCurrent ? newCurrent : current;
      if (!(0, _propsUtil.hasProp)(this, 'current')) {
        newState.stateCurrent = current;
        newState.stateCurrentInputValue = current;
      }
      newState.statePageSize = val;
      this.setState(newState);
    },
    stateCurrent: function stateCurrent(val, oldValue) {
      var _this = this;

      // When current page change, fix focused style of prev item
      // A hacky solution of https://github.com/ant-design/ant-design/issues/8948
      this.$nextTick(function () {
        if (_this.$refs.paginationNode) {
          var lastCurrentNode = _this.$refs.paginationNode.querySelector('.' + _this.prefixCls + '-item-' + oldValue);
          if (lastCurrentNode && document.activeElement === lastCurrentNode) {
            lastCurrentNode.blur();
          }
        }
      });
    },
    total: function total() {
      var newState = {};
      var newCurrent = calculatePage(this.pageSize, this.$data, this.$props);
      if ((0, _propsUtil.hasProp)(this, 'current')) {
        var current = Math.min(this.current, newCurrent);
        newState.stateCurrent = current;
        newState.stateCurrentInputValue = current;
      } else {
        var _current = this.stateCurrent;
        if (_current === 0 && newCurrent > 0) {
          _current = 1;
        } else {
          _current = Math.min(this.stateCurrent, newCurrent);
        }
        newState.stateCurrent = _current;
      }
      this.setState(newState);
    }
  },
  methods: {
    getJumpPrevPage: function getJumpPrevPage() {
      return Math.max(1, this.stateCurrent - (this.showLessItems ? 3 : 5));
    },
    getJumpNextPage: function getJumpNextPage() {
      return Math.min(calculatePage(undefined, this.$data, this.$props), this.stateCurrent + (this.showLessItems ? 3 : 5));
    },
    getItemIcon: function getItemIcon(icon) {
      var h = this.$createElement;
      var prefixCls = this.$props.prefixCls;

      var iconNode = (0, _propsUtil.getComponentFromProp)(this, icon, this.$props) || h('a', { 'class': prefixCls + '-item-link' });
      return iconNode;
    },
    getValidValue: function getValidValue(e) {
      var inputValue = e.target.value;
      var allPages = calculatePage(undefined, this.$data, this.$props);
      var stateCurrentInputValue = this.$data.stateCurrentInputValue;

      var value = void 0;
      if (inputValue === '') {
        value = inputValue;
      } else if (isNaN(Number(inputValue))) {
        value = stateCurrentInputValue;
      } else if (inputValue >= allPages) {
        value = allPages;
      } else {
        value = Number(inputValue);
      }
      return value;
    },
    isValid: function isValid(page) {
      return isInteger(page) && page !== this.stateCurrent;
    },
    shouldDisplayQuickJumper: function shouldDisplayQuickJumper() {
      var _$props = this.$props,
          showQuickJumper = _$props.showQuickJumper,
          pageSize = _$props.pageSize,
          total = _$props.total;

      if (total <= pageSize) {
        return false;
      }
      return showQuickJumper;
    },

    // calculatePage (p) {
    //   let pageSize = p
    //   if (typeof pageSize === 'undefined') {
    //     pageSize = this.statePageSize
    //   }
    //   return Math.floor((this.total - 1) / pageSize) + 1
    // },
    handleKeyDown: function handleKeyDown(event) {
      if (event.keyCode === _KeyCode2['default'].ARROW_UP || event.keyCode === _KeyCode2['default'].ARROW_DOWN) {
        event.preventDefault();
      }
    },
    handleKeyUp: function handleKeyUp(e) {
      if (e.isComposing || e.target.composing) return;
      var value = this.getValidValue(e);
      var stateCurrentInputValue = this.stateCurrentInputValue;

      if (value !== stateCurrentInputValue) {
        this.setState({
          stateCurrentInputValue: value
        });
      }

      if (e.keyCode === _KeyCode2['default'].ENTER) {
        this.handleChange(value);
      } else if (e.keyCode === _KeyCode2['default'].ARROW_UP) {
        this.handleChange(value - 1);
      } else if (e.keyCode === _KeyCode2['default'].ARROW_DOWN) {
        this.handleChange(value + 1);
      }
    },
    changePageSize: function changePageSize(size) {
      var current = this.stateCurrent;
      var preCurrent = current;
      var newCurrent = calculatePage(size, this.$data, this.$props);
      current = current > newCurrent ? newCurrent : current;
      // fix the issue:
      // Once 'total' is 0, 'current' in 'onShowSizeChange' is 0, which is not correct.
      if (newCurrent === 0) {
        current = this.stateCurrent;
      }
      if (typeof size === 'number') {
        if (!(0, _propsUtil.hasProp)(this, 'pageSize')) {
          this.setState({
            statePageSize: size
          });
        }
        if (!(0, _propsUtil.hasProp)(this, 'current')) {
          this.setState({
            stateCurrent: current,
            stateCurrentInputValue: current
          });
        }
      }
      this.$emit('update:pageSize', size);
      this.$emit('showSizeChange', current, size);
      if (current !== preCurrent) {
        this.$emit('change.current', current, size);
      }
    },
    handleChange: function handleChange(p) {
      var disabled = this.$props.disabled;

      var page = p;
      if (this.isValid(page) && !disabled) {
        var currentPage = calculatePage(undefined, this.$data, this.$props);
        if (page > currentPage) {
          page = currentPage;
        } else if (page < 1) {
          page = 1;
        }
        if (!(0, _propsUtil.hasProp)(this, 'current')) {
          this.setState({
            stateCurrent: page,
            stateCurrentInputValue: page
          });
        }
        // this.$emit('input', page)
        this.$emit('change', page, this.statePageSize);
        this.$emit('change.current', page, this.statePageSize);
        return page;
      }
      return this.stateCurrent;
    },
    prev: function prev() {
      if (this.hasPrev()) {
        this.handleChange(this.stateCurrent - 1);
      }
    },
    next: function next() {
      if (this.hasNext()) {
        this.handleChange(this.stateCurrent + 1);
      }
    },
    jumpPrev: function jumpPrev() {
      this.handleChange(this.getJumpPrevPage());
    },
    jumpNext: function jumpNext() {
      this.handleChange(this.getJumpNextPage());
    },
    hasPrev: function hasPrev() {
      return this.stateCurrent > 1;
    },
    hasNext: function hasNext() {
      return this.stateCurrent < calculatePage(undefined, this.$data, this.$props);
    },
    runIfEnter: function runIfEnter(event, callback) {
      if (event.key === 'Enter' || event.charCode === 13) {
        for (var _len = arguments.length, restParams = Array(_len > 2 ? _len - 2 : 0), _key = 2; _key < _len; _key++) {
          restParams[_key - 2] = arguments[_key];
        }

        callback.apply(undefined, (0, _toConsumableArray3['default'])(restParams));
      }
    },
    runIfEnterPrev: function runIfEnterPrev(event) {
      this.runIfEnter(event, this.prev);
    },
    runIfEnterNext: function runIfEnterNext(event) {
      this.runIfEnter(event, this.next);
    },
    runIfEnterJumpPrev: function runIfEnterJumpPrev(event) {
      this.runIfEnter(event, this.jumpPrev);
    },
    runIfEnterJumpNext: function runIfEnterJumpNext(event) {
      this.runIfEnter(event, this.jumpNext);
    },
    handleGoTO: function handleGoTO(event) {
      if (event.keyCode === _KeyCode2['default'].ENTER || event.type === 'click') {
        this.handleChange(this.stateCurrentInputValue);
      }
    }
  },
  render: function render() {
    var _ref;

    var h = arguments[0];
    var _$props2 = this.$props,
        prefixCls = _$props2.prefixCls,
        disabled = _$props2.disabled;

    // When hideOnSinglePage is true and there is only 1 page, hide the pager

    if (this.hideOnSinglePage === true && this.total <= this.statePageSize) {
      return null;
    }
    var props = this.$props;
    var locale = this.locale;

    var allPages = calculatePage(undefined, this.$data, this.$props);
    var pagerList = [];
    var jumpPrev = null;
    var jumpNext = null;
    var firstPager = null;
    var lastPager = null;
    var gotoButton = null;
    var goButton = this.showQuickJumper && this.showQuickJumper.goButton;
    var pageBufferSize = this.showLessItems ? 1 : 2;
    var stateCurrent = this.stateCurrent,
        statePageSize = this.statePageSize;

    var prevPage = stateCurrent - 1 > 0 ? stateCurrent - 1 : 0;
    var nextPage = stateCurrent + 1 < allPages ? stateCurrent + 1 : allPages;

    if (this.simple) {
      if (goButton) {
        if (typeof goButton === 'boolean') {
          gotoButton = h(
            'button',
            {
              attrs: { type: 'button' },
              on: {
                'click': this.handleGoTO,
                'keyup': this.handleGoTO
              }
            },
            [locale.jump_to_confirm]
          );
        } else {
          gotoButton = h(
            'span',
            {
              on: {
                'click': this.handleGoTO,
                'keyup': this.handleGoTO
              }
            },
            [goButton]
          );
        }
        gotoButton = h(
          'li',
          {
            attrs: {
              title: this.showTitle ? '' + locale.jump_to + this.stateCurrent + '/' + allPages : null
            },
            'class': prefixCls + '-simple-pager'
          },
          [gotoButton]
        );
      }
      var hasPrev = this.hasPrev();
      var hasNext = this.hasNext();
      return h(
        'ul',
        { 'class': prefixCls + ' ' + prefixCls + '-simple' },
        [h(
          'li',
          {
            attrs: {
              title: this.showTitle ? locale.prev_page : null,

              tabIndex: hasPrev ? 0 : null,

              'aria-disabled': !this.hasPrev()
            },
            on: {
              'click': this.prev,
              'keypress': this.runIfEnterPrev
            },

            'class': (hasPrev ? '' : prefixCls + '-disabled') + ' ' + prefixCls + '-prev' },
          [this.itemRender(prevPage, 'prev', this.getItemIcon('prevIcon'))]
        ), h(
          'li',
          {
            attrs: {
              title: this.showTitle ? stateCurrent + '/' + allPages : null
            },
            'class': prefixCls + '-simple-pager'
          },
          [h('input', (0, _babelHelperVueJsxMergeProps2['default'])([{
            attrs: {
              type: 'text',

              size: '3'
            },
            domProps: {
              'value': this.stateCurrentInputValue
            },
            on: {
              'keydown': this.handleKeyDown,
              'keyup': this.handleKeyUp,
              'input': this.handleKeyUp
            }
          }, {
            directives: [{
              name: 'ant-input'
            }]
          }])), h(
            'span',
            { 'class': prefixCls + '-slash' },
            ['\uFF0F']
          ), allPages]
        ), h(
          'li',
          {
            attrs: {
              title: this.showTitle ? locale.next_page : null,

              tabIndex: this.hasNext ? 0 : null,

              'aria-disabled': !this.hasNext()
            },
            on: {
              'click': this.next,
              'keypress': this.runIfEnterNext
            },

            'class': (hasNext ? '' : prefixCls + '-disabled') + ' ' + prefixCls + '-next' },
          [this.itemRender(nextPage, 'next', this.getItemIcon('nextIcon'))]
        ), gotoButton]
      );
    }
    if (allPages <= 5 + pageBufferSize * 2) {
      var pagerProps = {
        props: {
          locale: locale,
          rootPrefixCls: prefixCls,
          showTitle: props.showTitle,
          itemRender: props.itemRender
        },
        on: {
          click: this.handleChange,
          keypress: this.runIfEnter
        }
      };
      if (!allPages) {
        pagerList.push(h(_Pager2['default'], (0, _babelHelperVueJsxMergeProps2['default'])([pagerProps, { key: 'noPager', attrs: { page: allPages },
          'class': prefixCls + '-disabled' }])));
      }
      for (var i = 1; i <= allPages; i++) {
        var active = stateCurrent === i;
        pagerList.push(h(_Pager2['default'], (0, _babelHelperVueJsxMergeProps2['default'])([pagerProps, { key: i, attrs: { page: i, active: active }
        }])));
      }
    } else {
      var prevItemTitle = this.showLessItems ? locale.prev_3 : locale.prev_5;
      var nextItemTitle = this.showLessItems ? locale.next_3 : locale.next_5;
      if (this.showPrevNextJumpers) {
        var jumpPrevClassString = prefixCls + '-jump-prev';
        if (props.jumpPrevIcon) {
          jumpPrevClassString += ' ' + prefixCls + '-jump-prev-custom-icon';
        }
        jumpPrev = h(
          'li',
          {
            attrs: {
              title: this.showTitle ? prevItemTitle : null,

              tabIndex: '0'
            },
            key: 'prev',
            on: {
              'click': this.jumpPrev,
              'keypress': this.runIfEnterJumpPrev
            },

            'class': jumpPrevClassString
          },
          [this.itemRender(this.getJumpPrevPage(), 'jump-prev', this.getItemIcon('jumpPrevIcon'))]
        );
        var jumpNextClassString = prefixCls + '-jump-next';
        if (props.jumpNextIcon) {
          jumpNextClassString += ' ' + prefixCls + '-jump-next-custom-icon';
        }
        jumpNext = h(
          'li',
          {
            attrs: {
              title: this.showTitle ? nextItemTitle : null,

              tabIndex: '0'
            },
            key: 'next', on: {
              'click': this.jumpNext,
              'keypress': this.runIfEnterJumpNext
            },

            'class': jumpNextClassString
          },
          [this.itemRender(this.getJumpNextPage(), 'jump-next', this.getItemIcon('jumpNextIcon'))]
        );
      }

      lastPager = h(_Pager2['default'], {
        attrs: {
          locale: locale,
          last: true,
          rootPrefixCls: prefixCls,

          page: allPages,
          active: false,
          showTitle: this.showTitle,
          itemRender: this.itemRender
        },
        on: {
          'click': this.handleChange,
          'keypress': this.runIfEnter
        },

        key: allPages });
      firstPager = h(_Pager2['default'], {
        attrs: {
          locale: locale,
          rootPrefixCls: prefixCls,

          page: 1,
          active: false,
          showTitle: this.showTitle,
          itemRender: this.itemRender
        },
        on: {
          'click': this.handleChange,
          'keypress': this.runIfEnter
        },

        key: 1 });

      var left = Math.max(1, stateCurrent - pageBufferSize);
      var right = Math.min(stateCurrent + pageBufferSize, allPages);

      if (stateCurrent - 1 <= pageBufferSize) {
        right = 1 + pageBufferSize * 2;
      }

      if (allPages - stateCurrent <= pageBufferSize) {
        left = allPages - pageBufferSize * 2;
      }

      for (var _i = left; _i <= right; _i++) {
        var _active = stateCurrent === _i;
        pagerList.push(h(_Pager2['default'], {
          attrs: {
            locale: locale,
            rootPrefixCls: prefixCls,

            page: _i,
            active: _active,
            showTitle: this.showTitle,
            itemRender: this.itemRender
          },
          on: {
            'click': this.handleChange,
            'keypress': this.runIfEnter
          },

          key: _i }));
      }

      if (stateCurrent - 1 >= pageBufferSize * 2 && stateCurrent !== 1 + 2) {
        pagerList[0] = h(_Pager2['default'], {
          attrs: {
            locale: locale,
            rootPrefixCls: prefixCls,

            page: left,

            active: false,
            showTitle: this.showTitle,
            itemRender: this.itemRender
          },
          on: {
            'click': this.handleChange,
            'keypress': this.runIfEnter
          },

          key: left, 'class': prefixCls + '-item-after-jump-prev' });
        pagerList.unshift(jumpPrev);
      }
      if (allPages - stateCurrent >= pageBufferSize * 2 && stateCurrent !== allPages - 2) {
        pagerList[pagerList.length - 1] = h(_Pager2['default'], {
          attrs: {
            locale: locale,
            rootPrefixCls: prefixCls,

            page: right,

            active: false,
            showTitle: this.showTitle,
            itemRender: this.itemRender
          },
          on: {
            'click': this.handleChange,
            'keypress': this.runIfEnter
          },

          key: right, 'class': prefixCls + '-item-before-jump-next' });
        pagerList.push(jumpNext);
      }

      if (left !== 1) {
        pagerList.unshift(firstPager);
      }
      if (right !== allPages) {
        pagerList.push(lastPager);
      }
    }

    var totalText = null;

    if (this.showTotal) {
      totalText = h(
        'li',
        { 'class': prefixCls + '-total-text' },
        [this.showTotal(this.total, [this.total === 0 ? 0 : (stateCurrent - 1) * statePageSize + 1, stateCurrent * statePageSize > this.total ? this.total : stateCurrent * statePageSize])]
      );
    }
    var prevDisabled = !this.hasPrev() || !allPages;
    var nextDisabled = !this.hasNext() || !allPages;
    var buildOptionText = this.buildOptionText || this.$scopedSlots.buildOptionText;
    return h(
      'ul',
      {
        'class': (_ref = {}, (0, _defineProperty3['default'])(_ref, '' + prefixCls, true), (0, _defineProperty3['default'])(_ref, prefixCls + '-disabled', disabled), _ref),
        attrs: { unselectable: 'unselectable'
        },
        ref: 'paginationNode'
      },
      [totalText, h(
        'li',
        {
          attrs: {
            title: this.showTitle ? locale.prev_page : null,

            tabIndex: prevDisabled ? null : 0,

            'aria-disabled': prevDisabled
          },
          on: {
            'click': this.prev,
            'keypress': this.runIfEnterPrev
          },

          'class': (!prevDisabled ? '' : prefixCls + '-disabled') + ' ' + prefixCls + '-prev' },
        [this.itemRender(prevPage, 'prev', this.getItemIcon('prevIcon'))]
      ), pagerList, h(
        'li',
        {
          attrs: {
            title: this.showTitle ? locale.next_page : null,

            tabIndex: nextDisabled ? null : 0,

            'aria-disabled': nextDisabled
          },
          on: {
            'click': this.next,
            'keypress': this.runIfEnterNext
          },

          'class': (!nextDisabled ? '' : prefixCls + '-disabled') + ' ' + prefixCls + '-next' },
        [this.itemRender(nextPage, 'next', this.getItemIcon('nextIcon'))]
      ), h(_Options2['default'], {
        attrs: {
          disabled: disabled,
          locale: locale,
          rootPrefixCls: prefixCls,
          selectComponentClass: this.selectComponentClass,
          selectPrefixCls: this.selectPrefixCls,
          changeSize: this.showSizeChanger ? this.changePageSize : null,
          current: stateCurrent,
          pageSize: statePageSize,
          pageSizeOptions: this.pageSizeOptions,
          buildOptionText: buildOptionText || null,
          quickGo: this.shouldDisplayQuickJumper() ? this.handleChange : null,
          goButton: goButton
        }
      })]
    );
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-pagination/index.js":
/*!****************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-pagination/index.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _Pagination = __webpack_require__(/*! ./Pagination */ "./node_modules/ant-design-vue/lib/vc-pagination/Pagination.js");

Object.defineProperty(exports, 'default', {
  enumerable: true,
  get: function get() {
    return _interopRequireDefault(_Pagination)['default'];
  }
});

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-pagination/locale/zh_CN.js":
/*!***********************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-pagination/locale/zh_CN.js ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports['default'] = {
  // Options.jsx
  items_per_page: '条/页',
  jump_to: '跳至',
  jump_to_confirm: '确定',
  page: '页',

  // Pagination.jsx
  prev_page: '上一页',
  next_page: '下一页',
  prev_5: '向前 5 页',
  next_5: '向后 5 页',
  prev_3: '向前 3 页',
  next_3: '向后 3 页'
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-table/index.js":
/*!***********************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-table/index.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.INTERNAL_COL_DEFINE = exports.ColumnGroup = exports.Column = undefined;

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _Table = __webpack_require__(/*! ./src/Table */ "./node_modules/ant-design-vue/lib/vc-table/src/Table.js");

var _Table2 = _interopRequireDefault(_Table);

var _Column = __webpack_require__(/*! ./src/Column */ "./node_modules/ant-design-vue/lib/vc-table/src/Column.js");

var _Column2 = _interopRequireDefault(_Column);

var _ColumnGroup = __webpack_require__(/*! ./src/ColumnGroup */ "./node_modules/ant-design-vue/lib/vc-table/src/ColumnGroup.js");

var _ColumnGroup2 = _interopRequireDefault(_ColumnGroup);

var _propsUtil = __webpack_require__(/*! ../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

var _utils = __webpack_require__(/*! ./src/utils */ "./node_modules/ant-design-vue/lib/vc-table/src/utils.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var Table = {
  name: 'Table',
  Column: _Column2['default'],
  ColumnGroup: _ColumnGroup2['default'],
  props: _Table2['default'].props,
  methods: {
    getTableNode: function getTableNode() {
      return this.$refs.table.tableNode;
    },
    getBodyTable: function getBodyTable() {
      return this.$refs.table.ref_bodyTable;
    },
    normalize: function normalize() {
      var _this = this;

      var elements = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : [];

      var columns = [];
      elements.forEach(function (element) {
        if (!element.tag) {
          return;
        }
        var key = (0, _propsUtil.getKey)(element);
        var style = (0, _propsUtil.getStyle)(element);
        var cls = (0, _propsUtil.getClass)(element);
        var props = (0, _propsUtil.getOptionProps)(element);
        var events = (0, _propsUtil.getEvents)(element);
        var listeners = {};
        Object.keys(events).forEach(function (e) {
          var k = 'on-' + e;
          listeners[(0, _propsUtil.camelize)(k)] = events[e];
        });

        var _getSlots = (0, _propsUtil.getSlots)(element),
            children = _getSlots['default'],
            title = _getSlots.title;

        var column = (0, _extends3['default'])({ title: title }, props, { style: style, 'class': cls }, listeners);
        if (key) {
          column.key = key;
        }
        if ((0, _propsUtil.getSlotOptions)(element).isTableColumnGroup) {
          column.children = _this.normalize(typeof children === 'function' ? children() : children);
        } else {
          var customRender = element.data && element.data.scopedSlots && element.data.scopedSlots['default'];
          column.customRender = column.customRender || customRender;
        }
        columns.push(column);
      });
      return columns;
    }
  },
  render: function render() {
    var h = arguments[0];
    var $slots = this.$slots,
        normalize = this.normalize;

    var props = (0, _propsUtil.getOptionProps)(this);
    var columns = props.columns || normalize($slots['default']);
    var tProps = {
      props: (0, _extends3['default'])({}, props, {
        columns: columns
      }),
      on: (0, _propsUtil.getListeners)(this),
      ref: 'table'
    };
    return h(_Table2['default'], tProps);
  }
}; // base rc-table 6.10.9
exports['default'] = Table;
exports.Column = _Column2['default'];
exports.ColumnGroup = _ColumnGroup2['default'];
exports.INTERNAL_COL_DEFINE = _utils.INTERNAL_COL_DEFINE;

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-table/src/BaseTable.js":
/*!*******************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-table/src/BaseTable.js ***!
  \*******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _vueTypes = __webpack_require__(/*! ../../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _classnames = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");

var _classnames2 = _interopRequireDefault(_classnames);

var _ColGroup = __webpack_require__(/*! ./ColGroup */ "./node_modules/ant-design-vue/lib/vc-table/src/ColGroup.js");

var _ColGroup2 = _interopRequireDefault(_ColGroup);

var _TableHeader = __webpack_require__(/*! ./TableHeader */ "./node_modules/ant-design-vue/lib/vc-table/src/TableHeader.js");

var _TableHeader2 = _interopRequireDefault(_TableHeader);

var _TableRow = __webpack_require__(/*! ./TableRow */ "./node_modules/ant-design-vue/lib/vc-table/src/TableRow.js");

var _TableRow2 = _interopRequireDefault(_TableRow);

var _ExpandableRow = __webpack_require__(/*! ./ExpandableRow */ "./node_modules/ant-design-vue/lib/vc-table/src/ExpandableRow.js");

var _ExpandableRow2 = _interopRequireDefault(_ExpandableRow);

var _propsUtil = __webpack_require__(/*! ../../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

var _store = __webpack_require__(/*! ../../_util/store */ "./node_modules/ant-design-vue/lib/_util/store/index.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

function noop() {}
var BaseTable = {
  name: 'BaseTable',
  props: {
    fixed: _vueTypes2['default'].oneOfType([_vueTypes2['default'].string, _vueTypes2['default'].bool]),
    columns: _vueTypes2['default'].array.isRequired,
    tableClassName: _vueTypes2['default'].string.isRequired,
    hasHead: _vueTypes2['default'].bool.isRequired,
    hasBody: _vueTypes2['default'].bool.isRequired,
    store: _vueTypes2['default'].object.isRequired,
    expander: _vueTypes2['default'].object.isRequired,
    getRowKey: _vueTypes2['default'].func,
    isAnyColumnsFixed: _vueTypes2['default'].bool
  },
  inject: {
    table: { 'default': function _default() {
        return {};
      } }
  },
  methods: {
    getColumns: function getColumns(cols) {
      var _$props = this.$props,
          _$props$columns = _$props.columns,
          columns = _$props$columns === undefined ? [] : _$props$columns,
          fixed = _$props.fixed;
      var table = this.table;
      var prefixCls = table.$props.prefixCls;

      return (cols || columns).map(function (column) {
        return (0, _extends3['default'])({}, column, {
          className: !!column.fixed && !fixed ? (0, _classnames2['default'])(prefixCls + '-fixed-columns-in-body', column.className || column['class']) : column.className || column['class']
        });
      });
    },
    handleRowHover: function handleRowHover(isHover, key) {
      this.store.setState({
        currentHoverKey: isHover ? key : null
      });
    },
    renderRows: function renderRows(renderData, indent) {
      var _this = this;

      var ancestorKeys = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : [];
      var h = this.$createElement;
      var _table = this.table,
          columnManager = _table.columnManager,
          components = _table.sComponents,
          prefixCls = _table.prefixCls,
          childrenColumnName = _table.childrenColumnName,
          rowClassName = _table.rowClassName,
          _table$customRow = _table.customRow,
          customRow = _table$customRow === undefined ? noop : _table$customRow;

      var _getListeners = (0, _propsUtil.getListeners)(this.table),
          _getListeners$rowClic = _getListeners.rowClick,
          onRowClick = _getListeners$rowClic === undefined ? noop : _getListeners$rowClic,
          _getListeners$rowDoub = _getListeners.rowDoubleclick,
          onRowDoubleClick = _getListeners$rowDoub === undefined ? noop : _getListeners$rowDoub,
          _getListeners$rowCont = _getListeners.rowContextmenu,
          onRowContextMenu = _getListeners$rowCont === undefined ? noop : _getListeners$rowCont,
          _getListeners$rowMous = _getListeners.rowMouseenter,
          onRowMouseEnter = _getListeners$rowMous === undefined ? noop : _getListeners$rowMous,
          _getListeners$rowMous2 = _getListeners.rowMouseleave,
          onRowMouseLeave = _getListeners$rowMous2 === undefined ? noop : _getListeners$rowMous2;

      var getRowKey = this.getRowKey,
          fixed = this.fixed,
          expander = this.expander,
          isAnyColumnsFixed = this.isAnyColumnsFixed;


      var rows = [];

      var _loop = function _loop(i) {
        var record = renderData[i];
        var key = getRowKey(record, i);
        var className = typeof rowClassName === 'string' ? rowClassName : rowClassName(record, i, indent);

        var onHoverProps = {};
        if (columnManager.isAnyColumnsFixed()) {
          onHoverProps.hover = _this.handleRowHover;
        }

        var leafColumns = void 0;
        if (fixed === 'left') {
          leafColumns = columnManager.leftLeafColumns();
        } else if (fixed === 'right') {
          leafColumns = columnManager.rightLeafColumns();
        } else {
          leafColumns = _this.getColumns(columnManager.leafColumns());
        }

        var rowPrefixCls = prefixCls + '-row';

        var expandableRowProps = {
          props: (0, _extends3['default'])({}, expander.props, {
            fixed: fixed,
            index: i,
            prefixCls: rowPrefixCls,
            record: record,
            rowKey: key,
            needIndentSpaced: expander.needIndentSpaced
          }),
          key: key,
          on: {
            // ...expander.on,
            rowClick: onRowClick,
            expandedChange: expander.handleExpandChange
          },
          scopedSlots: {
            'default': function _default(expandableRow) {
              var tableRowProps = (0, _propsUtil.mergeProps)({
                props: {
                  fixed: fixed,
                  indent: indent,
                  record: record,
                  index: i,
                  prefixCls: rowPrefixCls,
                  childrenColumnName: childrenColumnName,
                  columns: leafColumns,
                  rowKey: key,
                  ancestorKeys: ancestorKeys,
                  components: components,
                  isAnyColumnsFixed: isAnyColumnsFixed,
                  customRow: customRow
                },
                on: (0, _extends3['default'])({
                  rowDoubleclick: onRowDoubleClick,
                  rowContextmenu: onRowContextMenu,
                  rowMouseenter: onRowMouseEnter,
                  rowMouseleave: onRowMouseLeave
                }, onHoverProps),
                'class': className,
                ref: 'row_' + i + '_' + indent
              }, expandableRow);
              return h(_TableRow2['default'], tableRowProps);
            }
          }
        };
        var row = h(_ExpandableRow2['default'], expandableRowProps);

        rows.push(row);
        expander.renderRows(_this.renderRows, rows, record, i, indent, fixed, key, ancestorKeys);
      };

      for (var i = 0; i < renderData.length; i += 1) {
        _loop(i);
      }
      return rows;
    }
  },

  render: function render() {
    var h = arguments[0];
    var _table2 = this.table,
        components = _table2.sComponents,
        prefixCls = _table2.prefixCls,
        scroll = _table2.scroll,
        data = _table2.data,
        getBodyWrapper = _table2.getBodyWrapper;
    var _$props2 = this.$props,
        expander = _$props2.expander,
        tableClassName = _$props2.tableClassName,
        hasHead = _$props2.hasHead,
        hasBody = _$props2.hasBody,
        fixed = _$props2.fixed,
        isAnyColumnsFixed = _$props2.isAnyColumnsFixed;


    var tableStyle = {};

    if (!fixed && scroll.x) {
      // 当有固定列时，width auto 会导致 body table 的宽度撑不开，从而固定列无法对齐
      // 详情见：https://github.com/ant-design/ant-design/issues/22160
      var tableWidthScrollX = isAnyColumnsFixed ? 'max-content' : 'auto';
      // not set width, then use content fixed width
      tableStyle.width = scroll.x === true ? tableWidthScrollX : scroll.x;
      tableStyle.width = typeof tableStyle.width === 'number' ? tableStyle.width + 'px' : tableStyle.width;
    }

    var Table = hasBody ? components.table : 'table';
    var BodyWrapper = components.body.wrapper;

    var body = void 0;
    if (hasBody) {
      body = h(
        BodyWrapper,
        { 'class': prefixCls + '-tbody' },
        [this.renderRows(data, 0)]
      );
      if (getBodyWrapper) {
        body = getBodyWrapper(body);
      }
    }
    var columns = this.getColumns();
    return h(
      Table,
      { 'class': tableClassName, style: tableStyle, key: 'table' },
      [h(_ColGroup2['default'], {
        attrs: { columns: columns, fixed: fixed }
      }), hasHead && h(_TableHeader2['default'], {
        attrs: { expander: expander, columns: columns, fixed: fixed }
      }), body]
    );
  }
};

exports['default'] = (0, _store.connect)()(BaseTable);

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-table/src/BodyTable.js":
/*!*******************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-table/src/BodyTable.js ***!
  \*******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _babelHelperVueJsxMergeProps = __webpack_require__(/*! babel-helper-vue-jsx-merge-props */ "./node_modules/babel-helper-vue-jsx-merge-props/index.js");

var _babelHelperVueJsxMergeProps2 = _interopRequireDefault(_babelHelperVueJsxMergeProps);

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _vueTypes = __webpack_require__(/*! ../../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _utils = __webpack_require__(/*! ./utils */ "./node_modules/ant-design-vue/lib/vc-table/src/utils.js");

var _BaseTable = __webpack_require__(/*! ./BaseTable */ "./node_modules/ant-design-vue/lib/vc-table/src/BaseTable.js");

var _BaseTable2 = _interopRequireDefault(_BaseTable);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports['default'] = {
  name: 'BodyTable',
  props: {
    fixed: _vueTypes2['default'].oneOfType([_vueTypes2['default'].string, _vueTypes2['default'].bool]),
    columns: _vueTypes2['default'].array.isRequired,
    tableClassName: _vueTypes2['default'].string.isRequired,
    handleBodyScroll: _vueTypes2['default'].func.isRequired,
    handleWheel: _vueTypes2['default'].func.isRequired,
    getRowKey: _vueTypes2['default'].func.isRequired,
    expander: _vueTypes2['default'].object.isRequired,
    isAnyColumnsFixed: _vueTypes2['default'].bool
  },
  inject: {
    table: { 'default': function _default() {
        return {};
      } }
  },
  render: function render() {
    var h = arguments[0];
    var _table = this.table,
        prefixCls = _table.prefixCls,
        scroll = _table.scroll;
    var columns = this.columns,
        fixed = this.fixed,
        tableClassName = this.tableClassName,
        getRowKey = this.getRowKey,
        handleBodyScroll = this.handleBodyScroll,
        handleWheel = this.handleWheel,
        expander = this.expander,
        isAnyColumnsFixed = this.isAnyColumnsFixed;
    var _table2 = this.table,
        useFixedHeader = _table2.useFixedHeader,
        saveRef = _table2.saveRef;

    var bodyStyle = (0, _extends3['default'])({}, this.table.bodyStyle);
    var innerBodyStyle = {};

    if (scroll.x || fixed) {
      bodyStyle.overflowX = bodyStyle.overflowX || 'scroll';
      // Fix weired webkit render bug
      // https://github.com/ant-design/ant-design/issues/7783
      bodyStyle.WebkitTransform = 'translate3d (0, 0, 0)';
    }

    if (scroll.y) {
      // maxHeight will make fixed-Table scrolling not working
      // so we only set maxHeight to body-Table here
      var maxHeight = bodyStyle.maxHeight || scroll.y;
      maxHeight = typeof maxHeight === 'number' ? maxHeight + 'px' : maxHeight;
      if (fixed) {
        innerBodyStyle.maxHeight = maxHeight;
        innerBodyStyle.overflowY = bodyStyle.overflowY || 'scroll';
      } else {
        bodyStyle.maxHeight = maxHeight;
      }
      bodyStyle.overflowY = bodyStyle.overflowY || 'scroll';
      useFixedHeader = true;

      // Add negative margin bottom for scroll bar overflow bug
      var scrollbarWidth = (0, _utils.measureScrollbar)({ direction: 'vertical' });
      if (scrollbarWidth > 0 && fixed) {
        bodyStyle.marginBottom = '-' + scrollbarWidth + 'px';
        bodyStyle.paddingBottom = '0px';
      }
    }

    var baseTable = h(_BaseTable2['default'], {
      attrs: {
        tableClassName: tableClassName,
        hasHead: !useFixedHeader,
        hasBody: true,
        fixed: fixed,
        columns: columns,
        expander: expander,
        getRowKey: getRowKey,
        isAnyColumnsFixed: isAnyColumnsFixed
      }
    });

    if (fixed && columns.length) {
      var refName = void 0;
      if (columns[0].fixed === 'left' || columns[0].fixed === true) {
        refName = 'fixedColumnsBodyLeft';
      } else if (columns[0].fixed === 'right') {
        refName = 'fixedColumnsBodyRight';
      }
      delete bodyStyle.overflowX;
      delete bodyStyle.overflowY;
      return h(
        'div',
        { key: 'bodyTable', 'class': prefixCls + '-body-outer', style: (0, _extends3['default'])({}, bodyStyle) },
        [h(
          'div',
          (0, _babelHelperVueJsxMergeProps2['default'])([{
            'class': prefixCls + '-body-inner',
            style: innerBodyStyle
          }, {
            directives: [{
              name: 'ant-ref',
              value: saveRef(refName)
            }]
          }, {
            on: {
              'wheel': handleWheel,
              'scroll': handleBodyScroll
            }
          }]),
          [baseTable]
        )]
      );
    }
    // Should provides `tabIndex` if use scroll to enable keyboard scroll
    var useTabIndex = scroll && (scroll.x || scroll.y);

    return h(
      'div',
      (0, _babelHelperVueJsxMergeProps2['default'])([{
        attrs: {
          tabIndex: useTabIndex ? -1 : undefined
        },
        key: 'bodyTable',
        'class': prefixCls + '-body',
        style: bodyStyle
      }, {
        directives: [{
          name: 'ant-ref',
          value: saveRef('bodyTable')
        }]
      }, {
        on: {
          'wheel': handleWheel,
          'scroll': handleBodyScroll
        }
      }]),
      [baseTable]
    );
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-table/src/ColGroup.js":
/*!******************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-table/src/ColGroup.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _babelHelperVueJsxMergeProps = __webpack_require__(/*! babel-helper-vue-jsx-merge-props */ "./node_modules/babel-helper-vue-jsx-merge-props/index.js");

var _babelHelperVueJsxMergeProps2 = _interopRequireDefault(_babelHelperVueJsxMergeProps);

var _vueTypes = __webpack_require__(/*! ../../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _utils = __webpack_require__(/*! ./utils */ "./node_modules/ant-design-vue/lib/vc-table/src/utils.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports['default'] = {
  name: 'ColGroup',
  props: {
    fixed: _vueTypes2['default'].string,
    columns: _vueTypes2['default'].array
  },
  inject: {
    table: { 'default': function _default() {
        return {};
      } }
  },
  render: function render() {
    var h = arguments[0];
    var fixed = this.fixed,
        table = this.table;
    var prefixCls = table.prefixCls,
        expandIconAsCell = table.expandIconAsCell,
        columnManager = table.columnManager;


    var cols = [];

    if (expandIconAsCell && fixed !== 'right') {
      cols.push(h('col', { 'class': prefixCls + '-expand-icon-col', key: 'rc-table-expand-icon-col' }));
    }

    var leafColumns = void 0;

    if (fixed === 'left') {
      leafColumns = columnManager.leftLeafColumns();
    } else if (fixed === 'right') {
      leafColumns = columnManager.rightLeafColumns();
    } else {
      leafColumns = columnManager.leafColumns();
    }
    cols = cols.concat(leafColumns.map(function (_ref) {
      var key = _ref.key,
          dataIndex = _ref.dataIndex,
          width = _ref.width,
          additionalProps = _ref[_utils.INTERNAL_COL_DEFINE];

      var mergedKey = key !== undefined ? key : dataIndex;
      var w = typeof width === 'number' ? width + 'px' : width;
      return h('col', (0, _babelHelperVueJsxMergeProps2['default'])([{ key: mergedKey, style: { width: w, minWidth: w } }, additionalProps]));
    }));
    return h('colgroup', [cols]);
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-table/src/Column.js":
/*!****************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-table/src/Column.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _vueTypes = __webpack_require__(/*! ../../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports['default'] = {
  name: 'Column',
  props: {
    rowSpan: _vueTypes2['default'].number,
    colSpan: _vueTypes2['default'].number,
    title: _vueTypes2['default'].any,
    dataIndex: _vueTypes2['default'].string,
    width: _vueTypes2['default'].oneOfType([_vueTypes2['default'].number, _vueTypes2['default'].string]),
    ellipsis: _vueTypes2['default'].bool,
    fixed: _vueTypes2['default'].oneOf([true, 'left', 'right']),
    align: _vueTypes2['default'].oneOf(['left', 'center', 'right']),
    customRender: _vueTypes2['default'].func,
    className: _vueTypes2['default'].string,
    // onCellClick: PropTypes.func,
    customCell: _vueTypes2['default'].func,
    customHeaderCell: _vueTypes2['default'].func
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-table/src/ColumnGroup.js":
/*!*********************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-table/src/ColumnGroup.js ***!
  \*********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _vueTypes = __webpack_require__(/*! ../../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports['default'] = {
  name: 'ColumnGroup',
  props: {
    title: _vueTypes2['default'].any
  },
  isTableColumnGroup: true
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-table/src/ColumnManager.js":
/*!***********************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-table/src/ColumnManager.js ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _toConsumableArray2 = __webpack_require__(/*! babel-runtime/helpers/toConsumableArray */ "./node_modules/babel-runtime/helpers/toConsumableArray.js");

var _toConsumableArray3 = _interopRequireDefault(_toConsumableArray2);

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _classCallCheck2 = __webpack_require__(/*! babel-runtime/helpers/classCallCheck */ "./node_modules/babel-runtime/helpers/classCallCheck.js");

var _classCallCheck3 = _interopRequireDefault(_classCallCheck2);

var _createClass2 = __webpack_require__(/*! babel-runtime/helpers/createClass */ "./node_modules/babel-runtime/helpers/createClass.js");

var _createClass3 = _interopRequireDefault(_createClass2);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var ColumnManager = function () {
  function ColumnManager(columns) {
    (0, _classCallCheck3['default'])(this, ColumnManager);

    this.columns = columns;
    this._cached = {};
  }

  (0, _createClass3['default'])(ColumnManager, [{
    key: 'isAnyColumnsFixed',
    value: function isAnyColumnsFixed() {
      var _this = this;

      return this._cache('isAnyColumnsFixed', function () {
        return _this.columns.some(function (column) {
          return !!column.fixed;
        });
      });
    }
  }, {
    key: 'isAnyColumnsLeftFixed',
    value: function isAnyColumnsLeftFixed() {
      var _this2 = this;

      return this._cache('isAnyColumnsLeftFixed', function () {
        return _this2.columns.some(function (column) {
          return column.fixed === 'left' || column.fixed === true;
        });
      });
    }
  }, {
    key: 'isAnyColumnsRightFixed',
    value: function isAnyColumnsRightFixed() {
      var _this3 = this;

      return this._cache('isAnyColumnsRightFixed', function () {
        return _this3.columns.some(function (column) {
          return column.fixed === 'right';
        });
      });
    }
  }, {
    key: 'leftColumns',
    value: function leftColumns() {
      var _this4 = this;

      return this._cache('leftColumns', function () {
        return _this4.groupedColumns().filter(function (column) {
          return column.fixed === 'left' || column.fixed === true;
        });
      });
    }
  }, {
    key: 'rightColumns',
    value: function rightColumns() {
      var _this5 = this;

      return this._cache('rightColumns', function () {
        return _this5.groupedColumns().filter(function (column) {
          return column.fixed === 'right';
        });
      });
    }
  }, {
    key: 'leafColumns',
    value: function leafColumns() {
      var _this6 = this;

      return this._cache('leafColumns', function () {
        return _this6._leafColumns(_this6.columns);
      });
    }
  }, {
    key: 'leftLeafColumns',
    value: function leftLeafColumns() {
      var _this7 = this;

      return this._cache('leftLeafColumns', function () {
        return _this7._leafColumns(_this7.leftColumns());
      });
    }
  }, {
    key: 'rightLeafColumns',
    value: function rightLeafColumns() {
      var _this8 = this;

      return this._cache('rightLeafColumns', function () {
        return _this8._leafColumns(_this8.rightColumns());
      });
    }

    // add appropriate rowspan and colspan to column

  }, {
    key: 'groupedColumns',
    value: function groupedColumns() {
      var _this9 = this;

      return this._cache('groupedColumns', function () {
        var _groupColumns = function _groupColumns(columns) {
          var currentRow = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;
          var parentColumn = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
          var rows = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : [];

          // track how many rows we got
          rows[currentRow] = rows[currentRow] || [];
          var grouped = [];
          var setRowSpan = function setRowSpan(column) {
            var rowSpan = rows.length - currentRow;
            if (column && !column.children && // parent columns are supposed to be one row
            rowSpan > 1 && (!column.rowSpan || column.rowSpan < rowSpan)) {
              column.rowSpan = rowSpan;
            }
          };
          columns.forEach(function (column, index) {
            var newColumn = (0, _extends3['default'])({}, column);
            rows[currentRow].push(newColumn);
            parentColumn.colSpan = parentColumn.colSpan || 0;
            if (newColumn.children && newColumn.children.length > 0) {
              newColumn.children = _groupColumns(newColumn.children, currentRow + 1, newColumn, rows);
              parentColumn.colSpan += newColumn.colSpan;
            } else {
              parentColumn.colSpan += 1;
            }
            // update rowspan to all same row columns
            for (var i = 0; i < rows[currentRow].length - 1; i += 1) {
              setRowSpan(rows[currentRow][i]);
            }
            // last column, update rowspan immediately
            if (index + 1 === columns.length) {
              setRowSpan(newColumn);
            }
            grouped.push(newColumn);
          });
          return grouped;
        };
        return _groupColumns(_this9.columns);
      });
    }
  }, {
    key: 'reset',
    value: function reset(columns) {
      this.columns = columns;
      this._cached = {};
    }
  }, {
    key: '_cache',
    value: function _cache(name, fn) {
      if (name in this._cached) {
        return this._cached[name];
      }
      this._cached[name] = fn();
      return this._cached[name];
    }
  }, {
    key: '_leafColumns',
    value: function _leafColumns(columns) {
      var _this10 = this;

      var leafColumns = [];
      columns.forEach(function (column) {
        if (!column.children) {
          leafColumns.push(column);
        } else {
          leafColumns.push.apply(leafColumns, (0, _toConsumableArray3['default'])(_this10._leafColumns(column.children)));
        }
      });
      return leafColumns;
    }
  }]);
  return ColumnManager;
}();

exports['default'] = ColumnManager;

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-table/src/ExpandIcon.js":
/*!********************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-table/src/ExpandIcon.js ***!
  \********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _vueTypes = __webpack_require__(/*! ../../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _BaseMixin = __webpack_require__(/*! ../../_util/BaseMixin */ "./node_modules/ant-design-vue/lib/_util/BaseMixin.js");

var _BaseMixin2 = _interopRequireDefault(_BaseMixin);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports['default'] = {
  name: 'ExpandIcon',
  mixins: [_BaseMixin2['default']],
  props: {
    record: _vueTypes2['default'].object,
    prefixCls: _vueTypes2['default'].string,
    expandable: _vueTypes2['default'].any,
    expanded: _vueTypes2['default'].bool,
    needIndentSpaced: _vueTypes2['default'].bool
  },
  methods: {
    onExpand: function onExpand(e) {
      this.__emit('expand', this.record, e);
    }
  },

  render: function render() {
    var h = arguments[0];
    var expandable = this.expandable,
        prefixCls = this.prefixCls,
        onExpand = this.onExpand,
        needIndentSpaced = this.needIndentSpaced,
        expanded = this.expanded;

    if (expandable) {
      var expandClassName = expanded ? 'expanded' : 'collapsed';
      return h('span', {
        'class': prefixCls + '-expand-icon ' + prefixCls + '-' + expandClassName,
        on: {
          'click': onExpand
        }
      });
    }
    if (needIndentSpaced) {
      return h('span', { 'class': prefixCls + '-expand-icon ' + prefixCls + '-spaced' });
    }
    return null;
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-table/src/ExpandableRow.js":
/*!***********************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-table/src/ExpandableRow.js ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _vueTypes = __webpack_require__(/*! ../../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _ExpandIcon = __webpack_require__(/*! ./ExpandIcon */ "./node_modules/ant-design-vue/lib/vc-table/src/ExpandIcon.js");

var _ExpandIcon2 = _interopRequireDefault(_ExpandIcon);

var _BaseMixin = __webpack_require__(/*! ../../_util/BaseMixin */ "./node_modules/ant-design-vue/lib/_util/BaseMixin.js");

var _BaseMixin2 = _interopRequireDefault(_BaseMixin);

var _store = __webpack_require__(/*! ../../_util/store */ "./node_modules/ant-design-vue/lib/_util/store/index.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var ExpandableRow = {
  mixins: [_BaseMixin2['default']],
  name: 'ExpandableRow',
  props: {
    prefixCls: _vueTypes2['default'].string.isRequired,
    rowKey: _vueTypes2['default'].oneOfType([_vueTypes2['default'].string, _vueTypes2['default'].number]).isRequired,
    fixed: _vueTypes2['default'].oneOfType([_vueTypes2['default'].string, _vueTypes2['default'].bool]),
    record: _vueTypes2['default'].oneOfType([_vueTypes2['default'].object, _vueTypes2['default'].array]).isRequired,
    indentSize: _vueTypes2['default'].number,
    needIndentSpaced: _vueTypes2['default'].bool.isRequired,
    expandRowByClick: _vueTypes2['default'].bool,
    expanded: _vueTypes2['default'].bool.isRequired,
    expandIconAsCell: _vueTypes2['default'].bool,
    expandIconColumnIndex: _vueTypes2['default'].number,
    childrenColumnName: _vueTypes2['default'].string,
    expandedRowRender: _vueTypes2['default'].func,
    expandIcon: _vueTypes2['default'].func
    // onExpandedChange: PropTypes.func.isRequired,
    // onRowClick: PropTypes.func,
    // children: PropTypes.func.isRequired,
  },

  beforeDestroy: function beforeDestroy() {
    this.handleDestroy();
  },

  methods: {
    hasExpandIcon: function hasExpandIcon(columnIndex) {
      var _$props = this.$props,
          expandRowByClick = _$props.expandRowByClick,
          expandIcon = _$props.expandIcon;


      if (this.tempExpandIconAsCell || columnIndex !== this.tempExpandIconColumnIndex) {
        return false;
      }

      return !!expandIcon || !expandRowByClick;
    },
    handleExpandChange: function handleExpandChange(record, event) {
      var expanded = this.expanded,
          rowKey = this.rowKey;

      this.__emit('expandedChange', !expanded, record, event, rowKey);
    },
    handleDestroy: function handleDestroy() {
      var rowKey = this.rowKey,
          record = this.record;

      this.__emit('expandedChange', false, record, null, rowKey, true);
    },
    handleRowClick: function handleRowClick(record, index, event) {
      var expandRowByClick = this.expandRowByClick;

      if (expandRowByClick) {
        this.handleExpandChange(record, event);
      }
      this.__emit('rowClick', record, index, event);
    },
    renderExpandIcon: function renderExpandIcon() {
      var h = this.$createElement;
      var prefixCls = this.prefixCls,
          expanded = this.expanded,
          record = this.record,
          needIndentSpaced = this.needIndentSpaced,
          expandIcon = this.expandIcon;

      if (expandIcon) {
        return expandIcon({
          prefixCls: prefixCls,
          expanded: expanded,
          record: record,
          needIndentSpaced: needIndentSpaced,
          expandable: this.expandable,
          onExpand: this.handleExpandChange
        });
      }
      return h(_ExpandIcon2['default'], {
        attrs: {
          expandable: this.expandable,
          prefixCls: prefixCls,

          needIndentSpaced: needIndentSpaced,
          expanded: expanded,
          record: record
        },
        on: {
          'expand': this.handleExpandChange
        }
      });
    },
    renderExpandIconCell: function renderExpandIconCell(cells) {
      var h = this.$createElement;

      if (!this.tempExpandIconAsCell) {
        return;
      }
      var prefixCls = this.prefixCls;


      cells.push(h(
        'td',
        { 'class': prefixCls + '-expand-icon-cell', key: 'rc-table-expand-icon-cell' },
        [this.renderExpandIcon()]
      ));
    }
  },

  render: function render() {
    var childrenColumnName = this.childrenColumnName,
        expandedRowRender = this.expandedRowRender,
        indentSize = this.indentSize,
        record = this.record,
        fixed = this.fixed,
        $scopedSlots = this.$scopedSlots,
        expanded = this.expanded;


    this.tempExpandIconAsCell = fixed !== 'right' ? this.expandIconAsCell : false;
    this.tempExpandIconColumnIndex = fixed !== 'right' ? this.expandIconColumnIndex : -1;
    var childrenData = record[childrenColumnName];
    this.expandable = !!(childrenData || expandedRowRender);
    var expandableRowProps = {
      props: {
        indentSize: indentSize,
        expanded: expanded, // not used in TableRow, but it's required to re-render TableRow when `expanded` changes
        hasExpandIcon: this.hasExpandIcon,
        renderExpandIcon: this.renderExpandIcon,
        renderExpandIconCell: this.renderExpandIconCell
      },

      on: {
        rowClick: this.handleRowClick
      }
    };

    return $scopedSlots['default'] && $scopedSlots['default'](expandableRowProps);
  }
};

exports['default'] = (0, _store.connect)(function (_ref, _ref2) {
  var expandedRowKeys = _ref.expandedRowKeys;
  var rowKey = _ref2.rowKey;
  return {
    expanded: expandedRowKeys.includes(rowKey)
  };
})(ExpandableRow);

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-table/src/ExpandableTable.js":
/*!*************************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-table/src/ExpandableTable.js ***!
  \*************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.ExpandableTableProps = undefined;

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _toConsumableArray2 = __webpack_require__(/*! babel-runtime/helpers/toConsumableArray */ "./node_modules/babel-runtime/helpers/toConsumableArray.js");

var _toConsumableArray3 = _interopRequireDefault(_toConsumableArray2);

var _vueTypes = __webpack_require__(/*! ../../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _BaseMixin = __webpack_require__(/*! ../../_util/BaseMixin */ "./node_modules/ant-design-vue/lib/_util/BaseMixin.js");

var _BaseMixin2 = _interopRequireDefault(_BaseMixin);

var _store = __webpack_require__(/*! ../../_util/store */ "./node_modules/ant-design-vue/lib/_util/store/index.js");

var _shallowequal = __webpack_require__(/*! shallowequal */ "./node_modules/shallowequal/index.js");

var _shallowequal2 = _interopRequireDefault(_shallowequal);

var _TableRow = __webpack_require__(/*! ./TableRow */ "./node_modules/ant-design-vue/lib/vc-table/src/TableRow.js");

var _TableRow2 = _interopRequireDefault(_TableRow);

var _utils = __webpack_require__(/*! ./utils */ "./node_modules/ant-design-vue/lib/vc-table/src/utils.js");

var _propsUtil = __webpack_require__(/*! ../../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var ExpandableTableProps = exports.ExpandableTableProps = function ExpandableTableProps() {
  return {
    expandIconAsCell: _vueTypes2['default'].bool,
    expandRowByClick: _vueTypes2['default'].bool,
    expandedRowKeys: _vueTypes2['default'].array,
    expandedRowClassName: _vueTypes2['default'].func,
    defaultExpandAllRows: _vueTypes2['default'].bool,
    defaultExpandedRowKeys: _vueTypes2['default'].array,
    expandIconColumnIndex: _vueTypes2['default'].number,
    expandedRowRender: _vueTypes2['default'].func,
    expandIcon: _vueTypes2['default'].func,
    childrenColumnName: _vueTypes2['default'].string,
    indentSize: _vueTypes2['default'].number,
    // onExpand: PropTypes.func,
    // onExpandedRowsChange: PropTypes.func,
    columnManager: _vueTypes2['default'].object.isRequired,
    store: _vueTypes2['default'].object.isRequired,
    prefixCls: _vueTypes2['default'].string.isRequired,
    data: _vueTypes2['default'].array,
    getRowKey: _vueTypes2['default'].func
  };
};

var ExpandableTable = {
  name: 'ExpandableTable',
  mixins: [_BaseMixin2['default']],
  props: (0, _propsUtil.initDefaultProps)(ExpandableTableProps(), {
    expandIconAsCell: false,
    expandedRowClassName: function expandedRowClassName() {
      return '';
    },
    expandIconColumnIndex: 0,
    defaultExpandAllRows: false,
    defaultExpandedRowKeys: [],
    childrenColumnName: 'children',
    indentSize: 15
  }),

  data: function data() {
    var data = this.data,
        childrenColumnName = this.childrenColumnName,
        defaultExpandAllRows = this.defaultExpandAllRows,
        expandedRowKeys = this.expandedRowKeys,
        defaultExpandedRowKeys = this.defaultExpandedRowKeys,
        getRowKey = this.getRowKey;


    var finalExpandedRowKeys = [];
    var rows = [].concat((0, _toConsumableArray3['default'])(data));

    if (defaultExpandAllRows) {
      for (var i = 0; i < rows.length; i += 1) {
        var row = rows[i];
        finalExpandedRowKeys.push(getRowKey(row, i));
        rows = rows.concat(row[childrenColumnName] || []);
      }
    } else {
      finalExpandedRowKeys = expandedRowKeys || defaultExpandedRowKeys;
    }

    // this.columnManager = props.columnManager
    // this.store = props.store

    this.store.setState({
      expandedRowsHeight: {},
      expandedRowKeys: finalExpandedRowKeys
    });
    return {};
  },
  mounted: function mounted() {
    this.handleUpdated();
  },
  updated: function updated() {
    this.handleUpdated();
  },

  watch: {
    expandedRowKeys: function expandedRowKeys(val) {
      var _this = this;

      this.$nextTick(function () {
        _this.store.setState({
          expandedRowKeys: val
        });
      });
    }
  },
  methods: {
    handleUpdated: function handleUpdated() {
      // We should record latest expanded rows to avoid multiple rows remove cause `onExpandedRowsChange` trigger many times
      this.latestExpandedRows = null;
    },
    handleExpandChange: function handleExpandChange(expanded, record, event, rowKey) {
      var destroy = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : false;

      if (event) {
        event.preventDefault();
        event.stopPropagation();
      }

      var _store$getState = this.store.getState(),
          expandedRowKeys = _store$getState.expandedRowKeys;

      if (expanded) {
        // row was expaned
        expandedRowKeys = [].concat((0, _toConsumableArray3['default'])(expandedRowKeys), [rowKey]);
      } else {
        // row was collapse
        var expandedRowIndex = expandedRowKeys.indexOf(rowKey);
        if (expandedRowIndex !== -1) {
          expandedRowKeys = (0, _utils.remove)(expandedRowKeys, rowKey);
        }
      }

      if (!this.expandedRowKeys) {
        this.store.setState({ expandedRowKeys: expandedRowKeys });
      }
      // De-dup of repeat call
      if (!this.latestExpandedRows || !(0, _shallowequal2['default'])(this.latestExpandedRows, expandedRowKeys)) {
        this.latestExpandedRows = expandedRowKeys;
        this.__emit('expandedRowsChange', expandedRowKeys);
      }

      if (!destroy) {
        this.__emit('expand', expanded, record);
      }
    },
    renderExpandIndentCell: function renderExpandIndentCell(rows, fixed) {
      var prefixCls = this.prefixCls,
          expandIconAsCell = this.expandIconAsCell;

      if (!expandIconAsCell || fixed === 'right' || !rows.length) {
        return;
      }

      var iconColumn = {
        key: 'rc-table-expand-icon-cell',
        className: prefixCls + '-expand-icon-th',
        title: '',
        rowSpan: rows.length
      };

      rows[0].unshift((0, _extends3['default'])({}, iconColumn, { column: iconColumn }));
    },
    renderExpandedRow: function renderExpandedRow(record, index, expandedRowRender, className, ancestorKeys, indent, fixed) {
      var _this2 = this;

      var h = this.$createElement;
      var prefixCls = this.prefixCls,
          expandIconAsCell = this.expandIconAsCell,
          indentSize = this.indentSize;

      var parentKey = ancestorKeys[ancestorKeys.length - 1];
      var rowKey = parentKey + '-extra-row';
      var components = {
        body: {
          row: 'tr',
          cell: 'td'
        }
      };
      var colCount = void 0;
      if (fixed === 'left') {
        colCount = this.columnManager.leftLeafColumns().length;
      } else if (fixed === 'right') {
        colCount = this.columnManager.rightLeafColumns().length;
      } else {
        colCount = this.columnManager.leafColumns().length;
      }
      var columns = [{
        key: 'extra-row',
        customRender: function customRender() {
          var _store$getState2 = _this2.store.getState(),
              expandedRowKeys = _store$getState2.expandedRowKeys;

          var expanded = expandedRowKeys.includes(parentKey);
          return {
            attrs: {
              colSpan: colCount
            },
            children: fixed !== 'right' ? expandedRowRender(record, index, indent, expanded) : '&nbsp;'
          };
        }
      }];
      if (expandIconAsCell && fixed !== 'right') {
        columns.unshift({
          key: 'expand-icon-placeholder',
          customRender: function customRender() {
            return null;
          }
        });
      }

      return h(_TableRow2['default'], {
        key: rowKey,
        attrs: { columns: columns,

          rowKey: rowKey,
          ancestorKeys: ancestorKeys,
          prefixCls: prefixCls + '-expanded-row',
          indentSize: indentSize,
          indent: indent,
          fixed: fixed,
          components: components,
          expandedRow: true,
          hasExpandIcon: function hasExpandIcon() {}
        },
        'class': className });
    },
    renderRows: function renderRows(_renderRows, rows, record, index, indent, fixed, parentKey, ancestorKeys) {
      var expandedRowClassName = this.expandedRowClassName,
          expandedRowRender = this.expandedRowRender,
          childrenColumnName = this.childrenColumnName;

      var childrenData = record[childrenColumnName];
      var nextAncestorKeys = [].concat((0, _toConsumableArray3['default'])(ancestorKeys), [parentKey]);
      var nextIndent = indent + 1;

      if (expandedRowRender) {
        rows.push(this.renderExpandedRow(record, index, expandedRowRender, expandedRowClassName(record, index, indent), nextAncestorKeys, nextIndent, fixed));
      }

      if (childrenData) {
        rows.push.apply(rows, (0, _toConsumableArray3['default'])(_renderRows(childrenData, nextIndent, nextAncestorKeys)));
      }
    }
  },

  render: function render() {
    var data = this.data,
        childrenColumnName = this.childrenColumnName,
        $scopedSlots = this.$scopedSlots;

    var props = (0, _propsUtil.getOptionProps)(this);
    var needIndentSpaced = data.some(function (record) {
      return record[childrenColumnName];
    });

    return $scopedSlots['default'] && $scopedSlots['default']({
      props: props,
      on: (0, _propsUtil.getListeners)(this),
      needIndentSpaced: needIndentSpaced,
      renderRows: this.renderRows,
      handleExpandChange: this.handleExpandChange,
      renderExpandIndentCell: this.renderExpandIndentCell
    });
  }
};

exports['default'] = (0, _store.connect)()(ExpandableTable);

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-table/src/HeadTable.js":
/*!*******************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-table/src/HeadTable.js ***!
  \*******************************************************************/
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

var _vueTypes = __webpack_require__(/*! ../../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _utils = __webpack_require__(/*! ./utils */ "./node_modules/ant-design-vue/lib/vc-table/src/utils.js");

var _BaseTable = __webpack_require__(/*! ./BaseTable */ "./node_modules/ant-design-vue/lib/vc-table/src/BaseTable.js");

var _BaseTable2 = _interopRequireDefault(_BaseTable);

var _classnames = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");

var _classnames2 = _interopRequireDefault(_classnames);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports['default'] = {
  name: 'HeadTable',
  props: {
    fixed: _vueTypes2['default'].oneOfType([_vueTypes2['default'].string, _vueTypes2['default'].bool]),
    columns: _vueTypes2['default'].array.isRequired,
    tableClassName: _vueTypes2['default'].string.isRequired,
    handleBodyScrollLeft: _vueTypes2['default'].func.isRequired,
    expander: _vueTypes2['default'].object.isRequired
  },
  inject: {
    table: { 'default': function _default() {
        return {};
      } }
  },
  render: function render() {
    var h = arguments[0];
    var columns = this.columns,
        fixed = this.fixed,
        tableClassName = this.tableClassName,
        handleBodyScrollLeft = this.handleBodyScrollLeft,
        expander = this.expander,
        table = this.table;
    var prefixCls = table.prefixCls,
        scroll = table.scroll,
        showHeader = table.showHeader,
        saveRef = table.saveRef;
    var useFixedHeader = table.useFixedHeader;

    var headStyle = {};

    var scrollbarWidth = (0, _utils.measureScrollbar)({ direction: 'vertical' });

    if (scroll.y) {
      useFixedHeader = true;
      // https://github.com/ant-design/ant-design/issues/17051
      var scrollbarWidthOfHeader = (0, _utils.measureScrollbar)({ direction: 'horizontal', prefixCls: prefixCls });
      // Add negative margin bottom for scroll bar overflow bug
      if (scrollbarWidthOfHeader > 0 && !fixed) {
        headStyle.marginBottom = '-' + scrollbarWidthOfHeader + 'px';
        headStyle.paddingBottom = '0px';
        // https://github.com/ant-design/ant-design/pull/19986
        headStyle.minWidth = scrollbarWidth + 'px';
        // https://github.com/ant-design/ant-design/issues/17051
        headStyle.overflowX = 'scroll';
        headStyle.overflowY = scrollbarWidth === 0 ? 'hidden' : 'scroll';
      }
    }

    if (!useFixedHeader || !showHeader) {
      return null;
    }
    return h(
      'div',
      (0, _babelHelperVueJsxMergeProps2['default'])([{
        key: 'headTable'
      }, {
        directives: [{
          name: 'ant-ref',
          value: fixed ? function () {} : saveRef('headTable')
        }]
      }, {
        'class': (0, _classnames2['default'])(prefixCls + '-header', (0, _defineProperty3['default'])({}, prefixCls + '-hide-scrollbar', scrollbarWidth > 0)),
        style: headStyle,
        on: {
          'scroll': handleBodyScrollLeft
        }
      }]),
      [h(_BaseTable2['default'], {
        attrs: {
          tableClassName: tableClassName,
          hasHead: true,
          hasBody: false,
          fixed: fixed,
          columns: columns,
          expander: expander
        }
      })]
    );
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-table/src/Table.js":
/*!***************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-table/src/Table.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _babelHelperVueJsxMergeProps = __webpack_require__(/*! babel-helper-vue-jsx-merge-props */ "./node_modules/babel-helper-vue-jsx-merge-props/index.js");

var _babelHelperVueJsxMergeProps2 = _interopRequireDefault(_babelHelperVueJsxMergeProps);

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _defineProperty2 = __webpack_require__(/*! babel-runtime/helpers/defineProperty */ "./node_modules/babel-runtime/helpers/defineProperty.js");

var _defineProperty3 = _interopRequireDefault(_defineProperty2);

var _toConsumableArray2 = __webpack_require__(/*! babel-runtime/helpers/toConsumableArray */ "./node_modules/babel-runtime/helpers/toConsumableArray.js");

var _toConsumableArray3 = _interopRequireDefault(_toConsumableArray2);

var _shallowequal = __webpack_require__(/*! shallowequal */ "./node_modules/shallowequal/index.js");

var _shallowequal2 = _interopRequireDefault(_shallowequal);

var _merge = __webpack_require__(/*! lodash/merge */ "./node_modules/lodash/merge.js");

var _merge2 = _interopRequireDefault(_merge);

var _componentClasses = __webpack_require__(/*! component-classes */ "./node_modules/component-classes/index.js");

var _componentClasses2 = _interopRequireDefault(_componentClasses);

var _classnames = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");

var _classnames2 = _interopRequireDefault(_classnames);

var _vueTypes = __webpack_require__(/*! ../../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _utils = __webpack_require__(/*! ./utils */ "./node_modules/ant-design-vue/lib/vc-table/src/utils.js");

var _warning = __webpack_require__(/*! ../../_util/warning */ "./node_modules/ant-design-vue/lib/_util/warning.js");

var _warning2 = _interopRequireDefault(_warning);

var _addEventListener = __webpack_require__(/*! ../../vc-util/Dom/addEventListener */ "./node_modules/ant-design-vue/lib/vc-util/Dom/addEventListener.js");

var _addEventListener2 = _interopRequireDefault(_addEventListener);

var _store = __webpack_require__(/*! ../../_util/store */ "./node_modules/ant-design-vue/lib/_util/store/index.js");

var _ColumnManager = __webpack_require__(/*! ./ColumnManager */ "./node_modules/ant-design-vue/lib/vc-table/src/ColumnManager.js");

var _ColumnManager2 = _interopRequireDefault(_ColumnManager);

var _HeadTable = __webpack_require__(/*! ./HeadTable */ "./node_modules/ant-design-vue/lib/vc-table/src/HeadTable.js");

var _HeadTable2 = _interopRequireDefault(_HeadTable);

var _BodyTable = __webpack_require__(/*! ./BodyTable */ "./node_modules/ant-design-vue/lib/vc-table/src/BodyTable.js");

var _BodyTable2 = _interopRequireDefault(_BodyTable);

var _ExpandableTable = __webpack_require__(/*! ./ExpandableTable */ "./node_modules/ant-design-vue/lib/vc-table/src/ExpandableTable.js");

var _ExpandableTable2 = _interopRequireDefault(_ExpandableTable);

var _propsUtil = __webpack_require__(/*! ../../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

var _BaseMixin = __webpack_require__(/*! ../../_util/BaseMixin */ "./node_modules/ant-design-vue/lib/_util/BaseMixin.js");

var _BaseMixin2 = _interopRequireDefault(_BaseMixin);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports['default'] = {
  name: 'Table',
  mixins: [_BaseMixin2['default']],
  props: (0, _propsUtil.initDefaultProps)({
    data: _vueTypes2['default'].array,
    useFixedHeader: _vueTypes2['default'].bool,
    columns: _vueTypes2['default'].array,
    prefixCls: _vueTypes2['default'].string,
    bodyStyle: _vueTypes2['default'].object,
    rowKey: _vueTypes2['default'].oneOfType([_vueTypes2['default'].string, _vueTypes2['default'].func]),
    rowClassName: _vueTypes2['default'].oneOfType([_vueTypes2['default'].string, _vueTypes2['default'].func]),
    customRow: _vueTypes2['default'].func,
    customHeaderRow: _vueTypes2['default'].func,
    // onRowClick: PropTypes.func,
    // onRowDoubleClick: PropTypes.func,
    // onRowContextMenu: PropTypes.func,
    // onRowMouseEnter: PropTypes.func,
    // onRowMouseLeave: PropTypes.func,
    showHeader: _vueTypes2['default'].bool,
    title: _vueTypes2['default'].func,
    id: _vueTypes2['default'].string,
    footer: _vueTypes2['default'].func,
    emptyText: _vueTypes2['default'].any,
    scroll: _vueTypes2['default'].object,
    rowRef: _vueTypes2['default'].func,
    getBodyWrapper: _vueTypes2['default'].func,
    components: _vueTypes2['default'].shape({
      table: _vueTypes2['default'].any,
      header: _vueTypes2['default'].shape({
        wrapper: _vueTypes2['default'].any,
        row: _vueTypes2['default'].any,
        cell: _vueTypes2['default'].any
      }),
      body: _vueTypes2['default'].shape({
        wrapper: _vueTypes2['default'].any,
        row: _vueTypes2['default'].any,
        cell: _vueTypes2['default'].any
      })
    }),
    expandIconAsCell: _vueTypes2['default'].bool,
    expandedRowKeys: _vueTypes2['default'].array,
    expandedRowClassName: _vueTypes2['default'].func,
    defaultExpandAllRows: _vueTypes2['default'].bool,
    defaultExpandedRowKeys: _vueTypes2['default'].array,
    expandIconColumnIndex: _vueTypes2['default'].number,
    expandedRowRender: _vueTypes2['default'].func,
    childrenColumnName: _vueTypes2['default'].string,
    indentSize: _vueTypes2['default'].number,
    expandRowByClick: _vueTypes2['default'].bool,
    expandIcon: _vueTypes2['default'].func,
    tableLayout: _vueTypes2['default'].string,
    transformCellText: _vueTypes2['default'].func
  }, {
    data: [],
    useFixedHeader: false,
    rowKey: 'key',
    rowClassName: function rowClassName() {
      return '';
    },
    prefixCls: 'rc-table',
    bodyStyle: {},
    showHeader: true,
    scroll: {},
    rowRef: function rowRef() {
      return null;
    },
    emptyText: function emptyText() {
      return 'No Data';
    },
    customHeaderRow: function customHeaderRow() {}
  }),
  data: function data() {
    this.preData = [].concat((0, _toConsumableArray3['default'])(this.data));
    return {
      columnManager: new _ColumnManager2['default'](this.columns),
      sComponents: (0, _merge2['default'])({
        table: 'table',
        header: {
          wrapper: 'thead',
          row: 'tr',
          cell: 'th'
        },
        body: {
          wrapper: 'tbody',
          row: 'tr',
          cell: 'td'
        }
      }, this.components)
    };
  },

  watch: {
    components: function components() {
      this._components = (0, _merge2['default'])({
        table: 'table',
        header: {
          wrapper: 'thead',
          row: 'tr',
          cell: 'th'
        },
        body: {
          wrapper: 'tbody',
          row: 'tr',
          cell: 'td'
        }
      }, this.components);
    },
    columns: function columns(val) {
      if (val) {
        this.columnManager.reset(val);
      }
    },
    data: function data(val) {
      var _this = this;

      if (val.length === 0 && this.hasScrollX()) {
        this.$nextTick(function () {
          _this.resetScrollX();
        });
      }
    }
  },

  // static childContextTypes = {
  //   table: PropTypes.any,
  //   components: PropTypes.any,
  // },

  created: function created() {
    var _this2 = this;

    ['rowClick', 'rowDoubleclick', 'rowContextmenu', 'rowMouseenter', 'rowMouseleave'].forEach(function (name) {
      (0, _warning2['default'])((0, _propsUtil.getListeners)(_this2)[name] === undefined, name + ' is deprecated, please use customRow instead.');
    });

    (0, _warning2['default'])(this.getBodyWrapper === undefined, 'getBodyWrapper is deprecated, please use custom components instead.');

    // this.columnManager = new ColumnManager(this.columns, this.$slots.default)

    this.store = (0, _store.create)({
      currentHoverKey: null,
      fixedColumnsHeadRowsHeight: [],
      fixedColumnsBodyRowsHeight: {}
    });

    this.setScrollPosition('left');

    this.debouncedWindowResize = (0, _utils.debounce)(this.handleWindowResize, 150);
  },
  provide: function provide() {
    return {
      table: this
    };
  },
  mounted: function mounted() {
    var _this3 = this;

    this.$nextTick(function () {
      if (_this3.columnManager.isAnyColumnsFixed()) {
        _this3.handleWindowResize();
        _this3.resizeEvent = (0, _addEventListener2['default'])(window, 'resize', _this3.debouncedWindowResize);
      }
      // https://github.com/ant-design/ant-design/issues/11635
      if (_this3.ref_headTable) {
        _this3.ref_headTable.scrollLeft = 0;
      }
      if (_this3.ref_bodyTable) {
        _this3.ref_bodyTable.scrollLeft = 0;
      }
    });
  },
  updated: function updated() {
    var _this4 = this;

    this.$nextTick(function () {
      if (_this4.columnManager.isAnyColumnsFixed()) {
        _this4.handleWindowResize();
        if (!_this4.resizeEvent) {
          _this4.resizeEvent = (0, _addEventListener2['default'])(window, 'resize', _this4.debouncedWindowResize);
        }
      }
    });
  },
  beforeDestroy: function beforeDestroy() {
    if (this.resizeEvent) {
      this.resizeEvent.remove();
    }
    if (this.debouncedWindowResize) {
      this.debouncedWindowResize.cancel();
    }
  },

  methods: {
    getRowKey: function getRowKey(record, index) {
      var rowKey = this.rowKey;
      var key = typeof rowKey === 'function' ? rowKey(record, index) : record[rowKey];
      (0, _warning2['default'])(key !== undefined, 'Each record in table should have a unique `key` prop,' + 'or set `rowKey` to an unique primary key.');
      return key === undefined ? index : key;
    },
    setScrollPosition: function setScrollPosition(position) {
      this.scrollPosition = position;
      if (this.tableNode) {
        var prefixCls = this.prefixCls;

        if (position === 'both') {
          (0, _componentClasses2['default'])(this.tableNode).remove(new RegExp('^' + prefixCls + '-scroll-position-.+$')).add(prefixCls + '-scroll-position-left').add(prefixCls + '-scroll-position-right');
        } else {
          (0, _componentClasses2['default'])(this.tableNode).remove(new RegExp('^' + prefixCls + '-scroll-position-.+$')).add(prefixCls + '-scroll-position-' + position);
        }
      }
    },
    setScrollPositionClassName: function setScrollPositionClassName() {
      var node = this.ref_bodyTable;
      var scrollToLeft = node.scrollLeft === 0;
      var scrollToRight = node.scrollLeft + 1 >= node.children[0].getBoundingClientRect().width - node.getBoundingClientRect().width;
      if (scrollToLeft && scrollToRight) {
        this.setScrollPosition('both');
      } else if (scrollToLeft) {
        this.setScrollPosition('left');
      } else if (scrollToRight) {
        this.setScrollPosition('right');
      } else if (this.scrollPosition !== 'middle') {
        this.setScrollPosition('middle');
      }
    },
    isTableLayoutFixed: function isTableLayoutFixed() {
      var _$props = this.$props,
          tableLayout = _$props.tableLayout,
          _$props$columns = _$props.columns,
          columns = _$props$columns === undefined ? [] : _$props$columns,
          useFixedHeader = _$props.useFixedHeader,
          _$props$scroll = _$props.scroll,
          scroll = _$props$scroll === undefined ? {} : _$props$scroll;

      if (typeof tableLayout !== 'undefined') {
        return tableLayout === 'fixed';
      }
      // if one column is ellipsis, use fixed table layout to fix align issue
      if (columns.some(function (_ref) {
        var ellipsis = _ref.ellipsis;
        return !!ellipsis;
      })) {
        return true;
      }
      // if header fixed, use fixed table layout to fix align issue
      if (useFixedHeader || scroll.y) {
        return true;
      }
      // if scroll.x is number/px/% width value, we should fixed table layout
      // to avoid long word layout broken issue
      if (scroll.x && scroll.x !== true && scroll.x !== 'max-content') {
        return true;
      }
      return false;
    },
    handleWindowResize: function handleWindowResize() {
      this.syncFixedTableRowHeight();
      this.setScrollPositionClassName();
    },
    syncFixedTableRowHeight: function syncFixedTableRowHeight() {
      var tableRect = this.tableNode.getBoundingClientRect();
      // If tableNode's height less than 0, suppose it is hidden and don't recalculate rowHeight.
      // see: https://github.com/ant-design/ant-design/issues/4836
      if (tableRect.height !== undefined && tableRect.height <= 0) {
        return;
      }
      var prefixCls = this.prefixCls;

      var headRows = this.ref_headTable ? this.ref_headTable.querySelectorAll('thead') : this.ref_bodyTable.querySelectorAll('thead');
      var bodyRows = this.ref_bodyTable.querySelectorAll('.' + prefixCls + '-row') || [];
      var fixedColumnsHeadRowsHeight = [].map.call(headRows, function (row) {
        return row.getBoundingClientRect().height ? row.getBoundingClientRect().height - 0.5 : 'auto';
      });
      var state = this.store.getState();
      var fixedColumnsBodyRowsHeight = [].reduce.call(bodyRows, function (acc, row) {
        var rowKey = row.getAttribute('data-row-key');
        var height = row.getBoundingClientRect().height || state.fixedColumnsBodyRowsHeight[rowKey] || 'auto';
        acc[rowKey] = height;
        return acc;
      }, {});
      if ((0, _shallowequal2['default'])(state.fixedColumnsHeadRowsHeight, fixedColumnsHeadRowsHeight) && (0, _shallowequal2['default'])(state.fixedColumnsBodyRowsHeight, fixedColumnsBodyRowsHeight)) {
        return;
      }
      this.store.setState({
        fixedColumnsHeadRowsHeight: fixedColumnsHeadRowsHeight,
        fixedColumnsBodyRowsHeight: fixedColumnsBodyRowsHeight
      });
    },
    resetScrollX: function resetScrollX() {
      if (this.ref_headTable) {
        this.ref_headTable.scrollLeft = 0;
      }
      if (this.ref_bodyTable) {
        this.ref_bodyTable.scrollLeft = 0;
      }
    },
    hasScrollX: function hasScrollX() {
      var _scroll = this.scroll,
          scroll = _scroll === undefined ? {} : _scroll;

      return 'x' in scroll;
    },
    handleBodyScrollLeft: function handleBodyScrollLeft(e) {
      // Fix https://github.com/ant-design/ant-design/issues/7635
      if (e.currentTarget !== e.target) {
        return;
      }
      var target = e.target;
      var _scroll2 = this.scroll,
          scroll = _scroll2 === undefined ? {} : _scroll2;
      var ref_headTable = this.ref_headTable,
          ref_bodyTable = this.ref_bodyTable;

      if (target.scrollLeft !== this.lastScrollLeft && scroll.x) {
        if (target === ref_bodyTable && ref_headTable) {
          ref_headTable.scrollLeft = target.scrollLeft;
        } else if (target === ref_headTable && ref_bodyTable) {
          ref_bodyTable.scrollLeft = target.scrollLeft;
        }
        this.setScrollPositionClassName();
      }
      // Remember last scrollLeft for scroll direction detecting.
      this.lastScrollLeft = target.scrollLeft;
    },
    handleBodyScrollTop: function handleBodyScrollTop(e) {
      var target = e.target;
      // Fix https://github.com/ant-design/ant-design/issues/9033
      if (e.currentTarget !== target) {
        return;
      }
      var _scroll3 = this.scroll,
          scroll = _scroll3 === undefined ? {} : _scroll3;
      var ref_headTable = this.ref_headTable,
          ref_bodyTable = this.ref_bodyTable,
          ref_fixedColumnsBodyLeft = this.ref_fixedColumnsBodyLeft,
          ref_fixedColumnsBodyRight = this.ref_fixedColumnsBodyRight;

      if (target.scrollTop !== this.lastScrollTop && scroll.y && target !== ref_headTable) {
        var scrollTop = target.scrollTop;
        if (ref_fixedColumnsBodyLeft && target !== ref_fixedColumnsBodyLeft) {
          ref_fixedColumnsBodyLeft.scrollTop = scrollTop;
        }
        if (ref_fixedColumnsBodyRight && target !== ref_fixedColumnsBodyRight) {
          ref_fixedColumnsBodyRight.scrollTop = scrollTop;
        }
        if (ref_bodyTable && target !== ref_bodyTable) {
          ref_bodyTable.scrollTop = scrollTop;
        }
      }
      // Remember last scrollTop for scroll direction detecting.
      this.lastScrollTop = target.scrollTop;
    },
    handleBodyScroll: function handleBodyScroll(e) {
      this.handleBodyScrollLeft(e);
      this.handleBodyScrollTop(e);
    },
    handleWheel: function handleWheel(event) {
      var _$props$scroll2 = this.$props.scroll,
          scroll = _$props$scroll2 === undefined ? {} : _$props$scroll2;

      if (window.navigator.userAgent.match(/Trident\/7\./) && scroll.y) {
        event.preventDefault();
        var wd = event.deltaY;
        var target = event.target;
        var bodyTable = this.ref_bodyTable,
            fixedColumnsBodyLeft = this.ref_fixedColumnsBodyLeft,
            fixedColumnsBodyRight = this.ref_fixedColumnsBodyRight;

        var scrollTop = 0;

        if (this.lastScrollTop) {
          scrollTop = this.lastScrollTop + wd;
        } else {
          scrollTop = wd;
        }

        if (fixedColumnsBodyLeft && target !== fixedColumnsBodyLeft) {
          fixedColumnsBodyLeft.scrollTop = scrollTop;
        }
        if (fixedColumnsBodyRight && target !== fixedColumnsBodyRight) {
          fixedColumnsBodyRight.scrollTop = scrollTop;
        }
        if (bodyTable && target !== bodyTable) {
          bodyTable.scrollTop = scrollTop;
        }
      }
    },

    // saveChildrenRef(name, node) {
    //   this[`ref_${name}`] = node;
    // },
    saveRef: function saveRef(name) {
      var _this5 = this;

      return function (node) {
        _this5['ref_' + name] = node;
      };
    },
    saveTableNodeRef: function saveTableNodeRef(node) {
      this.tableNode = node;
    },
    renderMainTable: function renderMainTable() {
      var h = this.$createElement;
      var scroll = this.scroll,
          prefixCls = this.prefixCls;

      var isAnyColumnsFixed = this.columnManager.isAnyColumnsFixed();
      var scrollable = isAnyColumnsFixed || scroll.x || scroll.y;

      var table = [this.renderTable({
        columns: this.columnManager.groupedColumns(),
        isAnyColumnsFixed: isAnyColumnsFixed
      }), this.renderEmptyText(), this.renderFooter()];

      return scrollable ? h(
        'div',
        { 'class': prefixCls + '-scroll' },
        [table]
      ) : table;
    },
    renderLeftFixedTable: function renderLeftFixedTable() {
      var h = this.$createElement;
      var prefixCls = this.prefixCls;


      return h(
        'div',
        { 'class': prefixCls + '-fixed-left' },
        [this.renderTable({
          columns: this.columnManager.leftColumns(),
          fixed: 'left'
        })]
      );
    },
    renderRightFixedTable: function renderRightFixedTable() {
      var h = this.$createElement;
      var prefixCls = this.prefixCls;


      return h(
        'div',
        { 'class': prefixCls + '-fixed-right' },
        [this.renderTable({
          columns: this.columnManager.rightColumns(),
          fixed: 'right'
        })]
      );
    },
    renderTable: function renderTable(options) {
      var h = this.$createElement;
      var columns = options.columns,
          fixed = options.fixed,
          isAnyColumnsFixed = options.isAnyColumnsFixed;
      var prefixCls = this.prefixCls,
          _scroll4 = this.scroll,
          scroll = _scroll4 === undefined ? {} : _scroll4;

      var tableClassName = scroll.x || fixed ? prefixCls + '-fixed' : '';

      var headTable = h(_HeadTable2['default'], {
        key: 'head',
        attrs: { columns: columns,
          fixed: fixed,
          tableClassName: tableClassName,
          handleBodyScrollLeft: this.handleBodyScrollLeft,
          expander: this.expander
        }
      });

      var bodyTable = h(_BodyTable2['default'], {
        key: 'body',
        attrs: { columns: columns,
          fixed: fixed,
          tableClassName: tableClassName,
          getRowKey: this.getRowKey,
          handleWheel: this.handleWheel,
          handleBodyScroll: this.handleBodyScroll,
          expander: this.expander,
          isAnyColumnsFixed: isAnyColumnsFixed
        }
      });

      return [headTable, bodyTable];
    },
    renderTitle: function renderTitle() {
      var h = this.$createElement;
      var title = this.title,
          prefixCls = this.prefixCls,
          data = this.data;

      return title ? h(
        'div',
        { 'class': prefixCls + '-title', key: 'title' },
        [title(data)]
      ) : null;
    },
    renderFooter: function renderFooter() {
      var h = this.$createElement;
      var footer = this.footer,
          prefixCls = this.prefixCls,
          data = this.data;

      return footer ? h(
        'div',
        { 'class': prefixCls + '-footer', key: 'footer' },
        [footer(data)]
      ) : null;
    },
    renderEmptyText: function renderEmptyText() {
      var h = this.$createElement;
      var emptyText = this.emptyText,
          prefixCls = this.prefixCls,
          data = this.data;

      if (data.length) {
        return null;
      }
      var emptyClassName = prefixCls + '-placeholder';
      return h(
        'div',
        { 'class': emptyClassName, key: 'emptyText' },
        [typeof emptyText === 'function' ? emptyText() : emptyText]
      );
    }
  },

  render: function render() {
    var _classNames,
        _this6 = this;

    var h = arguments[0];

    var props = (0, _propsUtil.getOptionProps)(this);
    var columnManager = this.columnManager,
        getRowKey = this.getRowKey;

    var prefixCls = props.prefixCls;

    var tableClassName = (0, _classnames2['default'])(props.prefixCls, (_classNames = {}, (0, _defineProperty3['default'])(_classNames, prefixCls + '-fixed-header', props.useFixedHeader || props.scroll && props.scroll.y), (0, _defineProperty3['default'])(_classNames, prefixCls + '-scroll-position-left ' + prefixCls + '-scroll-position-right', this.scrollPosition === 'both'), (0, _defineProperty3['default'])(_classNames, prefixCls + '-scroll-position-' + this.scrollPosition, this.scrollPosition !== 'both'), (0, _defineProperty3['default'])(_classNames, prefixCls + '-layout-fixed', this.isTableLayoutFixed()), _classNames));

    var hasLeftFixed = columnManager.isAnyColumnsLeftFixed();
    var hasRightFixed = columnManager.isAnyColumnsRightFixed();

    var expandableTableProps = {
      props: (0, _extends3['default'])({}, props, {
        columnManager: columnManager,
        getRowKey: getRowKey
      }),
      on: (0, _propsUtil.getListeners)(this),
      scopedSlots: {
        'default': function _default(expander) {
          _this6.expander = expander;
          return h(
            'div',
            (0, _babelHelperVueJsxMergeProps2['default'])([{
              directives: [{
                name: 'ant-ref',
                value: _this6.saveTableNodeRef
              }]
            }, {
              'class': tableClassName
              // style={props.style}
              // id={props.id}
            }]),
            [_this6.renderTitle(), h(
              'div',
              { 'class': prefixCls + '-content' },
              [_this6.renderMainTable(), hasLeftFixed && _this6.renderLeftFixedTable(), hasRightFixed && _this6.renderRightFixedTable()]
            )]
          );
        }
      }
    };
    return h(
      _store.Provider,
      {
        attrs: { store: this.store }
      },
      [h(_ExpandableTable2['default'], expandableTableProps)]
    );
  }
}; /* eslint-disable camelcase */

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-table/src/TableCell.js":
/*!*******************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-table/src/TableCell.js ***!
  \*******************************************************************/
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

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _vueTypes = __webpack_require__(/*! ../../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _get = __webpack_require__(/*! lodash/get */ "./node_modules/lodash/get.js");

var _get2 = _interopRequireDefault(_get);

var _classnames = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");

var _classnames2 = _interopRequireDefault(_classnames);

var _propsUtil = __webpack_require__(/*! ../../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

function isInvalidRenderCellText(text) {
  return text && !(0, _propsUtil.isValidElement)(text) && Object.prototype.toString.call(text) === '[object Object]';
}

exports['default'] = {
  name: 'TableCell',
  props: {
    record: _vueTypes2['default'].object,
    prefixCls: _vueTypes2['default'].string,
    index: _vueTypes2['default'].number,
    indent: _vueTypes2['default'].number,
    indentSize: _vueTypes2['default'].number,
    column: _vueTypes2['default'].object,
    expandIcon: _vueTypes2['default'].any,
    component: _vueTypes2['default'].any
  },
  inject: {
    table: { 'default': function _default() {
        return {};
      } }
  },
  methods: {
    handleClick: function handleClick(e) {
      var record = this.record,
          onCellClick = this.column.onCellClick;

      if (onCellClick) {
        onCellClick(record, e);
      }
    }
  },

  render: function render() {
    var _classNames;

    var h = arguments[0];
    var record = this.record,
        indentSize = this.indentSize,
        prefixCls = this.prefixCls,
        indent = this.indent,
        index = this.index,
        expandIcon = this.expandIcon,
        column = this.column,
        BodyCell = this.component;
    var dataIndex = column.dataIndex,
        customRender = column.customRender,
        _column$className = column.className,
        className = _column$className === undefined ? '' : _column$className;
    var transformCellText = this.table.transformCellText;
    // We should return undefined if no dataIndex is specified, but in order to
    // be compatible with object-path's behavior, we return the record object instead.

    var text = void 0;
    if (typeof dataIndex === 'number') {
      text = (0, _get2['default'])(record, dataIndex);
    } else if (!dataIndex || dataIndex.length === 0) {
      text = record;
    } else {
      text = (0, _get2['default'])(record, dataIndex);
    }
    var tdProps = {
      props: {},
      attrs: {},
      on: {
        click: this.handleClick
      }
    };
    var colSpan = void 0;
    var rowSpan = void 0;

    if (customRender) {
      text = customRender(text, record, index, column);
      if (isInvalidRenderCellText(text)) {
        tdProps.attrs = text.attrs || {};
        tdProps.props = text.props || {};
        tdProps['class'] = text['class'];
        tdProps.style = text.style;
        colSpan = tdProps.attrs.colSpan;
        rowSpan = tdProps.attrs.rowSpan;
        text = text.children;
      }
    }

    if (column.customCell) {
      tdProps = (0, _propsUtil.mergeProps)(tdProps, column.customCell(record, index));
    }

    // Fix https://github.com/ant-design/ant-design/issues/1202
    if (isInvalidRenderCellText(text)) {
      text = null;
    }

    if (transformCellText) {
      text = transformCellText({ text: text, column: column, record: record, index: index });
    }

    var indentText = expandIcon ? h('span', {
      style: { paddingLeft: indentSize * indent + 'px' },
      'class': prefixCls + '-indent indent-level-' + indent
    }) : null;

    if (rowSpan === 0 || colSpan === 0) {
      return null;
    }
    if (column.align) {
      tdProps.style = (0, _extends3['default'])({ textAlign: column.align }, tdProps.style);
    }

    var cellClassName = (0, _classnames2['default'])(className, column['class'], (_classNames = {}, (0, _defineProperty3['default'])(_classNames, prefixCls + '-cell-ellipsis', !!column.ellipsis), (0, _defineProperty3['default'])(_classNames, prefixCls + '-cell-break-word', !!column.width), _classNames));

    if (column.ellipsis) {
      if (typeof text === 'string') {
        tdProps.attrs.title = text;
      } else if (text) {
        // const { props: textProps } = text;
        // if (textProps && textProps.children && typeof textProps.children === 'string') {
        //   tdProps.attrs.title = textProps.children;
        // }
      }
    }

    return h(
      BodyCell,
      (0, _babelHelperVueJsxMergeProps2['default'])([{ 'class': cellClassName }, tdProps]),
      [indentText, expandIcon, text]
    );
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-table/src/TableHeader.js":
/*!*********************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-table/src/TableHeader.js ***!
  \*********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _vueTypes = __webpack_require__(/*! ../../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _TableHeaderRow = __webpack_require__(/*! ./TableHeaderRow */ "./node_modules/ant-design-vue/lib/vc-table/src/TableHeaderRow.js");

var _TableHeaderRow2 = _interopRequireDefault(_TableHeaderRow);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

function getHeaderRows(_ref) {
  var _ref$columns = _ref.columns,
      columns = _ref$columns === undefined ? [] : _ref$columns,
      _ref$currentRow = _ref.currentRow,
      currentRow = _ref$currentRow === undefined ? 0 : _ref$currentRow,
      _ref$rows = _ref.rows,
      rows = _ref$rows === undefined ? [] : _ref$rows,
      _ref$isLast = _ref.isLast,
      isLast = _ref$isLast === undefined ? true : _ref$isLast;

  rows = rows || [];
  rows[currentRow] = rows[currentRow] || [];

  columns.forEach(function (column, i) {
    if (column.rowSpan && rows.length < column.rowSpan) {
      while (rows.length < column.rowSpan) {
        rows.push([]);
      }
    }
    var cellIsLast = isLast && i === columns.length - 1;
    var cell = {
      key: column.key,
      className: column.className || column['class'] || '',
      children: column.title,
      isLast: cellIsLast,
      column: column
    };
    if (column.children) {
      getHeaderRows({
        columns: column.children,
        currentRow: currentRow + 1,
        rows: rows,
        isLast: cellIsLast
      });
    }
    if ('colSpan' in column) {
      cell.colSpan = column.colSpan;
    }
    if ('rowSpan' in column) {
      cell.rowSpan = column.rowSpan;
    }
    if (cell.colSpan !== 0) {
      rows[currentRow].push(cell);
    }
  });
  return rows.filter(function (row) {
    return row.length > 0;
  });
}

exports['default'] = {
  name: 'TableHeader',
  props: {
    fixed: _vueTypes2['default'].string,
    columns: _vueTypes2['default'].array.isRequired,
    expander: _vueTypes2['default'].object.isRequired
  },
  inject: {
    table: { 'default': function _default() {
        return {};
      } }
  },

  render: function render() {
    var h = arguments[0];
    var _table = this.table,
        components = _table.sComponents,
        prefixCls = _table.prefixCls,
        showHeader = _table.showHeader,
        customHeaderRow = _table.customHeaderRow;
    var expander = this.expander,
        columns = this.columns,
        fixed = this.fixed;


    if (!showHeader) {
      return null;
    }

    var rows = getHeaderRows({ columns: columns });

    expander.renderExpandIndentCell(rows, fixed);

    var HeaderWrapper = components.header.wrapper;

    return h(
      HeaderWrapper,
      { 'class': prefixCls + '-thead' },
      [rows.map(function (row, index) {
        return h(_TableHeaderRow2['default'], {
          attrs: {
            prefixCls: prefixCls,

            index: index,
            fixed: fixed,
            columns: columns,
            rows: rows,
            row: row,
            components: components,
            customHeaderRow: customHeaderRow
          },
          key: index });
      })]
    );
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-table/src/TableHeaderRow.js":
/*!************************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-table/src/TableHeaderRow.js ***!
  \************************************************************************/
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

var _objectWithoutProperties2 = __webpack_require__(/*! babel-runtime/helpers/objectWithoutProperties */ "./node_modules/babel-runtime/helpers/objectWithoutProperties.js");

var _objectWithoutProperties3 = _interopRequireDefault(_objectWithoutProperties2);

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _classnames = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");

var _classnames2 = _interopRequireDefault(_classnames);

var _vueTypes = __webpack_require__(/*! ../../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _store = __webpack_require__(/*! ../../_util/store */ "./node_modules/ant-design-vue/lib/_util/store/index.js");

var _propsUtil = __webpack_require__(/*! ../../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var TableHeaderRow = {
  props: {
    index: _vueTypes2['default'].number,
    fixed: _vueTypes2['default'].string,
    columns: _vueTypes2['default'].array,
    rows: _vueTypes2['default'].array,
    row: _vueTypes2['default'].array,
    components: _vueTypes2['default'].object,
    height: _vueTypes2['default'].any,
    customHeaderRow: _vueTypes2['default'].func,
    prefixCls: _vueTypes2['default'].prefixCls
  },
  name: 'TableHeaderRow',
  render: function render(h) {
    var row = this.row,
        index = this.index,
        height = this.height,
        components = this.components,
        customHeaderRow = this.customHeaderRow,
        prefixCls = this.prefixCls;

    var HeaderRow = components.header.row;
    var HeaderCell = components.header.cell;
    var rowProps = customHeaderRow(row.map(function (cell) {
      return cell.column;
    }), index);
    var customStyle = rowProps ? rowProps.style : {};
    var style = (0, _extends3['default'])({ height: height }, customStyle);
    if (style.height === null) {
      delete style.height;
    }
    return h(
      HeaderRow,
      (0, _babelHelperVueJsxMergeProps2['default'])([rowProps, { style: style }]),
      [row.map(function (cell, i) {
        var _classNames;

        var column = cell.column,
            isLast = cell.isLast,
            children = cell.children,
            className = cell.className,
            cellProps = (0, _objectWithoutProperties3['default'])(cell, ['column', 'isLast', 'children', 'className']);

        var customProps = column.customHeaderCell ? column.customHeaderCell(column) : {};
        var headerCellProps = (0, _propsUtil.mergeProps)({
          attrs: (0, _extends3['default'])({}, cellProps)
        }, (0, _extends3['default'])({}, customProps, {
          key: column.key || column.dataIndex || i
        }));

        if (column.align) {
          headerCellProps.style = (0, _extends3['default'])({}, customProps.style, { textAlign: column.align });
        }

        headerCellProps['class'] = (0, _classnames2['default'])(customProps['class'], customProps.className, column['class'], column.className, (_classNames = {}, (0, _defineProperty3['default'])(_classNames, prefixCls + '-align-' + column.align, !!column.align), (0, _defineProperty3['default'])(_classNames, prefixCls + '-row-cell-ellipsis', !!column.ellipsis), (0, _defineProperty3['default'])(_classNames, prefixCls + '-row-cell-break-word', !!column.width), (0, _defineProperty3['default'])(_classNames, prefixCls + '-row-cell-last', isLast), _classNames));

        if (typeof HeaderCell === 'function') {
          return HeaderCell(h, headerCellProps, children);
        }
        return h(
          HeaderCell,
          headerCellProps,
          [children]
        );
      })]
    );
  }
};

function getRowHeight(state, props) {
  var fixedColumnsHeadRowsHeight = state.fixedColumnsHeadRowsHeight;
  var columns = props.columns,
      rows = props.rows,
      fixed = props.fixed;

  var headerHeight = fixedColumnsHeadRowsHeight[0];

  if (!fixed) {
    return null;
  }

  if (headerHeight && columns) {
    if (headerHeight === 'auto') {
      return 'auto';
    }
    return headerHeight / rows.length + 'px';
  }
  return null;
}

exports['default'] = (0, _store.connect)(function (state, props) {
  return {
    height: getRowHeight(state, props)
  };
})(TableHeaderRow);

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-table/src/TableRow.js":
/*!******************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-table/src/TableRow.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _objectWithoutProperties2 = __webpack_require__(/*! babel-runtime/helpers/objectWithoutProperties */ "./node_modules/babel-runtime/helpers/objectWithoutProperties.js");

var _objectWithoutProperties3 = _interopRequireDefault(_objectWithoutProperties2);

var _defineProperty2 = __webpack_require__(/*! babel-runtime/helpers/defineProperty */ "./node_modules/babel-runtime/helpers/defineProperty.js");

var _defineProperty3 = _interopRequireDefault(_defineProperty2);

var _extends4 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends5 = _interopRequireDefault(_extends4);

var _classnames = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");

var _classnames2 = _interopRequireDefault(_classnames);

var _vueTypes = __webpack_require__(/*! ../../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _store = __webpack_require__(/*! ../../_util/store */ "./node_modules/ant-design-vue/lib/_util/store/index.js");

var _TableCell = __webpack_require__(/*! ./TableCell */ "./node_modules/ant-design-vue/lib/vc-table/src/TableCell.js");

var _TableCell2 = _interopRequireDefault(_TableCell);

var _propsUtil = __webpack_require__(/*! ../../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

var _BaseMixin = __webpack_require__(/*! ../../_util/BaseMixin */ "./node_modules/ant-design-vue/lib/_util/BaseMixin.js");

var _BaseMixin2 = _interopRequireDefault(_BaseMixin);

var _warning = __webpack_require__(/*! ../../_util/warning */ "./node_modules/ant-design-vue/lib/_util/warning.js");

var _warning2 = _interopRequireDefault(_warning);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

function noop() {}
var TableRow = {
  name: 'TableRow',
  mixins: [_BaseMixin2['default']],
  props: (0, _propsUtil.initDefaultProps)({
    customRow: _vueTypes2['default'].func,
    // onRowClick: PropTypes.func,
    // onRowDoubleClick: PropTypes.func,
    // onRowContextMenu: PropTypes.func,
    // onRowMouseEnter: PropTypes.func,
    // onRowMouseLeave: PropTypes.func,
    record: _vueTypes2['default'].object,
    prefixCls: _vueTypes2['default'].string,
    // onHover: PropTypes.func,
    columns: _vueTypes2['default'].array,
    height: _vueTypes2['default'].oneOfType([_vueTypes2['default'].string, _vueTypes2['default'].number]),
    index: _vueTypes2['default'].number,
    rowKey: _vueTypes2['default'].oneOfType([_vueTypes2['default'].string, _vueTypes2['default'].number]).isRequired,
    className: _vueTypes2['default'].string,
    indent: _vueTypes2['default'].number,
    indentSize: _vueTypes2['default'].number,
    hasExpandIcon: _vueTypes2['default'].func,
    hovered: _vueTypes2['default'].bool.isRequired,
    visible: _vueTypes2['default'].bool.isRequired,
    store: _vueTypes2['default'].object.isRequired,
    fixed: _vueTypes2['default'].oneOfType([_vueTypes2['default'].string, _vueTypes2['default'].bool]),
    renderExpandIcon: _vueTypes2['default'].func,
    renderExpandIconCell: _vueTypes2['default'].func,
    components: _vueTypes2['default'].any,
    expandedRow: _vueTypes2['default'].bool,
    isAnyColumnsFixed: _vueTypes2['default'].bool,
    ancestorKeys: _vueTypes2['default'].array.isRequired,
    expandIconColumnIndex: _vueTypes2['default'].number,
    expandRowByClick: _vueTypes2['default'].bool
    // visible: PropTypes.bool,
    // hovered: PropTypes.bool,
    // height: PropTypes.any,
  }, {
    // expandIconColumnIndex: 0,
    // expandRowByClick: false,
    hasExpandIcon: function hasExpandIcon() {},
    renderExpandIcon: function renderExpandIcon() {},
    renderExpandIconCell: function renderExpandIconCell() {}
  }),

  data: function data() {
    // this.shouldRender = this.visible
    return {
      shouldRender: this.visible
    };
  },
  mounted: function mounted() {
    var _this = this;

    if (this.shouldRender) {
      this.$nextTick(function () {
        _this.saveRowRef();
      });
    }
  },

  watch: {
    visible: function visible(val) {
      if (val) {
        this.shouldRender = true;
      }
    }
  },

  updated: function updated() {
    var _this2 = this;

    if (this.shouldRender && !this.rowRef) {
      this.$nextTick(function () {
        _this2.saveRowRef();
      });
    }
  },

  methods: {
    onRowClick: function onRowClick(event) {
      var rowPropFunc = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : noop;
      var record = this.record,
          index = this.index;

      this.__emit('rowClick', record, index, event);
      rowPropFunc(event);
    },
    onRowDoubleClick: function onRowDoubleClick(event) {
      var rowPropFunc = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : noop;
      var record = this.record,
          index = this.index;

      this.__emit('rowDoubleClick', record, index, event);
      rowPropFunc(event);
    },
    onContextMenu: function onContextMenu(event) {
      var rowPropFunc = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : noop;
      var record = this.record,
          index = this.index;

      this.__emit('rowContextmenu', record, index, event);
      rowPropFunc(event);
    },
    onMouseEnter: function onMouseEnter(event) {
      var rowPropFunc = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : noop;
      var record = this.record,
          index = this.index,
          rowKey = this.rowKey;

      this.__emit('hover', true, rowKey);
      this.__emit('rowMouseenter', record, index, event);
      rowPropFunc(event);
    },
    onMouseLeave: function onMouseLeave(event) {
      var rowPropFunc = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : noop;
      var record = this.record,
          index = this.index,
          rowKey = this.rowKey;

      this.__emit('hover', false, rowKey);
      this.__emit('rowMouseleave', record, index, event);
      rowPropFunc(event);
    },
    setExpandedRowHeight: function setExpandedRowHeight() {
      var store = this.store,
          rowKey = this.rowKey;

      var _store$getState = store.getState(),
          expandedRowsHeight = _store$getState.expandedRowsHeight;

      var height = this.rowRef.getBoundingClientRect().height;
      expandedRowsHeight = (0, _extends5['default'])({}, expandedRowsHeight, (0, _defineProperty3['default'])({}, rowKey, height));
      store.setState({ expandedRowsHeight: expandedRowsHeight });
    },
    setRowHeight: function setRowHeight() {
      var store = this.store,
          rowKey = this.rowKey;

      var _store$getState2 = store.getState(),
          fixedColumnsBodyRowsHeight = _store$getState2.fixedColumnsBodyRowsHeight;

      var height = this.rowRef.getBoundingClientRect().height;
      store.setState({
        fixedColumnsBodyRowsHeight: (0, _extends5['default'])({}, fixedColumnsBodyRowsHeight, (0, _defineProperty3['default'])({}, rowKey, height))
      });
    },
    getStyle: function getStyle() {
      var height = this.height,
          visible = this.visible;

      var style = (0, _propsUtil.getStyle)(this);
      if (height) {
        style = (0, _extends5['default'])({}, style, { height: height });
      }

      if (!visible && !style.display) {
        style = (0, _extends5['default'])({}, style, { display: 'none' });
      }

      return style;
    },
    saveRowRef: function saveRowRef() {
      this.rowRef = this.$el;

      var isAnyColumnsFixed = this.isAnyColumnsFixed,
          fixed = this.fixed,
          expandedRow = this.expandedRow,
          ancestorKeys = this.ancestorKeys;


      if (!isAnyColumnsFixed) {
        return;
      }

      if (!fixed && expandedRow) {
        this.setExpandedRowHeight();
      }

      if (!fixed && ancestorKeys.length >= 0) {
        this.setRowHeight();
      }
    }
  },

  render: function render() {
    var _this3 = this;

    var h = arguments[0];

    if (!this.shouldRender) {
      return null;
    }

    var prefixCls = this.prefixCls,
        columns = this.columns,
        record = this.record,
        rowKey = this.rowKey,
        index = this.index,
        _customRow = this.customRow,
        customRow = _customRow === undefined ? noop : _customRow,
        indent = this.indent,
        indentSize = this.indentSize,
        hovered = this.hovered,
        height = this.height,
        visible = this.visible,
        components = this.components,
        hasExpandIcon = this.hasExpandIcon,
        renderExpandIcon = this.renderExpandIcon,
        renderExpandIconCell = this.renderExpandIconCell;

    var BodyRow = components.body.row;
    var BodyCell = components.body.cell;

    var className = '';

    if (hovered) {
      className += ' ' + prefixCls + '-hover';
    }

    var cells = [];

    renderExpandIconCell(cells);

    for (var i = 0; i < columns.length; i += 1) {
      var column = columns[i];

      (0, _warning2['default'])(column.onCellClick === undefined, 'column[onCellClick] is deprecated, please use column[customCell] instead.');

      cells.push(h(_TableCell2['default'], {
        attrs: {
          prefixCls: prefixCls,
          record: record,
          indentSize: indentSize,
          indent: indent,
          index: index,
          column: column,

          expandIcon: hasExpandIcon(i) && renderExpandIcon(),
          component: BodyCell
        },
        key: column.key || column.dataIndex }));
    }

    var _ref = customRow(record, index) || {},
        customClass = _ref['class'],
        customClassName = _ref.className,
        customStyle = _ref.style,
        rowProps = (0, _objectWithoutProperties3['default'])(_ref, ['class', 'className', 'style']);

    var style = { height: typeof height === 'number' ? height + 'px' : height };

    if (!visible) {
      style.display = 'none';
    }

    style = (0, _extends5['default'])({}, style, customStyle);
    var rowClassName = (0, _classnames2['default'])(prefixCls, className, prefixCls + '-level-' + indent, customClassName, customClass);
    var rowPropEvents = rowProps.on || {};
    var bodyRowProps = (0, _propsUtil.mergeProps)((0, _extends5['default'])({}, rowProps, { style: style }), {
      on: {
        click: function click(e) {
          _this3.onRowClick(e, rowPropEvents.click);
        },
        dblclick: function dblclick(e) {
          _this3.onRowDoubleClick(e, rowPropEvents.dblclick);
        },
        mouseenter: function mouseenter(e) {
          _this3.onMouseEnter(e, rowPropEvents.mouseenter);
        },
        mouseleave: function mouseleave(e) {
          _this3.onMouseLeave(e, rowPropEvents.mouseleave);
        },
        contextmenu: function contextmenu(e) {
          _this3.onContextMenu(e, rowPropEvents.contextmenu);
        }
      },
      'class': rowClassName
    }, {
      attrs: {
        'data-row-key': rowKey
      }
    });
    return h(
      BodyRow,
      bodyRowProps,
      [cells]
    );
  }
};

function getRowHeight(state, props) {
  var expandedRowsHeight = state.expandedRowsHeight,
      fixedColumnsBodyRowsHeight = state.fixedColumnsBodyRowsHeight;
  var fixed = props.fixed,
      rowKey = props.rowKey;


  if (!fixed) {
    return null;
  }

  if (expandedRowsHeight[rowKey]) {
    return expandedRowsHeight[rowKey];
  }

  if (fixedColumnsBodyRowsHeight[rowKey]) {
    return fixedColumnsBodyRowsHeight[rowKey];
  }

  return null;
}

exports['default'] = (0, _store.connect)(function (state, props) {
  var currentHoverKey = state.currentHoverKey,
      expandedRowKeys = state.expandedRowKeys;
  var rowKey = props.rowKey,
      ancestorKeys = props.ancestorKeys;

  var visible = ancestorKeys.length === 0 || ancestorKeys.every(function (k) {
    return expandedRowKeys.includes(k);
  });

  return {
    visible: visible,
    hovered: currentHoverKey === rowKey,
    height: getRowHeight(state, props)
  };
})(TableRow);

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-table/src/utils.js":
/*!***************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-table/src/utils.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.measureScrollbar = measureScrollbar;
exports.debounce = debounce;
exports.remove = remove;
var scrollbarVerticalSize = void 0;
var scrollbarHorizontalSize = void 0;

// Measure scrollbar width for padding body during modal show/hide
var scrollbarMeasure = {
  position: 'absolute',
  top: '-9999px',
  width: '50px',
  height: '50px'
};

var INTERNAL_COL_DEFINE = exports.INTERNAL_COL_DEFINE = 'RC_TABLE_INTERNAL_COL_DEFINE';

function measureScrollbar(_ref) {
  var _ref$direction = _ref.direction,
      direction = _ref$direction === undefined ? 'vertical' : _ref$direction,
      prefixCls = _ref.prefixCls;

  if (typeof document === 'undefined' || typeof window === 'undefined') {
    return 0;
  }
  var isVertical = direction === 'vertical';
  if (isVertical && scrollbarVerticalSize) {
    return scrollbarVerticalSize;
  }
  if (!isVertical && scrollbarHorizontalSize) {
    return scrollbarHorizontalSize;
  }
  var scrollDiv = document.createElement('div');
  Object.keys(scrollbarMeasure).forEach(function (scrollProp) {
    scrollDiv.style[scrollProp] = scrollbarMeasure[scrollProp];
  });
  // apply hide scrollbar className ahead
  scrollDiv.className = prefixCls + '-hide-scrollbar scroll-div-append-to-body';

  // Append related overflow style
  if (isVertical) {
    scrollDiv.style.overflowY = 'scroll';
  } else {
    scrollDiv.style.overflowX = 'scroll';
  }
  document.body.appendChild(scrollDiv);
  var size = 0;
  if (isVertical) {
    size = scrollDiv.offsetWidth - scrollDiv.clientWidth;
    scrollbarVerticalSize = size;
  } else {
    size = scrollDiv.offsetHeight - scrollDiv.clientHeight;
    scrollbarHorizontalSize = size;
  }

  document.body.removeChild(scrollDiv);
  return size;
}

function debounce(func, wait, immediate) {
  var timeout = void 0;
  function debounceFunc() {
    for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    var context = this;
    // https://fb.me/react-event-pooling
    if (args[0] && args[0].persist) {
      args[0].persist();
    }
    var later = function later() {
      timeout = null;
      if (!immediate) {
        func.apply(context, args);
      }
    };
    var callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if (callNow) {
      func.apply(context, args);
    }
  }
  debounceFunc.cancel = function cancel() {
    if (timeout) {
      clearTimeout(timeout);
      timeout = null;
    }
  };
  return debounceFunc;
}

function remove(array, item) {
  var index = array.indexOf(item);
  var front = array.slice(0, index);
  var last = array.slice(index + 1, array.length);
  return front.concat(last);
}

/***/ }),

/***/ "./node_modules/dom-closest/index.js":
/*!*******************************************!*\
  !*** ./node_modules/dom-closest/index.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * Module dependencies
 */

var matches = __webpack_require__(/*! dom-matches */ "./node_modules/dom-matches/index.js");

/**
 * @param element {Element}
 * @param selector {String}
 * @param context {Element}
 * @return {Element}
 */
module.exports = function (element, selector, context) {
  context = context || document;
  // guard against orphans
  element = { parentNode: element };

  while ((element = element.parentNode) && element !== context) {
    if (matches(element, selector)) {
      return element;
    }
  }
};


/***/ }),

/***/ "./node_modules/dom-matches/index.js":
/*!*******************************************!*\
  !*** ./node_modules/dom-matches/index.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


/**
 * Determine if a DOM element matches a CSS selector
 *
 * @param {Element} elem
 * @param {String} selector
 * @return {Boolean}
 * @api public
 */

function matches(elem, selector) {
  // Vendor-specific implementations of `Element.prototype.matches()`.
  var proto = window.Element.prototype;
  var nativeMatches = proto.matches ||
      proto.mozMatchesSelector ||
      proto.msMatchesSelector ||
      proto.oMatchesSelector ||
      proto.webkitMatchesSelector;

  if (!elem || elem.nodeType !== 1) {
    return false;
  }

  var parentElem = elem.parentNode;

  // use native 'matches'
  if (nativeMatches) {
    return nativeMatches.call(elem, selector);
  }

  // native support for `matches` is missing and a fallback is required
  var nodes = parentElem.querySelectorAll(selector);
  var len = nodes.length;

  for (var i = 0; i < len; i++) {
    if (nodes[i] === elem) {
      return true;
    }
  }

  return false;
}

/**
 * Expose `matches`
 */

module.exports = matches;


/***/ }),

/***/ "./node_modules/lodash/_assignMergeValue.js":
/*!**************************************************!*\
  !*** ./node_modules/lodash/_assignMergeValue.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var baseAssignValue = __webpack_require__(/*! ./_baseAssignValue */ "./node_modules/lodash/_baseAssignValue.js"),
    eq = __webpack_require__(/*! ./eq */ "./node_modules/lodash/eq.js");

/**
 * This function is like `assignValue` except that it doesn't assign
 * `undefined` values.
 *
 * @private
 * @param {Object} object The object to modify.
 * @param {string} key The key of the property to assign.
 * @param {*} value The value to assign.
 */
function assignMergeValue(object, key, value) {
  if ((value !== undefined && !eq(object[key], value)) ||
      (value === undefined && !(key in object))) {
    baseAssignValue(object, key, value);
  }
}

module.exports = assignMergeValue;


/***/ }),

/***/ "./node_modules/lodash/_baseFor.js":
/*!*****************************************!*\
  !*** ./node_modules/lodash/_baseFor.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var createBaseFor = __webpack_require__(/*! ./_createBaseFor */ "./node_modules/lodash/_createBaseFor.js");

/**
 * The base implementation of `baseForOwn` which iterates over `object`
 * properties returned by `keysFunc` and invokes `iteratee` for each property.
 * Iteratee functions may exit iteration early by explicitly returning `false`.
 *
 * @private
 * @param {Object} object The object to iterate over.
 * @param {Function} iteratee The function invoked per iteration.
 * @param {Function} keysFunc The function to get the keys of `object`.
 * @returns {Object} Returns `object`.
 */
var baseFor = createBaseFor();

module.exports = baseFor;


/***/ }),

/***/ "./node_modules/lodash/_baseMerge.js":
/*!*******************************************!*\
  !*** ./node_modules/lodash/_baseMerge.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var Stack = __webpack_require__(/*! ./_Stack */ "./node_modules/lodash/_Stack.js"),
    assignMergeValue = __webpack_require__(/*! ./_assignMergeValue */ "./node_modules/lodash/_assignMergeValue.js"),
    baseFor = __webpack_require__(/*! ./_baseFor */ "./node_modules/lodash/_baseFor.js"),
    baseMergeDeep = __webpack_require__(/*! ./_baseMergeDeep */ "./node_modules/lodash/_baseMergeDeep.js"),
    isObject = __webpack_require__(/*! ./isObject */ "./node_modules/lodash/isObject.js"),
    keysIn = __webpack_require__(/*! ./keysIn */ "./node_modules/lodash/keysIn.js"),
    safeGet = __webpack_require__(/*! ./_safeGet */ "./node_modules/lodash/_safeGet.js");

/**
 * The base implementation of `_.merge` without support for multiple sources.
 *
 * @private
 * @param {Object} object The destination object.
 * @param {Object} source The source object.
 * @param {number} srcIndex The index of `source`.
 * @param {Function} [customizer] The function to customize merged values.
 * @param {Object} [stack] Tracks traversed source values and their merged
 *  counterparts.
 */
function baseMerge(object, source, srcIndex, customizer, stack) {
  if (object === source) {
    return;
  }
  baseFor(source, function(srcValue, key) {
    stack || (stack = new Stack);
    if (isObject(srcValue)) {
      baseMergeDeep(object, source, key, srcIndex, baseMerge, customizer, stack);
    }
    else {
      var newValue = customizer
        ? customizer(safeGet(object, key), srcValue, (key + ''), object, source, stack)
        : undefined;

      if (newValue === undefined) {
        newValue = srcValue;
      }
      assignMergeValue(object, key, newValue);
    }
  }, keysIn);
}

module.exports = baseMerge;


/***/ }),

/***/ "./node_modules/lodash/_baseMergeDeep.js":
/*!***********************************************!*\
  !*** ./node_modules/lodash/_baseMergeDeep.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var assignMergeValue = __webpack_require__(/*! ./_assignMergeValue */ "./node_modules/lodash/_assignMergeValue.js"),
    cloneBuffer = __webpack_require__(/*! ./_cloneBuffer */ "./node_modules/lodash/_cloneBuffer.js"),
    cloneTypedArray = __webpack_require__(/*! ./_cloneTypedArray */ "./node_modules/lodash/_cloneTypedArray.js"),
    copyArray = __webpack_require__(/*! ./_copyArray */ "./node_modules/lodash/_copyArray.js"),
    initCloneObject = __webpack_require__(/*! ./_initCloneObject */ "./node_modules/lodash/_initCloneObject.js"),
    isArguments = __webpack_require__(/*! ./isArguments */ "./node_modules/lodash/isArguments.js"),
    isArray = __webpack_require__(/*! ./isArray */ "./node_modules/lodash/isArray.js"),
    isArrayLikeObject = __webpack_require__(/*! ./isArrayLikeObject */ "./node_modules/lodash/isArrayLikeObject.js"),
    isBuffer = __webpack_require__(/*! ./isBuffer */ "./node_modules/lodash/isBuffer.js"),
    isFunction = __webpack_require__(/*! ./isFunction */ "./node_modules/lodash/isFunction.js"),
    isObject = __webpack_require__(/*! ./isObject */ "./node_modules/lodash/isObject.js"),
    isPlainObject = __webpack_require__(/*! ./isPlainObject */ "./node_modules/lodash/isPlainObject.js"),
    isTypedArray = __webpack_require__(/*! ./isTypedArray */ "./node_modules/lodash/isTypedArray.js"),
    safeGet = __webpack_require__(/*! ./_safeGet */ "./node_modules/lodash/_safeGet.js"),
    toPlainObject = __webpack_require__(/*! ./toPlainObject */ "./node_modules/lodash/toPlainObject.js");

/**
 * A specialized version of `baseMerge` for arrays and objects which performs
 * deep merges and tracks traversed objects enabling objects with circular
 * references to be merged.
 *
 * @private
 * @param {Object} object The destination object.
 * @param {Object} source The source object.
 * @param {string} key The key of the value to merge.
 * @param {number} srcIndex The index of `source`.
 * @param {Function} mergeFunc The function to merge values.
 * @param {Function} [customizer] The function to customize assigned values.
 * @param {Object} [stack] Tracks traversed source values and their merged
 *  counterparts.
 */
function baseMergeDeep(object, source, key, srcIndex, mergeFunc, customizer, stack) {
  var objValue = safeGet(object, key),
      srcValue = safeGet(source, key),
      stacked = stack.get(srcValue);

  if (stacked) {
    assignMergeValue(object, key, stacked);
    return;
  }
  var newValue = customizer
    ? customizer(objValue, srcValue, (key + ''), object, source, stack)
    : undefined;

  var isCommon = newValue === undefined;

  if (isCommon) {
    var isArr = isArray(srcValue),
        isBuff = !isArr && isBuffer(srcValue),
        isTyped = !isArr && !isBuff && isTypedArray(srcValue);

    newValue = srcValue;
    if (isArr || isBuff || isTyped) {
      if (isArray(objValue)) {
        newValue = objValue;
      }
      else if (isArrayLikeObject(objValue)) {
        newValue = copyArray(objValue);
      }
      else if (isBuff) {
        isCommon = false;
        newValue = cloneBuffer(srcValue, true);
      }
      else if (isTyped) {
        isCommon = false;
        newValue = cloneTypedArray(srcValue, true);
      }
      else {
        newValue = [];
      }
    }
    else if (isPlainObject(srcValue) || isArguments(srcValue)) {
      newValue = objValue;
      if (isArguments(objValue)) {
        newValue = toPlainObject(objValue);
      }
      else if (!isObject(objValue) || isFunction(objValue)) {
        newValue = initCloneObject(srcValue);
      }
    }
    else {
      isCommon = false;
    }
  }
  if (isCommon) {
    // Recursively merge objects and arrays (susceptible to call stack limits).
    stack.set(srcValue, newValue);
    mergeFunc(newValue, srcValue, srcIndex, customizer, stack);
    stack['delete'](srcValue);
  }
  assignMergeValue(object, key, newValue);
}

module.exports = baseMergeDeep;


/***/ }),

/***/ "./node_modules/lodash/_baseRest.js":
/*!******************************************!*\
  !*** ./node_modules/lodash/_baseRest.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var identity = __webpack_require__(/*! ./identity */ "./node_modules/lodash/identity.js"),
    overRest = __webpack_require__(/*! ./_overRest */ "./node_modules/lodash/_overRest.js"),
    setToString = __webpack_require__(/*! ./_setToString */ "./node_modules/lodash/_setToString.js");

/**
 * The base implementation of `_.rest` which doesn't validate or coerce arguments.
 *
 * @private
 * @param {Function} func The function to apply a rest parameter to.
 * @param {number} [start=func.length-1] The start position of the rest parameter.
 * @returns {Function} Returns the new function.
 */
function baseRest(func, start) {
  return setToString(overRest(func, start, identity), func + '');
}

module.exports = baseRest;


/***/ }),

/***/ "./node_modules/lodash/_createAssigner.js":
/*!************************************************!*\
  !*** ./node_modules/lodash/_createAssigner.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var baseRest = __webpack_require__(/*! ./_baseRest */ "./node_modules/lodash/_baseRest.js"),
    isIterateeCall = __webpack_require__(/*! ./_isIterateeCall */ "./node_modules/lodash/_isIterateeCall.js");

/**
 * Creates a function like `_.assign`.
 *
 * @private
 * @param {Function} assigner The function to assign values.
 * @returns {Function} Returns the new assigner function.
 */
function createAssigner(assigner) {
  return baseRest(function(object, sources) {
    var index = -1,
        length = sources.length,
        customizer = length > 1 ? sources[length - 1] : undefined,
        guard = length > 2 ? sources[2] : undefined;

    customizer = (assigner.length > 3 && typeof customizer == 'function')
      ? (length--, customizer)
      : undefined;

    if (guard && isIterateeCall(sources[0], sources[1], guard)) {
      customizer = length < 3 ? undefined : customizer;
      length = 1;
    }
    object = Object(object);
    while (++index < length) {
      var source = sources[index];
      if (source) {
        assigner(object, source, index, customizer);
      }
    }
    return object;
  });
}

module.exports = createAssigner;


/***/ }),

/***/ "./node_modules/lodash/_createBaseFor.js":
/*!***********************************************!*\
  !*** ./node_modules/lodash/_createBaseFor.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * Creates a base function for methods like `_.forIn` and `_.forOwn`.
 *
 * @private
 * @param {boolean} [fromRight] Specify iterating from right to left.
 * @returns {Function} Returns the new base function.
 */
function createBaseFor(fromRight) {
  return function(object, iteratee, keysFunc) {
    var index = -1,
        iterable = Object(object),
        props = keysFunc(object),
        length = props.length;

    while (length--) {
      var key = props[fromRight ? length : ++index];
      if (iteratee(iterable[key], key, iterable) === false) {
        break;
      }
    }
    return object;
  };
}

module.exports = createBaseFor;


/***/ }),

/***/ "./node_modules/lodash/_isIterateeCall.js":
/*!************************************************!*\
  !*** ./node_modules/lodash/_isIterateeCall.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var eq = __webpack_require__(/*! ./eq */ "./node_modules/lodash/eq.js"),
    isArrayLike = __webpack_require__(/*! ./isArrayLike */ "./node_modules/lodash/isArrayLike.js"),
    isIndex = __webpack_require__(/*! ./_isIndex */ "./node_modules/lodash/_isIndex.js"),
    isObject = __webpack_require__(/*! ./isObject */ "./node_modules/lodash/isObject.js");

/**
 * Checks if the given arguments are from an iteratee call.
 *
 * @private
 * @param {*} value The potential iteratee value argument.
 * @param {*} index The potential iteratee index or key argument.
 * @param {*} object The potential iteratee object argument.
 * @returns {boolean} Returns `true` if the arguments are from an iteratee call,
 *  else `false`.
 */
function isIterateeCall(value, index, object) {
  if (!isObject(object)) {
    return false;
  }
  var type = typeof index;
  if (type == 'number'
        ? (isArrayLike(object) && isIndex(index, object.length))
        : (type == 'string' && index in object)
      ) {
    return eq(object[index], value);
  }
  return false;
}

module.exports = isIterateeCall;


/***/ }),

/***/ "./node_modules/lodash/_safeGet.js":
/*!*****************************************!*\
  !*** ./node_modules/lodash/_safeGet.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * Gets the value at `key`, unless `key` is "__proto__" or "constructor".
 *
 * @private
 * @param {Object} object The object to query.
 * @param {string} key The key of the property to get.
 * @returns {*} Returns the property value.
 */
function safeGet(object, key) {
  if (key === 'constructor' && typeof object[key] === 'function') {
    return;
  }

  if (key == '__proto__') {
    return;
  }

  return object[key];
}

module.exports = safeGet;


/***/ }),

/***/ "./node_modules/lodash/isArrayLikeObject.js":
/*!**************************************************!*\
  !*** ./node_modules/lodash/isArrayLikeObject.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var isArrayLike = __webpack_require__(/*! ./isArrayLike */ "./node_modules/lodash/isArrayLike.js"),
    isObjectLike = __webpack_require__(/*! ./isObjectLike */ "./node_modules/lodash/isObjectLike.js");

/**
 * This method is like `_.isArrayLike` except that it also checks if `value`
 * is an object.
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is an array-like object,
 *  else `false`.
 * @example
 *
 * _.isArrayLikeObject([1, 2, 3]);
 * // => true
 *
 * _.isArrayLikeObject(document.body.children);
 * // => true
 *
 * _.isArrayLikeObject('abc');
 * // => false
 *
 * _.isArrayLikeObject(_.noop);
 * // => false
 */
function isArrayLikeObject(value) {
  return isObjectLike(value) && isArrayLike(value);
}

module.exports = isArrayLikeObject;


/***/ }),

/***/ "./node_modules/lodash/merge.js":
/*!**************************************!*\
  !*** ./node_modules/lodash/merge.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var baseMerge = __webpack_require__(/*! ./_baseMerge */ "./node_modules/lodash/_baseMerge.js"),
    createAssigner = __webpack_require__(/*! ./_createAssigner */ "./node_modules/lodash/_createAssigner.js");

/**
 * This method is like `_.assign` except that it recursively merges own and
 * inherited enumerable string keyed properties of source objects into the
 * destination object. Source properties that resolve to `undefined` are
 * skipped if a destination value exists. Array and plain object properties
 * are merged recursively. Other objects and value types are overridden by
 * assignment. Source objects are applied from left to right. Subsequent
 * sources overwrite property assignments of previous sources.
 *
 * **Note:** This method mutates `object`.
 *
 * @static
 * @memberOf _
 * @since 0.5.0
 * @category Object
 * @param {Object} object The destination object.
 * @param {...Object} [sources] The source objects.
 * @returns {Object} Returns `object`.
 * @example
 *
 * var object = {
 *   'a': [{ 'b': 2 }, { 'd': 4 }]
 * };
 *
 * var other = {
 *   'a': [{ 'c': 3 }, { 'e': 5 }]
 * };
 *
 * _.merge(object, other);
 * // => { 'a': [{ 'b': 2, 'c': 3 }, { 'd': 4, 'e': 5 }] }
 */
var merge = createAssigner(function(object, source, srcIndex) {
  baseMerge(object, source, srcIndex);
});

module.exports = merge;


/***/ }),

/***/ "./node_modules/lodash/toPlainObject.js":
/*!**********************************************!*\
  !*** ./node_modules/lodash/toPlainObject.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var copyObject = __webpack_require__(/*! ./_copyObject */ "./node_modules/lodash/_copyObject.js"),
    keysIn = __webpack_require__(/*! ./keysIn */ "./node_modules/lodash/keysIn.js");

/**
 * Converts `value` to a plain object flattening inherited enumerable string
 * keyed properties of `value` to own properties of the plain object.
 *
 * @static
 * @memberOf _
 * @since 3.0.0
 * @category Lang
 * @param {*} value The value to convert.
 * @returns {Object} Returns the converted plain object.
 * @example
 *
 * function Foo() {
 *   this.b = 2;
 * }
 *
 * Foo.prototype.c = 3;
 *
 * _.assign({ 'a': 1 }, new Foo);
 * // => { 'a': 1, 'b': 2 }
 *
 * _.assign({ 'a': 1 }, _.toPlainObject(new Foo));
 * // => { 'a': 1, 'b': 2, 'c': 3 }
 */
function toPlainObject(value) {
  return copyObject(value, keysIn(value));
}

module.exports = toPlainObject;


/***/ })

}]);