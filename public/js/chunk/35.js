(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[35],{

/***/ "./node_modules/ant-design-vue/lib/drawer/index.js":
/*!*********************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/drawer/index.js ***!
  \*********************************************************/
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

var _classnames2 = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");

var _classnames3 = _interopRequireDefault(_classnames2);

var _src = __webpack_require__(/*! ../vc-drawer/src */ "./node_modules/ant-design-vue/lib/vc-drawer/src/index.js");

var _src2 = _interopRequireDefault(_src);

var _vueTypes = __webpack_require__(/*! ../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _BaseMixin = __webpack_require__(/*! ../_util/BaseMixin */ "./node_modules/ant-design-vue/lib/_util/BaseMixin.js");

var _BaseMixin2 = _interopRequireDefault(_BaseMixin);

var _icon = __webpack_require__(/*! ../icon */ "./node_modules/ant-design-vue/lib/icon/index.js");

var _icon2 = _interopRequireDefault(_icon);

var _propsUtil = __webpack_require__(/*! ../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var Drawer = {
  name: 'ADrawer',
  props: {
    closable: _vueTypes2['default'].bool.def(true),
    destroyOnClose: _vueTypes2['default'].bool,
    getContainer: _vueTypes2['default'].any,
    maskClosable: _vueTypes2['default'].bool.def(true),
    mask: _vueTypes2['default'].bool.def(true),
    maskStyle: _vueTypes2['default'].object,
    wrapStyle: _vueTypes2['default'].object,
    title: _vueTypes2['default'].any,
    visible: _vueTypes2['default'].bool,
    width: _vueTypes2['default'].oneOfType([_vueTypes2['default'].string, _vueTypes2['default'].number]).def(256),
    height: _vueTypes2['default'].oneOfType([_vueTypes2['default'].string, _vueTypes2['default'].number]).def(256),
    zIndex: _vueTypes2['default'].number,
    prefixCls: _vueTypes2['default'].string.def('ant-drawer'),
    placement: _vueTypes2['default'].oneOf(['top', 'right', 'bottom', 'left']).def('right'),
    level: _vueTypes2['default'].any.def(null),
    wrapClassName: _vueTypes2['default'].string, // not use class like react, vue will add class to root dom
    handle: _vueTypes2['default'].any
  },
  mixins: [_BaseMixin2['default']],
  data: function data() {
    this.destoryClose = false;
    this.preVisible = this.$props.visible;
    return {
      _push: false
    };
  },

  inject: {
    parentDrawer: {
      'default': function _default() {
        return null;
      }
    }
  },
  provide: function provide() {
    return {
      parentDrawer: this
    };
  },
  updated: function updated() {
    var _this = this;

    this.$nextTick(function () {
      if (_this.preVisible !== _this.visible && _this.parentDrawer) {
        if (_this.visible) {
          _this.parentDrawer.push();
        } else {
          _this.parentDrawer.pull();
        }
      }
      _this.preVisible = _this.visible;
    });
  },

  methods: {
    close: function close(e) {
      if (this.visible !== undefined) {
        this.$emit('close', e);
        return;
      }
    },
    onMaskClick: function onMaskClick(e) {
      if (!this.maskClosable) {
        return;
      }
      this.close(e);
    },
    push: function push() {
      this.setState({
        _push: true
      });
    },
    pull: function pull() {
      this.setState({
        _push: false
      });
    },
    onDestoryTransitionEnd: function onDestoryTransitionEnd() {
      var isDestroyOnClose = this.getDestoryOnClose();
      if (!isDestroyOnClose) {
        return;
      }
      if (!this.visible) {
        this.destoryClose = true;
        this.$forceUpdate();
      }
    },
    getDestoryOnClose: function getDestoryOnClose() {
      return this.destroyOnClose && !this.visible;
    },

    // get drawar push width or height
    getPushTransform: function getPushTransform(placement) {
      if (placement === 'left' || placement === 'right') {
        return 'translateX(' + (placement === 'left' ? 180 : -180) + 'px)';
      }
      if (placement === 'top' || placement === 'bottom') {
        return 'translateY(' + (placement === 'top' ? 180 : -180) + 'px)';
      }
    },

    // render drawer body dom
    renderBody: function renderBody() {
      var h = this.$createElement;

      if (this.destoryClose && !this.visible) {
        return null;
      }
      this.destoryClose = false;
      var placement = this.$props.placement;


      var containerStyle = placement === 'left' || placement === 'right' ? {
        overflow: 'auto',
        height: '100%'
      } : {};

      var isDestroyOnClose = this.getDestoryOnClose();
      if (isDestroyOnClose) {
        // Increase the opacity transition, delete children after closing.
        containerStyle.opacity = 0;
        containerStyle.transition = 'opacity .3s';
      }
      var _$props = this.$props,
          prefixCls = _$props.prefixCls,
          closable = _$props.closable;

      var title = (0, _propsUtil.getComponentFromProp)(this, 'title');
      // is have header dom
      var header = void 0;
      if (title) {
        header = h(
          'div',
          { key: 'header', 'class': prefixCls + '-header' },
          [h(
            'div',
            { 'class': prefixCls + '-title' },
            [title]
          )]
        );
      }
      // is have closer button
      var closer = void 0;
      if (closable) {
        closer = h(
          'button',
          { key: 'closer', on: {
              'click': this.close
            },
            attrs: { 'aria-label': 'Close' },
            'class': prefixCls + '-close' },
          [h(
            'span',
            { 'class': prefixCls + '-close-x' },
            [h(_icon2['default'], {
              attrs: { type: 'close' }
            })]
          )]
        );
      }

      return h(
        'div',
        {
          'class': prefixCls + '-wrapper-body',
          style: containerStyle,
          on: {
            'transitionend': this.onDestoryTransitionEnd
          }
        },
        [header, closer, h(
          'div',
          { key: 'body', 'class': prefixCls + '-body' },
          [this.$slots['default']]
        )]
      );
    },
    getRcDrawerStyle: function getRcDrawerStyle() {
      var _$props2 = this.$props,
          zIndex = _$props2.zIndex,
          placement = _$props2.placement,
          maskStyle = _$props2.maskStyle,
          wrapStyle = _$props2.wrapStyle;
      var push = this.$data._push;

      return (0, _extends3['default'])({}, maskStyle, {
        zIndex: zIndex,
        transform: push ? this.getPushTransform(placement) : undefined
      }, wrapStyle);
    }
  },
  render: function render() {
    var _classnames;

    var h = arguments[0];

    var props = (0, _propsUtil.getOptionProps)(this);
    var width = props.width,
        height = props.height,
        visible = props.visible,
        placement = props.placement,
        wrapClassName = props.wrapClassName,
        rest = (0, _objectWithoutProperties3['default'])(props, ['width', 'height', 'visible', 'placement', 'wrapClassName']);

    var haveMask = rest.mask ? '' : 'no-mask';
    var offsetStyle = {};
    if (placement === 'left' || placement === 'right') {
      offsetStyle.width = typeof width === 'number' ? width + 'px' : width;
    } else {
      offsetStyle.height = typeof height === 'number' ? height + 'px' : height;
    }
    var handler = (0, _propsUtil.getComponentFromProp)(this, 'handle') || false;
    var vcDrawerProps = {
      props: (0, _extends3['default'])({}, rest, {
        handler: handler
      }, offsetStyle, {
        open: visible,
        showMask: props.mask,
        placement: placement,
        className: (0, _classnames3['default'])((_classnames = {}, (0, _defineProperty3['default'])(_classnames, wrapClassName, !!wrapClassName), (0, _defineProperty3['default'])(_classnames, haveMask, !!haveMask), _classnames)),
        wrapStyle: this.getRcDrawerStyle()
      }),
      on: (0, _extends3['default'])({
        maskClick: this.onMaskClick
      }, this.$listeners)
    };
    return h(
      _src2['default'],
      vcDrawerProps,
      [this.renderBody()]
    );
  }
};

/* istanbul ignore next */
Drawer.install = function (Vue) {
  Vue.component(Drawer.name, Drawer);
};

exports['default'] = Drawer;

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-drawer/src/Drawer.js":
/*!*****************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-drawer/src/Drawer.js ***!
  \*****************************************************************/
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

var _typeof2 = __webpack_require__(/*! babel-runtime/helpers/typeof */ "./node_modules/babel-runtime/helpers/typeof.js");

var _typeof3 = _interopRequireDefault(_typeof2);

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _classnames2 = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");

var _classnames3 = _interopRequireDefault(_classnames2);

var _vue = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.common.js");

var _vue2 = _interopRequireDefault(_vue);

var _vueRef = __webpack_require__(/*! vue-ref */ "./node_modules/vue-ref/index.js");

var _vueRef2 = _interopRequireDefault(_vueRef);

var _BaseMixin = __webpack_require__(/*! ../../_util/BaseMixin */ "./node_modules/ant-design-vue/lib/_util/BaseMixin.js");

var _BaseMixin2 = _interopRequireDefault(_BaseMixin);

var _propsUtil = __webpack_require__(/*! ../../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

var _vnode = __webpack_require__(/*! ../../_util/vnode */ "./node_modules/ant-design-vue/lib/_util/vnode.js");

var _ContainerRender = __webpack_require__(/*! ../../_util/ContainerRender */ "./node_modules/ant-design-vue/lib/_util/ContainerRender.js");

var _ContainerRender2 = _interopRequireDefault(_ContainerRender);

var _getScrollBarSize = __webpack_require__(/*! ../../_util/getScrollBarSize */ "./node_modules/ant-design-vue/lib/_util/getScrollBarSize.js");

var _getScrollBarSize2 = _interopRequireDefault(_getScrollBarSize);

var _drawerProps = __webpack_require__(/*! ./drawerProps */ "./node_modules/ant-design-vue/lib/vc-drawer/src/drawerProps.js");

var _drawerProps2 = _interopRequireDefault(_drawerProps);

var _utils = __webpack_require__(/*! ./utils */ "./node_modules/ant-design-vue/lib/vc-drawer/src/utils.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

function noop() {}

var currentDrawer = {};
var windowIsUndefined = !(typeof window !== 'undefined' && window.document && window.document.createElement);

_vue2['default'].use(_vueRef2['default'], { name: 'ant-ref' });
var Drawer = {
  mixins: [_BaseMixin2['default']],
  props: (0, _propsUtil.initDefaultProps)(_drawerProps2['default'], {
    prefixCls: 'drawer',
    placement: 'left',
    getContainer: 'body',
    level: 'all',
    duration: '.3s',
    ease: 'cubic-bezier(0.78, 0.14, 0.15, 0.86)',
    firstEnter: false, // 记录首次进入.
    showMask: true,
    handler: true,
    maskStyle: {},
    wrapperClassName: '',
    className: ''
  }),
  data: function data() {
    this.levelDom = [];
    this.contentDom = null;
    this.maskDom = null;
    this.handlerdom = null;
    this.mousePos = null;
    this.sFirstEnter = this.firstEnter;
    this.timeout = null;
    this.children = null;
    this.drawerId = Number((Date.now() + Math.random()).toString().replace('.', Math.round(Math.random() * 9))).toString(16);
    var open = this.open !== undefined ? this.open : !!this.defaultOpen;
    currentDrawer[this.drawerId] = open;
    this.orignalOpen = this.open;
    this.preProps = (0, _extends3['default'])({}, this.$props);
    return {
      sOpen: open
    };
  },
  mounted: function mounted() {
    var _this = this;

    this.$nextTick(function () {
      if (!windowIsUndefined) {
        var passiveSupported = false;
        window.addEventListener('test', null, Object.defineProperty({}, 'passive', {
          get: function get() {
            passiveSupported = true;
            return null;
          }
        }));
        _this.passive = passiveSupported ? { passive: false } : false;
      }
      var open = _this.getOpen();
      if (_this.handler || open || _this.sFirstEnter) {
        _this.getDefault(_this.$props);
        if (open) {
          _this.isOpenChange = true;
        }
        _this.$forceUpdate();
      }
    });
  },

  watch: {
    open: function (_open) {
      function open(_x) {
        return _open.apply(this, arguments);
      }

      open.toString = function () {
        return _open.toString();
      };

      return open;
    }(function (val) {
      if (val !== undefined && val !== this.preProps.open) {
        this.isOpenChange = true;
        // 没渲染 dom 时，获取默认数据;
        if (!this.container) {
          this.getDefault(this.$props);
        }
        this.setState({
          sOpen: open
        });
      }
      this.preProps.open = val;
    }),
    placement: function placement(val) {
      if (val !== this.preProps.placement) {
        // test 的 bug, 有动画过场，删除 dom
        this.contentDom = null;
      }
      this.preProps.placement = val;
    },
    level: function level(val) {
      if (this.preProps.level !== val) {
        this.getParentAndLevelDom(this.$props);
      }
      this.preProps.level = val;
    }
  },
  updated: function updated() {
    var _this2 = this;

    this.$nextTick(function () {
      // dom 没渲染时，重走一遍。
      if (!_this2.sFirstEnter && _this2.container) {
        _this2.$forceUpdate();
        _this2.sFirstEnter = true;
      }
    });
  },
  beforeDestroy: function beforeDestroy() {
    delete currentDrawer[this.drawerId];
    delete this.isOpenChange;
    if (this.container) {
      if (this.sOpen) {
        this.setLevelDomTransform(false, true);
      }
      document.body.style.overflow = '';
      // 拦不住。。直接删除；
      if (this.getSelfContainer) {
        this.container.parentNode.removeChild(this.container);
      }
    }
    this.sFirstEnter = false;
    clearTimeout(this.timeout);
    // 需要 didmount 后也会渲染，直接 unmount 将不会渲染，加上判断.
    if (this.renderComponent) {
      this.renderComponent({
        afterClose: this.removeContainer,
        onClose: function onClose() {},

        visible: false
      });
    }
  },

  methods: {
    onMaskTouchEnd: function onMaskTouchEnd(e) {
      this.$emit('maskClick', e);
      this.onTouchEnd(e, true);
    },
    onIconTouchEnd: function onIconTouchEnd(e) {
      this.$emit('handleClick', e);
      this.onTouchEnd(e);
    },
    onTouchEnd: function onTouchEnd(e, close) {
      if (this.open !== undefined) {
        return;
      }
      var open = close || this.sOpen;
      this.isOpenChange = true;
      this.setState({
        sOpen: !open
      });
    },
    onWrapperTransitionEnd: function onWrapperTransitionEnd(e) {
      if (e.target === this.contentWrapper) {
        this.dom.style.transition = '';
        if (!this.sOpen && this.getCurrentDrawerSome()) {
          document.body.style.overflowX = '';
          if (this.maskDom) {
            this.maskDom.style.left = '';
            this.maskDom.style.width = '';
          }
        }
      }
    },
    getDefault: function getDefault(props) {
      this.getParentAndLevelDom(props);
      if (props.getContainer || props.parent) {
        this.container = this.defaultGetContainer();
      }
    },
    getCurrentDrawerSome: function getCurrentDrawerSome() {
      return !Object.keys(currentDrawer).some(function (key) {
        return currentDrawer[key];
      });
    },
    getSelfContainer: function getSelfContainer() {
      return this.container;
    },
    getParentAndLevelDom: function getParentAndLevelDom(props) {
      var _this3 = this;

      if (windowIsUndefined) {
        return;
      }
      var level = props.level,
          getContainer = props.getContainer;

      this.levelDom = [];
      if (getContainer) {
        if (typeof getContainer === 'string') {
          var dom = document.querySelectorAll(getContainer)[0];
          this.parent = dom;
        }
        if (typeof getContainer === 'function') {
          this.parent = getContainer();
        }
        if ((typeof getContainer === 'undefined' ? 'undefined' : (0, _typeof3['default'])(getContainer)) === 'object' && getContainer instanceof window.HTMLElement) {
          this.parent = getContainer;
        }
      }
      if (!getContainer && this.container) {
        this.parent = this.container.parentNode;
      }
      if (level === 'all') {
        var children = Array.prototype.slice.call(this.parent.children);
        children.forEach(function (child) {
          if (child.nodeName !== 'SCRIPT' && child.nodeName !== 'STYLE' && child.nodeName !== 'LINK' && child !== _this3.container) {
            _this3.levelDom.push(child);
          }
        });
      } else if (level) {
        (0, _utils.dataToArray)(level).forEach(function (key) {
          document.querySelectorAll(key).forEach(function (item) {
            _this3.levelDom.push(item);
          });
        });
      }
    },
    setLevelDomTransform: function setLevelDomTransform(open, openTransition, placementName, value) {
      var _this4 = this;

      var _$props = this.$props,
          placement = _$props.placement,
          levelMove = _$props.levelMove,
          duration = _$props.duration,
          ease = _$props.ease,
          getContainer = _$props.getContainer;

      if (!windowIsUndefined) {
        this.levelDom.forEach(function (dom) {
          if (_this4.isOpenChange || openTransition) {
            /* eslint no-param-reassign: "error" */
            dom.style.transition = 'transform ' + duration + ' ' + ease;
            (0, _utils.addEventListener)(dom, _utils.transitionEnd, _this4.trnasitionEnd);
            var levelValue = open ? value : 0;
            if (levelMove) {
              var $levelMove = (0, _utils.transformArguments)(levelMove, { target: dom, open: open });
              levelValue = open ? $levelMove[0] : $levelMove[1] || 0;
            }
            var $value = typeof levelValue === 'number' ? levelValue + 'px' : levelValue;
            var placementPos = placement === 'left' || placement === 'top' ? $value : '-' + $value;
            dom.style.transform = levelValue ? placementName + '(' + placementPos + ')' : '';
            dom.style.msTransform = levelValue ? placementName + '(' + placementPos + ')' : '';
          }
        });
        // 处理 body 滚动
        if (getContainer === 'body') {
          var eventArray = ['touchstart'];
          var domArray = [document.body, this.maskDom, this.handlerdom, this.contentDom];
          var right = document.body.scrollHeight > (window.innerHeight || document.documentElement.clientHeight) && window.innerWidth > document.body.offsetWidth ? (0, _getScrollBarSize2['default'])(1) : 0;
          var widthTransition = 'width ' + duration + ' ' + ease;
          var trannsformTransition = 'transform ' + duration + ' ' + ease;
          if (open && document.body.style.overflow !== 'hidden') {
            document.body.style.overflow = 'hidden';
            if (right) {
              document.body.style.position = 'relative';
              document.body.style.width = 'calc(100% - ' + right + 'px)';
              this.dom.style.transition = 'none';
              switch (placement) {
                case 'right':
                  this.dom.style.transform = 'translateX(-' + right + 'px)';
                  this.dom.style.msTransform = 'translateX(-' + right + 'px)';
                  break;
                case 'top':
                case 'bottom':
                  this.dom.style.width = 'calc(100% - ' + right + 'px)';
                  this.dom.style.transform = 'translateZ(0)';
                  break;
                default:
                  break;
              }
              clearTimeout(this.timeout);
              this.timeout = setTimeout(function () {
                _this4.dom.style.transition = trannsformTransition + ',' + widthTransition;
                _this4.dom.style.width = '';
                _this4.dom.style.transform = '';
                _this4.dom.style.msTransform = '';
              });
            }
            // 手机禁滚
            domArray.forEach(function (item, i) {
              if (!item) {
                return;
              }
              (0, _utils.addEventListener)(item, eventArray[i] || 'touchmove', i ? _this4.removeMoveHandler : _this4.removeStartHandler, _this4.passive);
            });
          } else if (this.getCurrentDrawerSome()) {
            document.body.style.overflow = '';
            if ((this.isOpenChange || openTransition) && right) {
              document.body.style.position = '';
              document.body.style.width = '';
              if (_utils.transitionStr) {
                document.body.style.overflowX = 'hidden';
              }
              this.dom.style.transition = 'none';
              var heightTransition = void 0;
              switch (placement) {
                case 'right':
                  {
                    this.dom.style.transform = 'translateX(' + right + 'px)';
                    this.dom.style.msTransform = 'translateX(' + right + 'px)';
                    this.dom.style.width = '100%';
                    widthTransition = 'width 0s ' + ease + ' ' + duration;
                    if (this.maskDom) {
                      this.maskDom.style.left = '-' + right + 'px';
                      this.maskDom.style.width = 'calc(100% + ' + right + 'px)';
                    }
                    break;
                  }
                case 'top':
                case 'bottom':
                  {
                    this.dom.style.width = 'calc(100% + ' + right + 'px)';
                    this.dom.style.height = '100%';
                    this.dom.style.transform = 'translateZ(0)';
                    heightTransition = 'height 0s ' + ease + ' ' + duration;
                    break;
                  }
                default:
                  break;
              }
              clearTimeout(this.timeout);
              this.timeout = setTimeout(function () {
                _this4.dom.style.transition = trannsformTransition + ',' + (heightTransition ? heightTransition + ',' : '') + widthTransition;
                _this4.dom.style.transform = '';
                _this4.dom.style.msTransform = '';
                _this4.dom.style.width = '';
                _this4.dom.style.height = '';
              });
            }
            domArray.forEach(function (item, i) {
              if (!item) {
                return;
              }
              (0, _utils.removeEventListener)(item, eventArray[i] || 'touchmove', i ? _this4.removeMoveHandler : _this4.removeStartHandler, _this4.passive);
            });
          }
        }
      }
      var change = this.$listeners.change;

      if (change && this.isOpenChange && this.sFirstEnter) {
        change(open);
        this.isOpenChange = false;
      }
    },
    getChildToRender: function getChildToRender(open) {
      var _classnames,
          _this5 = this;

      var h = this.$createElement;
      var _$props2 = this.$props,
          className = _$props2.className,
          prefixCls = _$props2.prefixCls,
          placement = _$props2.placement,
          handler = _$props2.handler,
          showMask = _$props2.showMask,
          maskStyle = _$props2.maskStyle,
          width = _$props2.width,
          height = _$props2.height,
          wrapStyle = _$props2.wrapStyle;

      var children = this.$slots['default'];
      var wrapperClassname = (0, _classnames3['default'])(prefixCls, (_classnames = {}, (0, _defineProperty3['default'])(_classnames, prefixCls + '-' + placement, true), (0, _defineProperty3['default'])(_classnames, prefixCls + '-open', open), (0, _defineProperty3['default'])(_classnames, className, !!className), _classnames));
      var isOpenChange = this.isOpenChange;
      var isHorizontal = placement === 'left' || placement === 'right';
      var placementName = 'translate' + (isHorizontal ? 'X' : 'Y');
      // 百分比与像素动画不同步，第一次打用后全用像素动画。
      // const defaultValue = !this.contentDom || !level ? '100%' : `${value}px`;
      var placementPos = placement === 'left' || placement === 'top' ? '-100%' : '100%';
      var transform = open ? '' : placementName + '(' + placementPos + ')';
      if (isOpenChange === undefined || isOpenChange) {
        var contentValue = this.contentDom ? this.contentDom.getBoundingClientRect()[isHorizontal ? 'width' : 'height'] : 0;
        var value = (isHorizontal ? width : height) || contentValue;
        this.setLevelDomTransform(open, false, placementName, value);
      }
      var handlerChildren = void 0;
      if (handler !== false) {
        var handlerDefalut = h(
          'div',
          { 'class': 'drawer-handle' },
          [h('i', { 'class': 'drawer-handle-icon' })]
        );
        var handlerSlot = this.handler;

        var handlerSlotVnode = handlerSlot && handlerSlot[0] || handlerDefalut;

        var _getEvents = (0, _propsUtil.getEvents)(handlerSlotVnode),
            handleIconClick = _getEvents.click;

        handlerChildren = (0, _vnode.cloneElement)(handlerSlotVnode, {
          on: {
            click: function click(e) {
              handleIconClick && handleIconClick();
              _this5.onIconTouchEnd(e);
            }
          },
          directives: [{
            name: 'ant-ref',
            value: function value(c) {
              _this5.handlerdom = c;
            }
          }]
        });
      }

      var domContProps = {
        'class': wrapperClassname,
        directives: [{
          name: 'ant-ref',
          value: function value(c) {
            _this5.dom = c;
          }
        }],
        on: {
          transitionend: this.onWrapperTransitionEnd
        },
        style: wrapStyle
      };
      var directivesMaskDom = [{
        name: 'ant-ref',
        value: function value(c) {
          _this5.maskDom = c;
        }
      }];
      var directivesContentWrapper = [{
        name: 'ant-ref',
        value: function value(c) {
          _this5.contentWrapper = c;
        }
      }];
      var directivesContentDom = [{
        name: 'ant-ref',
        value: function value(c) {
          _this5.contentDom = c;
        }
      }];
      return h(
        'div',
        domContProps,
        [showMask && h('div', (0, _babelHelperVueJsxMergeProps2['default'])([{
          'class': prefixCls + '-mask',
          on: {
            'click': this.onMaskTouchEnd
          },

          style: maskStyle
        }, { directives: directivesMaskDom }])), h(
          'div',
          (0, _babelHelperVueJsxMergeProps2['default'])([{
            'class': prefixCls + '-content-wrapper',
            style: {
              transform: transform,
              msTransform: transform,
              width: (0, _utils.isNumeric)(width) ? width + 'px' : width,
              height: (0, _utils.isNumeric)(height) ? height + 'px' : height
            }
          }, { directives: directivesContentWrapper }]),
          [h(
            'div',
            (0, _babelHelperVueJsxMergeProps2['default'])([{
              'class': prefixCls + '-content'
            }, { directives: directivesContentDom }, {
              on: {
                'touchstart': open ? this.removeStartHandler : noop,
                'touchmove': open ? this.removeMoveHandler : noop
              }
            }]),
            [children]
          ), handlerChildren]
        )]
      );
    },
    getOpen: function getOpen() {
      return this.open !== undefined ? this.open : this.sOpen;
    },
    getTouchParentScroll: function getTouchParentScroll(root, currentTarget, differX, differY) {
      if (!currentTarget || currentTarget === document) {
        return false;
      }
      // root 为 drawer-content 设定了 overflow, 判断为 root 的 parent 时结束滚动；
      if (currentTarget === root.parentNode) {
        return true;
      }

      var isY = Math.max(Math.abs(differX), Math.abs(differY)) === Math.abs(differY);
      var isX = Math.max(Math.abs(differX), Math.abs(differY)) === Math.abs(differX);

      var scrollY = currentTarget.scrollHeight - currentTarget.clientHeight;
      var scrollX = currentTarget.scrollWidth - currentTarget.clientWidth;
      /**
       * <div style="height: 300px">
       *   <div style="height: 900px"></div>
       * </div>
       * 在没设定 overflow: auto 或 scroll 时，currentTarget 里获取不到 scrollTop 或 scrollLeft,
       * 预先用 scrollTo 来滚动，如果取出的值跟滚动前取出不同，则 currnetTarget 被设定了 overflow; 否则就是上面这种。
       */
      var t = currentTarget.scrollTop;
      var l = currentTarget.scrollLeft;
      if (currentTarget.scrollTo) {
        currentTarget.scrollTo(currentTarget.scrollLeft + 1, currentTarget.scrollTop + 1);
      }
      var currentT = currentTarget.scrollTop;
      var currentL = currentTarget.scrollLeft;
      if (currentTarget.scrollTo) {
        currentTarget.scrollTo(currentTarget.scrollLeft - 1, currentTarget.scrollTop - 1);
      }
      if (isY && (!scrollY || !(currentT - t) || scrollY && (currentTarget.scrollTop >= scrollY && differY < 0 || currentTarget.scrollTop <= 0 && differY > 0)) || isX && (!scrollX || !(currentL - l) || scrollX && (currentTarget.scrollLeft >= scrollX && differX < 0 || currentTarget.scrollLeft <= 0 && differX > 0))) {
        return this.getTouchParentScroll(root, currentTarget.parentNode, differX, differY);
      }
      return false;
    },
    removeStartHandler: function removeStartHandler(e) {
      if (e.touches.length > 1) {
        return;
      }
      this.startPos = {
        x: e.touches[0].clientX,
        y: e.touches[0].clientY
      };
    },
    removeMoveHandler: function removeMoveHandler(e) {
      if (e.changedTouches.length > 1) {
        return;
      }
      var currentTarget = e.currentTarget;
      var differX = e.changedTouches[0].clientX - this.startPos.x;
      var differY = e.changedTouches[0].clientY - this.startPos.y;
      if (currentTarget === this.maskDom || currentTarget === this.handlerdom || currentTarget === this.contentDom && this.getTouchParentScroll(currentTarget, e.target, differX, differY)) {
        e.preventDefault();
      }
    },
    trnasitionEnd: function trnasitionEnd(e) {
      (0, _utils.removeEventListener)(e.target, _utils.transitionEnd, this.trnasitionEnd);
      e.target.style.transition = '';
    },
    defaultGetContainer: function defaultGetContainer() {
      if (windowIsUndefined) {
        return null;
      }
      var container = document.createElement('div');
      this.parent.appendChild(container);
      if (this.wrapperClassName) {
        container.className = this.wrapperClassName;
      }
      return container;
    }
  },

  render: function render() {
    var _this6 = this;

    var h = arguments[0];
    var _$props3 = this.$props,
        getContainer = _$props3.getContainer,
        wrapperClassName = _$props3.wrapperClassName;

    var open = this.getOpen();
    currentDrawer[this.drawerId] = open ? this.container : open;
    var children = this.getChildToRender(this.sFirstEnter ? open : false);
    if (!getContainer) {
      var directives = [{
        name: 'ant-ref',
        value: function value(c) {
          _this6.container = c;
        }
      }];
      return h(
        'div',
        (0, _babelHelperVueJsxMergeProps2['default'])([{ 'class': wrapperClassName }, { directives: directives }]),
        [children]
      );
    }
    if (!this.container || !open && !this.sFirstEnter) {
      return null;
    }
    return h(_ContainerRender2['default'], {
      attrs: {
        parent: this,
        visible: true,
        autoMount: true,
        autoDestroy: false,
        getComponent: function getComponent() {
          return children;
        },
        getContainer: this.getSelfContainer,
        children: function children(_ref) {
          var renderComponent = _ref.renderComponent,
              removeContainer = _ref.removeContainer;

          _this6.renderComponent = renderComponent;
          _this6.removeContainer = removeContainer;
          return null;
        }
      }
    });
  }
};

exports['default'] = Drawer;

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-drawer/src/drawerProps.js":
/*!**********************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-drawer/src/drawerProps.js ***!
  \**********************************************************************/
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
  wrapperClassName: _vueTypes2['default'].string,
  width: _vueTypes2['default'].any,
  height: _vueTypes2['default'].any,
  defaultOpen: _vueTypes2['default'].bool,
  firstEnter: _vueTypes2['default'].bool,
  open: _vueTypes2['default'].bool,
  prefixCls: _vueTypes2['default'].string,
  placement: _vueTypes2['default'].string,
  level: _vueTypes2['default'].oneOfType([_vueTypes2['default'].string, _vueTypes2['default'].array]),
  levelMove: _vueTypes2['default'].oneOfType([_vueTypes2['default'].number, _vueTypes2['default'].func, _vueTypes2['default'].array]),
  ease: _vueTypes2['default'].string,
  duration: _vueTypes2['default'].string,
  getContainer: _vueTypes2['default'].oneOfType([_vueTypes2['default'].string, _vueTypes2['default'].func, _vueTypes2['default'].object, _vueTypes2['default'].bool]),
  handler: _vueTypes2['default'].any,
  showMask: _vueTypes2['default'].bool,
  maskStyle: _vueTypes2['default'].object,
  className: _vueTypes2['default'].string,
  wrapStyle: _vueTypes2['default'].object
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-drawer/src/index.js":
/*!****************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-drawer/src/index.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _Drawer = __webpack_require__(/*! ./Drawer */ "./node_modules/ant-design-vue/lib/vc-drawer/src/Drawer.js");

var _Drawer2 = _interopRequireDefault(_Drawer);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports['default'] = _Drawer2['default']; // base in 1.7.7
// export this package's api

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-drawer/src/utils.js":
/*!****************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-drawer/src/utils.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.dataToArray = dataToArray;
exports.addEventListener = addEventListener;
exports.removeEventListener = removeEventListener;
exports.transformArguments = transformArguments;
function dataToArray(vars) {
  if (Array.isArray(vars)) {
    return vars;
  }
  return [vars];
}
var transitionEndObject = {
  transition: 'transitionend',
  WebkitTransition: 'webkitTransitionEnd',
  MozTransition: 'transitionend',
  OTransition: 'oTransitionEnd otransitionend'
};
var transitionStr = exports.transitionStr = Object.keys(transitionEndObject).filter(function (key) {
  if (typeof document === 'undefined') {
    return false;
  }
  var html = document.getElementsByTagName('html')[0];
  return key in (html ? html.style : {});
})[0];
var transitionEnd = exports.transitionEnd = transitionEndObject[transitionStr];

function addEventListener(target, eventType, callback, options) {
  if (target.addEventListener) {
    target.addEventListener(eventType, callback, options);
  } else if (target.attachEvent) {
    target.attachEvent('on' + eventType, callback);
  }
}

function removeEventListener(target, eventType, callback, options) {
  if (target.removeEventListener) {
    target.removeEventListener(eventType, callback, options);
  } else if (target.attachEvent) {
    target.detachEvent('on' + eventType, callback);
  }
}

function transformArguments(arg, cb) {
  var result = void 0;
  if (typeof arg === 'function') {
    result = arg(cb);
  } else {
    result = arg;
  }
  if (Array.isArray(result)) {
    if (result.length === 2) {
      return result;
    }
    return [result[0], result[1]];
  }
  return [result];
}

var isNumeric = exports.isNumeric = function isNumeric(value) {
  return !isNaN(parseFloat(value)) && isFinite(value); // eslint-disable-line
};

/***/ })

}]);