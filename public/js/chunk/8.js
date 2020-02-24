(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[8],{

/***/ "./node_modules/ant-design-vue/lib/carousel/index.js":
/*!***********************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/carousel/index.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.CarouselProps = exports.CarouselEffect = undefined;

var _babelHelperVueJsxMergeProps = __webpack_require__(/*! babel-helper-vue-jsx-merge-props */ "./node_modules/babel-helper-vue-jsx-merge-props/index.js");

var _babelHelperVueJsxMergeProps2 = _interopRequireDefault(_babelHelperVueJsxMergeProps);

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _vueTypes = __webpack_require__(/*! ../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _debounce = __webpack_require__(/*! lodash/debounce */ "./node_modules/lodash/debounce.js");

var _debounce2 = _interopRequireDefault(_debounce);

var _propsUtil = __webpack_require__(/*! ../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

var _configProvider = __webpack_require__(/*! ../config-provider */ "./node_modules/ant-design-vue/lib/config-provider/index.js");

var _base = __webpack_require__(/*! ../base */ "./node_modules/ant-design-vue/lib/base/index.js");

var _base2 = _interopRequireDefault(_base);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

// matchMedia polyfill for
// https://github.com/WickyNilliams/enquire.js/issues/82
if (typeof window !== 'undefined') {
  var matchMediaPolyfill = function matchMediaPolyfill(mediaQuery) {
    return {
      media: mediaQuery,
      matches: false,
      addListener: function addListener() {},
      removeListener: function removeListener() {}
    };
  };
  window.matchMedia = window.matchMedia || matchMediaPolyfill;
}
// Use require over import (will be lifted up)
// make sure matchMedia polyfill run before require('vc-slick')
// Fix https://github.com/ant-design/ant-design/issues/6560
// Fix https://github.com/ant-design/ant-design/issues/3308
var SlickCarousel = __webpack_require__(/*! ../vc-slick/src */ "./node_modules/ant-design-vue/lib/vc-slick/src/index.js")['default'];

var CarouselEffect = exports.CarouselEffect = _vueTypes2['default'].oneOf(['scrollx', 'fade']);
// Carousel
var CarouselProps = exports.CarouselProps = {
  effect: CarouselEffect,
  dots: _vueTypes2['default'].bool,
  vertical: _vueTypes2['default'].bool,
  autoplay: _vueTypes2['default'].bool,
  easing: _vueTypes2['default'].string,
  beforeChange: _vueTypes2['default'].func,
  afterChange: _vueTypes2['default'].func,
  // style: PropTypes.React.CSSProperties,
  prefixCls: _vueTypes2['default'].string,
  accessibility: _vueTypes2['default'].bool,
  nextArrow: _vueTypes2['default'].any,
  prevArrow: _vueTypes2['default'].any,
  pauseOnHover: _vueTypes2['default'].bool,
  // className: PropTypes.string,
  adaptiveHeight: _vueTypes2['default'].bool,
  arrows: _vueTypes2['default'].bool,
  autoplaySpeed: _vueTypes2['default'].number,
  centerMode: _vueTypes2['default'].bool,
  centerPadding: _vueTypes2['default'].string,
  cssEase: _vueTypes2['default'].string,
  dotsClass: _vueTypes2['default'].string,
  draggable: _vueTypes2['default'].bool,
  fade: _vueTypes2['default'].bool,
  focusOnSelect: _vueTypes2['default'].bool,
  infinite: _vueTypes2['default'].bool,
  initialSlide: _vueTypes2['default'].number,
  lazyLoad: _vueTypes2['default'].bool,
  rtl: _vueTypes2['default'].bool,
  slide: _vueTypes2['default'].string,
  slidesToShow: _vueTypes2['default'].number,
  slidesToScroll: _vueTypes2['default'].number,
  speed: _vueTypes2['default'].number,
  swipe: _vueTypes2['default'].bool,
  swipeToSlide: _vueTypes2['default'].bool,
  touchMove: _vueTypes2['default'].bool,
  touchThreshold: _vueTypes2['default'].number,
  variableWidth: _vueTypes2['default'].bool,
  useCSS: _vueTypes2['default'].bool,
  slickGoTo: _vueTypes2['default'].number,
  responsive: _vueTypes2['default'].array
};

var Carousel = {
  name: 'ACarousel',
  props: (0, _propsUtil.initDefaultProps)(CarouselProps, {
    dots: true,
    arrows: false,
    draggable: false
  }),
  inject: {
    configProvider: { 'default': function _default() {
        return _configProvider.ConfigConsumerProps;
      } }
  },

  beforeMount: function beforeMount() {
    this.onWindowResized = (0, _debounce2['default'])(this.onWindowResized, 500, {
      leading: false
    });
  },
  mounted: function mounted() {
    var autoplay = this.autoplay;

    if (autoplay) {
      window.addEventListener('resize', this.onWindowResized);
    }
    // https://github.com/ant-design/ant-design/issues/7191
    this.innerSlider = this.$refs.slick && this.$refs.slick.innerSlider;
  },
  beforeDestroy: function beforeDestroy() {
    var autoplay = this.autoplay;

    if (autoplay) {
      window.removeEventListener('resize', this.onWindowResized);
      this.onWindowResized.cancel();
    }
  },

  methods: {
    onWindowResized: function onWindowResized() {
      // Fix https://github.com/ant-design/ant-design/issues/2550
      var autoplay = this.autoplay;

      if (autoplay && this.$refs.slick && this.$refs.slick.innerSlider && this.$refs.slick.innerSlider.autoPlay) {
        this.$refs.slick.innerSlider.autoPlay();
      }
    },
    next: function next() {
      this.$refs.slick.slickNext();
    },
    prev: function prev() {
      this.$refs.slick.slickPrev();
    },
    goTo: function goTo(slide) {
      var dontAnimate = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;

      this.$refs.slick.slickGoTo(slide, dontAnimate);
    }
  },

  render: function render() {
    var h = arguments[0];

    var props = (0, _extends3['default'])({}, this.$props);
    var $slots = this.$slots,
        $listeners = this.$listeners;


    if (props.effect === 'fade') {
      props.fade = true;
    }

    var getPrefixCls = this.configProvider.getPrefixCls;
    var className = getPrefixCls('carousel', props.prefixCls);

    if (props.vertical) {
      className = className + ' ' + className + '-vertical';
    }
    var SlickCarouselProps = {
      props: (0, _extends3['default'])({}, props, {
        nextArrow: (0, _propsUtil.getComponentFromProp)(this, 'nextArrow'),
        prevArrow: (0, _propsUtil.getComponentFromProp)(this, 'prevArrow')
      }),
      on: $listeners,
      scopedSlots: this.$scopedSlots
    };

    return h(
      'div',
      { 'class': className },
      [h(
        SlickCarousel,
        (0, _babelHelperVueJsxMergeProps2['default'])([{ ref: 'slick' }, SlickCarouselProps]),
        [(0, _propsUtil.filterEmpty)($slots['default'])]
      )]
    );
  }
};

/* istanbul ignore next */
Carousel.install = function (Vue) {
  Vue.use(_base2['default']);
  Vue.component(Carousel.name, Carousel);
};

exports['default'] = Carousel;

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-slick/src/arrows.js":
/*!****************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-slick/src/arrows.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.NextArrow = exports.PrevArrow = undefined;

var _babelHelperVueJsxMergeProps = __webpack_require__(/*! babel-helper-vue-jsx-merge-props */ "./node_modules/babel-helper-vue-jsx-merge-props/index.js");

var _babelHelperVueJsxMergeProps2 = _interopRequireDefault(_babelHelperVueJsxMergeProps);

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _vnode = __webpack_require__(/*! ../../_util/vnode */ "./node_modules/ant-design-vue/lib/_util/vnode.js");

