(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[2],{

/***/ "./node_modules/ant-design-vue/lib/progress/index.js":
/*!***********************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/progress/index.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.ProgressProps = undefined;

var _progress = __webpack_require__(/*! ./progress */ "./node_modules/ant-design-vue/lib/progress/progress.js");

Object.defineProperty(exports, 'ProgressProps', {
  enumerable: true,
  get: function get() {
    return _progress.ProgressProps;
  }
});

var _progress2 = _interopRequireDefault(_progress);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

/* istanbul ignore next */
_progress2['default'].install = function (Vue) {
  Vue.component(_progress2['default'].name, _progress2['default']);
};

exports['default'] = _progress2['default'];

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/progress/progress.js":
/*!**************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/progress/progress.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.ProgressProps = exports.ProgressSize = exports.ProgressType = undefined;

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _defineProperty2 = __webpack_require__(/*! babel-runtime/helpers/defineProperty */ "./node_modules/babel-runtime/helpers/defineProperty.js");

var _defineProperty3 = _interopRequireDefault(_defineProperty2);

var _objectWithoutProperties2 = __webpack_require__(/*! babel-runtime/helpers/objectWithoutProperties */ "./node_modules/babel-runtime/helpers/objectWithoutProperties.js");

var _objectWithoutProperties3 = _interopRequireDefault(_objectWithoutProperties2);

var _classnames = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");

var _classnames2 = _interopRequireDefault(_classnames);

var _vueTypes = __webpack_require__(/*! ../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _propsUtil = __webpack_require__(/*! ../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

var _icon = __webpack_require__(/*! ../icon */ "./node_modules/ant-design-vue/lib/icon/index.js");

var _icon2 = _interopRequireDefault(_icon);

