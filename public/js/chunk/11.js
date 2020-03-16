(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[11],{

/***/ "./node_modules/ant-design-vue/lib/input-number/index.js":
/*!***************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/input-number/index.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.InputNumberProps = undefined;

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _defineProperty2 = __webpack_require__(/*! babel-runtime/helpers/defineProperty */ "./node_modules/babel-runtime/helpers/defineProperty.js");

var _defineProperty3 = _interopRequireDefault(_defineProperty2);

var _objectWithoutProperties2 = __webpack_require__(/*! babel-runtime/helpers/objectWithoutProperties */ "./node_modules/babel-runtime/helpers/objectWithoutProperties.js");

var _objectWithoutProperties3 = _interopRequireDefault(_objectWithoutProperties2);

var _vueTypes = __webpack_require__(/*! ../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _propsUtil = __webpack_require__(/*! ../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

var _classnames = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");

var _classnames2 = _interopRequireDefault(_classnames);

var _icon = __webpack_require__(/*! ../icon */ "./node_modules/ant-design-vue/lib/icon/index.js");

var _icon2 = _interopRequireDefault(_icon);

var _src = __webpack_require__(/*! ../vc-input-number/src */ "./node_modules/ant-design-vue/lib/vc-input-number/src/index.js");

var _src2 = _interopRequireDefault(_src);

var _configProvider = __webpack_require__(/*! ../config-provider */ "./node_modules/ant-design-vue/lib/config-provider/index.js");

var _base = __webpack_require__(/*! ../base */ "./node_modules/ant-design-vue/lib/base/index.js");

var _base2 = _interopRequireDefault(_base);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var InputNumberProps = exports.InputNumberProps = {
  prefixCls: _vueTypes2['default'].string,
  min: _vueTypes2['default'].number,
  max: _vueTypes2['default'].number,
  value: _vueTypes2['default'].oneOfType([_vueTypes2['default'].number, _vueTypes2['default'].string]),
  step: _vueTypes2['default'].oneOfType([_vueTypes2['default'].number, _vueTypes2['default'].string]),
  defaultValue: _vueTypes2['default'].number,
  tabIndex: _vueTypes2['default'].number,
  disabled: _vueTypes2['default'].bool,
  size: _vueTypes2['default'].oneOf(['large', 'small', 'default']),
  formatter: _vueTypes2['default'].func,
  parser: _vueTypes2['default'].func,
  decimalSeparator: _vueTypes2['default'].string,
  placeholder: _vueTypes2['default'].string,
  name: _vueTypes2['default'].string,
  id: _vueTypes2['default'].string,
  precision: _vueTypes2['default'].number,
  autoFocus: _vueTypes2['default'].bool
};

var InputNumber = {
  name: 'AInputNumber',
  model: {
    prop: 'value',
    event: 'change'
  },
  props: (0, _propsUtil.initDefaultProps)(InputNumberProps, {
    step: 1
  }),
  inject: {
    configProvider: { 'default': function _default() {
        return _configProvider.ConfigConsumerProps;
      } }
  },
  methods: {
    focus: function focus() {
      this.$refs.inputNumberRef.focus();
    },
    blur: function blur() {
      this.$refs.inputNumberRef.blur();
    }
  },

  render: function render() {
    var _classNames;

    var h = arguments[0];

    var _getOptionProps = (0, _propsUtil.getOptionProps)(this),
        customizePrefixCls = _getOptionProps.prefixCls,
        size = _getOptionProps.size,
        others = (0, _objectWithoutProperties3['default'])(_getOptionProps, ['prefixCls', 'size']);

    var getPrefixCls = this.configProvider.getPrefixCls;
    var prefixCls = getPrefixCls('input-number', customizePrefixCls);

    var inputNumberClass = (0, _classnames2['default'])((_classNames = {}, (0, _defineProperty3['default'])(_classNames, prefixCls + '-lg', size === 'large'), (0, _defineProperty3['default'])(_classNames, prefixCls + '-sm', size === 'small'), _classNames));
    var upIcon = h(_icon2['default'], {
      attrs: { type: 'up' },
      'class': prefixCls + '-handler-up-inner' });
    var downIcon = h(_icon2['default'], {
      attrs: { type: 'down' },
      'class': prefixCls + '-handler-down-inner' });

    var vcInputNumberprops = {
      props: (0, _extends3['default'])({
        prefixCls: prefixCls,
        upHandler: upIcon,
        downHandler: downIcon
      }, others),
      'class': inputNumberClass,
      ref: 'inputNumberRef',
      on: this.$listeners
    };
    return h(_src2['default'], vcInputNumberprops);
  }
};

/* istanbul ignore next */
InputNumber.install = function (Vue) {
  Vue.use(_base2['default']);
  Vue.component(InputNumber.name, InputNumber);
};

exports['default'] = InputNumber;

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-input-number/src/InputHandler.js":
/*!*****************************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-input-number/src/InputHandler.js ***!
  \*****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _vueTypes = __webpack_require__(/*! ../../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _vcMFeedback = __webpack_require__(/*! ../../vc-m-feedback */ "./node_modules/ant-design-vue/lib/vc-m-feedback/index.js");

