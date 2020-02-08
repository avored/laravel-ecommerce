(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[47],{

/***/ "./node_modules/ant-design-vue/lib/avatar/Avatar.js":
/*!**********************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/avatar/Avatar.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _defineProperty2 = __webpack_require__(/*! babel-runtime/helpers/defineProperty */ "./node_modules/babel-runtime/helpers/defineProperty.js");

var _defineProperty3 = _interopRequireDefault(_defineProperty2);

var _extends4 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends5 = _interopRequireDefault(_extends4);

var _configProvider = __webpack_require__(/*! ../config-provider */ "./node_modules/ant-design-vue/lib/config-provider/index.js");

var _icon = __webpack_require__(/*! ../icon */ "./node_modules/ant-design-vue/lib/icon/index.js");

var _icon2 = _interopRequireDefault(_icon);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports['default'] = {
  name: 'AAvatar',
  props: {
    prefixCls: {
      type: String,
      'default': undefined
    },
    shape: {
      validator: function validator(val) {
        return ['circle', 'square'].includes(val);
      },
      'default': 'circle'
    },
    size: {
      validator: function validator(val) {
        return typeof val === 'number' || ['small', 'large', 'default'].includes(val);
      },
      'default': 'default'
    },
    src: String,
    /** Srcset of image avatar */
    srcSet: String,
    icon: String,
    alt: String,
    loadError: Function
  },
  inject: {
    configProvider: { 'default': function _default() {
        return _configProvider.ConfigConsumerProps;
      } }
  },
  data: function data() {
    return {
      isImgExist: true,
      scale: 1
    };
  },

  watch: {
    src: function src() {
      var _this = this;

      this.$nextTick(function () {
        _this.isImgExist = true;
        _this.scale = 1;
        // force uodate for position
        _this.$forceUpdate();
      });
    }
  },
  mounted: function mounted() {
    var _this2 = this;

    this.prevChildren = this.$slots['default'];
    this.prevState = (0, _extends5['default'])({}, this.$data);
    this.$nextTick(function () {
      _this2.setScale();
    });
  },
  updated: function updated() {
    var _this3 = this;

    if (this.preChildren !== this.$slots['default'] || this.prevState.scale !== this.$data.scale && this.$data.scale === 1 || this.prevState.isImgExist !== this.$data.isImgExist) {
      this.$nextTick(function () {
        _this3.setScale();
      });
    }
    this.preChildren = this.$slots['default'];
    this.prevState = (0, _extends5['default'])({}, this.$data);
  },

  methods: {
    setScale: function setScale() {
      var childrenNode = this.$refs.avatarChildren;
      if (childrenNode) {
        var childrenWidth = childrenNode.offsetWidth;
        var avatarWidth = this.$el.getBoundingClientRect().width;
        if (avatarWidth - 8 < childrenWidth) {
          this.scale = (avatarWidth - 8) / childrenWidth;
        } else {
          this.scale = 1;
        }
        this.$forceUpdate();
      }
    },
    handleImgLoadError: function handleImgLoadError() {
      var loadError = this.$props.loadError;

      var errorFlag = loadError ? loadError() : undefined;
      if (errorFlag !== false) {
        this.isImgExist = false;
      }
    }
  },
  render: function render() {
    var _sizeCls, _extends3;

    var h = arguments[0];
    var _$props = this.$props,
        customizePrefixCls = _$props.prefixCls,
        shape = _$props.shape,
        size = _$props.size,
        src = _$props.src,
        icon = _$props.icon,
        alt = _$props.alt,
        srcSet = _$props.srcSet;


    var getPrefixCls = this.configProvider.getPrefixCls;
    var prefixCls = getPrefixCls('avatar', customizePrefixCls);

    var _$data = this.$data,
        isImgExist = _$data.isImgExist,
        scale = _$data.scale;


    var sizeCls = (_sizeCls = {}, (0, _defineProperty3['default'])(_sizeCls, prefixCls + '-lg', size === 'large'), (0, _defineProperty3['default'])(_sizeCls, prefixCls + '-sm', size === 'small'), _sizeCls);

    var classString = (0, _extends5['default'])((0, _defineProperty3['default'])({}, prefixCls, true), sizeCls, (_extends3 = {}, (0, _defineProperty3['default'])(_extends3, prefixCls + '-' + shape, shape), (0, _defineProperty3['default'])(_extends3, prefixCls + '-image', src && isImgExist), (0, _defineProperty3['default'])(_extends3, prefixCls + '-icon', icon), _extends3));

    var sizeStyle = typeof size === 'number' ? {
      width: size + 'px',
      height: size + 'px',
      lineHeight: size + 'px',
      fontSize: icon ? size / 2 + 'px' : '18px'
    } : {};

    var children = this.$slots['default'];
    if (src && isImgExist) {
      children = h('img', {
        attrs: { src: src, srcSet: srcSet, alt: alt },
        on: {
          'error': this.handleImgLoadError
        }
      });
    } else if (icon) {
      children = h(_icon2['default'], {
        attrs: { type: icon }
      });
    } else {
      var childrenNode = this.$refs.avatarChildren;
      if (childrenNode || scale !== 1 && childrenNode) {
        var transformString = 'scale(' + scale + ') translateX(-50%)';
        var childrenStyle = {
          msTransform: transformString,
          WebkitTransform: transformString,
          transform: transformString
        };
        var sizeChildrenStyle = typeof size === 'number' ? {
          lineHeight: size + 'px'
        } : {};
        children = h(
          'span',
          {
            'class': prefixCls + '-string',
            ref: 'avatarChildren',
            style: (0, _extends5['default'])({}, sizeChildrenStyle, childrenStyle)
          },
          [children]
        );
      } else {
        children = h(
          'span',
          { 'class': prefixCls + '-string', ref: 'avatarChildren' },
          [children]
        );
      }
    }
    return h(
      'span',
      { on: this.$listeners, 'class': classString, style: sizeStyle },
      [children]
    );
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/avatar/index.js":
/*!*********************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/avatar/index.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _Avatar = __webpack_require__(/*! ./Avatar */ "./node_modules/ant-design-vue/lib/avatar/Avatar.js");

var _Avatar2 = _interopRequireDefault(_Avatar);

var _base = __webpack_require__(/*! ../base */ "./node_modules/ant-design-vue/lib/base/index.js");

var _base2 = _interopRequireDefault(_base);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

/* istanbul ignore next */
_Avatar2['default'].install = function (Vue) {
  Vue.use(_base2['default']);
  Vue.component(_Avatar2['default'].name, _Avatar2['default']);
};

exports['default'] = _Avatar2['default'];

/***/ })

}]);