var _vcProgress = __webpack_require__(/*! ../vc-progress */ "./node_modules/ant-design-vue/lib/vc-progress/index.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

function addUnit(num, unit) {
  var unitType = unit || 'px';
  return num ? num + unitType : null;
}
var statusColorMap = {
  normal: '#108ee9',
  exception: '#ff5500',
  success: '#87d068'
};

var ProgressType = exports.ProgressType = _vueTypes2['default'].oneOf(['line', 'circle', 'dashboard']);
var ProgressSize = exports.ProgressSize = _vueTypes2['default'].oneOf(['default', 'small']);

var ProgressProps = exports.ProgressProps = {
  prefixCls: _vueTypes2['default'].string,
  type: ProgressType,
  percent: _vueTypes2['default'].number,
  successPercent: _vueTypes2['default'].number,
  format: _vueTypes2['default'].func,
  status: _vueTypes2['default'].oneOf(['normal', 'success', 'active', 'exception']),
  showInfo: _vueTypes2['default'].bool,
  strokeWidth: _vueTypes2['default'].number,
  strokeLinecap: _vueTypes2['default'].oneOf(['round', 'square']),
  strokeColor: _vueTypes2['default'].string,
  trailColor: _vueTypes2['default'].string,
  width: _vueTypes2['default'].number,
  gapDegree: _vueTypes2['default'].number,
  gapPosition: _vueTypes2['default'].oneOf(['top', 'bottom', 'left', 'right']),
  size: ProgressSize
};

var validProgress = function validProgress(progress) {
  if (!progress || progress < 0) {
    return 0;
  } else if (progress > 100) {
    return 100;
  }
  return progress;
};

exports['default'] = {
  name: 'AProgress',
  props: (0, _propsUtil.initDefaultProps)(ProgressProps, {
    type: 'line',
    percent: 0,
    showInfo: true,
    trailColor: '#f3f3f3',
    prefixCls: 'ant-progress',
    size: 'default'
  }),

  render: function render() {
    var _classNames;

    var h = arguments[0];

    var props = (0, _propsUtil.getOptionProps)(this);
    var prefixCls = props.prefixCls,
        _props$percent = props.percent,
        percent = _props$percent === undefined ? 0 : _props$percent,
        status = props.status,
        format = props.format,
        trailColor = props.trailColor,
        size = props.size,
        successPercent = props.successPercent,
        type = props.type,
        strokeWidth = props.strokeWidth,
        width = props.width,
        showInfo = props.showInfo,
        _props$gapDegree = props.gapDegree,
        gapDegree = _props$gapDegree === undefined ? 0 : _props$gapDegree,
        gapPosition = props.gapPosition,
        strokeColor = props.strokeColor,
        _props$strokeLinecap = props.strokeLinecap,
        strokeLinecap = _props$strokeLinecap === undefined ? 'round' : _props$strokeLinecap,
        restProps = (0, _objectWithoutProperties3['default'])(props, ['prefixCls', 'percent', 'status', 'format', 'trailColor', 'size', 'successPercent', 'type', 'strokeWidth', 'width', 'showInfo', 'gapDegree', 'gapPosition', 'strokeColor', 'strokeLinecap']);

    var progressStatus = parseInt(successPercent ? successPercent.toString() : percent.toString(), 10) >= 100 && !('status' in props) ? 'success' : status || 'normal';
    var progressInfo = void 0;
    var progress = void 0;
    var textFormatter = format || function (percentNumber) {
      return percentNumber + '%';
    };

    if (showInfo) {
      var text = void 0;
      var iconType = type === 'circle' || type === 'dashboard' ? '' : '-circle';
      if (format || progressStatus !== 'exception' && progressStatus !== 'success') {
        text = textFormatter(validProgress(percent), validProgress(successPercent));
      } else if (progressStatus === 'exception') {
        text = h(_icon2['default'], {
          attrs: { type: 'close' + iconType, theme: type === 'line' ? 'filled' : 'outlined' }
        });
      } else if (progressStatus === 'success') {
        text = h(_icon2['default'], {
          attrs: { type: 'check' + iconType, theme: type === 'line' ? 'filled' : 'outlined' }
        });
      }
      progressInfo = h(
        'span',
        { 'class': prefixCls + '-text', attrs: { title: typeof text === 'string' ? text : undefined }
        },
        [text]
      );
    }

    if (type === 'line') {
      var percentStyle = {
        width: validProgress(percent) + '%',
        height: (strokeWidth || (size === 'small' ? 6 : 8)) + 'px',
        background: strokeColor,
        borderRadius: strokeLinecap === 'square' ? 0 : '100px'
      };
      var successPercentStyle = {
        width: validProgress(successPercent) + '%',
        height: (strokeWidth || (size === 'small' ? 6 : 8)) + 'px',
        borderRadius: strokeLinecap === 'square' ? 0 : '100px'
      };
      var successSegment = successPercent !== undefined ? h('div', { 'class': prefixCls + '-success-bg', style: successPercentStyle }) : null;
      progress = h('div', [h(
        'div',
        { 'class': prefixCls + '-outer' },
        [h(
          'div',
          { 'class': prefixCls + '-inner' },
          [h('div', { 'class': prefixCls + '-bg', style: percentStyle }), successSegment]
        )]
      ), progressInfo]);
    } else if (type === 'circle' || type === 'dashboard') {
      var circleSize = width || 120;
      var circleStyle = {
        width: addUnit(circleSize),
        height: addUnit(circleSize),
        fontSize: addUnit(circleSize * 0.15 + 6)
      };
      var circleWidth = strokeWidth || 6;
      var gapPos = gapPosition || type === 'dashboard' && 'bottom' || 'top';
      var gapDeg = gapDegree || type === 'dashboard' && 75;
      progress = h(
        'div',
        { 'class': prefixCls + '-inner', style: circleStyle },
        [h(_vcProgress.Circle, {
          attrs: {
            percent: validProgress(percent),
            strokeWidth: circleWidth,
            trailWidth: circleWidth,
            strokeColor: strokeColor || statusColorMap[progressStatus],
            strokeLinecap: strokeLinecap,
            trailColor: trailColor,
            prefixCls: prefixCls,
            gapDegree: gapDeg || 0,
            gapPosition: gapPos
          }
        }), progressInfo]
      );
    }

    var classString = (0, _classnames2['default'])(prefixCls, (_classNames = {}, (0, _defineProperty3['default'])(_classNames, prefixCls + '-' + (type === 'dashboard' && 'circle' || type), true), (0, _defineProperty3['default'])(_classNames, prefixCls + '-status-' + progressStatus, true), (0, _defineProperty3['default'])(_classNames, prefixCls + '-show-info', showInfo), (0, _defineProperty3['default'])(_classNames, prefixCls + '-' + size, size), _classNames));

    var progressProps = {
      props: (0, _extends3['default'])({}, restProps),
      on: this.$listeners,
      'class': classString
    };
    return h(
      'div',
      progressProps,
      [progress]
    );
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/upload/Dragger.js":
/*!***********************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/upload/Dragger.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _propsUtil = __webpack_require__(/*! ../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

var _Upload = __webpack_require__(/*! ./Upload */ "./node_modules/ant-design-vue/lib/upload/Upload.js");

var _Upload2 = _interopRequireDefault(_Upload);

var _interface = __webpack_require__(/*! ./interface */ "./node_modules/ant-design-vue/lib/upload/interface.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports['default'] = {
  name: 'AUploadDragger',
  props: _interface.UploadProps,
  render: function render() {
    var h = arguments[0];

    var props = (0, _propsUtil.getOptionProps)(this);
    var draggerProps = {
      props: (0, _extends3['default'])({}, props, {
        type: 'drag'
      }),
      on: this.$listeners,
      style: { height: this.height }
    };
    return h(
      _Upload2['default'],
      draggerProps,
      [this.$slots['default']]
    );
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/upload/Upload.js":
/*!**********************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/upload/Upload.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.UploadProps = undefined;

var _defineProperty2 = __webpack_require__(/*! babel-runtime/helpers/defineProperty */ "./node_modules/babel-runtime/helpers/defineProperty.js");

var _defineProperty3 = _interopRequireDefault(_defineProperty2);

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _classnames = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");

var _classnames2 = _interopRequireDefault(_classnames);

var _uniqBy = __webpack_require__(/*! lodash/uniqBy */ "./node_modules/lodash/uniqBy.js");

var _uniqBy2 = _interopRequireDefault(_uniqBy);

var _vcUpload = __webpack_require__(/*! ../vc-upload */ "./node_modules/ant-design-vue/lib/vc-upload/index.js");

var _vcUpload2 = _interopRequireDefault(_vcUpload);

var _BaseMixin = __webpack_require__(/*! ../_util/BaseMixin */ "./node_modules/ant-design-vue/lib/_util/BaseMixin.js");

var _BaseMixin2 = _interopRequireDefault(_BaseMixin);

var _propsUtil = __webpack_require__(/*! ../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

var _LocaleReceiver = __webpack_require__(/*! ../locale-provider/LocaleReceiver */ "./node_modules/ant-design-vue/lib/locale-provider/LocaleReceiver.js");

var _LocaleReceiver2 = _interopRequireDefault(_LocaleReceiver);

var _default = __webpack_require__(/*! ../locale-provider/default */ "./node_modules/ant-design-vue/lib/locale-provider/default.js");

var _default2 = _interopRequireDefault(_default);

var _Dragger = __webpack_require__(/*! ./Dragger */ "./node_modules/ant-design-vue/lib/upload/Dragger.js");

var _Dragger2 = _interopRequireDefault(_Dragger);

var _UploadList = __webpack_require__(/*! ./UploadList */ "./node_modules/ant-design-vue/lib/upload/UploadList.js");

var _UploadList2 = _interopRequireDefault(_UploadList);

var _interface = __webpack_require__(/*! ./interface */ "./node_modules/ant-design-vue/lib/upload/interface.js");

var _utils = __webpack_require__(/*! ./utils */ "./node_modules/ant-design-vue/lib/upload/utils.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports.UploadProps = _interface.UploadProps;
exports['default'] = {
  name: 'AUpload',
  mixins: [_BaseMixin2['default']],
  inheritAttrs: false,
  Dragger: _Dragger2['default'],
  props: (0, _propsUtil.initDefaultProps)(_interface.UploadProps, {
    prefixCls: 'ant-upload',
    type: 'select',
    multiple: false,
    action: '',
    data: {},
    accept: '',
    beforeUpload: _utils.T,
    showUploadList: true,
    listType: 'text', // or pictrue
    disabled: false,
    supportServerRender: true
  }),
  // recentUploadStatus: boolean | PromiseLike<any>;
  data: function data() {
    this.progressTimer = null;
    return {
      sFileList: this.fileList || this.defaultFileList || [],
      dragState: 'drop'
    };
  },

  watch: {
    fileList: function fileList(val) {
      this.sFileList = val || [];
    }
  },
  beforeDestroy: function beforeDestroy() {
    this.clearProgressTimer();
  },

  methods: {
    onStart: function onStart(file) {
      var targetItem = (0, _utils.fileToObject)(file);
      targetItem.status = 'uploading';
      var nextFileList = this.sFileList.concat();
      var fileIndex = nextFileList.findIndex(function (_ref) {
        var uid = _ref.uid;
        return uid === targetItem.uid;
      });
      if (fileIndex === -1) {
        nextFileList.push(targetItem);
      } else {
        nextFileList[fileIndex] = targetItem;
      }
      this.onChange({
        file: targetItem,
        fileList: nextFileList
      });
      // fix ie progress
      if (!window.FormData) {
        this.autoUpdateProgress(0, targetItem);
      }
    },
    autoUpdateProgress: function autoUpdateProgress(_, file) {
      var _this = this;

      var getPercent = (0, _utils.genPercentAdd)();
      var curPercent = 0;
      this.clearProgressTimer();
      this.progressTimer = setInterval(function () {
        curPercent = getPercent(curPercent);
        _this.onProgress({
          percent: curPercent * 100
        }, file);
      }, 200);
    },
    onSuccess: function onSuccess(response, file) {
      this.clearProgressTimer();
      try {
        if (typeof response === 'string') {
          response = JSON.parse(response);
        }
      } catch (e) {
        /* do nothing */
      }
      var fileList = this.sFileList;
      var targetItem = (0, _utils.getFileItem)(file, fileList);
      // removed
      if (!targetItem) {
        return;
      }
      targetItem.status = 'done';
      targetItem.response = response;
      this.onChange({
        file: (0, _extends3['default'])({}, targetItem),
        fileList: fileList
      });
    },
    onProgress: function onProgress(e, file) {
      var fileList = this.sFileList;
      var targetItem = (0, _utils.getFileItem)(file, fileList);
      // removed
      if (!targetItem) {
        return;
      }
      targetItem.percent = e.percent;
      this.onChange({
        event: e,
        file: (0, _extends3['default'])({}, targetItem),
        fileList: this.sFileList
      });
    },
    onError: function onError(error, response, file) {
      this.clearProgressTimer();
      var fileList = this.sFileList;
      var targetItem = (0, _utils.getFileItem)(file, fileList);
      // removed
      if (!targetItem) {
        return;
      }
      targetItem.error = error;
      targetItem.response = response;
      targetItem.status = 'error';
      this.onChange({
        file: (0, _extends3['default'])({}, targetItem),
        fileList: fileList
      });
    },
    handleRemove: function handleRemove(file) {
      var _this2 = this;

      var _getOptionProps = (0, _propsUtil.getOptionProps)(this),
          remove = _getOptionProps.remove;

      Promise.resolve(typeof remove === 'function' ? remove(file) : remove).then(function (ret) {
        // Prevent removing file
        if (ret === false) {
          return;
        }

        var removedFileList = (0, _utils.removeFileItem)(file, _this2.sFileList);
        if (removedFileList) {
          _this2.onChange({
            file: file,
            fileList: removedFileList
          });
        }
      });
    },
    handleManualRemove: function handleManualRemove(file) {
      this.$refs.uploadRef.abort(file);
      file.status = 'removed'; // eslint-disable-line
      this.handleRemove(file);
    },
    onChange: function onChange(info) {
      if (!(0, _propsUtil.hasProp)(this, 'fileList')) {
        this.setState({ sFileList: info.fileList });
      }
      this.$emit('change', info);
    },
    onFileDrop: function onFileDrop(e) {
      this.setState({
        dragState: e.type
      });
    },
    reBeforeUpload: function reBeforeUpload(file, fileList) {
      if (!this.beforeUpload) {
        return true;
      }
      var result = this.beforeUpload(file, fileList);
      if (result === false) {
        this.onChange({
          file: file,
          fileList: (0, _uniqBy2['default'])(this.sFileList.concat(fileList.map(_utils.fileToObject)), function (item) {
            return item.uid;
          })
        });
        return false;
      } else if (result && result.then) {
        return result;
      }
      return true;
    },
    clearProgressTimer: function clearProgressTimer() {
      clearInterval(this.progressTimer);
    },
    renderUploadList: function renderUploadList(locale) {
      var h = this.$createElement;

      var _getOptionProps2 = (0, _propsUtil.getOptionProps)(this),
          _getOptionProps2$show = _getOptionProps2.showUploadList,
          showUploadList = _getOptionProps2$show === undefined ? {} : _getOptionProps2$show,
          listType = _getOptionProps2.listType;

      var showRemoveIcon = showUploadList.showRemoveIcon,
          showPreviewIcon = showUploadList.showPreviewIcon;

      var uploadListProps = {
        props: {
          listType: listType,
          items: this.sFileList,
          showRemoveIcon: showRemoveIcon,
          showPreviewIcon: showPreviewIcon,
          locale: (0, _extends3['default'])({}, locale, this.$props.locale)
        },
        on: {
          remove: this.handleManualRemove
        }
      };
      if (this.$listeners.preview) {
        uploadListProps.on.preview = this.$listeners.preview;
      }
      return h(_UploadList2['default'], uploadListProps);
    }
  },
  render: function render() {
    var _classNames2;

    var h = arguments[0];

    var _getOptionProps3 = (0, _propsUtil.getOptionProps)(this),
        _getOptionProps3$pref = _getOptionProps3.prefixCls,
        prefixCls = _getOptionProps3$pref === undefined ? '' : _getOptionProps3$pref,
        showUploadList = _getOptionProps3.showUploadList,
        listType = _getOptionProps3.listType,
        type = _getOptionProps3.type,
        disabled = _getOptionProps3.disabled;

    var vcUploadProps = {
      props: (0, _extends3['default'])({}, this.$props, {
        beforeUpload: this.reBeforeUpload
      }),
      on: {
        // ...this.$listeners,
        start: this.onStart,
        error: this.onError,
        progress: this.onProgress,
        success: this.onSuccess
      },
      ref: 'uploadRef',
      'class': prefixCls + '-btn',
      attrs: this.$attrs
    };

    var uploadList = showUploadList ? h(_LocaleReceiver2['default'], {
      attrs: {
        componentName: 'Upload',
        defaultLocale: _default2['default'].Upload
      },
      scopedSlots: { 'default': this.renderUploadList }
    }) : null;

    var children = this.$slots['default'];

    if (type === 'drag') {
      var _classNames;

      var dragCls = (0, _classnames2['default'])(prefixCls, (_classNames = {}, (0, _defineProperty3['default'])(_classNames, prefixCls + '-drag', true), (0, _defineProperty3['default'])(_classNames, prefixCls + '-drag-uploading', this.sFileList.some(function (file) {
        return file.status === 'uploading';
      })), (0, _defineProperty3['default'])(_classNames, prefixCls + '-drag-hover', this.dragState === 'dragover'), (0, _defineProperty3['default'])(_classNames, prefixCls + '-disabled', disabled), _classNames));
      return h('span', [h(
        'div',
        {
          'class': dragCls,
          on: {
            'drop': this.onFileDrop,
            'dragover': this.onFileDrop,
            'dragleave': this.onFileDrop
          }
        },
        [h(
          _vcUpload2['default'],
          vcUploadProps,
          [h(
            'div',
            { 'class': prefixCls + '-drag-container' },
            [children]
          )]
        )]
      ), uploadList]);
    }

    var uploadButtonCls = (0, _classnames2['default'])(prefixCls, (_classNames2 = {}, (0, _defineProperty3['default'])(_classNames2, prefixCls + '-select', true), (0, _defineProperty3['default'])(_classNames2, prefixCls + '-select-' + listType, true), (0, _defineProperty3['default'])(_classNames2, prefixCls + '-disabled', disabled), _classNames2));
    var uploadButton = h(
      'div',
      { 'class': uploadButtonCls, style: { display: children ? '' : 'none' } },
      [h(
        _vcUpload2['default'],
        vcUploadProps,
        [children]
      )]
    );

    if (listType === 'picture-card') {
      return h('span', [uploadList, uploadButton]);
    }
    return h('span', [uploadButton, uploadList]);
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/upload/UploadList.js":
/*!**************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/upload/UploadList.js ***!
  \**************************************************************/
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

var _BaseMixin = __webpack_require__(/*! ../_util/BaseMixin */ "./node_modules/ant-design-vue/lib/_util/BaseMixin.js");

var _BaseMixin2 = _interopRequireDefault(_BaseMixin);

var _propsUtil = __webpack_require__(/*! ../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

var _getTransitionProps = __webpack_require__(/*! ../_util/getTransitionProps */ "./node_modules/ant-design-vue/lib/_util/getTransitionProps.js");

var _getTransitionProps2 = _interopRequireDefault(_getTransitionProps);

var _icon = __webpack_require__(/*! ../icon */ "./node_modules/ant-design-vue/lib/icon/index.js");

var _icon2 = _interopRequireDefault(_icon);

var _tooltip = __webpack_require__(/*! ../tooltip */ "./node_modules/ant-design-vue/lib/tooltip/index.js");

var _tooltip2 = _interopRequireDefault(_tooltip);

var _progress = __webpack_require__(/*! ../progress */ "./node_modules/ant-design-vue/lib/progress/index.js");

var _progress2 = _interopRequireDefault(_progress);

var _classnames = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");

var _classnames2 = _interopRequireDefault(_classnames);

var _interface = __webpack_require__(/*! ./interface */ "./node_modules/ant-design-vue/lib/upload/interface.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var imageTypes = ['image', 'webp', 'png', 'svg', 'gif', 'jpg', 'jpeg', 'bmp', 'ico'];
// https://developer.mozilla.org/en-US/docs/Web/API/FileReader/readAsDataURL
var previewFile = function previewFile(file, callback) {
  if (file.type && !imageTypes.includes(file.type)) {
    callback('');
  }
  var reader = new window.FileReader();
  reader.onloadend = function () {
    return callback(reader.result);
  };
  reader.readAsDataURL(file);
};

var extname = function extname(url) {
  if (!url) {
    return '';
  }
  var temp = url.split('/');
  var filename = temp[temp.length - 1];
  var filenameWithoutSuffix = filename.split(/#|\?/)[0];
  return (/\.[^./\\]*$/.exec(filenameWithoutSuffix) || [''])[0];
};

var isImageUrl = function isImageUrl(file) {
  if (imageTypes.includes(file.type)) {
    return true;
  }
  var url = file.thumbUrl || file.url;
  var extension = extname(url);
  if (/^data:image\//.test(url) || /(webp|svg|png|gif|jpg|jpeg|bmp|ico)$/i.test(extension)) {
    return true;
  } else if (/^data:/.test(url)) {
    // other file types of base64
    return false;
  } else if (extension) {
    // other file types which have extension
    return false;
  }
  return true;
};

exports['default'] = {
  name: 'AUploadList',
  mixins: [_BaseMixin2['default']],
  props: (0, _propsUtil.initDefaultProps)(_interface.UploadListProps, {
    listType: 'text', // or picture
    progressAttr: {
      strokeWidth: 2,
      showInfo: false
    },
    prefixCls: 'ant-upload',
    showRemoveIcon: true,
    showPreviewIcon: true
  }),
  updated: function updated() {
    var _this = this;

    this.$nextTick(function () {
      if (_this.listType !== 'picture' && _this.listType !== 'picture-card') {
        return;
      }
      (_this.items || []).forEach(function (file) {
        if (typeof document === 'undefined' || typeof window === 'undefined' || !window.FileReader || !window.File || !(file.originFileObj instanceof window.File) || file.thumbUrl !== undefined) {
          return;
        }
        /*eslint-disable */
        file.thumbUrl = '';
        /*eslint -enable */
        previewFile(file.originFileObj, function (previewDataUrl) {
          /*eslint-disable */
          file.thumbUrl = previewDataUrl;
          /*eslint -enable todo */
          // this.forceUpdate()
        });
      });
    });
  },

  methods: {
    handleClose: function handleClose(file) {
      this.$emit('remove', file);
    },
    handlePreview: function handlePreview(file, e) {
      var preview = this.$listeners.preview;

      if (!preview) {
        return;
      }
      e.preventDefault();
      return this.$emit('preview', file);
    }
  },
  render: function render() {
    var _this2 = this,
        _classNames2;

    var h = arguments[0];

    var _getOptionProps = (0, _propsUtil.getOptionProps)(this),
        prefixCls = _getOptionProps.prefixCls,
        _getOptionProps$items = _getOptionProps.items,
        items = _getOptionProps$items === undefined ? [] : _getOptionProps$items,
        listType = _getOptionProps.listType,
        showPreviewIcon = _getOptionProps.showPreviewIcon,
        showRemoveIcon = _getOptionProps.showRemoveIcon,
        locale = _getOptionProps.locale;

    var list = items.map(function (file) {
      var _classNames;

      var progress = void 0;
      var icon = h(_icon2['default'], {
        attrs: { type: file.status === 'uploading' ? 'loading' : 'paper-clip' }
      });

      if (listType === 'picture' || listType === 'picture-card') {
        if (listType === 'picture-card' && file.status === 'uploading') {
          icon = h(
            'div',
            { 'class': prefixCls + '-list-item-uploading-text' },
            [locale.uploading]
          );
        } else if (!file.thumbUrl && !file.url) {
          icon = h(_icon2['default'], { 'class': prefixCls + '-list-item-thumbnail', attrs: { type: 'picture', theme: 'twoTone' }
          });
        } else {
          var thumbnail = isImageUrl(file) ? h('img', {
            attrs: { src: file.thumbUrl || file.url, alt: file.name }
          }) : h(_icon2['default'], {
            attrs: { type: 'file', theme: 'twoTone' },
            'class': prefixCls + '-list-item-icon' });
          icon = h(
            'a',
            {
              'class': prefixCls + '-list-item-thumbnail',
              on: {
                'click': function click(e) {
                  return _this2.handlePreview(file, e);
                }
              },
              attrs: {
                href: file.url || file.thumbUrl,
                target: '_blank',
                rel: 'noopener noreferrer'
              }
            },
            [thumbnail]
          );
        }
      }

      if (file.status === 'uploading') {
        var progressProps = {
          props: (0, _extends3['default'])({}, _this2.progressAttr, {
            type: 'line',
            percent: file.percent
          })
        };
        // show loading icon if upload progress listener is disabled
        var loadingProgress = 'percent' in file ? h(_progress2['default'], progressProps) : null;

        progress = h(
          'div',
          { 'class': prefixCls + '-list-item-progress', key: 'progress' },
          [loadingProgress]
        );
      }
      var infoUploadingClass = (0, _classnames2['default'])((_classNames = {}, (0, _defineProperty3['default'])(_classNames, prefixCls + '-list-item', true), (0, _defineProperty3['default'])(_classNames, prefixCls + '-list-item-' + file.status, true), _classNames));
      var linkProps = typeof file.linkProps === 'string' ? JSON.parse(file.linkProps) : file.linkProps;
      var preview = file.url ? h(
        'a',
        (0, _babelHelperVueJsxMergeProps2['default'])([{
          attrs: {
            target: '_blank',
            rel: 'noopener noreferrer',

            title: file.name
          },
          'class': prefixCls + '-list-item-name' }, linkProps, {
          attrs: {
            href: file.url
          },
          on: {
            'click': function click(e) {
              return _this2.handlePreview(file, e);
            }
          }
        }]),
        [file.name]
      ) : h(
        'span',
        {
          'class': prefixCls + '-list-item-name',
          on: {
            'click': function click(e) {
              return _this2.handlePreview(file, e);
            }
          },
          attrs: {
            title: file.name
          }
        },
        [file.name]
      );
      var style = file.url || file.thumbUrl ? undefined : {
        pointerEvents: 'none',
        opacity: 0.5
      };
      var previewIcon = showPreviewIcon ? h(
        'a',
        {
          attrs: {
            href: file.url || file.thumbUrl,
            target: '_blank',
            rel: 'noopener noreferrer',

            title: locale.previewFile
          },
          style: style,
          on: {
            'click': function click(e) {
              return _this2.handlePreview(file, e);
            }
          }
        },
        [h(_icon2['default'], {
          attrs: { type: 'eye-o' }
        })]
      ) : null;
      var iconProps = {
        props: {
          type: 'delete',
          title: locale.removeFile
        },
        on: {
          click: function click() {
            _this2.handleClose(file);
          }
        }
      };
      var iconProps1 = (0, _extends3['default'])({}, iconProps, { props: { type: 'close' } });
      var removeIcon = showRemoveIcon ? h(_icon2['default'], iconProps) : null;
      var removeIconClose = showRemoveIcon ? h(_icon2['default'], iconProps1) : null;
      var actions = listType === 'picture-card' && file.status !== 'uploading' ? h(
        'span',
        { 'class': prefixCls + '-list-item-actions' },
        [previewIcon, removeIcon]
      ) : removeIconClose;
      var message = void 0;
      if (file.response && typeof file.response === 'string') {
        message = file.response;
      } else {
        message = file.error && file.error.statusText || locale.uploadError;
      }
      var iconAndPreview = file.status === 'error' ? h(
        _tooltip2['default'],
        {
          attrs: { title: message }
        },
        [icon, preview]
      ) : h('span', [icon, preview]);
      var transitionProps = (0, _getTransitionProps2['default'])('fade');
      return h(
        'div',
        { 'class': infoUploadingClass, key: file.uid },
        [h(
          'div',
          { 'class': prefixCls + '-list-item-info' },
          [iconAndPreview]
        ), actions, h(
          'transition',
          transitionProps,
          [progress]
        )]
      );
    });
    var listClassNames = (0, _classnames2['default'])((_classNames2 = {}, (0, _defineProperty3['default'])(_classNames2, prefixCls + '-list', true), (0, _defineProperty3['default'])(_classNames2, prefixCls + '-list-' + listType, true), _classNames2));
    var animationDirection = listType === 'picture-card' ? 'animate-inline' : 'animate';
    var transitionGroupProps = (0, _getTransitionProps2['default'])(prefixCls + '-' + animationDirection);
    return h(
      'transition-group',
      (0, _babelHelperVueJsxMergeProps2['default'])([transitionGroupProps, {
        attrs: { tag: 'div' },
        'class': listClassNames }]),
      [list]
    );
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/upload/index.js":
/*!*********************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/upload/index.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.UploadChangeParam = exports.UploadListProps = exports.UploadProps = undefined;

var _interface = __webpack_require__(/*! ./interface */ "./node_modules/ant-design-vue/lib/upload/interface.js");

Object.defineProperty(exports, 'UploadProps', {
  enumerable: true,
  get: function get() {
    return _interface.UploadProps;
  }
});
Object.defineProperty(exports, 'UploadListProps', {
  enumerable: true,
  get: function get() {
    return _interface.UploadListProps;
  }
});
Object.defineProperty(exports, 'UploadChangeParam', {
  enumerable: true,
  get: function get() {
    return _interface.UploadChangeParam;
  }
});

var _Upload = __webpack_require__(/*! ./Upload */ "./node_modules/ant-design-vue/lib/upload/Upload.js");

var _Upload2 = _interopRequireDefault(_Upload);

var _Dragger = __webpack_require__(/*! ./Dragger */ "./node_modules/ant-design-vue/lib/upload/Dragger.js");

var _Dragger2 = _interopRequireDefault(_Dragger);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

_Upload2['default'].Dragger = _Dragger2['default'];

/* istanbul ignore next */
_Upload2['default'].install = function (Vue) {
  Vue.component(_Upload2['default'].name, _Upload2['default']);
  Vue.component(_Dragger2['default'].name, _Dragger2['default']);
};

exports['default'] = _Upload2['default'];

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/upload/interface.js":
/*!*************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/upload/interface.js ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.UploadListProps = exports.UploadState = exports.UploadProps = exports.UploadLocale = exports.ShowUploadListInterface = exports.UploadChangeParam = exports.UploadFileStatus = undefined;

var _typeof2 = __webpack_require__(/*! babel-runtime/helpers/typeof */ "./node_modules/babel-runtime/helpers/typeof.js");

var _typeof3 = _interopRequireDefault(_typeof2);

var _vueTypes = __webpack_require__(/*! ../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var UploadFileStatus = exports.UploadFileStatus = _vueTypes2['default'].oneOf(['error', 'success', 'done', 'uploading', 'removed']);

// export const HttpRequestHeader {
//   [key: string]: string;
// }

// export const UploadFile = PropsTypes.shape({
//   uid: PropsTypes.oneOfType([
//     PropsTypes.string,
//     PropsTypes.number,
//   ]),
//   size: PropsTypes.number,
//   name: PropsTypes.string,
//   filename: PropsTypes.string,
//   lastModified: PropsTypes.number,
//   lastModifiedDate: PropsTypes.any,
//   url: PropsTypes.string,
//   status: UploadFileStatus,
//   percent: PropsTypes.number,
//   thumbUrl: PropsTypes.string,
//   originFileObj: PropsTypes.any,
//   response: PropsTypes.any,
//   error: PropsTypes.any,
//   linkProps: PropsTypes.any,
//   type: PropsTypes.string,
// }).loose

function UploadFile(_ref) {
  var uid = _ref.uid,
      name = _ref.name;

  if (!uid && uid !== 0) return false;
  if (!['string', 'number'].includes(typeof uid === 'undefined' ? 'undefined' : (0, _typeof3['default'])(uid))) return false;
  if (name === '' || typeof name !== 'string') return false;
  return true;
}

var UploadChangeParam = exports.UploadChangeParam = {
  file: _vueTypes2['default'].custom(UploadFile),
  fileList: _vueTypes2['default'].arrayOf(_vueTypes2['default'].custom(UploadFile)),
  event: _vueTypes2['default'].object
};

var ShowUploadListInterface = exports.ShowUploadListInterface = _vueTypes2['default'].shape({
  showRemoveIcon: _vueTypes2['default'].bool,
  showPreviewIcon: _vueTypes2['default'].bool
}).loose;

var UploadLocale = exports.UploadLocale = _vueTypes2['default'].shape({
  uploading: _vueTypes2['default'].string,
  removeFile: _vueTypes2['default'].string,
  uploadError: _vueTypes2['default'].string,
  previewFile: _vueTypes2['default'].string
}).loose;

var UploadProps = exports.UploadProps = {
  type: _vueTypes2['default'].oneOf(['drag', 'select']),
  name: _vueTypes2['default'].string,
  defaultFileList: _vueTypes2['default'].arrayOf(_vueTypes2['default'].custom(UploadFile)),
  fileList: _vueTypes2['default'].arrayOf(_vueTypes2['default'].custom(UploadFile)),
  action: _vueTypes2['default'].oneOfType([_vueTypes2['default'].string, _vueTypes2['default'].func]),
  directory: _vueTypes2['default'].bool,
  data: _vueTypes2['default'].oneOfType([_vueTypes2['default'].object, _vueTypes2['default'].func]),
  headers: _vueTypes2['default'].object,
  showUploadList: _vueTypes2['default'].oneOfType([_vueTypes2['default'].bool, ShowUploadListInterface]),
  multiple: _vueTypes2['default'].bool,
  accept: _vueTypes2['default'].string,
  beforeUpload: _vueTypes2['default'].func,
  // onChange: PropsTypes.func,
  listType: _vueTypes2['default'].oneOf(['text', 'picture', 'picture-card']),
  // className: PropsTypes.string,
  // onPreview: PropsTypes.func,
  remove: _vueTypes2['default'].func,
  supportServerRender: _vueTypes2['default'].bool,
  // style: PropsTypes.object,
  disabled: _vueTypes2['default'].bool,
  prefixCls: _vueTypes2['default'].string,
  customRequest: _vueTypes2['default'].func,
  withCredentials: _vueTypes2['default'].bool,
  openFileDialogOnClick: _vueTypes2['default'].bool,
  locale: UploadLocale,
  height: _vueTypes2['default'].number
};

var UploadState = exports.UploadState = {
  fileList: _vueTypes2['default'].arrayOf(_vueTypes2['default'].custom(UploadFile)),
  dragState: _vueTypes2['default'].string
};

var UploadListProps = exports.UploadListProps = {
  listType: _vueTypes2['default'].oneOf(['text', 'picture', 'picture-card']),
  // onPreview: PropsTypes.func,
  // onRemove: PropsTypes.func,
  // items: PropsTypes.arrayOf(UploadFile),
  items: _vueTypes2['default'].arrayOf(_vueTypes2['default'].custom(UploadFile)),
  // items: PropsTypes.any,
  progressAttr: _vueTypes2['default'].object,
  prefixCls: _vueTypes2['default'].string,
  showRemoveIcon: _vueTypes2['default'].bool,
  showPreviewIcon: _vueTypes2['default'].bool,
  locale: UploadLocale
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/upload/utils.js":
/*!*********************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/upload/utils.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

exports.T = T;
exports.fileToObject = fileToObject;
exports.genPercentAdd = genPercentAdd;
exports.getFileItem = getFileItem;
exports.removeFileItem = removeFileItem;

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

function T() {
  return true;
}

// Fix IE file.status problem
// via coping a new Object
function fileToObject(file) {
  return (0, _extends3['default'])({}, file, {
    lastModified: file.lastModified,
    lastModifiedDate: file.lastModifiedDate,
    name: file.name,
    size: file.size,
    type: file.type,
    uid: file.uid,
    percent: 0,
    originFileObj: file
  });
}

/**
 * 生成Progress percent: 0.1 -> 0.98
 *   - for ie
 */
function genPercentAdd() {
  var k = 0.1;
  var i = 0.01;
  var end = 0.98;
  return function (s) {
    var start = s;
    if (start >= end) {
      return start;
    }

    start += k;
    k = k - i;
    if (k < 0.001) {
      k = 0.001;
    }
    return start;
  };
}

function getFileItem(file, fileList) {
  var matchKey = file.uid !== undefined ? 'uid' : 'name';
  return fileList.filter(function (item) {
    return item[matchKey] === file[matchKey];
  })[0];
}

function removeFileItem(file, fileList) {
  var matchKey = file.uid !== undefined ? 'uid' : 'name';
  var removed = fileList.filter(function (item) {
    return item[matchKey] !== file[matchKey];
  });
  if (removed.length === fileList.length) {
    return null;
  }
  return removed;
}

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-progress/index.js":
/*!**************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-progress/index.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.Circle = exports.Line = undefined;

var _src = __webpack_require__(/*! ./src/ */ "./node_modules/ant-design-vue/lib/vc-progress/src/index.js");

var _src2 = _interopRequireDefault(_src);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports.Line = _src.Line;
exports.Circle = _src.Circle; // based on rc-progress 2.2.7

exports['default'] = _src2['default'];

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-progress/src/Circle.js":
/*!*******************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-progress/src/Circle.js ***!
  \*******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _babelHelperVueJsxMergeProps = __webpack_require__(/*! babel-helper-vue-jsx-merge-props */ "./node_modules/babel-helper-vue-jsx-merge-props/index.js");

var _babelHelperVueJsxMergeProps2 = _interopRequireDefault(_babelHelperVueJsxMergeProps);

var _objectWithoutProperties2 = __webpack_require__(/*! babel-runtime/helpers/objectWithoutProperties */ "./node_modules/babel-runtime/helpers/objectWithoutProperties.js");

var _objectWithoutProperties3 = _interopRequireDefault(_objectWithoutProperties2);

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _vueTypes = __webpack_require__(/*! ../../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _propsUtil = __webpack_require__(/*! ../../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

var _enhancer = __webpack_require__(/*! ./enhancer */ "./node_modules/ant-design-vue/lib/vc-progress/src/enhancer.js");

var _enhancer2 = _interopRequireDefault(_enhancer);

var _types = __webpack_require__(/*! ./types */ "./node_modules/ant-design-vue/lib/vc-progress/src/types.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var circlePropTypes = (0, _extends3['default'])({}, _types.propTypes, {
  gapPosition: _vueTypes2['default'].oneOf(['top', 'bottom', 'left', 'right']),
  gapDegree: _vueTypes2['default'].number
});

var circleDefaultProps = (0, _extends3['default'])({}, _types.defaultProps, {
  gapPosition: 'top'
});

var Circle = {
  props: (0, _propsUtil.initDefaultProps)(circlePropTypes, circleDefaultProps),
  methods: {
    getPathStyles: function getPathStyles() {
      var _$props = this.$props,
          percent = _$props.percent,
          strokeWidth = _$props.strokeWidth,
          strokeColor = _$props.strokeColor,
          _$props$gapDegree = _$props.gapDegree,
          gapDegree = _$props$gapDegree === undefined ? 0 : _$props$gapDegree,
          gapPosition = _$props.gapPosition;

      var radius = 50 - strokeWidth / 2;
      var beginPositionX = 0;
      var beginPositionY = -radius;
      var endPositionX = 0;
      var endPositionY = -2 * radius;
      switch (gapPosition) {
        case 'left':
          beginPositionX = -radius;
          beginPositionY = 0;
          endPositionX = 2 * radius;
          endPositionY = 0;
          break;
        case 'right':
          beginPositionX = radius;
          beginPositionY = 0;
          endPositionX = -2 * radius;
          endPositionY = 0;
          break;
        case 'bottom':
          beginPositionY = radius;
          endPositionY = 2 * radius;
          break;
        default:
      }
      var pathString = 'M 50,50 m ' + beginPositionX + ',' + beginPositionY + '\n       a ' + radius + ',' + radius + ' 0 1 1 ' + endPositionX + ',' + -endPositionY + '\n       a ' + radius + ',' + radius + ' 0 1 1 ' + -endPositionX + ',' + endPositionY;
      var len = Math.PI * 2 * radius;
      var trailPathStyle = {
        strokeDasharray: len - gapDegree + 'px ' + len + 'px',
        strokeDashoffset: '-' + gapDegree / 2 + 'px',
        transition: 'stroke-dashoffset .3s ease 0s, stroke-dasharray .3s ease 0s, stroke .3s'
      };
      var strokePathStyle = {
        stroke: strokeColor,
        strokeDasharray: percent / 100 * (len - gapDegree) + 'px ' + len + 'px',
        strokeDashoffset: '-' + gapDegree / 2 + 'px',
        transition: 'stroke-dashoffset .3s ease 0s, stroke-dasharray .3s ease 0s, stroke .3s, stroke-width .06s ease .3s' // eslint-disable-line
      };
      return { pathString: pathString, trailPathStyle: trailPathStyle, strokePathStyle: strokePathStyle };
    }
  },
  render: function render() {
    var h = arguments[0];
    var _$props2 = this.$props,
        prefixCls = _$props2.prefixCls,
        strokeWidth = _$props2.strokeWidth,
        trailWidth = _$props2.trailWidth,
        trailColor = _$props2.trailColor,
        strokeLinecap = _$props2.strokeLinecap,
        percent = _$props2.percent,
        restProps = (0, _objectWithoutProperties3['default'])(_$props2, ['prefixCls', 'strokeWidth', 'trailWidth', 'trailColor', 'strokeLinecap', 'percent']);

    var _getPathStyles = this.getPathStyles(),
        pathString = _getPathStyles.pathString,
        trailPathStyle = _getPathStyles.trailPathStyle,
        strokePathStyle = _getPathStyles.strokePathStyle;

    delete restProps.percent;
    delete restProps.gapDegree;
    delete restProps.gapPosition;
    delete restProps.strokeColor;
    var pathFirst = {
      attrs: {
        d: pathString,
        stroke: trailColor,
        'stroke-linecap': strokeLinecap,
        'stroke-width': trailWidth || strokeWidth,
        'fill-opacity': '0'
      },
      'class': prefixCls + '-circle-trail',
      style: trailPathStyle
    };
    var pathSecond = {
      attrs: {
        d: pathString,
        'stroke-linecap': strokeLinecap,
        'stroke-width': percent === 0 ? 0 : strokeWidth,
        'fill-opacity': '0'
      },
      'class': prefixCls + '-circle-path',
      style: strokePathStyle,
      ref: 'svgPathRef'
    };
    return h(
      'svg',
      (0, _babelHelperVueJsxMergeProps2['default'])([{ 'class': prefixCls + '-circle', attrs: { viewBox: '0 0 100 100' }
      }, restProps]),
      [h('path', pathFirst), h('path', pathSecond)]
    );
  }
};

exports['default'] = (0, _enhancer2['default'])(Circle);

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-progress/src/Line.js":
/*!*****************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-progress/src/Line.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _babelHelperVueJsxMergeProps = __webpack_require__(/*! babel-helper-vue-jsx-merge-props */ "./node_modules/babel-helper-vue-jsx-merge-props/index.js");

var _babelHelperVueJsxMergeProps2 = _interopRequireDefault(_babelHelperVueJsxMergeProps);

var _objectWithoutProperties2 = __webpack_require__(/*! babel-runtime/helpers/objectWithoutProperties */ "./node_modules/babel-runtime/helpers/objectWithoutProperties.js");

var _objectWithoutProperties3 = _interopRequireDefault(_objectWithoutProperties2);

var _propsUtil = __webpack_require__(/*! ../../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

var _enhancer = __webpack_require__(/*! ./enhancer */ "./node_modules/ant-design-vue/lib/vc-progress/src/enhancer.js");

var _enhancer2 = _interopRequireDefault(_enhancer);

var _types = __webpack_require__(/*! ./types */ "./node_modules/ant-design-vue/lib/vc-progress/src/types.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var Line = {
  props: (0, _propsUtil.initDefaultProps)(_types.propTypes, _types.defaultProps),
  render: function render() {
    var h = arguments[0];
    var _$props = this.$props,
        percent = _$props.percent,
        prefixCls = _$props.prefixCls,
        strokeColor = _$props.strokeColor,
        strokeLinecap = _$props.strokeLinecap,
        strokeWidth = _$props.strokeWidth,
        trailColor = _$props.trailColor,
        trailWidth = _$props.trailWidth,
        restProps = (0, _objectWithoutProperties3['default'])(_$props, ['percent', 'prefixCls', 'strokeColor', 'strokeLinecap', 'strokeWidth', 'trailColor', 'trailWidth']);


    delete restProps.gapPosition;

    var pathStyle = {
      strokeDasharray: '100px, 100px',
      strokeDashoffset: 100 - percent + 'px',
      transition: 'stroke-dashoffset 0.3s ease 0s, stroke 0.3s linear'
    };

    var center = strokeWidth / 2;
    var right = 100 - strokeWidth / 2;
    var pathString = 'M ' + (strokeLinecap === 'round' ? center : 0) + ',' + center + '\n           L ' + (strokeLinecap === 'round' ? right : 100) + ',' + center;
    var viewBoxString = '0 0 100 ' + strokeWidth;

    var pathFirst = {
      attrs: {
        d: pathString,
        'stroke-linecap': strokeLinecap,
        stroke: trailColor,
        'stroke-width': trailWidth || strokeWidth,
        'fill-opacity': '0'
      },
      'class': prefixCls + '-line-trail'
    };
    var pathSecond = {
      attrs: {
        d: pathString,
        'stroke-linecap': strokeLinecap,
        stroke: strokeColor,
        'stroke-width': strokeWidth,
        'fill-opacity': '0'
      },
      'class': prefixCls + '-line-path',
      style: pathStyle,
      ref: 'svgPathRef'
    };
    return h(
      'svg',
      (0, _babelHelperVueJsxMergeProps2['default'])([{
        'class': prefixCls + '-line',
        attrs: { viewBox: viewBoxString,
          preserveAspectRatio: 'none'
        }
      }, restProps]),
      [h('path', pathFirst), h('path', pathSecond)]
    );
  }
};

exports['default'] = (0, _enhancer2['default'])(Line);

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-progress/src/enhancer.js":
/*!*********************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-progress/src/enhancer.js ***!
  \*********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
function enhancer(Component) {
  return {
    mixins: [Component],
    updated: function updated() {
      var _this = this;

      this.$nextTick(function () {
        if (!_this.$refs.svgPathRef) {
          return;
        }
        var pathStyle = _this.$refs.svgPathRef.style;
        pathStyle.transitionDuration = '.3s, .3s, .3s, .06s';
        var now = Date.now();
        if (_this.prevTimeStamp && now - _this.prevTimeStamp < 100) {
          pathStyle.transitionDuration = '0s, 0s';
        }
        _this.prevTimeStamp = Date.now();
      });
    }
  };
}

exports['default'] = enhancer;

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-progress/src/index.js":
/*!******************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-progress/src/index.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.Circle = exports.Line = undefined;

var _Line = __webpack_require__(/*! ./Line */ "./node_modules/ant-design-vue/lib/vc-progress/src/Line.js");

var _Line2 = _interopRequireDefault(_Line);

var _Circle = __webpack_require__(/*! ./Circle */ "./node_modules/ant-design-vue/lib/vc-progress/src/Circle.js");

var _Circle2 = _interopRequireDefault(_Circle);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports.Line = _Line2['default'];
exports.Circle = _Circle2['default'];
exports['default'] = {
  Line: _Line2['default'],
  Circle: _Circle2['default']
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-progress/src/types.js":
/*!******************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-progress/src/types.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.propTypes = exports.defaultProps = undefined;

var _vueTypes = __webpack_require__(/*! ../../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var defaultProps = exports.defaultProps = {
  // className: '',
  percent: 0,
  prefixCls: 'rc-progress',
  strokeColor: '#2db7f5',
  strokeLinecap: 'round',
  strokeWidth: 1,
  // style: {},
  trailColor: '#D9D9D9',
  trailWidth: 1
};

var propTypes = exports.propTypes = {
  // className: PropTypes.string,
  percent: _vueTypes2['default'].oneOfType([_vueTypes2['default'].number, _vueTypes2['default'].string]),
  prefixCls: _vueTypes2['default'].string,
  strokeColor: _vueTypes2['default'].string,
  strokeLinecap: _vueTypes2['default'].oneOf(['butt', 'round', 'square']),
  strokeWidth: _vueTypes2['default'].oneOfType([_vueTypes2['default'].number, _vueTypes2['default'].string]),
  // style: PropTypes.object,
  trailColor: _vueTypes2['default'].string,
  trailWidth: _vueTypes2['default'].oneOfType([_vueTypes2['default'].number, _vueTypes2['default'].string])
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-upload/index.js":
/*!************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-upload/index.js ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _src = __webpack_require__(/*! ./src */ "./node_modules/ant-design-vue/lib/vc-upload/src/index.js");

var _src2 = _interopRequireDefault(_src);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports['default'] = _src2['default']; // rc-upload 2.6.0

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-upload/src/AjaxUploader.js":
/*!***********************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-upload/src/AjaxUploader.js ***!
  \***********************************************************************/
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

var _vueTypes = __webpack_require__(/*! ../../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _BaseMixin = __webpack_require__(/*! ../../_util/BaseMixin */ "./node_modules/ant-design-vue/lib/_util/BaseMixin.js");

var _BaseMixin2 = _interopRequireDefault(_BaseMixin);

var _classnames = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");

var _classnames2 = _interopRequireDefault(_classnames);

var _request = __webpack_require__(/*! ./request */ "./node_modules/ant-design-vue/lib/vc-upload/src/request.js");

var _request2 = _interopRequireDefault(_request);

var _uid = __webpack_require__(/*! ./uid */ "./node_modules/ant-design-vue/lib/vc-upload/src/uid.js");

var _uid2 = _interopRequireDefault(_uid);

var _attrAccept = __webpack_require__(/*! ./attr-accept */ "./node_modules/ant-design-vue/lib/vc-upload/src/attr-accept.js");

var _attrAccept2 = _interopRequireDefault(_attrAccept);

var _traverseFileTree = __webpack_require__(/*! ./traverseFileTree */ "./node_modules/ant-design-vue/lib/vc-upload/src/traverseFileTree.js");

var _traverseFileTree2 = _interopRequireDefault(_traverseFileTree);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var upLoadPropTypes = {
  componentTag: _vueTypes2['default'].string,
  // style: PropTypes.object,
  prefixCls: _vueTypes2['default'].string,
  name: _vueTypes2['default'].string,
  // className: PropTypes.string,
  multiple: _vueTypes2['default'].bool,
  directory: _vueTypes2['default'].bool,
  disabled: _vueTypes2['default'].bool,
  accept: _vueTypes2['default'].string,
  // children: PropTypes.any,
  // onStart: PropTypes.func,
  data: _vueTypes2['default'].oneOfType([_vueTypes2['default'].object, _vueTypes2['default'].func]),
  action: _vueTypes2['default'].oneOfType([_vueTypes2['default'].string, _vueTypes2['default'].func]),
  headers: _vueTypes2['default'].object,
  beforeUpload: _vueTypes2['default'].func,
  customRequest: _vueTypes2['default'].func,
  // onProgress: PropTypes.func,
  withCredentials: _vueTypes2['default'].bool,
  openFileDialogOnClick: _vueTypes2['default'].bool
};

var AjaxUploader = {
  inheritAttrs: false,
  name: 'ajaxUploader',
  mixins: [_BaseMixin2['default']],
  props: upLoadPropTypes,
  data: function data() {
    this.reqs = {};
    return {
      uid: (0, _uid2['default'])()
    };
  },
  mounted: function mounted() {
    this._isMounted = true;
  },
  beforeDestroy: function beforeDestroy() {
    this._isMounted = false;
    this.abort();
  },

  methods: {
    onChange: function onChange(e) {
      var files = e.target.files;
      this.uploadFiles(files);
      this.reset();
    },
    onClick: function onClick() {
      var el = this.$refs.fileInputRef;
      if (!el) {
        return;
      }
      el.click();
    },
    onKeyDown: function onKeyDown(e) {
      if (e.key === 'Enter') {
        this.onClick();
      }
    },
    onFileDrop: function onFileDrop(e) {
      var _this = this;

      e.preventDefault();
      if (e.type === 'dragover') {
        return;
      }
      if (this.directory) {
        (0, _traverseFileTree2['default'])(e.dataTransfer.items, this.uploadFiles, function (_file) {
          return (0, _attrAccept2['default'])(_file, _this.accept);
        });
      } else {
        var files = Array.prototype.slice.call(e.dataTransfer.files).filter(function (file) {
          return (0, _attrAccept2['default'])(file, _this.accept);
        });
        this.uploadFiles(files);
      }
    },
    uploadFiles: function uploadFiles(files) {
      var _this2 = this;

      var postFiles = Array.prototype.slice.call(files);
      postFiles.forEach(function (file) {
        file.uid = (0, _uid2['default'])();
        _this2.upload(file, postFiles);
      });
    },
    upload: function upload(file, fileList) {
      var _this3 = this;

      if (!this.beforeUpload) {
        // always async in case use react state to keep fileList
        return setTimeout(function () {
          return _this3.post(file);
        }, 0);
      }

      var before = this.beforeUpload(file, fileList);
      if (before && before.then) {
        before.then(function (processedFile) {
          var processedFileType = Object.prototype.toString.call(processedFile);
          if (processedFileType === '[object File]' || processedFileType === '[object Blob]') {
            return _this3.post(processedFile);
          }
          return _this3.post(file);
        })['catch'](function (e) {
          console && console.log(e); // eslint-disable-line
        });
      } else if (before !== false) {
        setTimeout(function () {
          return _this3.post(file);
        }, 0);
      }
    },
    post: function post(file) {
      var _this4 = this;

      if (!this._isMounted) {
        return;
      }
      var data = this.$props.data;

      if (typeof data === 'function') {
        data = data(file);
      }
      new Promise(function (resolve) {
        var action = _this4.action;

        if (typeof action === 'function') {
          return resolve(action(file));
        }
        resolve(action);
      }).then(function (action) {
        var uid = file.uid;

        var request = _this4.customRequest || _request2['default'];
        _this4.reqs[uid] = request({
          action: action,
          filename: _this4.name,
          file: file,
          data: data,
          headers: _this4.headers,
          withCredentials: _this4.withCredentials,
          onProgress: function onProgress(e) {
            _this4.$emit('progress', e, file);
          },
          onSuccess: function onSuccess(ret, xhr) {
            delete _this4.reqs[uid];
            _this4.$emit('success', ret, file, xhr);
          },
          onError: function onError(err, ret) {
            delete _this4.reqs[uid];
            _this4.$emit('error', err, ret, file);
          }
        });
        _this4.$emit('start', file);
      });
    },
    reset: function reset() {
      this.setState({
        uid: (0, _uid2['default'])()
      });
    },
    abort: function abort(file) {
      var reqs = this.reqs;

      if (file) {
        var uid = file;
        if (file && file.uid) {
          uid = file.uid;
        }
        if (reqs[uid]) {
          reqs[uid].abort();
          delete reqs[uid];
        }
      } else {
        Object.keys(reqs).forEach(function (uid) {
          if (reqs[uid]) {
            reqs[uid].abort();
          }

          delete reqs[uid];
        });
      }
    }
  },

  render: function render() {
    var _classNames;

    var h = arguments[0];
    var $props = this.$props,
        $attrs = this.$attrs;
    var Tag = $props.componentTag,
        prefixCls = $props.prefixCls,
        disabled = $props.disabled,
        multiple = $props.multiple,
        accept = $props.accept,
        directory = $props.directory,
        openFileDialogOnClick = $props.openFileDialogOnClick;

    var cls = (0, _classnames2['default'])((_classNames = {}, (0, _defineProperty3['default'])(_classNames, prefixCls, true), (0, _defineProperty3['default'])(_classNames, prefixCls + '-disabled', disabled), _classNames));
    var events = disabled ? {} : {
      click: openFileDialogOnClick ? this.onClick : function () {},
      keydown: this.onKeyDown,
      drop: this.onFileDrop,
      dragover: this.onFileDrop
    };
    var tagProps = {
      on: (0, _extends3['default'])({}, this.$listeners, events),
      attrs: {
        role: 'button',
        tabIndex: disabled ? null : '0'
      },
      'class': cls
    };
    return h(
      Tag,
      tagProps,
      [h('input', {
        attrs: {
          id: $attrs.id,
          type: 'file',

          accept: accept,
          directory: directory ? 'directory' : null,
          webkitdirectory: directory ? 'webkitdirectory' : null,
          multiple: multiple
        },
        ref: 'fileInputRef',
        key: this.uid,
        style: { display: 'none' }, on: {
          'change': this.onChange
        }
      }), this.$slots['default']]
    );
  }
};

exports['default'] = AjaxUploader;

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-upload/src/IframeUploader.js":
/*!*************************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-upload/src/IframeUploader.js ***!
  \*************************************************************************/
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

var _vueTypes = __webpack_require__(/*! ../../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _BaseMixin = __webpack_require__(/*! ../../_util/BaseMixin */ "./node_modules/ant-design-vue/lib/_util/BaseMixin.js");

var _BaseMixin2 = _interopRequireDefault(_BaseMixin);

var _classnames = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");

var _classnames2 = _interopRequireDefault(_classnames);

var _uid = __webpack_require__(/*! ./uid */ "./node_modules/ant-design-vue/lib/vc-upload/src/uid.js");

var _uid2 = _interopRequireDefault(_uid);

var _warning = __webpack_require__(/*! ../../_util/warning */ "./node_modules/ant-design-vue/lib/_util/warning.js");

var _warning2 = _interopRequireDefault(_warning);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var IFRAME_STYLE = {
  position: 'absolute',
  top: 0,
  opacity: 0,
  filter: 'alpha(opacity=0)',
  left: 0,
  zIndex: 9999
};

// diferent from AjaxUpload, can only upload on at one time, serial seriously
var IframeUploader = {
  mixins: [_BaseMixin2['default']],
  props: {
    componentTag: _vueTypes2['default'].string,
    // style: PropTypes.object,
    disabled: _vueTypes2['default'].bool,
    prefixCls: _vueTypes2['default'].string,
    // className: PropTypes.string,
    accept: _vueTypes2['default'].string,
    // onStart: PropTypes.func,
    multiple: _vueTypes2['default'].bool,
    // children: PropTypes.any,
    data: _vueTypes2['default'].oneOfType([_vueTypes2['default'].object, _vueTypes2['default'].func]),
    action: _vueTypes2['default'].oneOfType([_vueTypes2['default'].string, _vueTypes2['default'].func]),
    name: _vueTypes2['default'].string
  },
  data: function data() {
    this.file = {};
    return {
      uploading: false
    };
  },

  methods: {
    onLoad: function onLoad() {
      if (!this.uploading) {
        return;
      }
      var file = this.file;

      var response = void 0;
      try {
        var doc = this.getIframeDocument();
        var script = doc.getElementsByTagName('script')[0];
        if (script && script.parentNode === doc.body) {
          doc.body.removeChild(script);
        }
        response = doc.body.innerHTML;
        this.$emit('success', response, file);
      } catch (err) {
        (0, _warning2['default'])(false, 'cross domain error for Upload. Maybe server should return document.domain script. see Note from https://github.com/react-component/upload');
        response = 'cross-domain';
        this.$emit('error', err, null, file);
      }
      this.endUpload();
    },
    onChange: function onChange() {
      var _this = this;

      var target = this.getFormInputNode();
      // ie8/9 don't support FileList Object
      // http://stackoverflow.com/questions/12830058/ie8-input-type-file-get-files
      var file = this.file = {
        uid: (0, _uid2['default'])(),
        name: target.value
      };
      this.startUpload();
      var props = this.$props;

      if (!props.beforeUpload) {
        return this.post(file);
      }
      var before = props.beforeUpload(file);
      if (before && before.then) {
        before.then(function () {
          _this.post(file);
        }, function () {
          _this.endUpload();
        });
      } else if (before !== false) {
        this.post(file);
      } else {
        this.endUpload();
      }
    },
    getIframeNode: function getIframeNode() {
      return this.$refs.iframeRef;
    },
    getIframeDocument: function getIframeDocument() {
      return this.getIframeNode().contentDocument;
    },
    getFormNode: function getFormNode() {
      return this.getIframeDocument().getElementById('form');
    },
    getFormInputNode: function getFormInputNode() {
      return this.getIframeDocument().getElementById('input');
    },
    getFormDataNode: function getFormDataNode() {
      return this.getIframeDocument().getElementById('data');
    },
    getFileForMultiple: function getFileForMultiple(file) {
      return this.multiple ? [file] : file;
    },
    getIframeHTML: function getIframeHTML(domain) {
      var domainScript = '';
      var domainInput = '';
      if (domain) {
        var script = 'script';
        domainScript = '<' + script + '>document.domain="' + domain + '";</' + script + '>';
        domainInput = '<input name="_documentDomain" value="' + domain + '" />';
      }
      return '\n      <!DOCTYPE html>\n      <html>\n      <head>\n      <meta http-equiv="X-UA-Compatible" content="IE=edge" />\n      <style>\n      body,html {padding:0;margin:0;border:0;overflow:hidden;}\n      </style>\n      ' + domainScript + '\n      </head>\n      <body>\n      <form method="post"\n      encType="multipart/form-data"\n      action="" id="form"\n      style="display:block;height:9999px;position:relative;overflow:hidden;">\n      <input id="input" type="file"\n       name="' + this.name + '"\n       style="position:absolute;top:0;right:0;height:9999px;font-size:9999px;cursor:pointer;"/>\n      ' + domainInput + '\n      <span id="data"></span>\n      </form>\n      </body>\n      </html>\n      ';
    },
    initIframeSrc: function initIframeSrc() {
      if (this.domain) {
        this.getIframeNode().src = 'javascript:void((function(){\n          var d = document;\n          d.open();\n          d.domain=\'' + this.domain + '\';\n          d.write(\'\');\n          d.close();\n        })())';
      }
    },
    initIframe: function initIframe() {
      var iframeNode = this.getIframeNode();
      var win = iframeNode.contentWindow;
      var doc = void 0;
      this.domain = this.domain || '';
      this.initIframeSrc();
      try {
        doc = win.document;
      } catch (e) {
        this.domain = document.domain;
        this.initIframeSrc();
        win = iframeNode.contentWindow;
        doc = win.document;
      }
      doc.open('text/html', 'replace');
      doc.write(this.getIframeHTML(this.domain));
      doc.close();
      this.getFormInputNode().onchange = this.onChange;
    },
    endUpload: function endUpload() {
      if (this.uploading) {
        this.file = {};
        // hack avoid batch
        this.uploading = false;
        this.setState({
          uploading: false
        });
        this.initIframe();
      }
    },
    startUpload: function startUpload() {
      if (!this.uploading) {
        this.uploading = true;
        this.setState({
          uploading: true
        });
      }
    },
    updateIframeWH: function updateIframeWH() {
      var rootNode = this.$el;
      var iframeNode = this.getIframeNode();
      iframeNode.style.height = rootNode.offsetHeight + 'px';
      iframeNode.style.width = rootNode.offsetWidth + 'px';
    },
    abort: function abort(file) {
      if (file) {
        var uid = file;
        if (file && file.uid) {
          uid = file.uid;
        }
        if (uid === this.file.uid) {
          this.endUpload();
        }
      } else {
        this.endUpload();
      }
    },
    post: function post(file) {
      var _this2 = this;

      var formNode = this.getFormNode();
      var dataSpan = this.getFormDataNode();
      var data = this.$props.data;

      if (typeof data === 'function') {
        data = data(file);
      }
      var inputs = document.createDocumentFragment();
      for (var key in data) {
        if (data.hasOwnProperty(key)) {
          var input = document.createElement('input');
          input.setAttribute('name', key);
          input.value = data[key];
          inputs.appendChild(input);
        }
      }
      dataSpan.appendChild(inputs);
      new Promise(function (resolve) {
        var action = _this2.action;

        if (typeof action === 'function') {
          return resolve(action(file));
        }
        resolve(action);
      }).then(function (action) {
        formNode.setAttribute('action', action);
        formNode.submit();
        dataSpan.innerHTML = '';
        _this2.$emit('start', file);
      });
    }
  },
  mounted: function mounted() {
    var _this3 = this;

    this.$nextTick(function () {
      _this3.updateIframeWH();
      _this3.initIframe();
    });
  },
  updated: function updated() {
    var _this4 = this;

    this.$nextTick(function () {
      _this4.updateIframeWH();
    });
  },
  render: function render() {
    var _classNames;

    var h = arguments[0];
    var _$props = this.$props,
        Tag = _$props.componentTag,
        disabled = _$props.disabled,
        prefixCls = _$props.prefixCls;

    var iframeStyle = (0, _extends3['default'])({}, IFRAME_STYLE, {
      display: this.uploading || disabled ? 'none' : ''
    });
    var cls = (0, _classnames2['default'])((_classNames = {}, (0, _defineProperty3['default'])(_classNames, prefixCls, true), (0, _defineProperty3['default'])(_classNames, prefixCls + '-disabled', disabled), _classNames));

    return h(
      Tag,
      {
        attrs: { className: cls },
        style: { position: 'relative', zIndex: 0 } },
      [h('iframe', { ref: 'iframeRef', on: {
          'load': this.onLoad
        },
        style: iframeStyle }), this.$slots['default']]
    );
  }
};

exports['default'] = IframeUploader;

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-upload/src/Upload.js":
/*!*****************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-upload/src/Upload.js ***!
  \*****************************************************************/
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

var _propsUtil = __webpack_require__(/*! ../../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

var _BaseMixin = __webpack_require__(/*! ../../_util/BaseMixin */ "./node_modules/ant-design-vue/lib/_util/BaseMixin.js");

var _BaseMixin2 = _interopRequireDefault(_BaseMixin);

var _AjaxUploader = __webpack_require__(/*! ./AjaxUploader */ "./node_modules/ant-design-vue/lib/vc-upload/src/AjaxUploader.js");

var _AjaxUploader2 = _interopRequireDefault(_AjaxUploader);

var _IframeUploader = __webpack_require__(/*! ./IframeUploader */ "./node_modules/ant-design-vue/lib/vc-upload/src/IframeUploader.js");

var _IframeUploader2 = _interopRequireDefault(_IframeUploader);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

function empty() {}

var uploadProps = {
  componentTag: _vueTypes2['default'].string,
  prefixCls: _vueTypes2['default'].string,
  action: _vueTypes2['default'].oneOfType([_vueTypes2['default'].string, _vueTypes2['default'].func]),
  name: _vueTypes2['default'].string,
  multipart: _vueTypes2['default'].bool,
  directory: _vueTypes2['default'].bool,
  // onError: PropTypes.func,
  // onSuccess: PropTypes.func,
  // onProgress: PropTypes.func,
  // onStart: PropTypes.func,
  data: _vueTypes2['default'].oneOfType([_vueTypes2['default'].object, _vueTypes2['default'].func]),
  headers: _vueTypes2['default'].object,
  accept: _vueTypes2['default'].string,
  multiple: _vueTypes2['default'].bool,
  disabled: _vueTypes2['default'].bool,
  beforeUpload: _vueTypes2['default'].func,
  customRequest: _vueTypes2['default'].func,
  // onReady: PropTypes.func,
  withCredentials: _vueTypes2['default'].bool,
  supportServerRender: _vueTypes2['default'].bool,
  openFileDialogOnClick: _vueTypes2['default'].bool
};
exports['default'] = {
  name: 'Upload',
  mixins: [_BaseMixin2['default']],
  inheritAttrs: false,
  props: (0, _propsUtil.initDefaultProps)(uploadProps, {
    componentTag: 'span',
    prefixCls: 'rc-upload',
    data: {},
    headers: {},
    name: 'file',
    multipart: false,
    // onReady: empty,
    // onStart: empty,
    // onError: empty,
    // onSuccess: empty,
    supportServerRender: false,
    multiple: false,
    beforeUpload: empty,
    withCredentials: false,
    openFileDialogOnClick: true
  }),
  data: function data() {
    return {
      Component: null
    };
  },
  mounted: function mounted() {
    var _this = this;

    this.$nextTick(function () {
      if (_this.supportServerRender) {
        /* eslint react/no-did-mount-set-state:0 */
        _this.setState({
          Component: _this.getComponent()
        }, function () {
          _this.$emit('ready');
        });
      }
    });
  },

  methods: {
    getComponent: function getComponent() {
      return typeof File !== 'undefined' ? _AjaxUploader2['default'] : _IframeUploader2['default'];
    },
    abort: function abort(file) {
      this.$refs.uploaderRef.abort(file);
    }
  },

  render: function render() {
    var h = arguments[0];

    var componentProps = {
      props: (0, _extends3['default'])({}, this.$props),
      on: this.$listeners,
      ref: 'uploaderRef',
      attrs: this.$attrs
    };
    if (this.supportServerRender) {
      var _ComponentUploader = this.Component;
      if (_ComponentUploader) {
        return h(
          _ComponentUploader,
          componentProps,
          [this.$slots['default']]
        );
      }
      return null;
    }
    var ComponentUploader = this.getComponent();
    return h(
      ComponentUploader,
      componentProps,
      [this.$slots['default']]
    );
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-upload/src/attr-accept.js":
/*!**********************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-upload/src/attr-accept.js ***!
  \**********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
function endsWith(str, suffix) {
  return str.indexOf(suffix, str.length - suffix.length) !== -1;
}

exports['default'] = function (file, acceptedFiles) {
  if (file && acceptedFiles) {
    var acceptedFilesArray = Array.isArray(acceptedFiles) ? acceptedFiles : acceptedFiles.split(',');
    var fileName = file.name || '';
    var mimeType = file.type || '';
    var baseMimeType = mimeType.replace(/\/.*$/, '');

    return acceptedFilesArray.some(function (type) {
      var validType = type.trim();
      if (validType.charAt(0) === '.') {
        return endsWith(fileName.toLowerCase(), validType.toLowerCase());
      } else if (/\/\*$/.test(validType)) {
        // This is something like a image/* mime type
        return baseMimeType === validType.replace(/\/.*$/, '');
      }
      return mimeType === validType;
    });
  }
  return true;
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-upload/src/index.js":
/*!****************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-upload/src/index.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _Upload = __webpack_require__(/*! ./Upload */ "./node_modules/ant-design-vue/lib/vc-upload/src/Upload.js");

var _Upload2 = _interopRequireDefault(_Upload);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports['default'] = _Upload2['default']; // based on rc-upload 2.4.4
// export this package's api

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-upload/src/request.js":
/*!******************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-upload/src/request.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports['default'] = upload;
function getError(option, xhr) {
  var msg = 'cannot post ' + option.action + ' ' + xhr.status + '\'';
  var err = new Error(msg);
  err.status = xhr.status;
  err.method = 'post';
  err.url = option.action;
  return err;
}

function getBody(xhr) {
  var text = xhr.responseText || xhr.response;
  if (!text) {
    return text;
  }

  try {
    return JSON.parse(text);
  } catch (e) {
    return text;
  }
}

// option {
//  onProgress: (event: { percent: number }): void,
//  onError: (event: Error, body?: Object): void,
//  onSuccess: (body: Object): void,
//  data: Object,
//  filename: String,
//  file: File,
//  withCredentials: Boolean,
//  action: String,
//  headers: Object,
// }
function upload(option) {
  var xhr = new window.XMLHttpRequest();

  if (option.onProgress && xhr.upload) {
    xhr.upload.onprogress = function progress(e) {
      if (e.total > 0) {
        e.percent = e.loaded / e.total * 100;
      }
      option.onProgress(e);
    };
  }

  var formData = new window.FormData();

  if (option.data) {
    Object.keys(option.data).map(function (key) {
      formData.append(key, option.data[key]);
    });
  }

  formData.append(option.filename, option.file);

  xhr.onerror = function error(e) {
    option.onError(e);
  };

  xhr.onload = function onload() {
    // allow success when 2xx status
    // see https://github.com/react-component/upload/issues/34
    if (xhr.status < 200 || xhr.status >= 300) {
      return option.onError(getError(option, xhr), getBody(xhr));
    }

    option.onSuccess(getBody(xhr), xhr);
  };

  xhr.open('post', option.action, true);

  // Has to be after `.open()`. See https://github.com/enyo/dropzone/issues/179
  if (option.withCredentials && 'withCredentials' in xhr) {
    xhr.withCredentials = true;
  }

  var headers = option.headers || {};

  // when set headers['X-Requested-With'] = null , can close default XHR header
  // see https://github.com/react-component/upload/issues/33
  if (headers['X-Requested-With'] !== null) {
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
  }

  for (var h in headers) {
    if (headers.hasOwnProperty(h) && headers[h] !== null) {
      xhr.setRequestHeader(h, headers[h]);
    }
  }
  xhr.send(formData);

  return {
    abort: function abort() {
      xhr.abort();
    }
  };
}

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-upload/src/traverseFileTree.js":
/*!***************************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-upload/src/traverseFileTree.js ***!
  \***************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
var traverseFileTree = function traverseFileTree(files, callback, isAccepted) {
  var _traverseFileTree = function _traverseFileTree(item, path) {
    path = path || '';
    if (item.isFile) {
      item.file(function (file) {
        if (isAccepted(file)) {
          callback([file]);
        }
      });
    } else if (item.isDirectory) {
      var dirReader = item.createReader();

      dirReader.readEntries(function (entries) {
        var _iteratorNormalCompletion = true;
        var _didIteratorError = false;
        var _iteratorError = undefined;

        try {
          for (var _iterator = entries[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
            var entrieItem = _step.value;

            _traverseFileTree(entrieItem, '' + path + item.name + '/');
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
      });
    }
  };
  var _iteratorNormalCompletion2 = true;
  var _didIteratorError2 = false;
  var _iteratorError2 = undefined;

  try {
    for (var _iterator2 = files[Symbol.iterator](), _step2; !(_iteratorNormalCompletion2 = (_step2 = _iterator2.next()).done); _iteratorNormalCompletion2 = true) {
      var file = _step2.value;

      _traverseFileTree(file.webkitGetAsEntry());
    }
  } catch (err) {
    _didIteratorError2 = true;
    _iteratorError2 = err;
  } finally {
    try {
      if (!_iteratorNormalCompletion2 && _iterator2['return']) {
        _iterator2['return']();
      }
    } finally {
      if (_didIteratorError2) {
        throw _iteratorError2;
      }
    }
  }
};

exports['default'] = traverseFileTree;

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-upload/src/uid.js":
/*!**************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-upload/src/uid.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = uid;
var now = +new Date();
var index = 0;

function uid() {
  return "vc-upload-" + now + "-" + ++index;
}

/***/ }),

/***/ "./node_modules/lodash/_arrayIncludes.js":
/*!***********************************************!*\
  !*** ./node_modules/lodash/_arrayIncludes.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var baseIndexOf = __webpack_require__(/*! ./_baseIndexOf */ "./node_modules/lodash/_baseIndexOf.js");

/**
 * A specialized version of `_.includes` for arrays without support for
 * specifying an index to search from.
 *
 * @private
 * @param {Array} [array] The array to inspect.
 * @param {*} target The value to search for.
 * @returns {boolean} Returns `true` if `target` is found, else `false`.
 */
function arrayIncludes(array, value) {
  var length = array == null ? 0 : array.length;
  return !!length && baseIndexOf(array, value, 0) > -1;
}

module.exports = arrayIncludes;


/***/ }),