var _vcMFeedback2 = _interopRequireDefault(_vcMFeedback);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var InputHandler = {
  props: {
    prefixCls: _vueTypes2['default'].string,
    disabled: _vueTypes2['default'].bool
  },
  render: function render() {
    var h = arguments[0];
    var _$props = this.$props,
        prefixCls = _$props.prefixCls,
        disabled = _$props.disabled;

    var touchableProps = {
      props: {
        disabled: disabled,
        activeClassName: prefixCls + '-handler-active'
      },
      on: this.$listeners
    };
    return h(
      _vcMFeedback2['default'],
      touchableProps,
      [h('span', [this.$slots['default']])]
    );
  }
};

exports['default'] = InputHandler;

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-input-number/src/index.js":
/*!**********************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-input-number/src/index.js ***!
  \**********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _defineProperty2 = __webpack_require__(/*! babel-runtime/helpers/defineProperty */ "./node_modules/babel-runtime/helpers/defineProperty.js");

var _defineProperty3 = _interopRequireDefault(_defineProperty2);

var _toConsumableArray2 = __webpack_require__(/*! babel-runtime/helpers/toConsumableArray */ "./node_modules/babel-runtime/helpers/toConsumableArray.js");

var _toConsumableArray3 = _interopRequireDefault(_toConsumableArray2);

var _vueTypes = __webpack_require__(/*! ../../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

var _BaseMixin = __webpack_require__(/*! ../../_util/BaseMixin */ "./node_modules/ant-design-vue/lib/_util/BaseMixin.js");

var _BaseMixin2 = _interopRequireDefault(_BaseMixin);

var _propsUtil = __webpack_require__(/*! ../../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

var _classnames = __webpack_require__(/*! classnames */ "./node_modules/classnames/index.js");

var _classnames2 = _interopRequireDefault(_classnames);

var _isNegativeZero = __webpack_require__(/*! is-negative-zero */ "./node_modules/is-negative-zero/index.js");

var _isNegativeZero2 = _interopRequireDefault(_isNegativeZero);

var _KeyCode = __webpack_require__(/*! ../../_util/KeyCode */ "./node_modules/ant-design-vue/lib/_util/KeyCode.js");

var _KeyCode2 = _interopRequireDefault(_KeyCode);

var _InputHandler = __webpack_require__(/*! ./InputHandler */ "./node_modules/ant-design-vue/lib/vc-input-number/src/InputHandler.js");

var _InputHandler2 = _interopRequireDefault(_InputHandler);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

function noop() {} // based on rc-input-number 4.4.0


function preventDefault(e) {
  e.preventDefault();
}

function defaultParser(input) {
  return input.replace(/[^\w\.-]+/g, '');
}

/**
 * When click and hold on a button - the speed of auto changin the value.
 */
var SPEED = 200;

/**
 * When click and hold on a button - the delay before auto changin the value.
 */
var DELAY = 600;

/**
 * Max Safe Integer -- on IE this is not available, so manually set the number in that case.
 * The reason this is used, instead of Infinity is because numbers above the MSI are unstable
 */
var MAX_SAFE_INTEGER = Number.MAX_SAFE_INTEGER || Math.pow(2, 53) - 1;

var isValidProps = function isValidProps(value) {
  return value !== undefined && value !== null;
};

var inputNumberProps = {
  value: _vueTypes2['default'].oneOfType([_vueTypes2['default'].number, _vueTypes2['default'].string]),
  defaultValue: _vueTypes2['default'].oneOfType([_vueTypes2['default'].number, _vueTypes2['default'].string]),
  focusOnUpDown: _vueTypes2['default'].bool,
  autoFocus: _vueTypes2['default'].bool,
  // onChange: PropTypes.func,
  // onKeyDown: PropTypes.func,
  // onKeyUp: PropTypes.func,
  prefixCls: _vueTypes2['default'].string,
  tabIndex: _vueTypes2['default'].oneOfType([_vueTypes2['default'].string, _vueTypes2['default'].number]),
  placeholder: _vueTypes2['default'].string,
  disabled: _vueTypes2['default'].bool,
  // onFocus: PropTypes.func,
  // onBlur: PropTypes.func,
  readOnly: _vueTypes2['default'].bool,
  max: _vueTypes2['default'].number,
  min: _vueTypes2['default'].number,
  step: _vueTypes2['default'].oneOfType([_vueTypes2['default'].number, _vueTypes2['default'].string]),
  upHandler: _vueTypes2['default'].any,
  downHandler: _vueTypes2['default'].any,
  useTouch: _vueTypes2['default'].bool,
  formatter: _vueTypes2['default'].func,
  parser: _vueTypes2['default'].func,
  // onMouseEnter: PropTypes.func,
  // onMouseLeave: PropTypes.func,
  // onMouseOver: PropTypes.func,
  // onMouseOut: PropTypes.func,
  precision: _vueTypes2['default'].number,
  required: _vueTypes2['default'].bool,
  pattern: _vueTypes2['default'].string,
  decimalSeparator: _vueTypes2['default'].string,
  autoComplete: _vueTypes2['default'].string,
  title: _vueTypes2['default'].string
};

