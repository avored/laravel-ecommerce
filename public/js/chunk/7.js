(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[7],{

/***/ "./node_modules/ant-design-vue/lib/_util/Portal.js":
/*!*********************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/_util/Portal.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _vueTypes = __webpack_require__(/*! ./vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _vnode = __webpack_require__(/*! ./vnode */ "./node_modules/ant-design-vue/lib/_util/vnode.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports['default'] = {
  name: 'Portal',
  props: {
    getContainer: _vueTypes2['default'].func.isRequired,
    children: _vueTypes2['default'].any.isRequired,
    didUpdate: _vueTypes2['default'].func
  },
  mounted: function mounted() {
    this.createContainer();
  },
  updated: function updated() {
    var _this = this;

    var didUpdate = this.$props.didUpdate;

    if (didUpdate) {
      this.$nextTick(function () {
        didUpdate(_this.$props);
      });
    }
  },
  beforeDestroy: function beforeDestroy() {
    this.removeContainer();
  },

  methods: {
    createContainer: function createContainer() {
      this._container = this.$props.getContainer();
      this.$forceUpdate();
    },
    removeContainer: function removeContainer() {
      if (this._container && this._container.parentNode) {
        this._container.parentNode.removeChild(this._container);
      }
    }
  },

  render: function render() {
    if (this._container) {
      return (0, _vnode.cloneElement)(this.$props.children, {
        directives: [{
          name: 'ant-portal',
          value: this._container
        }]
      });
    }
    return null;
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/_util/PortalWrapper.js":
/*!****************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/_util/PortalWrapper.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _babelHelperVueJsxMergeProps = __webpack_require__(/*! babel-helper-vue-jsx-merge-props */ "./node_modules/babel-helper-vue-jsx-merge-props/index.js");

var _babelHelperVueJsxMergeProps2 = _interopRequireDefault(_babelHelperVueJsxMergeProps);

var _typeof2 = __webpack_require__(/*! babel-runtime/helpers/typeof */ "./node_modules/babel-runtime/helpers/typeof.js");

var _typeof3 = _interopRequireDefault(_typeof2);

var _vueTypes = __webpack_require__(/*! ./vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _switchScrollingEffect2 = __webpack_require__(/*! ./switchScrollingEffect */ "./node_modules/ant-design-vue/lib/_util/switchScrollingEffect.js");

var _switchScrollingEffect3 = _interopRequireDefault(_switchScrollingEffect2);

var _setStyle = __webpack_require__(/*! ./setStyle */ "./node_modules/ant-design-vue/lib/_util/setStyle.js");

var _setStyle2 = _interopRequireDefault(_setStyle);

var _Portal = __webpack_require__(/*! ./Portal */ "./node_modules/ant-design-vue/lib/_util/Portal.js");

var _Portal2 = _interopRequireDefault(_Portal);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var openCount = 0;
var windowIsUndefined = !(typeof window !== 'undefined' && window.document && window.document.createElement);
// https://github.com/ant-design/ant-design/issues/19340
// https://github.com/ant-design/ant-design/issues/19332
var cacheOverflow = {};

exports['default'] = {
  name: 'PortalWrapper',
  props: {
    wrapperClassName: _vueTypes2['default'].string,
    forceRender: _vueTypes2['default'].bool,
    getContainer: _vueTypes2['default'].any,
    children: _vueTypes2['default'].func,
    visible: _vueTypes2['default'].bool
  },
  data: function data() {
    var visible = this.$props.visible;

    openCount = visible ? openCount + 1 : openCount;
    return {};
  },
  updated: function updated() {
    this.setWrapperClassName();
  },

  watch: {
    visible: function visible(val) {
      openCount = val ? openCount + 1 : openCount - 1;
    },
    getContainer: function getContainer(_getContainer, prevGetContainer) {
      var getContainerIsFunc = typeof _getContainer === 'function' && typeof prevGetContainer === 'function';
      if (getContainerIsFunc ? _getContainer.toString() !== prevGetContainer.toString() : _getContainer !== prevGetContainer) {
        this.removeCurrentContainer(false);
      }
    }
  },
  beforeDestroy: function beforeDestroy() {
    var visible = this.$props.visible;
    // 离开时不会 render， 导到离开时数值不变，改用 func 。。

    openCount = visible && openCount ? openCount - 1 : openCount;
    this.removeCurrentContainer(visible);
  },

  methods: {
    getParent: function getParent() {
      var getContainer = this.$props.getContainer;

      if (getContainer) {
        if (typeof getContainer === 'string') {
          return document.querySelectorAll(getContainer)[0];
        }
        if (typeof getContainer === 'function') {
          return getContainer();
        }
        if ((typeof getContainer === 'undefined' ? 'undefined' : (0, _typeof3['default'])(getContainer)) === 'object' && getContainer instanceof window.HTMLElement) {
          return getContainer;
        }
      }
      return document.body;
    },
    getDomContainer: function getDomContainer() {
      if (windowIsUndefined) {
        return null;
      }
      if (!this.container) {
        this.container = document.createElement('div');
        var parent = this.getParent();
        if (parent) {
          parent.appendChild(this.container);
        }
      }
      this.setWrapperClassName();
      return this.container;
    },
    setWrapperClassName: function setWrapperClassName() {
      var wrapperClassName = this.$props.wrapperClassName;

      if (this.container && wrapperClassName && wrapperClassName !== this.container.className) {
        this.container.className = wrapperClassName;
      }
    },
    savePortal: function savePortal(c) {
      // Warning: don't rename _component
      // https://github.com/react-component/util/pull/65#discussion_r352407916
      this._component = c;
    },
    removeCurrentContainer: function removeCurrentContainer() {
      this.container = null;
      this._component = null;
    },


    /**
     * Enhance ./switchScrollingEffect
     * 1. Simulate document body scroll bar with
     * 2. Record body has overflow style and recover when all of PortalWrapper invisible
     * 3. Disable body scroll when PortalWrapper has open
     *
     * @memberof PortalWrapper
     */
    switchScrollingEffect: function switchScrollingEffect() {
      if (openCount === 1 && !Object.keys(cacheOverflow).length) {
        (0, _switchScrollingEffect3['default'])();
        // Must be set after switchScrollingEffect
        cacheOverflow = (0, _setStyle2['default'])({
          overflow: 'hidden',
          overflowX: 'hidden',
          overflowY: 'hidden'
        });
      } else if (!openCount) {
        (0, _setStyle2['default'])(cacheOverflow);
        cacheOverflow = {};
        (0, _switchScrollingEffect3['default'])(true);
      }
    }
  },

  render: function render() {
    var h = arguments[0];
    var _$props = this.$props,
        children = _$props.children,
        forceRender = _$props.forceRender,
        visible = _$props.visible;

    var portal = null;
    var childProps = {
      getOpenCount: function getOpenCount() {
        return openCount;
      },
      getContainer: this.getDomContainer,
      switchScrollingEffect: this.switchScrollingEffect
    };
    if (forceRender || visible || this._component) {
      portal = h(_Portal2['default'], (0, _babelHelperVueJsxMergeProps2['default'])([{
        attrs: {
          getContainer: this.getDomContainer,
          children: children(childProps)
        }
      }, {
        directives: [{
          name: 'ant-ref',
          value: this.savePortal
        }]
      }]));
    }
    return portal;
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/_util/getScrollBarSize.js":
/*!*******************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/_util/getScrollBarSize.js ***!
  \*******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports['default'] = getScrollBarSize;
var cached = void 0;

function getScrollBarSize(fresh) {
  if (fresh || cached === undefined) {
    var inner = document.createElement('div');
    inner.style.width = '100%';
    inner.style.height = '200px';

    var outer = document.createElement('div');
    var outerStyle = outer.style;

    outerStyle.position = 'absolute';
    outerStyle.top = 0;
    outerStyle.left = 0;
    outerStyle.pointerEvents = 'none';
    outerStyle.visibility = 'hidden';
    outerStyle.width = '200px';
    outerStyle.height = '150px';
    outerStyle.overflow = 'hidden';

    outer.appendChild(inner);

    document.body.appendChild(outer);

    var widthContained = inner.offsetWidth;
    outer.style.overflow = 'scroll';
    var widthScroll = inner.offsetWidth;

    if (widthContained === widthScroll) {
      widthScroll = outer.clientWidth;
    }

    document.body.removeChild(outer);

    cached = widthContained - widthScroll;
  }
  return cached;
}

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/_util/setStyle.js":
/*!***********************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/_util/setStyle.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
/**
 * Easy to set element style, return previous style
 * IE browser compatible(IE browser doesn't merge overflow style, need to set it separately)
 * https://github.com/ant-design/ant-design/issues/19393
 *
 */
function setStyle(style) {
  var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
  var _options$element = options.element,
      element = _options$element === undefined ? document.body : _options$element;

  var oldStyle = {};

  var styleKeys = Object.keys(style);

  // IE browser compatible
  styleKeys.forEach(function (key) {
    oldStyle[key] = element.style[key];
  });

  styleKeys.forEach(function (key) {
    element.style[key] = style[key];
  });

  return oldStyle;
}

exports["default"] = setStyle;

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/_util/switchScrollingEffect.js":
/*!************************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/_util/switchScrollingEffect.js ***!
  \************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _getScrollBarSize = __webpack_require__(/*! ./getScrollBarSize */ "./node_modules/ant-design-vue/lib/_util/getScrollBarSize.js");

var _getScrollBarSize2 = _interopRequireDefault(_getScrollBarSize);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports['default'] = function (close) {
  var bodyIsOverflowing = document.body.scrollHeight > (window.innerHeight || document.documentElement.clientHeight) && window.innerWidth > document.body.offsetWidth;
  if (!bodyIsOverflowing) {
    return;
  }
  if (close) {
    document.body.style.position = '';
    document.body.style.width = '';
    return;
  }
  var scrollBarSize = (0, _getScrollBarSize2['default'])();
  if (scrollBarSize) {
    document.body.style.position = 'relative';
    document.body.style.width = 'calc(100% - ' + scrollBarSize + 'px)';
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/modal/ActionButton.js":
/*!***************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/modal/ActionButton.js ***!
  \***************************************************************/
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

var _button = __webpack_require__(/*! ../button */ "./node_modules/ant-design-vue/lib/button/index.js");

var _button2 = _interopRequireDefault(_button);

var _BaseMixin = __webpack_require__(/*! ../_util/BaseMixin */ "./node_modules/ant-design-vue/lib/_util/BaseMixin.js");

var _BaseMixin2 = _interopRequireDefault(_BaseMixin);

var _buttonTypes = __webpack_require__(/*! ../button/buttonTypes */ "./node_modules/ant-design-vue/lib/button/buttonTypes.js");

var _buttonTypes2 = _interopRequireDefault(_buttonTypes);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var ButtonType = (0, _buttonTypes2['default'])().type;
var ActionButtonProps = {
  type: ButtonType,
  actionFn: _vueTypes2['default'].func,
  closeModal: _vueTypes2['default'].func,
  autoFocus: _vueTypes2['default'].bool,
  buttonProps: _vueTypes2['default'].object
};

exports['default'] = {
  mixins: [_BaseMixin2['default']],
  props: ActionButtonProps,
  data: function data() {
    return {
      loading: false
    };
  },
  mounted: function mounted() {
    var _this = this;

    if (this.autoFocus) {
      this.timeoutId = setTimeout(function () {
        return _this.$el.focus();
      });
    }
  },
  beforeDestroy: function beforeDestroy() {
    clearTimeout(this.timeoutId);
  },

  methods: {
    onClick: function onClick() {
      var _this2 = this;

      var actionFn = this.actionFn,
          closeModal = this.closeModal;

      if (actionFn) {
        var ret = void 0;
        if (actionFn.length) {
          ret = actionFn(closeModal);
        } else {
          ret = actionFn();
          if (!ret) {
            closeModal();
          }
        }
        if (ret && ret.then) {
          this.setState({ loading: true });
          ret.then(function () {
            // It's unnecessary to set loading=false, for the Modal will be unmounted after close.
            // this.setState({ loading: false });
            closeModal.apply(undefined, arguments);
          }, function (e) {
            // Emit error when catch promise reject
            // eslint-disable-next-line no-console
            console.error(e);
            // See: https://github.com/ant-design/ant-design/issues/6183
            _this2.setState({ loading: false });
          });
        }
      } else {
        closeModal();
      }
    }
  },

  render: function render() {
    var h = arguments[0];
    var type = this.type,
        $slots = this.$slots,
        loading = this.loading,
        buttonProps = this.buttonProps;

    return h(
      _button2['default'],
      (0, _babelHelperVueJsxMergeProps2['default'])([{
        attrs: { type: type, loading: loading },
        on: {
          'click': this.onClick
        }
      }, buttonProps]),
      [$slots['default']]
    );
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/modal/ConfirmDialog.js":
/*!****************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/modal/ConfirmDialog.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _defineProperty2 = __webpack_require__(/*! babel-runtime/helpers/defineProperty */ "./node_modules/babel-runtime/helpers/defineProperty.js");

var _defineProperty3 = _interopRequireDefault(_defineProperty2);

var _classnames = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");

var _classnames2 = _interopRequireDefault(_classnames);

var _icon = __webpack_require__(/*! ../icon */ "./node_modules/ant-design-vue/lib/icon/index.js");

var _icon2 = _interopRequireDefault(_icon);

var _Modal = __webpack_require__(/*! ./Modal */ "./node_modules/ant-design-vue/lib/modal/Modal.js");

var _Modal2 = _interopRequireDefault(_Modal);

var _ActionButton = __webpack_require__(/*! ./ActionButton */ "./node_modules/ant-design-vue/lib/modal/ActionButton.js");

var _ActionButton2 = _interopRequireDefault(_ActionButton);

var _locale = __webpack_require__(/*! ./locale */ "./node_modules/ant-design-vue/lib/modal/locale.js");

var _warning = __webpack_require__(/*! ../_util/warning */ "./node_modules/ant-design-vue/lib/_util/warning.js");

var _warning2 = _interopRequireDefault(_warning);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports['default'] = {
  functional: true,
  render: function render(h, context) {
    var props = context.props;
    var onCancel = props.onCancel,
        onOk = props.onOk,
        close = props.close,
        zIndex = props.zIndex,
        afterClose = props.afterClose,
        visible = props.visible,
        keyboard = props.keyboard,
        centered = props.centered,
        getContainer = props.getContainer,
        maskStyle = props.maskStyle,
        okButtonProps = props.okButtonProps,
        cancelButtonProps = props.cancelButtonProps,
        _props$iconType = props.iconType,
        iconType = _props$iconType === undefined ? 'question-circle' : _props$iconType,
        _props$closable = props.closable,
        closable = _props$closable === undefined ? false : _props$closable;

    (0, _warning2['default'])(!('iconType' in props), 'Modal', 'The property \'iconType\' is deprecated. Use the property \'icon\' instead.');
    var icon = props.icon ? props.icon : iconType;
    var okType = props.okType || 'primary';
    var prefixCls = props.prefixCls || 'ant-modal';
    var contentPrefixCls = prefixCls + '-confirm';
    // 默认为 true，保持向下兼容
    var okCancel = 'okCancel' in props ? props.okCancel : true;
    var width = props.width || 416;
    var style = props.style || {};
    var mask = props.mask === undefined ? true : props.mask;
    // 默认为 false，保持旧版默认行为
    var maskClosable = props.maskClosable === undefined ? false : props.maskClosable;
    var runtimeLocale = (0, _locale.getConfirmLocale)();
    var okText = props.okText || (okCancel ? runtimeLocale.okText : runtimeLocale.justOkText);
    var cancelText = props.cancelText || runtimeLocale.cancelText;
    var autoFocusButton = props.autoFocusButton === null ? false : props.autoFocusButton || 'ok';
    var transitionName = props.transitionName || 'zoom';
    var maskTransitionName = props.maskTransitionName || 'fade';

    var classString = (0, _classnames2['default'])(contentPrefixCls, contentPrefixCls + '-' + props.type, prefixCls + '-' + props.type, props['class']);

    var cancelButton = okCancel && h(
      _ActionButton2['default'],
      {
        attrs: {
          actionFn: onCancel,
          closeModal: close,
          autoFocus: autoFocusButton === 'cancel',
          buttonProps: cancelButtonProps
        }
      },
      [cancelText]
    );
    var iconNode = typeof icon === 'string' ? h(_icon2['default'], {
      attrs: { type: icon }
    }) : icon(h);

    return h(
      _Modal2['default'],
      {
        attrs: {
          prefixCls: prefixCls,

          wrapClassName: (0, _classnames2['default'])((0, _defineProperty3['default'])({}, contentPrefixCls + '-centered', !!centered)),

          visible: visible,
          closable: closable,
          title: '',
          transitionName: transitionName,
          footer: '',
          maskTransitionName: maskTransitionName,
          mask: mask,
          maskClosable: maskClosable,
          maskStyle: maskStyle,

          width: width,
          zIndex: zIndex,
          afterClose: afterClose,
          keyboard: keyboard,
          centered: centered,
          getContainer: getContainer
        },
        'class': classString, on: {
          'cancel': function cancel(e) {
            return close({ triggerCancel: true }, e);
          }
        },
        style: style },
      [h(
        'div',
        { 'class': contentPrefixCls + '-body-wrapper' },
        [h(
          'div',
          { 'class': contentPrefixCls + '-body' },
          [iconNode, props.title === undefined ? null : h(
            'span',
            { 'class': contentPrefixCls + '-title' },
            [props.title]
          ), h(
            'div',
            { 'class': contentPrefixCls + '-content' },
            [typeof props.content === 'function' ? props.content(h) : props.content]
          )]
        ), h(
          'div',
          { 'class': contentPrefixCls + '-btns' },
          [cancelButton, h(
            _ActionButton2['default'],
            {
              attrs: {
                type: okType,
                actionFn: onOk,
                closeModal: close,
                autoFocus: autoFocusButton === 'ok',
                buttonProps: okButtonProps
              }
            },
            [okText]
          )]
        )]
      )]
    );
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/modal/Modal.js":
/*!********************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/modal/Modal.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.destroyFns = undefined;

var _defineProperty2 = __webpack_require__(/*! babel-runtime/helpers/defineProperty */ "./node_modules/babel-runtime/helpers/defineProperty.js");

var _defineProperty3 = _interopRequireDefault(_defineProperty2);

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _classnames = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");

var _classnames2 = _interopRequireDefault(_classnames);

var _vcDialog = __webpack_require__(/*! ../vc-dialog */ "./node_modules/ant-design-vue/lib/vc-dialog/index.js");

var _vcDialog2 = _interopRequireDefault(_vcDialog);

var _vueTypes = __webpack_require__(/*! ../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _addEventListener = __webpack_require__(/*! ../vc-util/Dom/addEventListener */ "./node_modules/ant-design-vue/lib/vc-util/Dom/addEventListener.js");

var _addEventListener2 = _interopRequireDefault(_addEventListener);

var _locale = __webpack_require__(/*! ./locale */ "./node_modules/ant-design-vue/lib/modal/locale.js");

var _icon = __webpack_require__(/*! ../icon */ "./node_modules/ant-design-vue/lib/icon/index.js");

var _icon2 = _interopRequireDefault(_icon);

var _button = __webpack_require__(/*! ../button */ "./node_modules/ant-design-vue/lib/button/index.js");

var _button2 = _interopRequireDefault(_button);

var _buttonTypes = __webpack_require__(/*! ../button/buttonTypes */ "./node_modules/ant-design-vue/lib/button/buttonTypes.js");

var _buttonTypes2 = _interopRequireDefault(_buttonTypes);

var _LocaleReceiver = __webpack_require__(/*! ../locale-provider/LocaleReceiver */ "./node_modules/ant-design-vue/lib/locale-provider/LocaleReceiver.js");

var _LocaleReceiver2 = _interopRequireDefault(_LocaleReceiver);

var _propsUtil = __webpack_require__(/*! ../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

var _configProvider2 = __webpack_require__(/*! ../config-provider */ "./node_modules/ant-design-vue/lib/config-provider/index.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var ButtonType = (0, _buttonTypes2['default'])().type;


var mousePosition = null;
// ref: https://github.com/ant-design/ant-design/issues/15795
var getClickPosition = function getClickPosition(e) {
  mousePosition = {
    x: e.pageX,
    y: e.pageY
  };
  // 100ms 内发生过点击事件，则从点击位置动画展示
  // 否则直接 zoom 展示
  // 这样可以兼容非点击方式展开
  setTimeout(function () {
    return mousePosition = null;
  }, 100);
};

// 只有点击事件支持从鼠标位置动画展开
if (typeof window !== 'undefined' && window.document && window.document.documentElement) {
  (0, _addEventListener2['default'])(document.documentElement, 'click', getClickPosition, true);
}

function noop() {}
var modalProps = function modalProps() {
  var defaultProps = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

  var props = {
    prefixCls: _vueTypes2['default'].string,
    /** 对话框是否可见*/
    visible: _vueTypes2['default'].bool,
    /** 确定按钮 loading*/
    confirmLoading: _vueTypes2['default'].bool,
    /** 标题*/
    title: _vueTypes2['default'].any,
    /** 是否显示右上角的关闭按钮*/
    closable: _vueTypes2['default'].bool,
    closeIcon: _vueTypes2['default'].any,
    /** 点击确定回调*/
    // onOk: (e: React.MouseEvent<any>) => void,
    /** 点击模态框右上角叉、取消按钮、Props.maskClosable 值为 true 时的遮罩层或键盘按下 Esc 时的回调*/
    // onCancel: (e: React.MouseEvent<any>) => void,
    afterClose: _vueTypes2['default'].func.def(noop),
    /** 垂直居中 */
    centered: _vueTypes2['default'].bool,
    /** 宽度*/
    width: _vueTypes2['default'].oneOfType([_vueTypes2['default'].string, _vueTypes2['default'].number]),
    /** 底部内容*/
    footer: _vueTypes2['default'].any,
    /** 确认按钮文字*/
    okText: _vueTypes2['default'].any,
    /** 确认按钮类型*/
    okType: ButtonType,
    /** 取消按钮文字*/
    cancelText: _vueTypes2['default'].any,
    icon: _vueTypes2['default'].any,
    /** 点击蒙层是否允许关闭*/
    maskClosable: _vueTypes2['default'].bool,
    /** 强制渲染 Modal*/
    forceRender: _vueTypes2['default'].bool,
    okButtonProps: _vueTypes2['default'].object,
    cancelButtonProps: _vueTypes2['default'].object,
    destroyOnClose: _vueTypes2['default'].bool,
    wrapClassName: _vueTypes2['default'].string,
    maskTransitionName: _vueTypes2['default'].string,
    transitionName: _vueTypes2['default'].string,
    getContainer: _vueTypes2['default'].func,
    zIndex: _vueTypes2['default'].number,
    bodyStyle: _vueTypes2['default'].object,
    maskStyle: _vueTypes2['default'].object,
    mask: _vueTypes2['default'].bool,
    keyboard: _vueTypes2['default'].bool,
    wrapProps: _vueTypes2['default'].object,
    focusTriggerAfterClose: _vueTypes2['default'].bool
  };
  return (0, _propsUtil.initDefaultProps)(props, defaultProps);
};

var destroyFns = exports.destroyFns = [];

exports['default'] = {
  name: 'AModal',
  inheritAttrs: false,
  model: {
    prop: 'visible',
    event: 'change'
  },
  props: modalProps({
    width: 520,
    transitionName: 'zoom',
    maskTransitionName: 'fade',
    confirmLoading: false,
    visible: false,
    okType: 'primary'
  }),
  data: function data() {
    return {
      sVisible: !!this.visible
    };
  },

  watch: {
    visible: function visible(val) {
      this.sVisible = val;
    }
  },
  inject: {
    configProvider: { 'default': function _default() {
        return _configProvider2.ConfigConsumerProps;
      } }
  },
  // static info: ModalFunc;
  // static success: ModalFunc;
  // static error: ModalFunc;
  // static warn: ModalFunc;
  // static warning: ModalFunc;
  // static confirm: ModalFunc;
  methods: {
    handleCancel: function handleCancel(e) {
      this.$emit('cancel', e);
      this.$emit('change', false);
    },
    handleOk: function handleOk(e) {
      this.$emit('ok', e);
    },
    renderFooter: function renderFooter(locale) {
      var h = this.$createElement;
      var okType = this.okType,
          confirmLoading = this.confirmLoading;

      var cancelBtnProps = (0, _propsUtil.mergeProps)({ on: { click: this.handleCancel } }, this.cancelButtonProps || {});
      var okBtnProps = (0, _propsUtil.mergeProps)({
        on: { click: this.handleOk },
        props: {
          type: okType,
          loading: confirmLoading
        }
      }, this.okButtonProps || {});
      return h('div', [h(
        _button2['default'],
        cancelBtnProps,
        [(0, _propsUtil.getComponentFromProp)(this, 'cancelText') || locale.cancelText]
      ), h(
        _button2['default'],
        okBtnProps,
        [(0, _propsUtil.getComponentFromProp)(this, 'okText') || locale.okText]
      )]);
    }
  },

  render: function render() {
    var h = arguments[0];
    var customizePrefixCls = this.prefixCls,
        visible = this.sVisible,
        wrapClassName = this.wrapClassName,
        centered = this.centered,
        getContainer = this.getContainer,
        $slots = this.$slots,
        $scopedSlots = this.$scopedSlots,
        $attrs = this.$attrs;

    var children = $scopedSlots['default'] ? $scopedSlots['default']() : $slots['default'];
    var _configProvider = this.configProvider,
        getPrefixCls = _configProvider.getPrefixCls,
        getContextPopupContainer = _configProvider.getPopupContainer;

    var prefixCls = getPrefixCls('modal', customizePrefixCls);

    var defaultFooter = h(_LocaleReceiver2['default'], {
      attrs: {
        componentName: 'Modal',
        defaultLocale: (0, _locale.getConfirmLocale)()
      },
      scopedSlots: { 'default': this.renderFooter }
    });
    var closeIcon = (0, _propsUtil.getComponentFromProp)(this, 'closeIcon');
    var closeIconToRender = h(
      'span',
      { 'class': prefixCls + '-close-x' },
      [closeIcon || h(_icon2['default'], { 'class': prefixCls + '-close-icon', attrs: { type: 'close' }
      })]
    );
    var footer = (0, _propsUtil.getComponentFromProp)(this, 'footer');
    var title = (0, _propsUtil.getComponentFromProp)(this, 'title');
    var dialogProps = {
      props: (0, _extends3['default'])({}, this.$props, {
        getContainer: getContainer === undefined ? getContextPopupContainer : getContainer,
        prefixCls: prefixCls,
        wrapClassName: (0, _classnames2['default'])((0, _defineProperty3['default'])({}, prefixCls + '-centered', !!centered), wrapClassName),
        title: title,
        footer: footer === undefined ? defaultFooter : footer,
        visible: visible,
        mousePosition: mousePosition,
        closeIcon: closeIconToRender
      }),
      on: (0, _extends3['default'])({}, (0, _propsUtil.getListeners)(this), {
        close: this.handleCancel
      }),
      'class': (0, _propsUtil.getClass)(this),
      style: (0, _propsUtil.getStyle)(this),
      attrs: $attrs
    };
    return h(
      _vcDialog2['default'],
      dialogProps,
      [children]
    );
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/modal/confirm.js":
/*!**********************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/modal/confirm.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

exports['default'] = confirm;

var _vue = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.common.js");

var _vue2 = _interopRequireDefault(_vue);

var _ConfirmDialog = __webpack_require__(/*! ./ConfirmDialog */ "./node_modules/ant-design-vue/lib/modal/ConfirmDialog.js");

var _ConfirmDialog2 = _interopRequireDefault(_ConfirmDialog);

var _Modal = __webpack_require__(/*! ./Modal */ "./node_modules/ant-design-vue/lib/modal/Modal.js");

var _base = __webpack_require__(/*! ../base */ "./node_modules/ant-design-vue/lib/base/index.js");

var _base2 = _interopRequireDefault(_base);

var _omit = __webpack_require__(/*! omit.js */ "./node_modules/omit.js/es/index.js");

var _omit2 = _interopRequireDefault(_omit);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

function confirm(config) {
  var div = document.createElement('div');
  var el = document.createElement('div');
  div.appendChild(el);
  document.body.appendChild(div);
  var currentConfig = (0, _extends3['default'])({}, (0, _omit2['default'])(config, ['parentContext']), { close: close, visible: true });

  var confirmDialogInstance = null;
  var confirmDialogProps = { props: {} };
  function close() {
    destroy.apply(undefined, arguments);
  }
  function update(newConfig) {
    currentConfig = (0, _extends3['default'])({}, currentConfig, newConfig);
    confirmDialogProps.props = currentConfig;
  }
  function destroy() {
    if (confirmDialogInstance && div.parentNode) {
      confirmDialogInstance.$destroy();
      confirmDialogInstance = null;
      div.parentNode.removeChild(div);
    }

    for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    var triggerCancel = args.some(function (param) {
      return param && param.triggerCancel;
    });
    if (config.onCancel && triggerCancel) {
      config.onCancel.apply(config, args);
    }
    for (var i = 0; i < _Modal.destroyFns.length; i++) {
      var fn = _Modal.destroyFns[i];
      if (fn === close) {
        _Modal.destroyFns.splice(i, 1);
        break;
      }
    }
  }

  function render(props) {
    confirmDialogProps.props = props;
    var V = _base2['default'].Vue || _vue2['default'];
    return new V({
      el: el,
      parent: config.parentContext,
      data: function data() {
        return { confirmDialogProps: confirmDialogProps };
      },
      render: function render() {
        var h = arguments[0];

        // 先解构，避免报错，原因不详
        var cdProps = (0, _extends3['default'])({}, this.confirmDialogProps);
        return h(_ConfirmDialog2['default'], cdProps);
      }
    });
  }

  confirmDialogInstance = render(currentConfig);
  _Modal.destroyFns.push(close);
  return {
    destroy: close,
    update: update
  };
}

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/modal/index.js":
/*!********************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/modal/index.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _Modal = __webpack_require__(/*! ./Modal */ "./node_modules/ant-design-vue/lib/modal/Modal.js");

var _Modal2 = _interopRequireDefault(_Modal);

var _confirm = __webpack_require__(/*! ./confirm */ "./node_modules/ant-design-vue/lib/modal/confirm.js");

var _confirm2 = _interopRequireDefault(_confirm);

var _icon = __webpack_require__(/*! ../icon */ "./node_modules/ant-design-vue/lib/icon/index.js");

var _icon2 = _interopRequireDefault(_icon);

var _base = __webpack_require__(/*! ../base */ "./node_modules/ant-design-vue/lib/base/index.js");

var _base2 = _interopRequireDefault(_base);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

// export { ActionButtonProps } from './ActionButton'
// export { ModalProps, ModalFuncProps } from './Modal'

var info = function info(props) {
  var config = (0, _extends3['default'])({
    type: 'info',
    icon: function icon(h) {
      return h(_icon2['default'], {
        attrs: { type: 'info-circle' }
      });
    },
    okCancel: false
  }, props);
  return (0, _confirm2['default'])(config);
};

var success = function success(props) {
  var config = (0, _extends3['default'])({
    type: 'success',
    icon: function icon(h) {
      return h(_icon2['default'], {
        attrs: { type: 'check-circle' }
      });
    },
    okCancel: false
  }, props);
  return (0, _confirm2['default'])(config);
};

var error = function error(props) {
  var config = (0, _extends3['default'])({
    type: 'error',
    icon: function icon(h) {
      return h(_icon2['default'], {
        attrs: { type: 'close-circle' }
      });
    },
    okCancel: false
  }, props);
  return (0, _confirm2['default'])(config);
};

var warning = function warning(props) {
  var config = (0, _extends3['default'])({
    type: 'warning',
    icon: function icon(h) {
      return h(_icon2['default'], {
        attrs: { type: 'exclamation-circle' }
      });
    },
    okCancel: false
  }, props);
  return (0, _confirm2['default'])(config);
};
var warn = warning;

var confirm = function confirmFn(props) {
  var config = (0, _extends3['default'])({
    type: 'confirm',
    okCancel: true
  }, props);
  return (0, _confirm2['default'])(config);
};
_Modal2['default'].info = info;
_Modal2['default'].success = success;
_Modal2['default'].error = error;
_Modal2['default'].warning = warning;
_Modal2['default'].warn = warn;
_Modal2['default'].confirm = confirm;

_Modal2['default'].destroyAll = function destroyAllFn() {
  while (_Modal.destroyFns.length) {
    var close = _Modal.destroyFns.pop();
    if (close) {
      close();
    }
  }
};

/* istanbul ignore next */
_Modal2['default'].install = function (Vue) {
  Vue.use(_base2['default']);
  Vue.component(_Modal2['default'].name, _Modal2['default']);
};

exports['default'] = _Modal2['default'];

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-dialog/Dialog.js":
/*!*************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-dialog/Dialog.js ***!
  \*************************************************************/
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

var _propsUtil = __webpack_require__(/*! ../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

var _KeyCode = __webpack_require__(/*! ../_util/KeyCode */ "./node_modules/ant-design-vue/lib/_util/KeyCode.js");

var _KeyCode2 = _interopRequireDefault(_KeyCode);

var _contains = __webpack_require__(/*! ../vc-util/Dom/contains */ "./node_modules/ant-design-vue/lib/vc-util/Dom/contains.js");

var _contains2 = _interopRequireDefault(_contains);

var _LazyRenderBox = __webpack_require__(/*! ./LazyRenderBox */ "./node_modules/ant-design-vue/lib/vc-dialog/LazyRenderBox.js");

var _LazyRenderBox2 = _interopRequireDefault(_LazyRenderBox);

var _BaseMixin = __webpack_require__(/*! ../_util/BaseMixin */ "./node_modules/ant-design-vue/lib/_util/BaseMixin.js");

var _BaseMixin2 = _interopRequireDefault(_BaseMixin);

var _getTransitionProps = __webpack_require__(/*! ../_util/getTransitionProps */ "./node_modules/ant-design-vue/lib/_util/getTransitionProps.js");

var _getTransitionProps2 = _interopRequireDefault(_getTransitionProps);

var _switchScrollingEffect2 = __webpack_require__(/*! ../_util/switchScrollingEffect */ "./node_modules/ant-design-vue/lib/_util/switchScrollingEffect.js");

var _switchScrollingEffect3 = _interopRequireDefault(_switchScrollingEffect2);

var _IDialogPropTypes = __webpack_require__(/*! ./IDialogPropTypes */ "./node_modules/ant-design-vue/lib/vc-dialog/IDialogPropTypes.js");

var _IDialogPropTypes2 = _interopRequireDefault(_IDialogPropTypes);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var IDialogPropTypes = (0, _IDialogPropTypes2['default'])();

var uuid = 0;

function noop() {}
function getScroll(w, top) {
  var ret = w['page' + (top ? 'Y' : 'X') + 'Offset'];
  var method = 'scroll' + (top ? 'Top' : 'Left');
  if (typeof ret !== 'number') {
    var d = w.document;
    ret = d.documentElement[method];
    if (typeof ret !== 'number') {
      ret = d.body[method];
    }
  }
  return ret;
}

function setTransformOrigin(node, value) {
  var style = node.style;
  ['Webkit', 'Moz', 'Ms', 'ms'].forEach(function (prefix) {
    style[prefix + 'TransformOrigin'] = value;
  });
  style['transformOrigin'] = value;
}

function offset(el) {
  var rect = el.getBoundingClientRect();
  var pos = {
    left: rect.left,
    top: rect.top
  };
  var doc = el.ownerDocument;
  var w = doc.defaultView || doc.parentWindow;
  pos.left += getScroll(w);
  pos.top += getScroll(w, true);
  return pos;
}

var cacheOverflow = {};

exports['default'] = {
  mixins: [_BaseMixin2['default']],
  props: (0, _propsUtil.initDefaultProps)(IDialogPropTypes, {
    mask: true,
    visible: false,
    keyboard: true,
    closable: true,
    maskClosable: true,
    destroyOnClose: false,
    prefixCls: 'rc-dialog',
    getOpenCount: function getOpenCount() {
      return null;
    },
    focusTriggerAfterClose: true
  }),
  data: function data() {
    return {
      destroyPopup: false
    };
  },
  provide: function provide() {
    return {
      dialogContext: this
    };
  },


  watch: {
    visible: function visible(val) {
      var _this = this;

      if (val) {
        this.destroyPopup = false;
      }
      this.$nextTick(function () {
        _this.updatedCallback(!val);
      });
    }
  },

  beforeMount: function beforeMount() {
    this.inTransition = false;
    this.titleId = 'rcDialogTitle' + uuid++;
  },
  mounted: function mounted() {
    var _this2 = this;

    this.$nextTick(function () {
      _this2.updatedCallback(false);
      // if forceRender is true, set element style display to be none;
      if ((_this2.forceRender || _this2.getContainer === false && !_this2.visible) && _this2.$refs.wrap) {
        _this2.$refs.wrap.style.display = 'none';
      }
    });
  },
  beforeDestroy: function beforeDestroy() {
    var visible = this.visible,
        getOpenCount = this.getOpenCount;

    if ((visible || this.inTransition) && !getOpenCount()) {
      this.switchScrollingEffect();
    }
    clearTimeout(this.timeoutId);
  },

  methods: {
    // 对外暴露的 api 不要更改名称或删除
    getDialogWrap: function getDialogWrap() {
      return this.$refs.wrap;
    },
    updatedCallback: function updatedCallback(visible) {
      var mousePosition = this.mousePosition;
      var mask = this.mask,
          focusTriggerAfterClose = this.focusTriggerAfterClose;

      if (this.visible) {
        // first show
        if (!visible) {
          this.openTime = Date.now();
          // this.lastOutSideFocusNode = document.activeElement
          this.switchScrollingEffect();
          // this.$refs.wrap.focus()
          this.tryFocus();
          var dialogNode = this.$refs.dialog.$el;
          if (mousePosition) {
            var elOffset = offset(dialogNode);
            setTransformOrigin(dialogNode, mousePosition.x - elOffset.left + 'px ' + (mousePosition.y - elOffset.top) + 'px');
          } else {
            setTransformOrigin(dialogNode, '');
          }
        }
      } else if (visible) {
        this.inTransition = true;
        if (mask && this.lastOutSideFocusNode && focusTriggerAfterClose) {
          try {
            this.lastOutSideFocusNode.focus();
          } catch (e) {
            this.lastOutSideFocusNode = null;
          }
          this.lastOutSideFocusNode = null;
        }
      }
    },
    tryFocus: function tryFocus() {
      if (!(0, _contains2['default'])(this.$refs.wrap, document.activeElement)) {
        this.lastOutSideFocusNode = document.activeElement;
        this.$refs.sentinelStart.focus();
      }
    },
    onAnimateLeave: function onAnimateLeave() {
      var afterClose = this.afterClose,
          destroyOnClose = this.destroyOnClose;
      // need demo?
      // https://github.com/react-component/dialog/pull/28

      if (this.$refs.wrap) {
        this.$refs.wrap.style.display = 'none';
      }
      if (destroyOnClose) {
        this.destroyPopup = true;
      }
      this.inTransition = false;
      this.switchScrollingEffect();
      if (afterClose) {
        afterClose();
      }
    },
    onDialogMouseDown: function onDialogMouseDown() {
      this.dialogMouseDown = true;
    },
    onMaskMouseUp: function onMaskMouseUp() {
      var _this3 = this;

      if (this.dialogMouseDown) {
        this.timeoutId = setTimeout(function () {
          _this3.dialogMouseDown = false;
        }, 0);
      }
    },
    onMaskClick: function onMaskClick(e) {
      // android trigger click on open (fastclick??)
      if (Date.now() - this.openTime < 300) {
        return;
      }
      if (e.target === e.currentTarget && !this.dialogMouseDown) {
        this.close(e);
      }
    },
    onKeydown: function onKeydown(e) {
      var props = this.$props;
      if (props.keyboard && e.keyCode === _KeyCode2['default'].ESC) {
        e.stopPropagation();
        this.close(e);
        return;
      }
      // keep focus inside dialog
      if (props.visible) {
        if (e.keyCode === _KeyCode2['default'].TAB) {
          var activeElement = document.activeElement;
          var sentinelStart = this.$refs.sentinelStart;
          if (e.shiftKey) {
            if (activeElement === sentinelStart) {
              this.$refs.sentinelEnd.focus();
            }
          } else if (activeElement === this.$refs.sentinelEnd) {
            sentinelStart.focus();
          }
        }
      }
    },
    getDialogElement: function getDialogElement() {
      var h = this.$createElement;
      var closable = this.closable,
          prefixCls = this.prefixCls,
          width = this.width,
          height = this.height,
          title = this.title,
          tempFooter = this.footer,
          bodyStyle = this.bodyStyle,
          visible = this.visible,
          bodyProps = this.bodyProps,
          forceRender = this.forceRender,
          dialogStyle = this.dialogStyle,
          dialogClass = this.dialogClass;

      var dest = (0, _extends3['default'])({}, dialogStyle);
      if (width !== undefined) {
        dest.width = typeof width === 'number' ? width + 'px' : width;
      }
      if (height !== undefined) {
        dest.height = typeof height === 'number' ? height + 'px' : height;
      }

      var footer = void 0;
      if (tempFooter) {
        footer = h(
          'div',
          { key: 'footer', 'class': prefixCls + '-footer', ref: 'footer' },
          [tempFooter]
        );
      }

      var header = void 0;
      if (title) {
        header = h(
          'div',
          { key: 'header', 'class': prefixCls + '-header', ref: 'header' },
          [h(
            'div',
            { 'class': prefixCls + '-title', attrs: { id: this.titleId }
            },
            [title]
          )]
        );
      }

      var closer = void 0;
      if (closable) {
        var closeIcon = (0, _propsUtil.getComponentFromProp)(this, 'closeIcon');
        closer = h(
          'button',
          {
            attrs: {
              type: 'button',

              'aria-label': 'Close'
            },
            key: 'close',
            on: {
              'click': this.close || noop
            },
            'class': prefixCls + '-close'
          },
          [closeIcon || h('span', { 'class': prefixCls + '-close-x' })]
        );
      }

      var style = dest;
      var sentinelStyle = { width: 0, height: 0, overflow: 'hidden' };
      var cls = (0, _defineProperty3['default'])({}, prefixCls, true);
      var transitionName = this.getTransitionName();
      var dialogElement = h(
        _LazyRenderBox2['default'],
        {
          directives: [{
            name: 'show',
            value: visible
          }],

          key: 'dialog-element',
          attrs: { role: 'document',

            forceRender: forceRender
          },
          ref: 'dialog',
          style: style,
          'class': [cls, dialogClass], on: {
            'mousedown': this.onDialogMouseDown
          }
        },
        [h('div', {
          attrs: { tabIndex: 0, 'aria-hidden': 'true' },
          ref: 'sentinelStart', style: sentinelStyle }), h(
          'div',
          { 'class': prefixCls + '-content' },
          [closer, header, h(
            'div',
            (0, _babelHelperVueJsxMergeProps2['default'])([{ key: 'body', 'class': prefixCls + '-body', style: bodyStyle, ref: 'body' }, bodyProps]),
            [this.$slots['default']]
          ), footer]
        ), h('div', {
          attrs: { tabIndex: 0, 'aria-hidden': 'true' },
          ref: 'sentinelEnd', style: sentinelStyle })]
      );
      var dialogTransitionProps = (0, _getTransitionProps2['default'])(transitionName, {
        afterLeave: this.onAnimateLeave
      });
      return h(
        'transition',
        (0, _babelHelperVueJsxMergeProps2['default'])([{ key: 'dialog' }, dialogTransitionProps]),
        [visible || !this.destroyPopup ? dialogElement : null]
      );
    },
    getZIndexStyle: function getZIndexStyle() {
      var style = {};
      var props = this.$props;
      if (props.zIndex !== undefined) {
        style.zIndex = props.zIndex;
      }
      return style;
    },
    getWrapStyle: function getWrapStyle() {
      return (0, _extends3['default'])({}, this.getZIndexStyle(), this.wrapStyle);
    },
    getMaskStyle: function getMaskStyle() {
      return (0, _extends3['default'])({}, this.getZIndexStyle(), this.maskStyle);
    },
    getMaskElement: function getMaskElement() {
      var h = this.$createElement;

      var props = this.$props;
      var maskElement = void 0;
      if (props.mask) {
        var maskTransition = this.getMaskTransitionName();
        maskElement = h(_LazyRenderBox2['default'], (0, _babelHelperVueJsxMergeProps2['default'])([{
          directives: [{
            name: 'show',
            value: props.visible
          }],

          style: this.getMaskStyle(),
          key: 'mask',
          'class': props.prefixCls + '-mask'
        }, props.maskProps]));
        if (maskTransition) {
          var maskTransitionProps = (0, _getTransitionProps2['default'])(maskTransition);
          maskElement = h(
            'transition',
            (0, _babelHelperVueJsxMergeProps2['default'])([{ key: 'mask' }, maskTransitionProps]),
            [maskElement]
          );
        }
      }
      return maskElement;
    },
    getMaskTransitionName: function getMaskTransitionName() {
      var props = this.$props;
      var transitionName = props.maskTransitionName;
      var animation = props.maskAnimation;
      if (!transitionName && animation) {
        transitionName = props.prefixCls + '-' + animation;
      }
      return transitionName;
    },
    getTransitionName: function getTransitionName() {
      var props = this.$props;
      var transitionName = props.transitionName;
      var animation = props.animation;
      if (!transitionName && animation) {
        transitionName = props.prefixCls + '-' + animation;
      }
      return transitionName;
    },

    // setScrollbar() {
    //   if (this.bodyIsOverflowing && this.scrollbarWidth !== undefined) {
    //     document.body.style.paddingRight = `${this.scrollbarWidth}px`;
    //   }
    // },
    switchScrollingEffect: function switchScrollingEffect() {
      var getOpenCount = this.getOpenCount;

      var openCount = getOpenCount();
      if (openCount === 1) {
        if (cacheOverflow.hasOwnProperty('overflowX')) {
          return;
        }
        cacheOverflow = {
          overflowX: document.body.style.overflowX,
          overflowY: document.body.style.overflowY,
          overflow: document.body.style.overflow
        };
        (0, _switchScrollingEffect3['default'])();
        // Must be set after switchScrollingEffect
        document.body.style.overflow = 'hidden';
      } else if (!openCount) {
        // IE browser doesn't merge overflow style, need to set it separately
        // https://github.com/ant-design/ant-design/issues/19393
        if (cacheOverflow.overflow !== undefined) {
          document.body.style.overflow = cacheOverflow.overflow;
        }
        if (cacheOverflow.overflowX !== undefined) {
          document.body.style.overflowX = cacheOverflow.overflowX;
        }
        if (cacheOverflow.overflowY !== undefined) {
          document.body.style.overflowY = cacheOverflow.overflowY;
        }
        cacheOverflow = {};
        (0, _switchScrollingEffect3['default'])(true);
      }
    },

    // removeScrollingEffect() {
    //   const { getOpenCount } = this;
    //   const openCount = getOpenCount();
    //   if (openCount !== 0) {
    //     return;
    //   }
    //   document.body.style.overflow = '';
    //   switchScrollingEffect(true);
    //   // this.resetAdjustments();
    // },
    close: function close(e) {
      this.__emit('close', e);
    }
  },
  render: function render() {
    var h = arguments[0];
    var prefixCls = this.prefixCls,
        maskClosable = this.maskClosable,
        visible = this.visible,
        wrapClassName = this.wrapClassName,
        title = this.title,
        wrapProps = this.wrapProps;

    var style = this.getWrapStyle();
    // clear hide display
    // and only set display after async anim, not here for hide
    if (visible) {
      style.display = null;
    }
    return h(
      'div',
      { 'class': prefixCls + '-root' },
      [this.getMaskElement(), h(
        'div',
        (0, _babelHelperVueJsxMergeProps2['default'])([{
          attrs: {
            tabIndex: -1,

            role: 'dialog',
            'aria-labelledby': title ? this.titleId : null
          },
          on: {
            'keydown': this.onKeydown,
            'click': maskClosable ? this.onMaskClick : noop,
            'mouseup': maskClosable ? this.onMaskMouseUp : noop
          },

          'class': prefixCls + '-wrap ' + (wrapClassName || ''),
          ref: 'wrap',
          style: style
        }, wrapProps]),
        [this.getDialogElement()]
      )]
    );
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-dialog/DialogWrap.js":
/*!*****************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-dialog/DialogWrap.js ***!
  \*****************************************************************/
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

var _Dialog = __webpack_require__(/*! ./Dialog */ "./node_modules/ant-design-vue/lib/vc-dialog/Dialog.js");

var _Dialog2 = _interopRequireDefault(_Dialog);

var _IDialogPropTypes = __webpack_require__(/*! ./IDialogPropTypes */ "./node_modules/ant-design-vue/lib/vc-dialog/IDialogPropTypes.js");

var _IDialogPropTypes2 = _interopRequireDefault(_IDialogPropTypes);

var _propsUtil = __webpack_require__(/*! ../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

var _PortalWrapper = __webpack_require__(/*! ../_util/PortalWrapper */ "./node_modules/ant-design-vue/lib/_util/PortalWrapper.js");

var _PortalWrapper2 = _interopRequireDefault(_PortalWrapper);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var IDialogPropTypes = (0, _IDialogPropTypes2['default'])();
var DialogWrap = {
  inheritAttrs: false,
  props: (0, _extends3['default'])({}, IDialogPropTypes, {
    visible: IDialogPropTypes.visible.def(false)
  }),

  render: function render() {
    var _this = this;

    var h = arguments[0];
    var _$props = this.$props,
        visible = _$props.visible,
        getContainer = _$props.getContainer,
        forceRender = _$props.forceRender;

    var dialogProps = {
      props: this.$props,
      attrs: this.$attrs,
      ref: '_component',
      key: 'dialog',
      on: (0, _propsUtil.getListeners)(this)
    };
    // 渲染在当前 dom 里；
    if (getContainer === false) {
      return h(
        _Dialog2['default'],
        (0, _babelHelperVueJsxMergeProps2['default'])([dialogProps, {
          attrs: {
            getOpenCount: function getOpenCount() {
              return 2;
            } // 不对 body 做任何操作。。
          }
        }]),
        [this.$slots['default']]
      );
    }
    return h(_PortalWrapper2['default'], {
      attrs: {
        visible: visible,
        forceRender: forceRender,
        getContainer: getContainer,
        children: function children(childProps) {
          dialogProps.props = (0, _extends3['default'])({}, dialogProps.props, childProps);
          return h(
            _Dialog2['default'],
            dialogProps,
            [_this.$slots['default']]
          );
        }
      }
    });
  }
};

exports['default'] = DialogWrap;

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-dialog/IDialogPropTypes.js":
/*!***********************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-dialog/IDialogPropTypes.js ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _vueTypes = __webpack_require__(/*! ../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

function IDialogPropTypes() {
  return {
    keyboard: _vueTypes2['default'].bool,
    mask: _vueTypes2['default'].bool,
    afterClose: _vueTypes2['default'].func,
    // onClose: PropTypes. (e: SyntheticEvent<HTMLDivElement>) =>any,
    closable: _vueTypes2['default'].bool,
    maskClosable: _vueTypes2['default'].bool,
    visible: _vueTypes2['default'].bool,
    destroyOnClose: _vueTypes2['default'].bool,
    mousePosition: _vueTypes2['default'].shape({
      x: _vueTypes2['default'].number,
      y: _vueTypes2['default'].number
    }).loose,
    title: _vueTypes2['default'].any,
    footer: _vueTypes2['default'].any,
    transitionName: _vueTypes2['default'].string,
    maskTransitionName: _vueTypes2['default'].string,
    animation: _vueTypes2['default'].any,
    maskAnimation: _vueTypes2['default'].any,
    wrapStyle: _vueTypes2['default'].object,
    bodyStyle: _vueTypes2['default'].object,
    maskStyle: _vueTypes2['default'].object,
    prefixCls: _vueTypes2['default'].string,
    wrapClassName: _vueTypes2['default'].string,
    width: _vueTypes2['default'].oneOfType([_vueTypes2['default'].string, _vueTypes2['default'].number]),
    height: _vueTypes2['default'].oneOfType([_vueTypes2['default'].string, _vueTypes2['default'].number]),
    zIndex: _vueTypes2['default'].number,
    bodyProps: _vueTypes2['default'].any,
    maskProps: _vueTypes2['default'].any,
    wrapProps: _vueTypes2['default'].any,
    getContainer: _vueTypes2['default'].any,
    dialogStyle: _vueTypes2['default'].object.def(function () {
      return {};
    }),
    dialogClass: _vueTypes2['default'].object.def(''),
    closeIcon: _vueTypes2['default'].any,
    forceRender: _vueTypes2['default'].bool,
    getOpenCount: _vueTypes2['default'].func,
    // https://github.com/ant-design/ant-design/issues/19771
    // https://github.com/react-component/dialog/issues/95
    focusTriggerAfterClose: _vueTypes2['default'].bool
  };
}

exports['default'] = IDialogPropTypes;

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-dialog/LazyRenderBox.js":
/*!********************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-dialog/LazyRenderBox.js ***!
  \********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _vueTypes = __webpack_require__(/*! ../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _propsUtil = __webpack_require__(/*! ../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var ILazyRenderBoxPropTypes = {
  visible: _vueTypes2['default'].bool,
  hiddenClassName: _vueTypes2['default'].string,
  forceRender: _vueTypes2['default'].bool
};

exports['default'] = {
  props: ILazyRenderBoxPropTypes,
  render: function render() {
    var h = arguments[0];

    return h(
      'div',
      { on: (0, _propsUtil.getListeners)(this) },
      [this.$slots['default']]
    );
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-dialog/index.js":
/*!************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-dialog/index.js ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _DialogWrap = __webpack_require__(/*! ./DialogWrap */ "./node_modules/ant-design-vue/lib/vc-dialog/DialogWrap.js");

var _DialogWrap2 = _interopRequireDefault(_DialogWrap);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports['default'] = _DialogWrap2['default']; // based on vc-dialog 7.5.14

/***/ })

}]);