/***/ "./node_modules/lodash/_arrayIncludesWith.js":
/*!***************************************************!*\
  !*** ./node_modules/lodash/_arrayIncludesWith.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * This function is like `arrayIncludes` except that it accepts a comparator.
 *
 * @private
 * @param {Array} [array] The array to inspect.
 * @param {*} target The value to search for.
 * @param {Function} comparator The comparator invoked per element.
 * @returns {boolean} Returns `true` if `target` is found, else `false`.
 */
function arrayIncludesWith(array, value, comparator) {
  var index = -1,
      length = array == null ? 0 : array.length;

  while (++index < length) {
    if (comparator(value, array[index])) {
      return true;
    }
  }
  return false;
}

module.exports = arrayIncludesWith;


/***/ }),

/***/ "./node_modules/lodash/_baseIndexOf.js":
/*!*********************************************!*\
  !*** ./node_modules/lodash/_baseIndexOf.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var baseFindIndex = __webpack_require__(/*! ./_baseFindIndex */ "./node_modules/lodash/_baseFindIndex.js"),
    baseIsNaN = __webpack_require__(/*! ./_baseIsNaN */ "./node_modules/lodash/_baseIsNaN.js"),
    strictIndexOf = __webpack_require__(/*! ./_strictIndexOf */ "./node_modules/lodash/_strictIndexOf.js");