exports['default'] = {
  name: 'InputNumber',
  mixins: [_BaseMixin2['default']],
  model: {
    prop: 'value',
    event: 'change'
  },
  props: (0, _propsUtil.initDefaultProps)(inputNumberProps, {
    focusOnUpDown: true,
    useTouch: false,
    prefixCls: 'rc-input-number',
    min: -MAX_SAFE_INTEGER,
    step: 1,
    parser: defaultParser,
    required: false,
    autoComplete: 'off'
  }),
  data: function data() {
    var value = void 0;
    if ((0, _propsUtil.hasProp)(this, 'value')) {
      value = this.value;
    } else {
      value = this.defaultValue;
    }
    value = this.toNumber(value);

    return {
      inputValue: this.toPrecisionAsStep(value),
      sValue: value,
      focused: this.autoFocus
    };
  },
  mounted: function mounted() {
    var _this = this;

    this.$nextTick(function () {
      if (_this.autoFocus && !_this.disabled) {
        _this.focus();
      }
      _this.updatedFunc();
    });
  },
  beforeUpdate: function beforeUpdate() {
    var _this2 = this;

    this.$nextTick(function () {
      try {
        _this2.start = _this2.$refs.inputRef.selectionStart;
        _this2.end = _this2.$refs.inputRef.selectionEnd;
      } catch (e) {
        // Fix error in Chrome:
        // Failed to read the 'selectionStart' property from 'HTMLInputElement'
        // http://stackoverflow.com/q/21177489/3040605
      }
    });
  },
  updated: function updated() {
    var _this3 = this;

    this.$nextTick(function () {
      _this3.updatedFunc();
    });
  },
  beforeDestroy: function beforeDestroy() {
    this.stop();
  },

  watch: {
    value: function value(val) {
      var value = this.focused ? val : this.getValidValue(val, this.min, this.max);
      this.setState({
        sValue: val,
        inputValue: this.inputting ? value : this.toPrecisionAsStep(value)
      });
    },
    max: function max(val) {
      var props = (0, _propsUtil.getOptionProps)(this);
      // Trigger onChange when max or min change
      // https://github.com/ant-design/ant-design/issues/11574
      var nextValue = 'value' in props ? props.value : this.sValue;
      // ref: null < 20 === true
      // https://github.com/ant-design/ant-design/issues/14277
      if (typeof nextValue === 'number' && nextValue > val) {
        this.__emit('change', val);
      }
    },
    min: function min(val) {
      var props = (0, _propsUtil.getOptionProps)(this);
      var nextValue = 'value' in props ? props.value : this.sValue;
      if (typeof nextValue === 'number' && nextValue < val) {
        this.__emit('change', val);
      }
    }
  },
  methods: {
    updatedFunc: function updatedFunc() {
      var inputElem = this.$refs.inputRef;
      // Restore cursor
      try {
        // Firefox set the input cursor after it get focused.
        // This caused that if an input didn't init with the selection,
        // set will cause cursor not correct when first focus.
        // Safari will focus input if set selection. We need skip this.
        if (this.cursorStart !== undefined && this.focused) {
          // In most cases, the string after cursor is stable.
          // We can move the cursor before it

          if (
          // If not match full str, try to match part of str
          !this.partRestoreByAfter(this.cursorAfter) && this.sValue !== this.value) {
            // If not match any of then, let's just keep the position
            // TODO: Logic should not reach here, need check if happens
            var pos = this.cursorStart + 1;

            // If not have last string, just position to the end
            if (!this.cursorAfter) {
              pos = inputElem.value.length;
            } else if (this.lastKeyCode === _KeyCode2['default'].BACKSPACE) {
              pos = this.cursorStart - 1;
            } else if (this.lastKeyCode === _KeyCode2['default'].DELETE) {
              pos = this.cursorStart;
            }
            this.fixCaret(pos, pos);
          } else if (this.currentValue === inputElem.value) {
            // Handle some special key code
            switch (this.lastKeyCode) {
              case _KeyCode2['default'].BACKSPACE:
                this.fixCaret(this.cursorStart - 1, this.cursorStart - 1);
                break;
              case _KeyCode2['default'].DELETE:
                this.fixCaret(this.cursorStart + 1, this.cursorStart + 1);
                break;
              default:
              // Do nothing
            }
          }
        }
      } catch (e) {}
      // Do nothing

      // Reset last key
      this.lastKeyCode = null;

      // pressingUpOrDown is true means that someone just click up or down button
      if (!this.pressingUpOrDown) {
        return;
      }
      if (this.focusOnUpDown && this.focused) {
        if (document.activeElement !== inputElem) {
          this.focus();
        }
      }

      this.pressingUpOrDown = false;
    },
    onKeyDown: function onKeyDown(e) {
      if (e.keyCode === _KeyCode2['default'].UP) {
        var ratio = this.getRatio(e);
        this.up(e, ratio);
        this.stop();
      } else if (e.keyCode === _KeyCode2['default'].DOWN) {
        var _ratio = this.getRatio(e);
        this.down(e, _ratio);
        this.stop();
      }
      // Trigger user key down
      this.recordCursorPosition();
      this.lastKeyCode = e.keyCode;

      for (var _len = arguments.length, args = Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
        args[_key - 1] = arguments[_key];
      }

      this.$emit.apply(this, ['keydown', e].concat((0, _toConsumableArray3['default'])(args)));
    },
    onKeyUp: function onKeyUp(e) {
      this.stop();

      this.recordCursorPosition();

      for (var _len2 = arguments.length, args = Array(_len2 > 1 ? _len2 - 1 : 0), _key2 = 1; _key2 < _len2; _key2++) {
        args[_key2 - 1] = arguments[_key2];
      }

      this.$emit.apply(this, ['keyup', e].concat((0, _toConsumableArray3['default'])(args)));
    },
    onChange: function onChange(e) {
      if (this.focused) {
        this.inputting = true;
      }
      var input = this.parser(this.getValueFromEvent(e));
      this.setState({ inputValue: input });
      this.$emit('change', this.toNumberWhenUserInput(input)); // valid number or invalid string
    },
    onFocus: function onFocus() {
      this.setState({
        focused: true
      });

      for (var _len3 = arguments.length, args = Array(_len3), _key3 = 0; _key3 < _len3; _key3++) {
        args[_key3] = arguments[_key3];
      }

      this.$emit.apply(this, ['focus'].concat((0, _toConsumableArray3['default'])(args)));
    },
    onBlur: function onBlur(e) {
      var _this4 = this;

      for (var _len4 = arguments.length, args = Array(_len4 > 1 ? _len4 - 1 : 0), _key4 = 1; _key4 < _len4; _key4++) {
        args[_key4 - 1] = arguments[_key4];
      }

      this.inputting = false;
      this.setState({
        focused: false
      });
      var value = this.getCurrentValidValue(this.inputValue);
      // todo
      // e.persist() // fix https://github.com/react-component/input-number/issues/51
      this.setValue(value, function () {
        _this4.$emit.apply(_this4, ['blur', e].concat((0, _toConsumableArray3['default'])(args)));
      });
    },
    getCurrentValidValue: function getCurrentValidValue(value) {
      var val = value;
      if (val === '') {
        val = '';
      } else if (!this.isNotCompleteNumber(parseFloat(val, 10))) {
        val = this.getValidValue(val);
      } else {
        val = this.sValue;
      }
      return this.toNumber(val);
    },
    getRatio: function getRatio(e) {
      var ratio = 1;
      if (e.metaKey || e.ctrlKey) {
        ratio = 0.1;
      } else if (e.shiftKey) {
        ratio = 10;
      }
      return ratio;
    },
    getValueFromEvent: function getValueFromEvent(e) {
      // optimize for chinese input expierence
      // https://github.com/ant-design/ant-design/issues/8196
      var value = e.target.value.trim().replace(/。/g, '.');

      if (isValidProps(this.decimalSeparator)) {
        value = value.replace(this.decimalSeparator, '.');
      }

      return value;
    },
    getValidValue: function getValidValue(value) {
      var min = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : this.min;
      var max = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : this.max;

      var val = parseFloat(value, 10);
      // https://github.com/ant-design/ant-design/issues/7358
      if (isNaN(val)) {
        return value;
      }
      if (val < min) {
        val = min;
      }
      if (val > max) {
        val = max;
      }
      return val;
    },
    setValue: function setValue(v, callback) {
      // trigger onChange
      var newValue = this.isNotCompleteNumber(parseFloat(v, 10)) ? null : parseFloat(v, 10);
      var changed = newValue !== this.sValue || '' + newValue !== '' + this.inputValue; // https://github.com/ant-design/ant-design/issues/7363
      if (!(0, _propsUtil.hasProp)(this, 'value')) {
        this.setState({
          sValue: newValue,
          inputValue: this.toPrecisionAsStep(v)
        }, callback);
      } else {
        // always set input value same as value
        this.setState({
          inputValue: this.toPrecisionAsStep(this.sValue)
        }, callback);
      }
      if (changed) {
        this.$emit('change', newValue);
      }
    },
    getPrecision: function getPrecision(value) {
      if (isValidProps(this.precision)) {
        return this.precision;
      }
      var valueString = value.toString();
      if (valueString.indexOf('e-') >= 0) {
        return parseInt(valueString.slice(valueString.indexOf('e-') + 2), 10);
      }
      var precision = 0;
      if (valueString.indexOf('.') >= 0) {
        precision = valueString.length - valueString.indexOf('.') - 1;
      }
      return precision;
    },

    // step={1.0} value={1.51}
    // press +
    // then value should be 2.51, rather than 2.5
    // if this.props.precision is undefined
    // https://github.com/react-component/input-number/issues/39
    getMaxPrecision: function getMaxPrecision(currentValue) {
      var ratio = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 1;

      if (isValidProps(this.precision)) {
        return this.precision;
      }
      var step = this.step;

      var ratioPrecision = this.getPrecision(ratio);
      var stepPrecision = this.getPrecision(step);
      var currentValuePrecision = this.getPrecision(currentValue);
      if (!currentValue) {
        return ratioPrecision + stepPrecision;
      }
      return Math.max(currentValuePrecision, ratioPrecision + stepPrecision);
    },
    getPrecisionFactor: function getPrecisionFactor(currentValue) {
      var ratio = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 1;

      var precision = this.getMaxPrecision(currentValue, ratio);
      return Math.pow(10, precision);
    },
    getInputDisplayValue: function getInputDisplayValue() {
      var focused = this.focused,
          inputValue = this.inputValue,
          sValue = this.sValue;

      var inputDisplayValue = void 0;
      if (focused) {
        inputDisplayValue = inputValue;
      } else {
        inputDisplayValue = this.toPrecisionAsStep(sValue);
      }

      if (inputDisplayValue === undefined || inputDisplayValue === null) {
        inputDisplayValue = '';
      }

      return inputDisplayValue;
    },
    recordCursorPosition: function recordCursorPosition() {
      // Record position
      try {
        var inputElem = this.$refs.inputRef;
        this.cursorStart = inputElem.selectionStart;
        this.cursorEnd = inputElem.selectionEnd;
        this.currentValue = inputElem.value;
        this.cursorBefore = inputElem.value.substring(0, this.cursorStart);
        this.cursorAfter = inputElem.value.substring(this.cursorEnd);
      } catch (e) {
        // Fix error in Chrome:
        // Failed to read the 'selectionStart' property from 'HTMLInputElement'
        // http://stackoverflow.com/q/21177489/3040605
      }
    },
    fixCaret: function fixCaret(start, end) {
      if (start === undefined || end === undefined || !this.input || !this.input.value) {
        return;
      }

      try {
        var inputElem = this.$refs.inputRef;
        var currentStart = inputElem.selectionStart;
        var currentEnd = inputElem.selectionEnd;

        if (start !== currentStart || end !== currentEnd) {
          inputElem.setSelectionRange(start, end);
        }
      } catch (e) {
        // Fix error in Chrome:
        // Failed to read the 'selectionStart' property from 'HTMLInputElement'
        // http://stackoverflow.com/q/21177489/3040605
      }
    },
    restoreByAfter: function restoreByAfter(str) {
      if (str === undefined) return false;

      var fullStr = this.$refs.inputRef.value;
      var index = fullStr.lastIndexOf(str);

      if (index === -1) return false;

      if (index + str.length === fullStr.length) {
        this.fixCaret(index, index);

        return true;
      }
      return false;
    },
    partRestoreByAfter: function partRestoreByAfter(str) {
      var _this5 = this;

      if (str === undefined) return false;

      // For loop from full str to the str with last char to map. e.g. 123
      // -> 123
      // -> 23
      // -> 3
      return Array.prototype.some.call(str, function (_, start) {
        var partStr = str.substring(start);

        return _this5.restoreByAfter(partStr);
      });
    },
    focus: function focus() {
      this.$refs.inputRef.focus();
      this.recordCursorPosition();
    },
    blur: function blur() {
      this.$refs.inputRef.blur();
    },
    formatWrapper: function formatWrapper(num) {
      // http://2ality.com/2012/03/signedzero.html
      // https://github.com/ant-design/ant-design/issues/9439
      if ((0, _isNegativeZero2['default'])(num)) {
        return '-0';
      }
      if (this.formatter) {
        return this.formatter(num);
      }
      return num;
    },
    toPrecisionAsStep: function toPrecisionAsStep(num) {
      if (this.isNotCompleteNumber(num) || num === '') {
        return num;
      }
      var precision = Math.abs(this.getMaxPrecision(num));
      if (precision === 0) {
        return num.toString();
      }
      if (!isNaN(precision)) {
        return Number(num).toFixed(precision);
      }
      return num.toString();
    },

    // '1.' '1x' 'xx' '' => are not complete numbers
    isNotCompleteNumber: function isNotCompleteNumber(num) {
      return isNaN(num) || num === '' || num === null || num && num.toString().indexOf('.') === num.toString().length - 1;
    },
    toNumber: function toNumber(num) {
      if (this.isNotCompleteNumber(num)) {
        return num;
      }
      if (isValidProps(this.precision)) {
        return Number(Number(num).toFixed(this.precision));
      }
      return Number(num);
    },

    // '1.0' '1.00'  => may be a inputing number
    toNumberWhenUserInput: function toNumberWhenUserInput(num) {
      // num.length > 16 => prevent input large number will became Infinity
      if ((/\.\d*0$/.test(num) || num.length > 16) && this.focused) {
        return num;
      }
      return this.toNumber(num);
    },
    upStep: function upStep(val, rat) {
      var step = this.step,
          min = this.min;

      var precisionFactor = this.getPrecisionFactor(val, rat);
      var precision = Math.abs(this.getMaxPrecision(val, rat));
      var result = void 0;
      if (typeof val === 'number') {
        result = ((precisionFactor * val + precisionFactor * step * rat) / precisionFactor).toFixed(precision);
      } else {
        result = min === -Infinity ? step : min;
      }
      return this.toNumber(result);
    },
    downStep: function downStep(val, rat) {
      var step = this.step,
          min = this.min;

      var precisionFactor = this.getPrecisionFactor(val, rat);
      var precision = Math.abs(this.getMaxPrecision(val, rat));
      var result = void 0;
      if (typeof val === 'number') {
        result = ((precisionFactor * val - precisionFactor * step * rat) / precisionFactor).toFixed(precision);
      } else {
        result = min === -Infinity ? -step : min;
      }
      return this.toNumber(result);
    },
    stepFn: function stepFn(type, e) {
      var _this6 = this;

      var ratio = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 1;
      var recursive = arguments[3];

      this.stop();
      if (e) {
        // e.persist()
        e.preventDefault();
      }
      if (this.disabled) {
        return;
      }
      var max = this.max,
          min = this.min;

      var value = this.getCurrentValidValue(this.inputValue) || 0;
      if (this.isNotCompleteNumber(value)) {
        return;
      }
      var val = this[type + 'Step'](value, ratio);
      var outOfRange = val > max || val < min;
      if (val > max) {
        val = max;
      } else if (val < min) {
        val = min;
      }
      this.setValue(val);
      this.setState({
        focused: true
      });
      if (outOfRange) {
        return;
      }
      this.autoStepTimer = setTimeout(function () {
        _this6[type](e, ratio, true);
      }, recursive ? SPEED : DELAY);
    },
    stop: function stop() {
      if (this.autoStepTimer) {
        clearTimeout(this.autoStepTimer);
      }
    },
    down: function down(e, ratio, recursive) {
      this.pressingUpOrDown = true;
      this.stepFn('down', e, ratio, recursive);
    },
    up: function up(e, ratio, recursive) {
      this.pressingUpOrDown = true;
      this.stepFn('up', e, ratio, recursive);
    },
    handleInputClick: function handleInputClick() {
      this.$emit('click');
    }
  },
  render: function render() {
    var _classNames;

    var h = arguments[0];
    var _$props = this.$props,
        prefixCls = _$props.prefixCls,
        disabled = _$props.disabled,
        readOnly = _$props.readOnly,
        useTouch = _$props.useTouch,
        autoComplete = _$props.autoComplete,
        upHandler = _$props.upHandler,
        downHandler = _$props.downHandler;

    var classes = (0, _classnames2['default'])((_classNames = {}, (0, _defineProperty3['default'])(_classNames, prefixCls, true), (0, _defineProperty3['default'])(_classNames, prefixCls + '-disabled', disabled), (0, _defineProperty3['default'])(_classNames, prefixCls + '-focused', this.focused), _classNames));
    var upDisabledClass = '';
    var downDisabledClass = '';
    var sValue = this.sValue;

    if (sValue || sValue === 0) {
      if (!isNaN(sValue)) {
        var val = Number(sValue);
        if (val >= this.max) {
          upDisabledClass = prefixCls + '-handler-up-disabled';
        }
        if (val <= this.min) {
          downDisabledClass = prefixCls + '-handler-down-disabled';
        }
      } else {
        upDisabledClass = prefixCls + '-handler-up-disabled';
        downDisabledClass = prefixCls + '-handler-down-disabled';
      }
    }

    var editable = !this.readOnly && !this.disabled;

    // focus state, show input value
    // unfocus state, show valid value
    var inputDisplayValue = void 0;
    if (this.focused) {
      inputDisplayValue = this.inputValue;
    } else {
      inputDisplayValue = this.toPrecisionAsStep(this.sValue);
    }

    if (inputDisplayValue === undefined || inputDisplayValue === null) {
      inputDisplayValue = '';
    }

    var upEvents = void 0;
    var downEvents = void 0;
    if (useTouch) {
      upEvents = {
        touchstart: editable && !upDisabledClass ? this.up : noop,
        touchend: this.stop
      };
      downEvents = {
        touchstart: editable && !downDisabledClass ? this.down : noop,
        touchend: this.stop
      };
    } else {
      upEvents = {
        mousedown: editable && !upDisabledClass ? this.up : noop,
        mouseup: this.stop,
        mouseleave: this.stop
      };
      downEvents = {
        mousedown: editable && !downDisabledClass ? this.down : noop,
        mouseup: this.stop,
        mouseleave: this.stop
      };
    }
    var inputDisplayValueFormat = this.formatWrapper(inputDisplayValue);
    if (isValidProps(this.decimalSeparator)) {
      inputDisplayValueFormat = inputDisplayValueFormat.toString().replace('.', this.decimalSeparator);
    }
    var isUpDisabled = !!upDisabledClass || disabled || readOnly;
    var isDownDisabled = !!downDisabledClass || disabled || readOnly;
    var _$listeners = this.$listeners,
        _$listeners$mouseente = _$listeners.mouseenter,
        mouseenter = _$listeners$mouseente === undefined ? noop : _$listeners$mouseente,
        _$listeners$mouseleav = _$listeners.mouseleave,
        mouseleave = _$listeners$mouseleav === undefined ? noop : _$listeners$mouseleav,
        _$listeners$mouseover = _$listeners.mouseover,
        mouseover = _$listeners$mouseover === undefined ? noop : _$listeners$mouseover,
        _$listeners$mouseout = _$listeners.mouseout,
        mouseout = _$listeners$mouseout === undefined ? noop : _$listeners$mouseout;

    var contentProps = {
      on: { mouseenter: mouseenter, mouseleave: mouseleave, mouseover: mouseover, mouseout: mouseout },
      'class': classes,
      attrs: { title: this.$props.title }
    };
    var upHandlerProps = {
      props: {
        disabled: isUpDisabled,
        prefixCls: prefixCls
      },
      attrs: {
        unselectable: 'unselectable',
        role: 'button',
        'aria-label': 'Increase Value',
        'aria-disabled': !!isUpDisabled
      },
      'class': prefixCls + '-handler ' + prefixCls + '-handler-up ' + upDisabledClass,
      on: upEvents,
      ref: 'up'
    };
    var downHandlerProps = {
      props: {
        disabled: isDownDisabled,
        prefixCls: prefixCls
      },
      attrs: {
        unselectable: 'unselectable',
        role: 'button',
        'aria-label': 'Decrease Value',
        'aria-disabled': !!isDownDisabled
      },
      'class': prefixCls + '-handler ' + prefixCls + '-handler-down ' + downDisabledClass,
      on: downEvents,
      ref: 'down'
    };
    // ref for test
    return h(
      'div',
      contentProps,
      [h(
        'div',
        { 'class': prefixCls + '-handler-wrap' },
        [h(
          _InputHandler2['default'],
          upHandlerProps,
          [upHandler || h('span', {
            attrs: {
              unselectable: 'unselectable'
            },
            'class': prefixCls + '-handler-up-inner',
            on: {
              'click': preventDefault
            }
          })]
        ), h(
          _InputHandler2['default'],
          downHandlerProps,
          [downHandler || h('span', {
            attrs: {
              unselectable: 'unselectable'
            },
            'class': prefixCls + '-handler-down-inner',
            on: {
              'click': preventDefault
            }
          })]
        )]
      ), h(
        'div',
        {
          'class': prefixCls + '-input-wrap',
          attrs: { role: 'spinbutton',
            'aria-valuemin': this.min,
            'aria-valuemax': this.max,
            'aria-valuenow': sValue
          }
        },
        [h('input', {
          attrs: {
            required: this.required,
            type: this.type,
            placeholder: this.placeholder,

            tabIndex: this.tabIndex,
            autoComplete: autoComplete,

            maxLength: this.maxLength,
            readOnly: this.readOnly,
            disabled: this.disabled,
            max: this.max,
            min: this.min,
            step: this.step,
            name: this.name,
            id: this.id,

            pattern: this.pattern
          },
          on: {
            'click': this.handleInputClick,
            'focus': this.onFocus,
            'blur': this.onBlur,
            'keydown': editable ? this.onKeyDown : noop,
            'keyup': editable ? this.onKeyUp : noop,
            'input': this.onChange
          },

          'class': prefixCls + '-input',
          ref: 'inputRef',
          domProps: {
            'value': inputDisplayValueFormat
          }
        })]
      )]
    );
  }
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-m-feedback/index.js":
/*!****************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-m-feedback/index.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _TouchFeedback = __webpack_require__(/*! ./src/TouchFeedback */ "./node_modules/ant-design-vue/lib/vc-m-feedback/src/TouchFeedback.js");