var _innerSliderUtils = __webpack_require__(/*! ./utils/innerSliderUtils */ "./node_modules/ant-design-vue/lib/vc-slick/src/utils/innerSliderUtils.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

function noop() {}

var PrevArrow = exports.PrevArrow = {
  functional: true,
  clickHandler: function clickHandler(options, handle, e) {
    if (e) {
      e.preventDefault();
    }
    handle(options, e);
  },
  render: function render(createElement, context) {
    var h = arguments[0];
    var props = context.props;
    var clickHandler = props.clickHandler,
        infinite = props.infinite,
        currentSlide = props.currentSlide,
        slideCount = props.slideCount,
        slidesToShow = props.slidesToShow;

    var prevClasses = { 'slick-arrow': true, 'slick-prev': true };
    var prevHandler = function prevHandler(e) {
      if (e) {
        e.preventDefault();
      }
      clickHandler({ message: 'previous' });
    };

    if (!infinite && (currentSlide === 0 || slideCount <= slidesToShow)) {
      prevClasses['slick-disabled'] = true;
      prevHandler = noop;
    }

    var prevArrowProps = {
      key: '0',
      domProps: {
        'data-role': 'none'
      },
      'class': prevClasses,
      style: { display: 'block' },
      on: {
        click: prevHandler
      }
    };
    var customProps = {
      currentSlide: currentSlide,
      slideCount: slideCount
    };
    var prevArrow = void 0;

    if (props.prevArrow) {
      prevArrow = (0, _vnode.cloneElement)(props.prevArrow((0, _extends3['default'])({}, prevArrowProps, {
        props: customProps
      })), {
        key: '0',
        'class': prevClasses,
        style: { display: 'block' },
        on: {
          click: prevHandler
        }
      });
    } else {
      prevArrow = h(
        'button',
        (0, _babelHelperVueJsxMergeProps2['default'])([{ key: '0', attrs: { type: 'button' }
        }, prevArrowProps]),
        [' ', 'Previous']
      );
    }

    return prevArrow;
  }
};

var NextArrow = exports.NextArrow = {
  functional: true,
  clickHandler: function clickHandler(options, handle, e) {
    if (e) {
      e.preventDefault();
    }
    handle(options, e);
  },
  render: function render(createElement, context) {
    var h = arguments[0];
    var props = context.props;
    var clickHandler = props.clickHandler,
        currentSlide = props.currentSlide,
        slideCount = props.slideCount;


    var nextClasses = { 'slick-arrow': true, 'slick-next': true };
    var nextHandler = function nextHandler(e) {
      if (e) {
        e.preventDefault();
      }
      clickHandler({ message: 'next' });
    };
    if (!(0, _innerSliderUtils.canGoNext)(props)) {
      nextClasses['slick-disabled'] = true;
      nextHandler = noop;
    }

    var nextArrowProps = {
      key: '1',
      domProps: {
        'data-role': 'none'
      },
      'class': nextClasses,
      style: { display: 'block' },
      on: {
        click: nextHandler
      }
    };
    var customProps = {
      currentSlide: currentSlide,
      slideCount: slideCount
    };
    var nextArrow = void 0;

    if (props.nextArrow) {
      nextArrow = (0, _vnode.cloneElement)(props.nextArrow((0, _extends3['default'])({}, nextArrowProps, {
        props: customProps
      })), {
        key: '1',
        'class': nextClasses,
        style: { display: 'block' },
        on: {
          click: nextHandler
        }
      });
    } else {
      nextArrow = h(
        'button',
        (0, _babelHelperVueJsxMergeProps2['default'])([{ key: '1', attrs: { type: 'button' }
        }, nextArrowProps]),
        [' ', 'Next']
      );
    }

    return nextArrow;
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-slick/src/default-props.js":
/*!***********************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-slick/src/default-props.js ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _vueTypes = __webpack_require__(/*! ../../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var defaultProps = {
  accessibility: _vueTypes2['default'].bool.def(true),
  // 自定义高度
  adaptiveHeight: _vueTypes2['default'].bool.def(false),
  afterChange: _vueTypes2['default'].any.def(null),
  arrows: _vueTypes2['default'].bool.def(true),
  autoplay: _vueTypes2['default'].bool.def(false),
  autoplaySpeed: _vueTypes2['default'].number.def(3000),
  beforeChange: _vueTypes2['default'].any.def(null),
  centerMode: _vueTypes2['default'].bool.def(false),
  centerPadding: _vueTypes2['default'].string.def('50px'),
  cssEase: _vueTypes2['default'].string.def('ease'),
  dots: _vueTypes2['default'].bool.def(false),
  dotsClass: _vueTypes2['default'].string.def('slick-dots'),
  draggable: _vueTypes2['default'].bool.def(true),
  unslick: _vueTypes2['default'].bool.def(false),
  easing: _vueTypes2['default'].string.def('linear'),
  edgeFriction: _vueTypes2['default'].number.def(0.35),
  fade: _vueTypes2['default'].bool.def(false),
  focusOnSelect: _vueTypes2['default'].bool.def(false),
  infinite: _vueTypes2['default'].bool.def(true),
  initialSlide: _vueTypes2['default'].number.def(0),
  lazyLoad: _vueTypes2['default'].any.def(null),
  verticalSwiping: _vueTypes2['default'].bool.def(false),
  asNavFor: _vueTypes2['default'].any.def(null),
  // 圆点hover是否暂停
  pauseOnDotsHover: _vueTypes2['default'].bool.def(false),
  // focus是否暂停
  pauseOnFocus: _vueTypes2['default'].bool.def(false),
  // hover是否暂停
  pauseOnHover: _vueTypes2['default'].bool.def(true),
  responsive: _vueTypes2['default'].array,
  rows: _vueTypes2['default'].number.def(1),
  rtl: _vueTypes2['default'].bool.def(false),
  slide: _vueTypes2['default'].string.def('div'),
  slidesPerRow: _vueTypes2['default'].number.def(1),
  slidesToScroll: _vueTypes2['default'].number.def(1),
  slidesToShow: _vueTypes2['default'].number.def(1),
  speed: _vueTypes2['default'].number.def(500),
  swipe: _vueTypes2['default'].bool.def(true),
  swipeEvent: _vueTypes2['default'].any.def(null),
  swipeToSlide: _vueTypes2['default'].bool.def(false),
  touchMove: _vueTypes2['default'].bool.def(true),
  touchThreshold: _vueTypes2['default'].number.def(5),
  useCSS: _vueTypes2['default'].bool.def(true),
  useTransform: _vueTypes2['default'].bool.def(true),
  variableWidth: _vueTypes2['default'].bool.def(false),
  vertical: _vueTypes2['default'].bool.def(false),
  waitForAnimate: _vueTypes2['default'].bool.def(true),
  children: _vueTypes2['default'].array,
  __propsSymbol__: _vueTypes2['default'].any
};

exports['default'] = defaultProps;

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-slick/src/dots.js":
/*!**************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-slick/src/dots.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _classnames = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");

var _classnames2 = _interopRequireDefault(_classnames);

var _vnode = __webpack_require__(/*! ../../_util/vnode */ "./node_modules/ant-design-vue/lib/_util/vnode.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var getDotCount = function getDotCount(spec) {
  var dots = void 0;

  if (spec.infinite) {
    dots = Math.ceil(spec.slideCount / spec.slidesToScroll);
  } else {
    dots = Math.ceil((spec.slideCount - spec.slidesToShow) / spec.slidesToScroll) + 1;
  }

  return dots;
};

exports['default'] = {
  functional: true,
  render: function render(createElement, context) {
    var h = arguments[0];
    var props = context.props,
        listeners = context.listeners;
    var slideCount = props.slideCount,
        slidesToScroll = props.slidesToScroll,
        slidesToShow = props.slidesToShow,
        infinite = props.infinite,
        currentSlide = props.currentSlide,
        appendDots = props.appendDots,
        customPaging = props.customPaging,
        clickHandler = props.clickHandler,
        dotsClass = props.dotsClass;

    var dotCount = getDotCount({
      slideCount: slideCount,
      slidesToScroll: slidesToScroll,
      slidesToShow: slidesToShow,
      infinite: infinite
    });

    // Apply join & split to Array to pre-fill it for IE8
    //
    // Credit: http://stackoverflow.com/a/13735425/1849458
    var mouseenter = listeners.mouseenter,
        mouseover = listeners.mouseover,
        mouseleave = listeners.mouseleave;

    var mouseEvents = { mouseenter: mouseenter, mouseover: mouseover, mouseleave: mouseleave };
    var dots = Array.apply(null, Array(dotCount + 1).join('0').split('')).map(function (x, i) {
      var leftBound = i * slidesToScroll;
      var rightBound = i * slidesToScroll + (slidesToScroll - 1);
      var className = (0, _classnames2['default'])({
        'slick-active': currentSlide >= leftBound && currentSlide <= rightBound
      });

      var dotOptions = {
        message: 'dots',
        index: i,
        slidesToScroll: slidesToScroll,
        currentSlide: currentSlide
      };
      function onClick(e) {
        // In Autoplay the focus stays on clicked button even after transition
        // to next slide. That only goes away by click somewhere outside
        if (e) {
          e.preventDefault();
        }
        clickHandler(dotOptions);
      }
      return h(
        'li',
        { key: i, 'class': className },
        [(0, _vnode.cloneElement)(customPaging({ i: i }), {
          on: {
            click: onClick
          }
        })]
      );
    });

    return (0, _vnode.cloneElement)(appendDots({ dots: dots }), {
      'class': dotsClass,
      on: (0, _extends3['default'])({}, mouseEvents)
    });
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-slick/src/index.js":
/*!***************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-slick/src/index.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _slider = __webpack_require__(/*! ./slider */ "./node_modules/ant-design-vue/lib/vc-slick/src/slider.js");

var _slider2 = _interopRequireDefault(_slider);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports['default'] = _slider2['default']; // base react-slick 0.23.2

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-slick/src/initial-state.js":
/*!***********************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-slick/src/initial-state.js ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
var initialState = {
  animating: false,
  autoplaying: null,
  currentDirection: 0,
  currentLeft: null,
  currentSlide: 0,
  direction: 1,
  dragging: false,
  edgeDragged: false,
  initialized: false,
  lazyLoadedList: [],
  listHeight: null,
  listWidth: null,
  scrolling: false,
  slideCount: null,
  slideHeight: null,
  slideWidth: null,
  swipeLeft: null,
  swiped: false, // used by swipeEvent. differentites between touch and swipe.
  swiping: false,
  touchObject: { startX: 0, startY: 0, curX: 0, curY: 0 },
  trackStyle: {},
  trackWidth: 0
};

exports["default"] = initialState;

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-slick/src/inner-slider.js":
/*!**********************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-slick/src/inner-slider.js ***!
  \**********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _typeof2 = __webpack_require__(/*! babel-runtime/helpers/typeof */ "./node_modules/babel-runtime/helpers/typeof.js");

var _typeof3 = _interopRequireDefault(_typeof2);

var _objectWithoutProperties2 = __webpack_require__(/*! babel-runtime/helpers/objectWithoutProperties */ "./node_modules/babel-runtime/helpers/objectWithoutProperties.js");

var _objectWithoutProperties3 = _interopRequireDefault(_objectWithoutProperties2);

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _debounce = __webpack_require__(/*! lodash/debounce */ "./node_modules/lodash/debounce.js");

var _debounce2 = _interopRequireDefault(_debounce);

var _classnames = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");

var _classnames2 = _interopRequireDefault(_classnames);

var _vue = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.common.js");

var _vue2 = _interopRequireDefault(_vue);

var _vueRef = __webpack_require__(/*! vue-ref */ "./node_modules/vue-ref/index.js");

var _vueRef2 = _interopRequireDefault(_vueRef);

var _propsUtil = __webpack_require__(/*! ../../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

var _BaseMixin = __webpack_require__(/*! ../../_util/BaseMixin */ "./node_modules/ant-design-vue/lib/_util/BaseMixin.js");

var _BaseMixin2 = _interopRequireDefault(_BaseMixin);

var _defaultProps = __webpack_require__(/*! ./default-props */ "./node_modules/ant-design-vue/lib/vc-slick/src/default-props.js");

var _defaultProps2 = _interopRequireDefault(_defaultProps);

var _initialState = __webpack_require__(/*! ./initial-state */ "./node_modules/ant-design-vue/lib/vc-slick/src/initial-state.js");

var _initialState2 = _interopRequireDefault(_initialState);

var _innerSliderUtils = __webpack_require__(/*! ./utils/innerSliderUtils */ "./node_modules/ant-design-vue/lib/vc-slick/src/utils/innerSliderUtils.js");

var _track = __webpack_require__(/*! ./track */ "./node_modules/ant-design-vue/lib/vc-slick/src/track.js");

var _track2 = _interopRequireDefault(_track);

var _dots = __webpack_require__(/*! ./dots */ "./node_modules/ant-design-vue/lib/vc-slick/src/dots.js");

var _dots2 = _interopRequireDefault(_dots);

var _arrows = __webpack_require__(/*! ./arrows */ "./node_modules/ant-design-vue/lib/vc-slick/src/arrows.js");

var _resizeObserverPolyfill = __webpack_require__(/*! resize-observer-polyfill */ "./node_modules/resize-observer-polyfill/dist/ResizeObserver.es.js");

var _resizeObserverPolyfill2 = _interopRequireDefault(_resizeObserverPolyfill);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

_vue2['default'].use(_vueRef2['default'], { name: 'ant-ref' });

function noop() {}

exports['default'] = {
  props: (0, _extends3['default'])({}, _defaultProps2['default']),
  mixins: [_BaseMixin2['default']],
  data: function data() {
    this.preProps = (0, _extends3['default'])({}, this.$props);
    this.list = null;
    this.track = null;
    this.callbackTimers = [];
    this.clickable = true;
    this.debouncedResize = null;
    return (0, _extends3['default'])({}, _initialState2['default'], {
      currentSlide: this.initialSlide,
      slideCount: this.children.length
    });
  },

  methods: {
    listRefHandler: function listRefHandler(ref) {
      this.list = ref;
    },
    trackRefHandler: function trackRefHandler(ref) {
      this.track = ref;
    },
    adaptHeight: function adaptHeight() {
      if (this.adaptiveHeight && this.list) {
        var elem = this.list.querySelector('[data-index="' + this.currentSlide + '"]');
        this.list.style.height = (0, _innerSliderUtils.getHeight)(elem) + 'px';
      }
    },
    onWindowResized: function onWindowResized(setTrackStyle) {
      var _this = this;

      if (this.debouncedResize) this.debouncedResize.cancel();
      this.debouncedResize = (0, _debounce2['default'])(function () {
        return _this.resizeWindow(setTrackStyle);
      }, 50);
      this.debouncedResize();
    },
    resizeWindow: function resizeWindow() {
      var _this2 = this;

      var setTrackStyle = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : true;

      if (!this.track) return;
      var spec = (0, _extends3['default'])({
        listRef: this.list,
        trackRef: this.track,
        children: this.children
      }, this.$props, this.$data);
      this.updateState(spec, setTrackStyle, function () {
        if (_this2.autoplay) {
          _this2.handleAutoPlay('update');
        } else {
          _this2.pause('paused');
        }
      });
      // animating state should be cleared while resizing, otherwise autoplay stops working
      this.setState({
        animating: false
      });
      clearTimeout(this.animationEndCallback);
      delete this.animationEndCallback;
    },
    updateState: function updateState(spec, setTrackStyle, callback) {
      var updatedState = (0, _innerSliderUtils.initializedState)(spec);
      spec = (0, _extends3['default'])({}, spec, updatedState, { slideIndex: updatedState.currentSlide });
      var targetLeft = (0, _innerSliderUtils.getTrackLeft)(spec);
      spec = (0, _extends3['default'])({}, spec, { left: targetLeft });
      var trackStyle = (0, _innerSliderUtils.getTrackCSS)(spec);
      if (setTrackStyle || this.children.length !== spec.children.length) {
        updatedState['trackStyle'] = trackStyle;
      }
      this.setState(updatedState, callback);
    },
    ssrInit: function ssrInit() {
      var children = this.children;
      if (this.variableWidth) {
        var _trackWidth = 0;
        var _trackLeft = 0;
        var childrenWidths = [];
        var preClones = (0, _innerSliderUtils.getPreClones)((0, _extends3['default'])({}, this.$props, this.$data, {
          slideCount: children.length
        }));
        var postClones = (0, _innerSliderUtils.getPostClones)((0, _extends3['default'])({}, this.$props, this.$data, {
          slideCount: children.length
        }));
        children.forEach(function (child) {
          var childWidth = (0, _propsUtil.getStyle)(child).width.split('px')[0];
          childrenWidths.push(childWidth);
          _trackWidth += childWidth;
        });
        for (var i = 0; i < preClones; i++) {
          _trackLeft += childrenWidths[childrenWidths.length - 1 - i];
          _trackWidth += childrenWidths[childrenWidths.length - 1 - i];
        }
        for (var _i = 0; _i < postClones; _i++) {
          _trackWidth += childrenWidths[_i];
        }
        for (var _i2 = 0; _i2 < this.currentSlide; _i2++) {
          _trackLeft += childrenWidths[_i2];
        }
        var _trackStyle = {
          width: _trackWidth + 'px',
          left: -_trackLeft + 'px'
        };
        if (this.centerMode) {
          var currentWidth = childrenWidths[this.currentSlide] + 'px';
          _trackStyle.left = 'calc(' + _trackStyle.left + ' + (100% - ' + currentWidth + ') / 2 ) ';
        }
        this.setState({
          trackStyle: _trackStyle
        });
        return;
      }
      var childrenCount = children.length;
      var spec = (0, _extends3['default'])({}, this.$props, this.$data, { slideCount: childrenCount });
      var slideCount = (0, _innerSliderUtils.getPreClones)(spec) + (0, _innerSliderUtils.getPostClones)(spec) + childrenCount;
      var trackWidth = 100 / this.slidesToShow * slideCount;
      var slideWidth = 100 / slideCount;
      var trackLeft = -slideWidth * ((0, _innerSliderUtils.getPreClones)(spec) + this.currentSlide) * trackWidth / 100;
      if (this.centerMode) {
        trackLeft += (100 - slideWidth * trackWidth / 100) / 2;
      }
      var trackStyle = {
        width: trackWidth + '%',
        left: trackLeft + '%'
      };
      this.setState({
        slideWidth: slideWidth + '%',
        trackStyle: trackStyle
      });
    },
    checkImagesLoad: function checkImagesLoad() {
      var _this3 = this;

      var images = document.querySelectorAll('.slick-slide img');
      var imagesCount = images.length;
      var loadedCount = 0;
      Array.prototype.forEach.call(images, function (image) {
        var handler = function handler() {
          return ++loadedCount && loadedCount >= imagesCount && _this3.onWindowResized();
        };
        if (!image.onclick) {
          image.onclick = function () {
            return image.parentNode.focus();
          };
        } else {
          var prevClickHandler = image.onclick;
          image.onclick = function () {
            prevClickHandler();
            image.parentNode.focus();
          };
        }
        if (!image.onload) {
          if (_this3.$props.lazyLoad) {
            image.onload = function () {
              _this3.adaptHeight();
              _this3.callbackTimers.push(setTimeout(_this3.onWindowResized, _this3.speed));
            };
          } else {
            image.onload = handler;
            image.onerror = function () {
              handler();
              _this3.$emit('lazyLoadError');
            };
          }
        }
      });
    },
    progressiveLazyLoad: function progressiveLazyLoad() {
      var slidesToLoad = [];
      var spec = (0, _extends3['default'])({}, this.$props, this.$data);
      for (var index = this.currentSlide; index < this.slideCount + (0, _innerSliderUtils.getPostClones)(spec); index++) {
        if (this.lazyLoadedList.indexOf(index) < 0) {
          slidesToLoad.push(index);
          break;
        }
      }
      for (var _index = this.currentSlide - 1; _index >= -(0, _innerSliderUtils.getPreClones)(spec); _index--) {
        if (this.lazyLoadedList.indexOf(_index) < 0) {
          slidesToLoad.push(_index);
          break;
        }
      }
      if (slidesToLoad.length > 0) {
        this.setState(function (state) {
          return {
            lazyLoadedList: state.lazyLoadedList.concat(slidesToLoad)
          };
        });
        this.$emit('lazyLoad', slidesToLoad);
      } else {
        if (this.lazyLoadTimer) {
          clearInterval(this.lazyLoadTimer);
          delete this.lazyLoadTimer;
        }
      }
    },
    slideHandler: function slideHandler(index) {
      var _this4 = this;

      var dontAnimate = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
      var _$props = this.$props,
          asNavFor = _$props.asNavFor,
          currentSlide = _$props.currentSlide,
          beforeChange = _$props.beforeChange,
          speed = _$props.speed,
          afterChange = _$props.afterChange;

      var _slideHandler2 = (0, _innerSliderUtils.slideHandler)((0, _extends3['default'])({
        index: index
      }, this.$props, this.$data, {
        trackRef: this.track,
        useCSS: this.useCSS && !dontAnimate
      })),
          state = _slideHandler2.state,
          nextState = _slideHandler2.nextState;

      if (!state) return;
      beforeChange && beforeChange(currentSlide, state.currentSlide);
      var slidesToLoad = state.lazyLoadedList.filter(function (value) {
        return _this4.lazyLoadedList.indexOf(value) < 0;
      });
      if (this.$listeners.lazyLoad && slidesToLoad.length > 0) {
        this.$emit('lazyLoad', slidesToLoad);
      }
      this.setState(state, function () {
        asNavFor && asNavFor.innerSlider.currentSlide !== currentSlide && asNavFor.innerSlider.slideHandler(index);
        if (!nextState) return;
        _this4.animationEndCallback = setTimeout(function () {
          var animating = nextState.animating,
              firstBatch = (0, _objectWithoutProperties3['default'])(nextState, ['animating']);

          _this4.setState(firstBatch, function () {
            _this4.callbackTimers.push(setTimeout(function () {
              return _this4.setState({ animating: animating });
            }, 10));
            afterChange && afterChange(state.currentSlide);
            delete _this4.animationEndCallback;
          });
        }, speed);
      });
    },
    changeSlide: function changeSlide(options) {
      var dontAnimate = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;

      var spec = (0, _extends3['default'])({}, this.$props, this.$data);
      var targetSlide = (0, _innerSliderUtils.changeSlide)(spec, options);
      if (targetSlide !== 0 && !targetSlide) return;
      if (dontAnimate === true) {
        this.slideHandler(targetSlide, dontAnimate);
      } else {
        this.slideHandler(targetSlide);
      }
    },
    clickHandler: function clickHandler(e) {
      if (this.clickable === false) {
        e.stopPropagation();
        e.preventDefault();
      }
      this.clickable = true;
    },
    keyHandler: function keyHandler(e) {
      var dir = (0, _innerSliderUtils.keyHandler)(e, this.accessibility, this.rtl);
      dir !== '' && this.changeSlide({ message: dir });
    },
    selectHandler: function selectHandler(options) {
      this.changeSlide(options);
    },
    disableBodyScroll: function disableBodyScroll() {
      var preventDefault = function preventDefault(e) {
        e = e || window.event;
        if (e.preventDefault) e.preventDefault();
        e.returnValue = false;
      };
      window.ontouchmove = preventDefault;
    },
    enableBodyScroll: function enableBodyScroll() {
      window.ontouchmove = null;
    },
    swipeStart: function swipeStart(e) {
      if (this.verticalSwiping) {
        this.disableBodyScroll();
      }
      var state = (0, _innerSliderUtils.swipeStart)(e, this.swipe, this.draggable);
      state !== '' && this.setState(state);
    },
    swipeMove: function swipeMove(e) {
      var state = (0, _innerSliderUtils.swipeMove)(e, (0, _extends3['default'])({}, this.$props, this.$data, {
        trackRef: this.track,
        listRef: this.list,
        slideIndex: this.currentSlide
      }));
      if (!state) return;
      if (state['swiping']) {
        this.clickable = false;
      }
      this.setState(state);
    },
    swipeEnd: function swipeEnd(e) {
      var state = (0, _innerSliderUtils.swipeEnd)(e, (0, _extends3['default'])({}, this.$props, this.$data, {
        trackRef: this.track,
        listRef: this.list,
        slideIndex: this.currentSlide
      }));
      if (!state) return;
      var triggerSlideHandler = state['triggerSlideHandler'];
      delete state['triggerSlideHandler'];
      this.setState(state);
      if (triggerSlideHandler === undefined) return;
      this.slideHandler(triggerSlideHandler);
      if (this.$props.verticalSwiping) {
        this.enableBodyScroll();
      }
    },
    slickPrev: function slickPrev() {
      var _this5 = this;

      // this and fellow methods are wrapped in setTimeout
      // to make sure initialize setState has happened before
      // any of such methods are called
      this.callbackTimers.push(setTimeout(function () {
        return _this5.changeSlide({ message: 'previous' });
      }, 0));
    },
    slickNext: function slickNext() {
      var _this6 = this;

      this.callbackTimers.push(setTimeout(function () {
        return _this6.changeSlide({ message: 'next' });
      }, 0));
    },
    slickGoTo: function slickGoTo(slide) {
      var _this7 = this;

      var dontAnimate = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;

      slide = Number(slide);
      if (isNaN(slide)) return '';
      this.callbackTimers.push(setTimeout(function () {
        return _this7.changeSlide({
          message: 'index',
          index: slide,
          currentSlide: _this7.currentSlide
        }, dontAnimate);
      }, 0));
    },
    play: function play() {
      var nextIndex = void 0;
      if (this.rtl) {
        nextIndex = this.currentSlide - this.slidesToScroll;
      } else {
        if ((0, _innerSliderUtils.canGoNext)((0, _extends3['default'])({}, this.$props, this.$data))) {
          nextIndex = this.currentSlide + this.slidesToScroll;
        } else {
          return false;
        }
      }

      this.slideHandler(nextIndex);
    },
    handleAutoPlay: function handleAutoPlay(playType) {
      if (this.autoplayTimer) {
        clearInterval(this.autoplayTimer);
      }
      var autoplaying = this.autoplaying;
      if (playType === 'update') {
        if (autoplaying === 'hovered' || autoplaying === 'focused' || autoplaying === 'paused') {
          return;
        }
      } else if (playType === 'leave') {
        if (autoplaying === 'paused' || autoplaying === 'focused') {
          return;
        }
      } else if (playType === 'blur') {
        if (autoplaying === 'paused' || autoplaying === 'hovered') {
          return;
        }
      }
      this.autoplayTimer = setInterval(this.play, this.autoplaySpeed + 50);
      this.setState({ autoplaying: 'playing' });
    },
    pause: function pause(pauseType) {
      if (this.autoplayTimer) {
        clearInterval(this.autoplayTimer);
        this.autoplayTimer = null;
      }
      var autoplaying = this.autoplaying;
      if (pauseType === 'paused') {
        this.setState({ autoplaying: 'paused' });
      } else if (pauseType === 'focused') {
        if (autoplaying === 'hovered' || autoplaying === 'playing') {
          this.setState({ autoplaying: 'focused' });
        }
      } else {
        // pauseType  is 'hovered'
        if (autoplaying === 'playing') {
          this.setState({ autoplaying: 'hovered' });
        }
      }
    },
    onDotsOver: function onDotsOver() {
      this.autoplay && this.pause('hovered');
    },
    onDotsLeave: function onDotsLeave() {
      this.autoplay && this.autoplaying === 'hovered' && this.handleAutoPlay('leave');
    },
    onTrackOver: function onTrackOver() {
      this.autoplay && this.pause('hovered');
    },
    onTrackLeave: function onTrackLeave() {
      this.autoplay && this.autoplaying === 'hovered' && this.handleAutoPlay('leave');
    },
    onSlideFocus: function onSlideFocus() {
      this.autoplay && this.pause('focused');
    },
    onSlideBlur: function onSlideBlur() {
      this.autoplay && this.autoplaying === 'focused' && this.handleAutoPlay('blur');
    },
    customPaging: function customPaging(_ref) {
      var i = _ref.i;
      var h = this.$createElement;

      return h('button', [i + 1]);
    },
    appendDots: function appendDots(_ref2) {
      var dots = _ref2.dots;
      var h = this.$createElement;

      return h(
        'ul',
        { style: { display: 'block' } },
        [dots]
      );
    }
  },
  beforeMount: function beforeMount() {
    this.ssrInit();
    this.$emit('init');
    if (this.lazyLoad) {
      var slidesToLoad = (0, _innerSliderUtils.getOnDemandLazySlides)((0, _extends3['default'])({}, this.$props, this.$data));
      if (slidesToLoad.length > 0) {
        this.setState(function (prevState) {
          return {
            lazyLoadedList: prevState.lazyLoadedList.concat(slidesToLoad)
          };
        });
        this.$emit('lazyLoad', slidesToLoad);
      }
    }
  },
  mounted: function mounted() {
    var _this8 = this;

    this.$nextTick(function () {
      var spec = (0, _extends3['default'])({
        listRef: _this8.list,
        trackRef: _this8.track,
        children: _this8.children
      }, _this8.$props);
      _this8.updateState(spec, true, function () {
        _this8.adaptHeight();
        _this8.autoplay && _this8.handleAutoPlay('update');
      });
      if (_this8.lazyLoad === 'progressive') {
        _this8.lazyLoadTimer = setInterval(_this8.progressiveLazyLoad, 1000);
      }
      _this8.ro = new _resizeObserverPolyfill2['default'](function () {
        if (_this8.animating) {
          _this8.onWindowResized(false); // don't set trackStyle hence don't break animation
          _this8.callbackTimers.push(setTimeout(function () {
            return _this8.onWindowResized();
          }, _this8.speed));
        } else {
          _this8.onWindowResized();
        }
      });
      _this8.ro.observe(_this8.list);
      Array.prototype.forEach.call(document.querySelectorAll('.slick-slide'), function (slide) {
        slide.onfocus = _this8.$props.pauseOnFocus ? _this8.onSlideFocus : null;
        slide.onblur = _this8.$props.pauseOnFocus ? _this8.onSlideBlur : null;
      });
      // To support server-side rendering
      if (!window) {
        return;
      }
      if (window.addEventListener) {
        window.addEventListener('resize', _this8.onWindowResized);
      } else {
        window.attachEvent('onresize', _this8.onWindowResized);
      }
    });
  },
  beforeDestroy: function beforeDestroy() {
    if (this.animationEndCallback) {
      clearTimeout(this.animationEndCallback);
    }
    if (this.lazyLoadTimer) {
      clearInterval(this.lazyLoadTimer);
    }
    if (this.callbackTimers.length) {
      this.callbackTimers.forEach(function (timer) {
        return clearTimeout(timer);
      });
      this.callbackTimers = [];
    }
    if (window.addEventListener) {
      window.removeEventListener('resize', this.onWindowResized);
    } else {
      window.detachEvent('onresize', this.onWindowResized);
    }
    if (this.autoplayTimer) {
      clearInterval(this.autoplayTimer);
    }
  },
  updated: function updated() {
    this.checkImagesLoad();
    this.$emit('reInit');
    if (this.lazyLoad) {
      var slidesToLoad = (0, _innerSliderUtils.getOnDemandLazySlides)((0, _extends3['default'])({}, this.$props, this.$data));
      if (slidesToLoad.length > 0) {
        this.setState(function (prevState) {
          return {
            lazyLoadedList: prevState.lazyLoadedList.concat(slidesToLoad)
          };
        });
        this.$emit('lazyLoad');
      }
    }
    // if (this.props.onLazyLoad) {
    //   this.props.onLazyLoad([leftMostSlide])
    // }
    this.adaptHeight();
  },

  watch: {
    __propsSymbol__: function __propsSymbol__() {
      var _this9 = this;

      var nextProps = this.$props;
      var spec = (0, _extends3['default'])({
        listRef: this.list,
        trackRef: this.track
      }, nextProps, this.$data);
      var setTrackStyle = false;
      var _iteratorNormalCompletion = true;
      var _didIteratorError = false;
      var _iteratorError = undefined;

      try {
        for (var _iterator = Object.keys(this.preProps)[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
          var key = _step.value;

          if (!nextProps.hasOwnProperty(key)) {
            setTrackStyle = true;
            break;
          }
          if ((0, _typeof3['default'])(nextProps[key]) === 'object' || typeof nextProps[key] === 'function' || (0, _typeof3['default'])(nextProps[key]) === 'symbol') {
            continue;
          }
          if (nextProps[key] !== this.preProps[key]) {
            setTrackStyle = true;
            break;
          }
        }
      } catch (err) {
        _didIteratorError = true;
        _iteratorError = err;
      } finally {
        try {
          if (!_iteratorNormalCompletion && _iterator['return']) {
            _iterator['return']();
          }
        } finally {
          if (_didIteratorError) {
            throw _iteratorError;
          }
        }
      }

      this.updateState(spec, setTrackStyle, function () {
        if (_this9.currentSlide >= nextProps.children.length) {
          _this9.changeSlide({
            message: 'index',
            index: nextProps.children.length - nextProps.slidesToShow,
            currentSlide: _this9.currentSlide
          });
        }
        if (nextProps.autoplay) {
          _this9.handleAutoPlay('update');
        } else {
          _this9.pause('paused');
        }
      });
      this.preProps = (0, _extends3['default'])({}, nextProps);
    }
  },
  render: function render() {
    var h = arguments[0];

    var className = (0, _classnames2['default'])('slick-slider', {
      'slick-vertical': this.vertical,
      'slick-initialized': true
    });
    var spec = (0, _extends3['default'])({}, this.$props, this.$data);
    var trackProps = (0, _innerSliderUtils.extractObject)(spec, ['fade', 'cssEase', 'speed', 'infinite', 'centerMode', 'focusOnSelect', 'currentSlide', 'lazyLoad', 'lazyLoadedList', 'rtl', 'slideWidth', 'slideHeight', 'listHeight', 'vertical', 'slidesToShow', 'slidesToScroll', 'slideCount', 'trackStyle', 'variableWidth', 'unslick', 'centerPadding']);
    var pauseOnHover = this.$props.pauseOnHover;

    trackProps = {
      props: (0, _extends3['default'])({}, trackProps, {
        focusOnSelect: this.focusOnSelect ? this.selectHandler : null
      }),
      directives: [{
        name: 'ant-ref',
        value: this.trackRefHandler
      }],
      on: {
        mouseenter: pauseOnHover ? this.onTrackOver : noop,
        mouseleave: pauseOnHover ? this.onTrackLeave : noop,
        mouseover: pauseOnHover ? this.onTrackOver : noop
      }
    };

    var dots = void 0;
    if (this.dots === true && this.slideCount >= this.slidesToShow) {
      var dotProps = (0, _innerSliderUtils.extractObject)(spec, ['dotsClass', 'slideCount', 'slidesToShow', 'currentSlide', 'slidesToScroll', 'clickHandler', 'children', 'infinite', 'appendDots']);
      dotProps.customPaging = this.customPaging;
      dotProps.appendDots = this.appendDots;
      var _$scopedSlots = this.$scopedSlots,
          customPaging = _$scopedSlots.customPaging,
          appendDots = _$scopedSlots.appendDots;

      if (customPaging) {
        dotProps.customPaging = customPaging;
      }
      if (appendDots) {
        dotProps.appendDots = appendDots;
      }
      var pauseOnDotsHover = this.$props.pauseOnDotsHover;

      dotProps = {
        props: (0, _extends3['default'])({}, dotProps, {
          clickHandler: this.changeSlide
        }),
        on: {
          mouseenter: pauseOnDotsHover ? this.onDotsLeave : noop,
          mouseover: pauseOnDotsHover ? this.onDotsOver : noop,
          mouseleave: pauseOnDotsHover ? this.onDotsLeave : noop
        }
      };
      dots = h(_dots2['default'], dotProps);
    }

    var prevArrow = void 0,
        nextArrow = void 0;
    var arrowProps = (0, _innerSliderUtils.extractObject)(spec, ['infinite', 'centerMode', 'currentSlide', 'slideCount', 'slidesToShow']);
    arrowProps.clickHandler = this.changeSlide;
    var _$scopedSlots2 = this.$scopedSlots,
        prevArrowCustom = _$scopedSlots2.prevArrow,
        nextArrowCustom = _$scopedSlots2.nextArrow;

    if (prevArrowCustom) {
      arrowProps.prevArrow = prevArrowCustom;
    }
    if (nextArrowCustom) {
      arrowProps.nextArrow = nextArrowCustom;
    }
    if (this.arrows) {
      prevArrow = h(_arrows.PrevArrow, { props: arrowProps });
      nextArrow = h(_arrows.NextArrow, { props: arrowProps });
    }
    var verticalHeightStyle = null;

    if (this.vertical) {
      verticalHeightStyle = {
        height: typeof this.listHeight === 'number' ? this.listHeight + 'px' : this.listHeight
      };
    }

    var centerPaddingStyle = null;

    if (this.vertical === false) {
      if (this.centerMode === true) {
        centerPaddingStyle = {
          padding: '0px ' + this.centerPadding
        };
      }
    } else {
      if (this.centerMode === true) {
        centerPaddingStyle = {
          padding: this.centerPadding + ' 0px'
        };
      }
    }

    var listStyle = (0, _extends3['default'])({}, verticalHeightStyle, centerPaddingStyle);
    var touchMove = this.touchMove;
    var listProps = {
      directives: [{
        name: 'ant-ref',
        value: this.listRefHandler
      }],
      'class': 'slick-list',
      style: listStyle,
      on: {
        click: this.clickHandler,
        mousedown: touchMove ? this.swipeStart : noop,
        mousemove: this.dragging && touchMove ? this.swipeMove : noop,
        mouseup: touchMove ? this.swipeEnd : noop,
        mouseleave: this.dragging && touchMove ? this.swipeEnd : noop,
        touchstart: touchMove ? this.swipeStart : noop,
        touchmove: this.dragging && touchMove ? this.swipeMove : noop,
        touchend: touchMove ? this.swipeEnd : noop,
        touchcancel: this.dragging && touchMove ? this.swipeEnd : noop,
        keydown: this.accessibility ? this.keyHandler : noop
      }
    };

    var innerSliderProps = {
      'class': className,
      props: {
        dir: 'ltr'
      }
    };

    if (this.unslick) {
      listProps = {
        'class': 'slick-list',
        directives: [{
          name: 'ant-ref',
          value: this.listRefHandler
        }]
      };
      innerSliderProps = { 'class': className };
    }
    return h(
      'div',
      innerSliderProps,
      [!this.unslick ? prevArrow : '', h(
        'div',
        listProps,
        [h(
          _track2['default'],
          trackProps,
          [this.children]
        )]
      ), !this.unslick ? nextArrow : '', !this.unslick ? dots : '']
    );
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-slick/src/slider.js":
/*!****************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-slick/src/slider.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _json2mq = __webpack_require__(/*! json2mq */ "./node_modules/json2mq/index.js");

var _json2mq2 = _interopRequireDefault(_json2mq);

var _vue = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.common.js");

var _vue2 = _interopRequireDefault(_vue);

var _vueRef = __webpack_require__(/*! vue-ref */ "./node_modules/vue-ref/index.js");

var _vueRef2 = _interopRequireDefault(_vueRef);

var _BaseMixin = __webpack_require__(/*! ../../_util/BaseMixin */ "./node_modules/ant-design-vue/lib/_util/BaseMixin.js");

var _BaseMixin2 = _interopRequireDefault(_BaseMixin);

var _vnode = __webpack_require__(/*! ../../_util/vnode */ "./node_modules/ant-design-vue/lib/_util/vnode.js");

var _propsUtil = __webpack_require__(/*! ../../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

var _innerSlider = __webpack_require__(/*! ./inner-slider */ "./node_modules/ant-design-vue/lib/vc-slick/src/inner-slider.js");

var _innerSlider2 = _interopRequireDefault(_innerSlider);

var _defaultProps = __webpack_require__(/*! ./default-props */ "./node_modules/ant-design-vue/lib/vc-slick/src/default-props.js");

var _defaultProps2 = _interopRequireDefault(_defaultProps);

var _innerSliderUtils = __webpack_require__(/*! ./utils/innerSliderUtils */ "./node_modules/ant-design-vue/lib/vc-slick/src/utils/innerSliderUtils.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var enquire = (0, _innerSliderUtils.canUseDOM)() && __webpack_require__(/*! enquire.js */ "./node_modules/enquire.js/src/index.js");

_vue2['default'].use(_vueRef2['default'], { name: 'ant-ref' });

exports['default'] = {
  props: (0, _extends3['default'])({}, _defaultProps2['default']),
  mixins: [_BaseMixin2['default']],
  data: function data() {
    this._responsiveMediaHandlers = [];
    return {
      breakpoint: null
    };
  },

  methods: {
    innerSliderRefHandler: function innerSliderRefHandler(ref) {
      this.innerSlider = ref;
    },
    media: function media(query, handler) {
      // javascript handler for  css media query
      enquire.register(query, handler);
      this._responsiveMediaHandlers.push({ query: query, handler: handler });
    },
    slickPrev: function slickPrev() {
      this.innerSlider.slickPrev();
    },
    slickNext: function slickNext() {
      this.innerSlider.slickNext();
    },
    slickGoTo: function slickGoTo(slide) {
      var dontAnimate = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;

      this.innerSlider.slickGoTo(slide, dontAnimate);
    },
    slickPause: function slickPause() {
      this.innerSlider.pause('paused');
    },
    slickPlay: function slickPlay() {
      this.innerSlider.handleAutoPlay('play');
    }
  },
  // handles responsive breakpoints
  beforeMount: function beforeMount() {
    var _this = this;

    // performance monitoring
    // if (process.env.NODE_ENV !== 'production') {
    // const { whyDidYouUpdate } = require('why-did-you-update')
    // whyDidYouUpdate(React)
    // }
    if (this.responsive) {
      var breakpoints = this.responsive.map(function (breakpt) {
        return breakpt.breakpoint;
      });
      // sort them in increasing order of their numerical value
      breakpoints.sort(function (x, y) {
        return x - y;
      });

      breakpoints.forEach(function (breakpoint, index) {
        // media query for each breakpoint
        var bQuery = void 0;
        if (index === 0) {
          bQuery = (0, _json2mq2['default'])({ minWidth: 0, maxWidth: breakpoint });
        } else {
          bQuery = (0, _json2mq2['default'])({
            minWidth: breakpoints[index - 1] + 1,
            maxWidth: breakpoint
          });
        }
        // when not using server side rendering
        (0, _innerSliderUtils.canUseDOM)() && _this.media(bQuery, function () {
          _this.setState({ breakpoint: breakpoint });
        });
      });

      // Register media query for full screen. Need to support resize from small to large
      // convert javascript object to media query string
      var query = (0, _json2mq2['default'])({ minWidth: breakpoints.slice(-1)[0] });

      (0, _innerSliderUtils.canUseDOM)() && this.media(query, function () {
        _this.setState({ breakpoint: null });
      });
    }
  },
  beforeDestroy: function beforeDestroy() {
    this._responsiveMediaHandlers.forEach(function (obj) {
      enquire.unregister(obj.query, obj.handler);
    });
  },
  render: function render() {
    var _this2 = this;

    var h = arguments[0];

    var settings = void 0;
    var newProps = void 0;
    if (this.breakpoint) {
      newProps = this.responsive.filter(function (resp) {
        return resp.breakpoint === _this2.breakpoint;
      });
      settings = newProps[0].settings === 'unslick' ? 'unslick' : (0, _extends3['default'])({}, this.$props, newProps[0].settings);
    } else {
      settings = (0, _extends3['default'])({}, this.$props);
    }

    // force scrolling by one if centerMode is on
    if (settings.centerMode) {
      if (settings.slidesToScroll > 1 && "development" !== 'production') {
        console.warn('slidesToScroll should be equal to 1 in centerMode, you are using ' + settings.slidesToScroll);
      }
      settings.slidesToScroll = 1;
    }
    // force showing one slide and scrolling by one if the fade mode is on
    if (settings.fade) {
      if (settings.slidesToShow > 1 && "development" !== 'production') {
        console.warn('slidesToShow should be equal to 1 when fade is true, you\'re using ' + settings.slidesToShow);
      }
      if (settings.slidesToScroll > 1 && "development" !== 'production') {
        console.warn('slidesToScroll should be equal to 1 when fade is true, you\'re using ' + settings.slidesToScroll);
      }
      settings.slidesToShow = 1;
      settings.slidesToScroll = 1;
    }

    // makes sure that children is an array, even when there is only 1 child
    var children = this.$slots['default'] || [];

    // Children may contain false or null, so we should filter them
    // children may also contain string filled with spaces (in certain cases where we use jsx strings)
    children = children.filter(function (child) {
      if (typeof child === 'string') {
        return !!child.trim();
      }
      return !!child;
    });

    // rows and slidesPerRow logic is handled here
    if (settings.variableWidth && (settings.rows > 1 || settings.slidesPerRow > 1)) {
      console.warn('variableWidth is not supported in case of rows > 1 or slidesPerRow > 1');
      settings.variableWidth = false;
    }
    var newChildren = [];
    var currentWidth = null;
    for (var i = 0; i < children.length; i += settings.rows * settings.slidesPerRow) {
      var newSlide = [];
      for (var j = i; j < i + settings.rows * settings.slidesPerRow; j += settings.slidesPerRow) {
        var row = [];
        for (var k = j; k < j + settings.slidesPerRow; k += 1) {
          if (settings.variableWidth && (0, _propsUtil.getStyle)(children[k])) {
            currentWidth = (0, _propsUtil.getStyle)(children[k]).width;
          }
          if (k >= children.length) break;
          row.push((0, _vnode.cloneElement)(children[k], {
            key: 100 * i + 10 * j + k,
            attrs: {
              tabIndex: -1
            },
            style: {
              width: 100 / settings.slidesPerRow + '%',
              display: 'inline-block'
            }
          }));
        }
        newSlide.push(h(
          'div',
          { key: 10 * i + j },
          [row]
        ));
      }
      if (settings.variableWidth) {
        newChildren.push(h(
          'div',
          { key: i, style: { width: currentWidth } },
          [newSlide]
        ));
      } else {
        newChildren.push(h(
          'div',
          { key: i },
          [newSlide]
        ));
      }
    }

    if (settings === 'unslick') {
      var className = 'regular slider ' + (this.className || '');
      return h(
        'div',
        { 'class': className },
        [newChildren]
      );
    } else if (newChildren.length <= settings.slidesToShow) {
      settings.unslick = true;
    }
    var sliderProps = {
      props: (0, _extends3['default'])({}, settings, {
        children: newChildren,
        __propsSymbol__: Symbol()
      }),
      on: (0, _extends3['default'])({}, this.$listeners),
      directives: [{
        name: 'ant-ref',
        value: this.innerSliderRefHandler
      }],
      scopedSlots: this.$scopedSlots
    };
    return h(_innerSlider2['default'], sliderProps);
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-slick/src/track.js":
/*!***************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-slick/src/track.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _classnames = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");

var _classnames2 = _interopRequireDefault(_classnames);

var _vnode = __webpack_require__(/*! ../../_util/vnode */ "./node_modules/ant-design-vue/lib/_util/vnode.js");

var _propsUtil = __webpack_require__(/*! ../../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

var _innerSliderUtils = __webpack_require__(/*! ./utils/innerSliderUtils */ "./node_modules/ant-design-vue/lib/vc-slick/src/utils/innerSliderUtils.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

// given specifications/props for a slide, fetch all the classes that need to be applied to the slide
var getSlideClasses = function getSlideClasses(spec) {
  var slickActive = void 0,
      slickCenter = void 0;
  var centerOffset = void 0,
      index = void 0;

  if (spec.rtl) {
    index = spec.slideCount - 1 - spec.index;
  } else {
    index = spec.index;
  }
  var slickCloned = index < 0 || index >= spec.slideCount;
  if (spec.centerMode) {
    centerOffset = Math.floor(spec.slidesToShow / 2);
    slickCenter = (index - spec.currentSlide) % spec.slideCount === 0;
    if (index > spec.currentSlide - centerOffset - 1 && index <= spec.currentSlide + centerOffset) {
      slickActive = true;
    }
  } else {
    slickActive = spec.currentSlide <= index && index < spec.currentSlide + spec.slidesToShow;
  }
  var slickCurrent = index === spec.currentSlide;
  return {
    'slick-slide': true,
    'slick-active': slickActive,
    'slick-center': slickCenter,
    'slick-cloned': slickCloned,
    'slick-current': slickCurrent // dubious in case of RTL
  };
};

var getSlideStyle = function getSlideStyle(spec) {
  var style = {};

  if (spec.variableWidth === undefined || spec.variableWidth === false) {
    style.width = spec.slideWidth + (typeof spec.slideWidth === 'number' ? 'px' : '');
  }

  if (spec.fade) {
    style.position = 'relative';
    if (spec.vertical) {
      style.top = -spec.index * parseInt(spec.slideHeight) + 'px';
    } else {
      style.left = -spec.index * parseInt(spec.slideWidth) + 'px';
    }
    style.opacity = spec.currentSlide === spec.index ? 1 : 0;
    style.transition = 'opacity ' + spec.speed + 'ms ' + spec.cssEase + ', ' + 'visibility ' + spec.speed + 'ms ' + spec.cssEase;
    style.WebkitTransition = 'opacity ' + spec.speed + 'ms ' + spec.cssEase + ', ' + 'visibility ' + spec.speed + 'ms ' + spec.cssEase;
  }

  return style;
};

var getKey = function getKey(child, fallbackKey) {
  return child.key || child.key === 0 && '0' || fallbackKey;
};

var renderSlides = function renderSlides(spec, children, createElement) {
  var key = void 0;
  var slides = [];
  var preCloneSlides = [];
  var postCloneSlides = [];
  var childrenCount = children.length;
  var startIndex = (0, _innerSliderUtils.lazyStartIndex)(spec);
  var endIndex = (0, _innerSliderUtils.lazyEndIndex)(spec);

  children.forEach(function (elem, index) {
    var child = void 0;
    var childOnClickOptions = {
      message: 'children',
      index: index,
      slidesToScroll: spec.slidesToScroll,
      currentSlide: spec.currentSlide
    };

    // in case of lazyLoad, whether or not we want to fetch the slide
    if (!spec.lazyLoad || spec.lazyLoad && spec.lazyLoadedList.indexOf(index) >= 0) {
      child = elem;
    } else {
      child = createElement('div');
    }
    var childStyle = getSlideStyle((0, _extends3['default'])({}, spec, { index: index }));
    var slideClass = (0, _propsUtil.getClass)(child.context) || '';
    var slideClasses = getSlideClasses((0, _extends3['default'])({}, spec, { index: index }));
    // push a cloned element of the desired slide
    slides.push((0, _vnode.cloneElement)(child, {
      key: 'original' + getKey(child, index),
      attrs: {
        tabIndex: '-1',
        'data-index': index,
        'aria-hidden': !slideClasses['slick-active']
      },
      'class': (0, _classnames2['default'])(slideClasses, slideClass),
      style: (0, _extends3['default'])({ outline: 'none' }, (0, _propsUtil.getStyle)(child.context) || {}, childStyle),
      on: {
        click: function click() {
          // child.props && child.props.onClick && child.props.onClick(e)
          if (spec.focusOnSelect) {
            spec.focusOnSelect(childOnClickOptions);
          }
        }
      }
    }, true));

    // if slide needs to be precloned or postcloned
    if (spec.infinite && spec.fade === false) {
      var preCloneNo = childrenCount - index;
      if (preCloneNo <= (0, _innerSliderUtils.getPreClones)(spec) && childrenCount !== spec.slidesToShow) {
        key = -preCloneNo;
        if (key >= startIndex) {
          child = elem;
        }
        slideClasses = getSlideClasses((0, _extends3['default'])({}, spec, { index: key }));
        preCloneSlides.push((0, _vnode.cloneElement)(child, {
          key: 'precloned' + getKey(child, key),
          'class': (0, _classnames2['default'])(slideClasses, slideClass),
          attrs: {
            tabIndex: '-1',
            'data-index': key,
            'aria-hidden': !slideClasses['slick-active']
          },
          style: (0, _extends3['default'])({}, (0, _propsUtil.getStyle)(child.context) || {}, childStyle),
          on: {
            click: function click() {
              // child.props && child.props.onClick && child.props.onClick(e)
              if (spec.focusOnSelect) {
                spec.focusOnSelect(childOnClickOptions);
              }
            }
          }
        }));
      }

      if (childrenCount !== spec.slidesToShow) {
        key = childrenCount + index;
        if (key < endIndex) {
          child = elem;
        }
        slideClasses = getSlideClasses((0, _extends3['default'])({}, spec, { index: key }));
        postCloneSlides.push((0, _vnode.cloneElement)(child, {
          key: 'postcloned' + getKey(child, key),
          attrs: {
            tabIndex: '-1',
            'data-index': key,
            'aria-hidden': !slideClasses['slick-active']
          },
          'class': (0, _classnames2['default'])(slideClasses, slideClass),
          style: (0, _extends3['default'])({}, (0, _propsUtil.getStyle)(child.context) || {}, childStyle),
          on: {
            click: function click() {
              // child.props && child.props.onClick && child.props.onClick(e)
              if (spec.focusOnSelect) {
                spec.focusOnSelect(childOnClickOptions);
              }
            }
          }
        }));
      }
    }
  });
  if (spec.rtl) {
    return preCloneSlides.concat(slides, postCloneSlides).reverse();
  } else {
    return preCloneSlides.concat(slides, postCloneSlides);
  }
};

exports['default'] = {
  functional: true,
  render: function render(createElement, context) {
    var h = arguments[0];
    var props = context.props,
        listeners = context.listeners,
        children = context.children,
        data = context.data;

    var slides = renderSlides(props, children, createElement);
    var mouseenter = listeners.mouseenter,
        mouseover = listeners.mouseover,
        mouseleave = listeners.mouseleave;

    var mouseEvents = { mouseenter: mouseenter, mouseover: mouseover, mouseleave: mouseleave };
    var trackProps = {
      'class': 'slick-track',
      style: props.trackStyle,
      on: (0, _extends3['default'])({}, mouseEvents),
      directives: data.directives
    };
    return h(
      'div',
      trackProps,
      [slides]
    );
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-slick/src/utils/innerSliderUtils.js":
/*!********************************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-slick/src/utils/innerSliderUtils.js ***!
  \********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.canUseDOM = exports.slidesOnLeft = exports.slidesOnRight = exports.siblingDirection = exports.getTotalSlides = exports.getPostClones = exports.getPreClones = exports.getTrackLeft = exports.getTrackAnimateCSS = exports.getTrackCSS = exports.checkSpecKeys = exports.getSlideCount = exports.checkNavigable = exports.getNavigableIndexes = exports.swipeEnd = exports.swipeMove = exports.swipeStart = exports.keyHandler = exports.changeSlide = exports.slideHandler = exports.initializedState = exports.extractObject = exports.canGoNext = exports.getSwipeDirection = exports.getHeight = exports.getWidth = exports.lazySlidesOnRight = exports.lazySlidesOnLeft = exports.lazyEndIndex = exports.lazyStartIndex = exports.getRequiredLazySlides = exports.getOnDemandLazySlides = undefined;

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var getOnDemandLazySlides = exports.getOnDemandLazySlides = function getOnDemandLazySlides(spec) {
  var onDemandSlides = [];
  var startIndex = lazyStartIndex(spec);
  var endIndex = lazyEndIndex(spec);
  for (var slideIndex = startIndex; slideIndex < endIndex; slideIndex++) {
    if (spec.lazyLoadedList.indexOf(slideIndex) < 0) {
      onDemandSlides.push(slideIndex);
    }
  }
  return onDemandSlides;
};

// return list of slides that need to be present
var getRequiredLazySlides = exports.getRequiredLazySlides = function getRequiredLazySlides(spec) {
  var requiredSlides = [];
  var startIndex = lazyStartIndex(spec);
  var endIndex = lazyEndIndex(spec);
  for (var slideIndex = startIndex; slideIndex < endIndex; slideIndex++) {
    requiredSlides.push(slideIndex);
  }
  return requiredSlides;
};

// startIndex that needs to be present
var lazyStartIndex = exports.lazyStartIndex = function lazyStartIndex(spec) {
  return spec.currentSlide - lazySlidesOnLeft(spec);
};
var lazyEndIndex = exports.lazyEndIndex = function lazyEndIndex(spec) {
  return spec.currentSlide + lazySlidesOnRight(spec);
};
var lazySlidesOnLeft = exports.lazySlidesOnLeft = function lazySlidesOnLeft(spec) {
  return spec.centerMode ? Math.floor(spec.slidesToShow / 2) + (parseInt(spec.centerPadding) > 0 ? 1 : 0) : 0;
};
var lazySlidesOnRight = exports.lazySlidesOnRight = function lazySlidesOnRight(spec) {
  return spec.centerMode ? Math.floor((spec.slidesToShow - 1) / 2) + 1 + (parseInt(spec.centerPadding) > 0 ? 1 : 0) : spec.slidesToShow;
};

// get width of an element
var getWidth = exports.getWidth = function getWidth(elem) {
  return elem && elem.offsetWidth || 0;
};
var getHeight = exports.getHeight = function getHeight(elem) {
  return elem && elem.offsetHeight || 0;
};
var getSwipeDirection = exports.getSwipeDirection = function getSwipeDirection(touchObject) {
  var verticalSwiping = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;

  var swipeAngle = void 0;
  var xDist = touchObject.startX - touchObject.curX;
  var yDist = touchObject.startY - touchObject.curY;
  var r = Math.atan2(yDist, xDist);
  swipeAngle = Math.round(r * 180 / Math.PI);
  if (swipeAngle < 0) {
    swipeAngle = 360 - Math.abs(swipeAngle);
  }
  if (swipeAngle <= 45 && swipeAngle >= 0 || swipeAngle <= 360 && swipeAngle >= 315) {
    return 'left';
  }
  if (swipeAngle >= 135 && swipeAngle <= 225) {
    return 'right';
  }
  if (verticalSwiping === true) {
    if (swipeAngle >= 35 && swipeAngle <= 135) {
      return 'up';
    } else {
      return 'down';
    }
  }

  return 'vertical';
};

// whether or not we can go next
var canGoNext = exports.canGoNext = function canGoNext(spec) {
  var canGo = true;
  if (!spec.infinite) {
    if (spec.centerMode && spec.currentSlide >= spec.slideCount - 1) {
      canGo = false;
    } else if (spec.slideCount <= spec.slidesToShow || spec.currentSlide >= spec.slideCount - spec.slidesToShow) {
      canGo = false;
    }
  }
  return canGo;
};

// given an object and a list of keys, return new object with given keys
var extractObject = exports.extractObject = function extractObject(spec, keys) {
  var newObject = {};
  keys.forEach(function (key) {
    return newObject[key] = spec[key];
  });
  return newObject;
};

// get initialized state
var initializedState = exports.initializedState = function initializedState(spec) {
  // spec also contains listRef, trackRef
  var slideCount = spec.children.length;
  var listWidth = Math.ceil(getWidth(spec.listRef));
  var trackWidth = Math.ceil(getWidth(spec.trackRef));
  var slideWidth = void 0;
  if (!spec.vertical) {
    var centerPaddingAdj = spec.centerMode && parseInt(spec.centerPadding) * 2;
    if (typeof spec.centerPadding === 'string' && spec.centerPadding.slice(-1) === '%') {
      centerPaddingAdj *= listWidth / 100;
    }
    slideWidth = Math.ceil((listWidth - centerPaddingAdj) / spec.slidesToShow);
  } else {
    slideWidth = listWidth;
  }
  var slideHeight = spec.listRef && getHeight(spec.listRef.querySelector('[data-index="0"]'));
  var listHeight = slideHeight * spec.slidesToShow;
  var currentSlide = spec.currentSlide === undefined ? spec.initialSlide : spec.currentSlide;
  if (spec.rtl && spec.currentSlide === undefined) {
    currentSlide = slideCount - 1 - spec.initialSlide;
  }
  var lazyLoadedList = spec.lazyLoadedList || [];
  var slidesToLoad = getOnDemandLazySlides({ currentSlide: currentSlide, lazyLoadedList: lazyLoadedList }, spec);
  lazyLoadedList.concat(slidesToLoad);

  var state = {
    slideCount: slideCount,
    slideWidth: slideWidth,
    listWidth: listWidth,
    trackWidth: trackWidth,
    currentSlide: currentSlide,
    slideHeight: slideHeight,
    listHeight: listHeight,
    lazyLoadedList: lazyLoadedList
  };

  if (spec.autoplaying === null && spec.autoplay) {
    state['autoplaying'] = 'playing';
  }

  return state;
};

var slideHandler = exports.slideHandler = function slideHandler(spec) {
  var waitForAnimate = spec.waitForAnimate,
      animating = spec.animating,
      fade = spec.fade,
      infinite = spec.infinite,
      index = spec.index,
      slideCount = spec.slideCount,
      lazyLoadedList = spec.lazyLoadedList,
      lazyLoad = spec.lazyLoad,
      currentSlide = spec.currentSlide,
      centerMode = spec.centerMode,
      slidesToScroll = spec.slidesToScroll,
      slidesToShow = spec.slidesToShow,
      useCSS = spec.useCSS;

  if (waitForAnimate && animating) return {};
  var animationSlide = index;
  var finalSlide = void 0;
  var animationLeft = void 0;
  var finalLeft = void 0;
  var state = {};
  var nextState = {};
  if (fade) {
    if (!infinite && (index < 0 || index >= slideCount)) return {};
    if (index < 0) {
      animationSlide = index + slideCount;
    } else if (index >= slideCount) {
      animationSlide = index - slideCount;
    }
    if (lazyLoad && lazyLoadedList.indexOf(animationSlide) < 0) {
      lazyLoadedList.push(animationSlide);
    }
    state = {
      animating: true,
      currentSlide: animationSlide,
      lazyLoadedList: lazyLoadedList
    };
    nextState = { animating: false };
  } else {
    finalSlide = animationSlide;
    if (animationSlide < 0) {
      finalSlide = animationSlide + slideCount;
      if (!infinite) finalSlide = 0;else if (slideCount % slidesToScroll !== 0) {
        finalSlide = slideCount - slideCount % slidesToScroll;
      }
    } else if (!canGoNext(spec) && animationSlide > currentSlide) {
      animationSlide = finalSlide = currentSlide;
    } else if (centerMode && animationSlide >= slideCount) {
      animationSlide = infinite ? slideCount : slideCount - 1;
      finalSlide = infinite ? 0 : slideCount - 1;
    } else if (animationSlide >= slideCount) {
      finalSlide = animationSlide - slideCount;
      if (!infinite) finalSlide = slideCount - slidesToShow;else if (slideCount % slidesToScroll !== 0) finalSlide = 0;
    }
    animationLeft = getTrackLeft((0, _extends3['default'])({}, spec, { slideIndex: animationSlide }));
    finalLeft = getTrackLeft((0, _extends3['default'])({}, spec, { slideIndex: finalSlide }));
    if (!infinite) {
      if (animationLeft === finalLeft) animationSlide = finalSlide;
      animationLeft = finalLeft;
    }
    lazyLoad && lazyLoadedList.concat(getOnDemandLazySlides((0, _extends3['default'])({}, spec, { currentSlide: animationSlide })));
    if (!useCSS) {
      state = {
        currentSlide: finalSlide,
        trackStyle: getTrackCSS((0, _extends3['default'])({}, spec, { left: finalLeft })),
        lazyLoadedList: lazyLoadedList
      };
    } else {
      state = {
        animating: true,
        currentSlide: finalSlide,
        trackStyle: getTrackAnimateCSS((0, _extends3['default'])({}, spec, { left: animationLeft })),
        lazyLoadedList: lazyLoadedList
      };
      nextState = {
        animating: false,
        currentSlide: finalSlide,
        trackStyle: getTrackCSS((0, _extends3['default'])({}, spec, { left: finalLeft })),
        swipeLeft: null
      };
    }
  }
  return { state: state, nextState: nextState };
};

var changeSlide = exports.changeSlide = function changeSlide(spec, options) {
  var previousInt = void 0,
      slideOffset = void 0,
      targetSlide = void 0;
  var slidesToScroll = spec.slidesToScroll,
      slidesToShow = spec.slidesToShow,
      slideCount = spec.slideCount,
      currentSlide = spec.currentSlide,
      lazyLoad = spec.lazyLoad,
      infinite = spec.infinite;

  var unevenOffset = slideCount % slidesToScroll !== 0;
  var indexOffset = unevenOffset ? 0 : (slideCount - currentSlide) % slidesToScroll;

  if (options.message === 'previous') {
    slideOffset = indexOffset === 0 ? slidesToScroll : slidesToShow - indexOffset;
    targetSlide = currentSlide - slideOffset;
    if (lazyLoad && !infinite) {
      previousInt = currentSlide - slideOffset;
      targetSlide = previousInt === -1 ? slideCount - 1 : previousInt;
    }
  } else if (options.message === 'next') {
    slideOffset = indexOffset === 0 ? slidesToScroll : indexOffset;
    targetSlide = currentSlide + slideOffset;
    if (lazyLoad && !infinite) {
      targetSlide = (currentSlide + slidesToScroll) % slideCount + indexOffset;
    }
  } else if (options.message === 'dots') {
    // Click on dots
    targetSlide = options.index * options.slidesToScroll;
    if (targetSlide === options.currentSlide) {
      return null;
    }
  } else if (options.message === 'children') {
    // Click on the slides
    targetSlide = options.index;
    if (targetSlide === options.currentSlide) {
      return null;
    }
    if (infinite) {
      var direction = siblingDirection((0, _extends3['default'])({}, spec, { targetSlide: targetSlide }));
      if (targetSlide > options.currentSlide && direction === 'left') {
        targetSlide = targetSlide - slideCount;
      } else if (targetSlide < options.currentSlide && direction === 'right') {
        targetSlide = targetSlide + slideCount;
      }
    }
  } else if (options.message === 'index') {
    targetSlide = Number(options.index);
    if (targetSlide === options.currentSlide) {
      return null;
    }
  }
  return targetSlide;
};
var keyHandler = exports.keyHandler = function keyHandler(e, accessibility, rtl) {
  if (e.target.tagName.match('TEXTAREA|INPUT|SELECT') || !accessibility) {
    return '';
  }
  if (e.keyCode === 37) return rtl ? 'next' : 'previous';
  if (e.keyCode === 39) return rtl ? 'previous' : 'next';
  return '';
};

var swipeStart = exports.swipeStart = function swipeStart(e, swipe, draggable) {
  e.target.tagName === 'IMG' && e.preventDefault();
  if (!swipe || !draggable && e.type.indexOf('mouse') !== -1) return '';
  return {
    dragging: true,
    touchObject: {
      startX: e.touches ? e.touches[0].pageX : e.clientX,
      startY: e.touches ? e.touches[0].pageY : e.clientY,
      curX: e.touches ? e.touches[0].pageX : e.clientX,
      curY: e.touches ? e.touches[0].pageY : e.clientY
    }
  };
};
var swipeMove = exports.swipeMove = function swipeMove(e, spec) {
  // spec also contains, trackRef and slideIndex
  var scrolling = spec.scrolling,
      animating = spec.animating,
      vertical = spec.vertical,
      swipeToSlide = spec.swipeToSlide,
      verticalSwiping = spec.verticalSwiping,
      rtl = spec.rtl,
      currentSlide = spec.currentSlide,
      edgeFriction = spec.edgeFriction,
      edgeDragged = spec.edgeDragged,
      onEdge = spec.onEdge,
      swiped = spec.swiped,
      swiping = spec.swiping,
      slideCount = spec.slideCount,
      slidesToScroll = spec.slidesToScroll,
      infinite = spec.infinite,
      touchObject = spec.touchObject,
      swipeEvent = spec.swipeEvent,
      listHeight = spec.listHeight,
      listWidth = spec.listWidth;

  if (scrolling) return;
  if (animating) return e.preventDefault();
  if (vertical && swipeToSlide && verticalSwiping) e.preventDefault();
  var swipeLeft = void 0;
  var state = {};
  var curLeft = getTrackLeft(spec);
  touchObject.curX = e.touches ? e.touches[0].pageX : e.clientX;
  touchObject.curY = e.touches ? e.touches[0].pageY : e.clientY;
  touchObject.swipeLength = Math.round(Math.sqrt(Math.pow(touchObject.curX - touchObject.startX, 2)));
  var verticalSwipeLength = Math.round(Math.sqrt(Math.pow(touchObject.curY - touchObject.startY, 2)));
  if (!verticalSwiping && !swiping && verticalSwipeLength > 10) {
    return { scrolling: true };
  }
  if (verticalSwiping) touchObject.swipeLength = verticalSwipeLength;
  var positionOffset = (!rtl ? 1 : -1) * (touchObject.curX > touchObject.startX ? 1 : -1);
  if (verticalSwiping) {
    positionOffset = touchObject.curY > touchObject.startY ? 1 : -1;
  }

  var dotCount = Math.ceil(slideCount / slidesToScroll);
  var swipeDirection = getSwipeDirection(spec.touchObject, verticalSwiping);
  var touchSwipeLength = touchObject.swipeLength;
  if (!infinite) {
    if (currentSlide === 0 && swipeDirection === 'right' || currentSlide + 1 >= dotCount && swipeDirection === 'left' || !canGoNext(spec) && swipeDirection === 'left') {
      touchSwipeLength = touchObject.swipeLength * edgeFriction;
      if (edgeDragged === false && onEdge) {
        onEdge(swipeDirection);
        state['edgeDragged'] = true;
      }
    }
  }
  if (!swiped && swipeEvent) {
    swipeEvent(swipeDirection);
    state['swiped'] = true;
  }
  if (!vertical) {
    if (!rtl) {
      swipeLeft = curLeft + touchSwipeLength * positionOffset;
    } else {
      swipeLeft = curLeft - touchSwipeLength * positionOffset;
    }
  } else {
    swipeLeft = curLeft + touchSwipeLength * (listHeight / listWidth) * positionOffset;
  }
  if (verticalSwiping) {
    swipeLeft = curLeft + touchSwipeLength * positionOffset;
  }
  state = (0, _extends3['default'])({}, state, {
    touchObject: touchObject,
    swipeLeft: swipeLeft,
    trackStyle: getTrackCSS((0, _extends3['default'])({}, spec, { left: swipeLeft }))
  });
  if (Math.abs(touchObject.curX - touchObject.startX) < Math.abs(touchObject.curY - touchObject.startY) * 0.8) {
    return state;
  }
  if (touchObject.swipeLength > 10) {
    state['swiping'] = true;
    e.preventDefault();
  }
  return state;
};
var swipeEnd = exports.swipeEnd = function swipeEnd(e, spec) {
  var dragging = spec.dragging,
      swipe = spec.swipe,
      touchObject = spec.touchObject,
      listWidth = spec.listWidth,
      touchThreshold = spec.touchThreshold,
      verticalSwiping = spec.verticalSwiping,
      listHeight = spec.listHeight,
      currentSlide = spec.currentSlide,
      swipeToSlide = spec.swipeToSlide,
      scrolling = spec.scrolling,
      onSwipe = spec.onSwipe;

  if (!dragging) {
    if (swipe) e.preventDefault();
    return {};
  }
  var minSwipe = verticalSwiping ? listHeight / touchThreshold : listWidth / touchThreshold;
  var swipeDirection = getSwipeDirection(touchObject, verticalSwiping);
  // reset the state of touch related state variables.
  var state = {
    dragging: false,
    edgeDragged: false,
    scrolling: false,
    swiping: false,
    swiped: false,
    swipeLeft: null,
    touchObject: {}
  };
  if (scrolling) {
    return state;
  }
  if (!touchObject.swipeLength) {
    return state;
  }
  if (touchObject.swipeLength > minSwipe) {
    e.preventDefault();
    if (onSwipe) {
      onSwipe(swipeDirection);
    }
    var slideCount = void 0,
        newSlide = void 0;
    switch (swipeDirection) {
      case 'left':
      case 'up':
        newSlide = currentSlide + getSlideCount(spec);
        slideCount = swipeToSlide ? checkNavigable(spec, newSlide) : newSlide;
        state['currentDirection'] = 0;
        break;
      case 'right':
      case 'down':
        newSlide = currentSlide - getSlideCount(spec);
        slideCount = swipeToSlide ? checkNavigable(spec, newSlide) : newSlide;
        state['currentDirection'] = 1;
        break;
      default:
        slideCount = currentSlide;
    }
    state['triggerSlideHandler'] = slideCount;
  } else {
    // Adjust the track back to it's original position.
    var currentLeft = getTrackLeft(spec);
    state['trackStyle'] = getTrackAnimateCSS((0, _extends3['default'])({}, spec, { left: currentLeft }));
  }
  return state;
};
var getNavigableIndexes = exports.getNavigableIndexes = function getNavigableIndexes(spec) {
  var max = spec.infinite ? spec.slideCount * 2 : spec.slideCount;
  var breakpoint = spec.infinite ? spec.slidesToShow * -1 : 0;
  var counter = spec.infinite ? spec.slidesToShow * -1 : 0;
  var indexes = [];
  while (breakpoint < max) {
    indexes.push(breakpoint);
    breakpoint = counter + spec.slidesToScroll;
    counter += Math.min(spec.slidesToScroll, spec.slidesToShow);
  }
  return indexes;
};
var checkNavigable = exports.checkNavigable = function checkNavigable(spec, index) {
  var navigables = getNavigableIndexes(spec);
  var prevNavigable = 0;
  if (index > navigables[navigables.length - 1]) {
    index = navigables[navigables.length - 1];
  } else {
    for (var n in navigables) {
      if (index < navigables[n]) {
        index = prevNavigable;
        break;
      }
      prevNavigable = navigables[n];
    }
  }
  return index;
};
var getSlideCount = exports.getSlideCount = function getSlideCount(spec) {
  var centerOffset = spec.centerMode ? spec.slideWidth * Math.floor(spec.slidesToShow / 2) : 0;
  if (spec.swipeToSlide) {
    var swipedSlide = void 0;
    var slickList = spec.listRef;
    var slides = slickList.querySelectorAll('.slick-slide');
    Array.from(slides).every(function (slide) {
      if (!spec.vertical) {
        if (slide.offsetLeft - centerOffset + getWidth(slide) / 2 > spec.swipeLeft * -1) {
          swipedSlide = slide;
          return false;
        }
      } else {
        if (slide.offsetTop + getHeight(slide) / 2 > spec.swipeLeft * -1) {
          swipedSlide = slide;
          return false;
        }
      }

      return true;
    });

    if (!swipedSlide) {
      return 0;
    }
    var currentIndex = spec.rtl === true ? spec.slideCount - spec.currentSlide : spec.currentSlide;
    var slidesTraversed = Math.abs(swipedSlide.dataset.index - currentIndex) || 1;
    return slidesTraversed;
  } else {
    return spec.slidesToScroll;
  }
};

var checkSpecKeys = exports.checkSpecKeys = function checkSpecKeys(spec, keysArray) {
  return keysArray.reduce(function (value, key) {
    return value && spec.hasOwnProperty(key);
  }, true) ? null : console.error('Keys Missing:', spec);
};

var getTrackCSS = exports.getTrackCSS = function getTrackCSS(spec) {
  checkSpecKeys(spec, ['left', 'variableWidth', 'slideCount', 'slidesToShow', 'slideWidth']);
  var trackWidth = void 0,
      trackHeight = void 0;
  var trackChildren = spec.slideCount + 2 * spec.slidesToShow;
  if (!spec.vertical) {
    trackWidth = getTotalSlides(spec) * spec.slideWidth;
  } else {
    trackHeight = trackChildren * spec.slideHeight;
  }
  var style = {
    opacity: 1,
    transition: '',
    WebkitTransition: ''
  };
  if (spec.useTransform) {
    var WebkitTransform = !spec.vertical ? 'translate3d(' + spec.left + 'px, 0px, 0px)' : 'translate3d(0px, ' + spec.left + 'px, 0px)';
    var transform = !spec.vertical ? 'translate3d(' + spec.left + 'px, 0px, 0px)' : 'translate3d(0px, ' + spec.left + 'px, 0px)';
    var msTransform = !spec.vertical ? 'translateX(' + spec.left + 'px)' : 'translateY(' + spec.left + 'px)';
    style = (0, _extends3['default'])({}, style, {
      WebkitTransform: WebkitTransform,
      transform: transform,
      msTransform: msTransform
    });
  } else {
    if (spec.vertical) {
      style['top'] = spec.left;
    } else {
      style['left'] = spec.left;
    }
  }
  if (spec.fade) style = { opacity: 1 };
  if (trackWidth) style.width = trackWidth + 'px';
  if (trackHeight) style.height = trackHeight + 'px';

  // Fallback for IE8
  if (window && !window.addEventListener && window.attachEvent) {
    if (!spec.vertical) {
      style.marginLeft = spec.left + 'px';
    } else {
      style.marginTop = spec.left + 'px';
    }
  }

  return style;
};
var getTrackAnimateCSS = exports.getTrackAnimateCSS = function getTrackAnimateCSS(spec) {
  checkSpecKeys(spec, ['left', 'variableWidth', 'slideCount', 'slidesToShow', 'slideWidth', 'speed', 'cssEase']);
  var style = getTrackCSS(spec);
  // useCSS is true by default so it can be undefined
  if (spec.useTransform) {
    style.WebkitTransition = '-webkit-transform ' + spec.speed + 'ms ' + spec.cssEase;
    style.transition = 'transform ' + spec.speed + 'ms ' + spec.cssEase;
  } else {
    if (spec.vertical) {
      style.transition = 'top ' + spec.speed + 'ms ' + spec.cssEase;
    } else {
      style.transition = 'left ' + spec.speed + 'ms ' + spec.cssEase;
    }
  }
  return style;
};
var getTrackLeft = exports.getTrackLeft = function getTrackLeft(spec) {
  if (spec.unslick) {
    return 0;
  }

  checkSpecKeys(spec, ['slideIndex', 'trackRef', 'infinite', 'centerMode', 'slideCount', 'slidesToShow', 'slidesToScroll', 'slideWidth', 'listWidth', 'variableWidth', 'slideHeight']);

  var slideIndex = spec.slideIndex,
      trackRef = spec.trackRef,
      infinite = spec.infinite,
      centerMode = spec.centerMode,
      slideCount = spec.slideCount,
      slidesToShow = spec.slidesToShow,
      slidesToScroll = spec.slidesToScroll,
      slideWidth = spec.slideWidth,
      listWidth = spec.listWidth,
      variableWidth = spec.variableWidth,
      slideHeight = spec.slideHeight,
      fade = spec.fade,
      vertical = spec.vertical;


  var slideOffset = 0;
  var targetLeft = void 0;
  var targetSlide = void 0;
  var verticalOffset = 0;

  if (fade || spec.slideCount === 1) {
    return 0;
  }

  var slidesToOffset = 0;
  if (infinite) {
    slidesToOffset = -getPreClones(spec); // bring active slide to the beginning of visual area
    // if next scroll doesn't have enough children, just reach till the end of original slides instead of shifting slidesToScroll children
    if (slideCount % slidesToScroll !== 0 && slideIndex + slidesToScroll > slideCount) {
      slidesToOffset = -(slideIndex > slideCount ? slidesToShow - (slideIndex - slideCount) : slideCount % slidesToScroll);
    }
    // shift current slide to center of the frame
    if (centerMode) {
      slidesToOffset += parseInt(slidesToShow / 2);
    }
  } else {
    if (slideCount % slidesToScroll !== 0 && slideIndex + slidesToScroll > slideCount) {
      slidesToOffset = slidesToShow - slideCount % slidesToScroll;
    }
    if (centerMode) {
      slidesToOffset = parseInt(slidesToShow / 2);
    }
  }
  slideOffset = slidesToOffset * slideWidth;
  verticalOffset = slidesToOffset * slideHeight;

  if (!vertical) {
    targetLeft = slideIndex * slideWidth * -1 + slideOffset;
  } else {
    targetLeft = slideIndex * slideHeight * -1 + verticalOffset;
  }

  if (variableWidth === true) {
    var targetSlideIndex = void 0;
    var trackElem = trackRef;
    targetSlideIndex = slideIndex + getPreClones(spec);
    targetSlide = trackElem && trackElem.childNodes[targetSlideIndex];
    targetLeft = targetSlide ? targetSlide.offsetLeft * -1 : 0;
    if (centerMode === true) {
      targetSlideIndex = infinite ? slideIndex + getPreClones(spec) : slideIndex;
      targetSlide = trackElem && trackElem.children[targetSlideIndex];
      targetLeft = 0;
      for (var slide = 0; slide < targetSlideIndex; slide++) {
        targetLeft -= trackElem && trackElem.children[slide] && trackElem.children[slide].offsetWidth;
      }
      targetLeft -= parseInt(spec.centerPadding);
      targetLeft += targetSlide && (listWidth - targetSlide.offsetWidth) / 2;
    }
  }

  return targetLeft;
};

var getPreClones = exports.getPreClones = function getPreClones(spec) {
  if (spec.unslick || !spec.infinite) {
    return 0;
  }
  if (spec.variableWidth) {
    return spec.slideCount;
  }
  return spec.slidesToShow + (spec.centerMode ? 1 : 0);
};

var getPostClones = exports.getPostClones = function getPostClones(spec) {
  if (spec.unslick || !spec.infinite) {
    return 0;
  }
  return spec.slideCount;
};

var getTotalSlides = exports.getTotalSlides = function getTotalSlides(spec) {
  return spec.slideCount === 1 ? 1 : getPreClones(spec) + spec.slideCount + getPostClones(spec);
};
var siblingDirection = exports.siblingDirection = function siblingDirection(spec) {
  if (spec.targetSlide > spec.currentSlide) {
    if (spec.targetSlide > spec.currentSlide + slidesOnRight(spec)) {
      return 'left';
    }
    return 'right';
  } else {
    if (spec.targetSlide < spec.currentSlide - slidesOnLeft(spec)) {
      return 'right';
    }
    return 'left';
  }
};

var slidesOnRight = exports.slidesOnRight = function slidesOnRight(_ref) {
  var slidesToShow = _ref.slidesToShow,
      centerMode = _ref.centerMode,
      rtl = _ref.rtl,
      centerPadding = _ref.centerPadding;

  // returns no of slides on the right of active slide
  if (centerMode) {
    var right = (slidesToShow - 1) / 2 + 1;
    if (parseInt(centerPadding) > 0) right += 1;
    if (rtl && slidesToShow % 2 === 0) right += 1;
    return right;
  }
  if (rtl) {
    return 0;
  }
  return slidesToShow - 1;
};

var slidesOnLeft = exports.slidesOnLeft = function slidesOnLeft(_ref2) {
  var slidesToShow = _ref2.slidesToShow,
      centerMode = _ref2.centerMode,
      rtl = _ref2.rtl,
      centerPadding = _ref2.centerPadding;

  // returns no of slides on the left of active slide
  if (centerMode) {
    var left = (slidesToShow - 1) / 2 + 1;
    if (parseInt(centerPadding) > 0) left += 1;
    if (!rtl && slidesToShow % 2 === 0) left += 1;
    return left;
  }
  if (rtl) {
    return slidesToShow - 1;
  }
  return 0;
};

var canUseDOM = exports.canUseDOM = function canUseDOM() {
  return !!(typeof window !== 'undefined' && window.document && window.document.createElement);
};

/***/ }),

/***/ "./node_modules/json2mq/index.js":
/*!***************************************!*\
  !*** ./node_modules/json2mq/index.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var camel2hyphen = __webpack_require__(/*! string-convert/camel2hyphen */ "./node_modules/string-convert/camel2hyphen.js");

var isDimension = function (feature) {
  var re = /[height|width]$/;
  return re.test(feature);
};

var obj2mq = function (obj) {
  var mq = '';
  var features = Object.keys(obj);
  features.forEach(function (feature, index) {
    var value = obj[feature];
    feature = camel2hyphen(feature);
    // Add px to dimension features
    if (isDimension(feature) && typeof value === 'number') {
      value = value + 'px';
    }
    if (value === true) {
      mq += feature;
    } else if (value === false) {
      mq += 'not ' + feature;
    } else {
      mq += '(' + feature + ': ' + value + ')';
    }
    if (index < features.length-1) {
      mq += ' and '
    }
  });
  return mq;
};

var json2mq = function (query) {
  var mq = '';
  if (typeof query === 'string') {
    return query;
  }
  // Handling array of media queries
  if (query instanceof Array) {
    query.forEach(function (q, index) {
      mq += obj2mq(q);
      if (index < query.length-1) {
        mq += ', '
      }
    });
    return mq;
  }
  // Handling single media query
  return obj2mq(query);
};

module.exports = json2mq;

/***/ }),

/***/ "./node_modules/string-convert/camel2hyphen.js":
/*!*****************************************************!*\
  !*** ./node_modules/string-convert/camel2hyphen.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var camel2hyphen = function (str) {
  return str
          .replace(/[A-Z]/g, function (match) {
            return '-' + match.toLowerCase();
          })
          .toLowerCase();
};

module.exports = camel2hyphen;

/***/ })

}]);