/**
 * The base implementation of `_.indexOf` without `fromIndex` bounds checks.
 *
 * @private
 * @param {Array} array The array to inspect.
 * @param {*} value The value to search for.
 * @param {number} fromIndex The index to search from.
 * @returns {number} Returns the index of the matched value, else `-1`.
 */
function baseIndexOf(array, value, fromIndex) {
  return value === value
    ? strictIndexOf(array, value, fromIndex)
    : baseFindIndex(array, baseIsNaN, fromIndex);
}

module.exports = baseIndexOf;


/***/ }),

/***/ "./node_modules/lodash/_baseIsNaN.js":
/*!*******************************************!*\
  !*** ./node_modules/lodash/_baseIsNaN.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * The base implementation of `_.isNaN` without support for number objects.
 *
 * @private
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is `NaN`, else `false`.
 */
function baseIsNaN(value) {
  return value !== value;
}

module.exports = baseIsNaN;


/***/ }),

/***/ "./node_modules/lodash/_baseUniq.js":
/*!******************************************!*\
  !*** ./node_modules/lodash/_baseUniq.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var SetCache = __webpack_require__(/*! ./_SetCache */ "./node_modules/lodash/_SetCache.js"),
    arrayIncludes = __webpack_require__(/*! ./_arrayIncludes */ "./node_modules/lodash/_arrayIncludes.js"),
    arrayIncludesWith = __webpack_require__(/*! ./_arrayIncludesWith */ "./node_modules/lodash/_arrayIncludesWith.js"),
    cacheHas = __webpack_require__(/*! ./_cacheHas */ "./node_modules/lodash/_cacheHas.js"),
    createSet = __webpack_require__(/*! ./_createSet */ "./node_modules/lodash/_createSet.js"),
    setToArray = __webpack_require__(/*! ./_setToArray */ "./node_modules/lodash/_setToArray.js");

