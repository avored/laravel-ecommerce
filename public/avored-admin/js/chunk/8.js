(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[8],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./vendor/avored/framework/resources/components/catalog/attribute/AttributeSave.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./vendor/avored/framework/resources/components/catalog/attribute/AttributeSave.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var lodash_isNil__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! lodash/isNil */ "./node_modules/lodash/isNil.js");
/* harmony import */ var lodash_isNil__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(lodash_isNil__WEBPACK_IMPORTED_MODULE_0__);

var id = 0;
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['attribute', 'baseUrl'],
  data: function data() {
    return {
      attributeForm: this.$form.createForm(this),
      dropdownOptions: [],
      image_path_lists: [],
      headers: {},
      display_as: '',
      fields: ['name', 'slug', 'display_as']
    };
  },
  methods: {
    handleSubmit: function handleSubmit() {
      this.attributeForm.validateFields(function (err, values) {
        if (err) {
          e.preventDefault();
        }
      });
    },
    imagePathName: function imagePathName(path) {
      var name = "dropdown_option[";
      Object.keys(path).forEach(function (key) {
        name += key;
      });
      name += "][path]";
      return name;
    },
    imagePathValue: function imagePathValue(path) {
      var value = "";
      Object.keys(path).forEach(function (key) {
        value += path[key];
      });
      return value;
    },
    handleUploadImageChange: function handleUploadImageChange(info, record) {
      if (info.file.status == "done") {
        var object = {};
        object[record] = info.file.response.path;
        this.image_path_lists.push(object);
      }
    },
    displayAsChange: function displayAsChange(val) {
      this.display_as = val;
    },
    cancelAttribute: function cancelAttribute() {
      window.location = this.baseUrl + '/attribute';
    },
    randomString: function randomString() {
      var random_string = '';
      var random_ascii;

      for (var i = 0; i < 6; i++) {
        random_ascii = Math.floor(Math.random() * 25 + 97);
        random_string += String.fromCharCode(random_ascii);
      }

      return random_string;
    },
    dropdownOptionChange: function dropdownOptionChange(index) {
      if (index == this.dropdownOptions.length - 1) {
        this.dropdownOptions.push(this.randomString());
      } else {
        this.dropdownOptions.splice(index, 1);
      }
    },
    getDefaultFile: function getDefaultFile(record) {
      if (lodash_isNil__WEBPACK_IMPORTED_MODULE_0___default()(this.attribute)) {
        return [];
      }

      var dropdownOption = this.attribute.dropdown_options[record];

      if (!lodash_isNil__WEBPACK_IMPORTED_MODULE_0___default()(dropdownOption) && !lodash_isNil__WEBPACK_IMPORTED_MODULE_0___default()(dropdownOption.path)) {
        var filename = dropdownOption.path.replace(/^.*[\\\/]/, '');
        return [{
          uid: dropdownOption.id,
          name: filename,
          status: 'done',
          url: '/storage/' + dropdownOption.path
        }];
      }
    },
    dropdownOptionDisplayTextName: function dropdownOptionDisplayTextName(index) {
      return 'dropdown_option[' + index + '][display_text]';
    },
    dropdown_options_image: function dropdown_options_image(index) {
      return 'dropdown_option_image[' + index + ']';
    }
  },
  mounted: function mounted() {
    var _this = this;

    this.headers = {
      'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
    };

    if (!lodash_isNil__WEBPACK_IMPORTED_MODULE_0___default()(this.attribute)) {
      this.display_as = this.attribute.display_as;
      this.fields.forEach(function (field) {
        _this.attributeForm.getFieldDecorator(field, {
          initialValue: _this.attribute[field]
        });
      });

      if (this.attribute.dropdown_options.length > 0) {
        this.attribute.dropdown_options.forEach(function (element) {
          _this.dropdownOptions.push(element.id);

          _this.attributeForm.getFieldDecorator('dropdown_options[' + element.id + ']', {
            initialValue: element.display_text,
            preserve: true
          });
        });
      }
    } else {
      this.dropdownOptions.push(this.randomString());
    }
  }
});

/***/ }),

/***/ "./node_modules/lodash/isNil.js":
/*!**************************************!*\
  !*** ./node_modules/lodash/isNil.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * Checks if `value` is `null` or `undefined`.
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is nullish, else `false`.
 * @example
 *
 * _.isNil(null);
 * // => true
 *
 * _.isNil(void 0);
 * // => true
 *
 * _.isNil(NaN);
 * // => false
 */
function isNil(value) {
  return value == null;
}

module.exports = isNil;


/***/ }),

/***/ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js":
/*!********************************************************************!*\
  !*** ./node_modules/vue-loader/lib/runtime/componentNormalizer.js ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return normalizeComponent; });
/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file (except for modules).
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

function normalizeComponent (
  scriptExports,
  render,
  staticRenderFns,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier, /* server only */
  shadowMode /* vue-cli only */
) {
  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (render) {
    options.render = render
    options.staticRenderFns = staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = 'data-v-' + scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = shadowMode
      ? function () { injectStyles.call(this, this.$root.$options.shadowRoot) }
      : injectStyles
  }

  if (hook) {
    if (options.functional) {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functioal component in vue file
      var originalRender = options.render
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return originalRender(h, context)
      }
    } else {
      // inject component registration as beforeCreate hook
      var existing = options.beforeCreate
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    }
  }

  return {
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ "./vendor/avored/framework/resources/components/catalog/attribute/AttributeSave.vue":
/*!******************************************************************************************!*\
  !*** ./vendor/avored/framework/resources/components/catalog/attribute/AttributeSave.vue ***!
  \******************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _AttributeSave_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./AttributeSave.vue?vue&type=script&lang=js& */ "./vendor/avored/framework/resources/components/catalog/attribute/AttributeSave.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");
var render, staticRenderFns




/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__["default"])(
  _AttributeSave_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"],
  render,
  staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "vendor/avored/framework/resources/components/catalog/attribute/AttributeSave.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./vendor/avored/framework/resources/components/catalog/attribute/AttributeSave.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************!*\
  !*** ./vendor/avored/framework/resources/components/catalog/attribute/AttributeSave.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AttributeSave_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./AttributeSave.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./vendor/avored/framework/resources/components/catalog/attribute/AttributeSave.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AttributeSave_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ })

}]);