var _TouchFeedback2 = _interopRequireDefault(_TouchFeedback);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports['default'] = _TouchFeedback2['default']; // based on 2.0.0

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-m-feedback/src/PropTypes.js":
/*!************************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-m-feedback/src/PropTypes.js ***!
  \************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.ITouchProps = undefined;

var _vueTypes = __webpack_require__(/*! ../../_util/vue-types */ "./node_modules/ant-design-vue/lib/_util/vue-types/index.js");

var _vueTypes2 = _interopRequireDefault(_vueTypes);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

var ITouchProps = exports.ITouchProps = {
  disabled: _vueTypes2['default'].bool,
  activeClassName: _vueTypes2['default'].string,
  activeStyle: _vueTypes2['default'].any
  // onTouchStart: PropTypes.func,
  // onTouchEnd: PropTypes.func,
  // onTouchCancel: PropTypes.func,
  // onMouseDown: PropTypes.func,
  // onMouseUp: PropTypes.func,
  // onMouseLeave: PropTypes.func,
};

/***/ }),

/***/ "./node_modules/ant-design-vue/lib/vc-m-feedback/src/TouchFeedback.js":
/*!****************************************************************************!*\
  !*** ./node_modules/ant-design-vue/lib/vc-m-feedback/src/TouchFeedback.js ***!
  \****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _extends2 = __webpack_require__(/*! babel-runtime/helpers/extends */ "./node_modules/babel-runtime/helpers/extends.js");