/** Used as the size to enable large array optimizations. */
var LARGE_ARRAY_SIZE = 200;

/**
 * The base implementation of `_.uniqBy` without support for iteratee shorthands.
 *
 * @private
 * @param {Array} array The array to inspect.
 * @param {Function} [iteratee] The iteratee invoked per element.
 * @param {Function} [comparator] The comparator invoked per element.
 * @returns {Array} Returns the new duplicate free array.
 */
function baseUniq(array, iteratee, comparator) {
  var index = -1,
      includes = arrayIncludes,
      length = array.length,
      isCommon = true,
      result = [],
      seen = result;

  if (comparator) {
    isCommon = false;
    includes = arrayIncludesWith;
  }
  else if (length >= LARGE_ARRAY_SIZE) {
    var set = iteratee ? null : createSet(array);
    if (set) {
      return setToArray(set);
    }
    isCommon = false;
    includes = cacheHas;
    seen = new SetCache;
  }
  else {
    seen = iteratee ? [] : result;
  }
  outer:
  while (++index < length) {
    var value = array[index],
        computed = iteratee ? iteratee(value) : value;

    value = (comparator || value !== 0) ? value : 0;
    if (isCommon && computed === computed) {
      var seenIndex = seen.length;
      while (seenIndex--) {
        if (seen[seenIndex] === computed) {
          continue outer;
        }
      }
      if (iteratee) {
        seen.push(computed);
      }
      result.push(value);
    }
    else if (!includes(seen, computed, comparator)) {
      if (seen !== result) {
        seen.push(computed);
      }
      result.push(value);
    }
  }
  return result;
}

module.exports = baseUniq;


/***/ }),

/***/ "./node_modules/lodash/_createSet.js":
/*!*******************************************!*\
  !*** ./node_modules/lodash/_createSet.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var Set = __webpack_require__(/*! ./_Set */ "./node_modules/lodash/_Set.js"),
    noop = __webpack_require__(/*! ./noop */ "./node_modules/lodash/noop.js"),
    setToArray = __webpack_require__(/*! ./_setToArray */ "./node_modules/lodash/_setToArray.js");

/** Used as references for various `Number` constants. */
var INFINITY = 1 / 0;

/**
 * Creates a set object of `values`.
 *
 * @private
 * @param {Array} values The values to add to the set.
 * @returns {Object} Returns the new set.
 */
var createSet = !(Set && (1 / setToArray(new Set([,-0]))[1]) == INFINITY) ? noop : function(values) {
  return new Set(values);
};

module.exports = createSet;


/***/ }),

/***/ "./node_modules/lodash/_strictIndexOf.js":
/*!***********************************************!*\
  !*** ./node_modules/lodash/_strictIndexOf.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * A specialized version of `_.indexOf` which performs strict equality
 * comparisons of values, i.e. `===`.
 *
 * @private
 * @param {Array} array The array to inspect.
 * @param {*} value The value to search for.
 * @param {number} fromIndex The index to search from.
 * @returns {number} Returns the index of the matched value, else `-1`.
 */