var _extends3 = _interopRequireDefault(_extends2);

var _propsUtil = __webpack_require__(/*! ../../_util/props-util */ "./node_modules/ant-design-vue/lib/_util/props-util.js");

var _vnode = __webpack_require__(/*! ../../_util/vnode */ "./node_modules/ant-design-vue/lib/_util/vnode.js");

var _warning = __webpack_require__(/*! ../../_util/warning */ "./node_modules/ant-design-vue/lib/_util/warning.js");

var _warning2 = _interopRequireDefault(_warning);

var _BaseMixin = __webpack_require__(/*! ../../_util/BaseMixin */ "./node_modules/ant-design-vue/lib/_util/BaseMixin.js");

var _BaseMixin2 = _interopRequireDefault(_BaseMixin);

var _PropTypes = __webpack_require__(/*! ./PropTypes */ "./node_modules/ant-design-vue/lib/vc-m-feedback/src/PropTypes.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { 'default': obj }; }

exports['default'] = {
  name: 'TouchFeedback',
  mixins: [_BaseMixin2['default']],
  props: (0, _propsUtil.initDefaultProps)(_PropTypes.ITouchProps, {
    disabled: false
  }),
  data: function data() {
    return {
      active: false
    };
  },
  mounted: function mounted() {
    var _this = this;

    this.$nextTick(function () {
      if (_this.disabled && _this.active) {
        _this.setState({
          active: false
        });
      }
    });
  },

  methods: {
    triggerEvent: function triggerEvent(type, isActive, ev) {
      // 暂时仅有input-number用到，事件直接到挂载到Touchable上，不需要像antd那样从子组件触发
      this.$emit(type, ev);
      if (isActive !== this.active) {
        this.setState({
          active: isActive
        });
      }
    },
    onTouchStart: function onTouchStart(e) {
      this.triggerEvent('touchstart', true, e);
    },
    onTouchMove: function onTouchMove(e) {
      this.triggerEvent('touchmove', false, e);
    },
    onTouchEnd: function onTouchEnd(e) {
      this.triggerEvent('touchend', false, e);
    },
    onTouchCancel: function onTouchCancel(e) {
      this.triggerEvent('touchcancel', false, e);
    },
    onMouseDown: function onMouseDown(e) {
      // pc simulate mobile
      this.triggerEvent('mousedown', true, e);
    },
    onMouseUp: function onMouseUp(e) {
      this.triggerEvent('mouseup', false, e);
    },
    onMouseLeave: function onMouseLeave(e) {
      this.triggerEvent('mouseleave', false, e);
    }
  },
  render: function render() {
    var _$props = this.$props,
        disabled = _$props.disabled,
        _$props$activeClassNa = _$props.activeClassName,
        activeClassName = _$props$activeClassNa === undefined ? '' : _$props$activeClassNa,
        _$props$activeStyle = _$props.activeStyle,
        activeStyle = _$props$activeStyle === undefined ? {} : _$props$activeStyle;


    var child = this.$slots['default'];
    if (child.length !== 1) {
      (0, _warning2['default'])(false, 'm-feedback组件只能包含一个子元素');
      return null;
    }
    var childProps = {
      on: disabled ? {} : {
        touchstart: this.onTouchStart,
        touchmove: this.onTouchMove,
        touchend: this.onTouchEnd,
        touchcancel: this.onTouchCancel,
        mousedown: this.onMouseDown,
        mouseup: this.onMouseUp,
        mouseleave: this.onMouseLeave
      }
    };

    if (!disabled && this.active) {
      childProps = (0, _extends3['default'])({}, childProps, {
        style: activeStyle,
        'class': activeClassName
      });
    }

    return (0, _vnode.cloneElement)(child, childProps);
  }
};

/***/ }),

/***/ "./node_modules/is-negative-zero/index.js":
/*!************************************************!*\
  !*** ./node_modules/is-negative-zero/index.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


module.exports = function isNegativeZero(number) {
	return number === 0 && (1 / number) === -Infinity;
};



/***/ })

}]);