function strictIndexOf(array, value, fromIndex) {
  var index = fromIndex - 1,
      length = array.length;

  while (++index < length) {
    if (array[index] === value) {
      return index;
    }
  }
  return -1;
}

module.exports = strictIndexOf;


/***/ }),

/***/ "./node_modules/lodash/noop.js":
/*!*************************************!*\
  !*** ./node_modules/lodash/noop.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * This method returns `undefined`.
 *
 * @static
 * @memberOf _
 * @since 2.3.0
 * @category Util
 * @example
 *
 * _.times(2, _.noop);
 * // => [undefined, undefined]
 */
function noop() {
  // No operation performed.
}

module.exports = noop;


/***/ }),

/***/ "./node_modules/lodash/uniqBy.js":
/*!***************************************!*\
  !*** ./node_modules/lodash/uniqBy.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var baseIteratee = __webpack_require__(/*! ./_baseIteratee */ "./node_modules/lodash/_baseIteratee.js"),
    baseUniq = __webpack_require__(/*! ./_baseUniq */ "./node_modules/lodash/_baseUniq.js");

/**
 * This method is like `_.uniq` except that it accepts `iteratee` which is
 * invoked for each element in `array` to generate the criterion by which
 * uniqueness is computed. The order of result values is determined by the
 * order they occur in the array. The iteratee is invoked with one argument:
 * (value).
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Array
 * @param {Array} array The array to inspect.
 * @param {Function} [iteratee=_.identity] The iteratee invoked per element.
 * @returns {Array} Returns the new duplicate free array.
 * @example
 *
 * _.uniqBy([2.1, 1.2, 2.3], Math.floor);
 * // => [2.1, 1.2]
 *
 * // The `_.property` iteratee shorthand.
 * _.uniqBy([{ 'x': 1 }, { 'x': 2 }, { 'x': 1 }], 'x');
 * // => [{ 'x': 1 }, { 'x': 2 }]
 */
function uniqBy(array, iteratee) {
  return (array && array.length) ? baseUniq(array, baseIteratee(iteratee, 2)) : [];
}

module.exports = uniqBy;


/***/ })

}]);