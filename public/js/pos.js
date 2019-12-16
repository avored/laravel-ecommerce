/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/components/PosConfig.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/components/PosConfig.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'pos-config',
  props: ['data', 'users'],
  data: function data() {
    return {
      status: false,
      user: null,
      addresses: [],
      shippingAddress: null,
      billingAddress: null
    };
  },
  methods: {
    statusChange: function statusChange(val) {
      this.status = val;
    },
    shippingAddressChange: function shippingAddressChange(val) {
      this.shippingAddress = val;
    },
    billingAddressChange: function billingAddressChange(val) {
      this.billingAddress = val;
    },
    setupAddresses: function setupAddresses(userId) {
      var app = this;
      var baseUrl = '/admin';
      axios.get(baseUrl + '/configuration/get-address/' + userId).then(function (res) {
        app.addresses = res.data;
      });
    },
    userChange: function userChange(val) {
      this.user = val;
      var axios = window.axios;
      this.setupAddresses(val);
    }
  },
  mounted: function mounted() {
    if (typeof this.data.a_pos_user !== 'undefined' && this.data.a_pos_user !== null) {
      this.user = this.data.a_pos_user;
      this.status = this.data.a_pos_status;
      this.shippingAddress = this.data.a_pos_user_shipping_address;
      this.billingAddress = this.data.a_pos_user_billing_address;
      this.setupAddresses(this.data.a_pos_user);
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/components/PosConfig.vue?vue&type=template&id=63844a15&":
/*!*********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/components/PosConfig.vue?vue&type=template&id=63844a15& ***!
  \*********************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c(
        "a-form-item",
        { attrs: { label: "Status" } },
        [
          _c(
            "a-select",
            {
              attrs: { "default-value": _vm.data.a_pos_status },
              on: { change: _vm.statusChange }
            },
            [
              _c("a-select-option", { attrs: { value: "true" } }, [
                _vm._v("Enabled")
              ]),
              _vm._v(" "),
              _c("a-select-option", { attrs: { value: "false" } }, [
                _vm._v("Disabled")
              ])
            ],
            1
          )
        ],
        1
      ),
      _vm._v(" "),
      _c("input", {
        directives: [
          {
            name: "model",
            rawName: "v-model",
            value: _vm.status,
            expression: "status"
          }
        ],
        attrs: { type: "hidden", name: "a_pos_status" },
        domProps: { value: _vm.status },
        on: {
          input: function($event) {
            if ($event.target.composing) {
              return
            }
            _vm.status = $event.target.value
          }
        }
      }),
      _vm._v(" "),
      _c(
        "a-form-item",
        { attrs: { label: "Default User" } },
        [
          _c(
            "a-select",
            {
              attrs: { "default-value": parseInt(_vm.data.a_pos_user) },
              on: { change: _vm.userChange }
            },
            _vm._l(_vm.users, function(user) {
              return _c(
                "a-select-option",
                { key: user.id, attrs: { value: user.id } },
                [_vm._v(_vm._s(user.name))]
              )
            }),
            1
          )
        ],
        1
      ),
      _vm._v(" "),
      _c("input", {
        directives: [
          {
            name: "model",
            rawName: "v-model",
            value: _vm.user,
            expression: "user"
          }
        ],
        attrs: { type: "hidden", name: "a_pos_user" },
        domProps: { value: _vm.user },
        on: {
          input: function($event) {
            if ($event.target.composing) {
              return
            }
            _vm.user = $event.target.value
          }
        }
      }),
      _vm._v(" "),
      _vm.addresses.length > 0
        ? _c(
            "a-form-item",
            { attrs: { label: "Default Shipping Address" } },
            [
              _c(
                "a-select",
                {
                  attrs: {
                    "default-value": parseInt(
                      _vm.data.a_pos_user_shipping_address
                    )
                  },
                  on: { change: _vm.shippingAddressChange }
                },
                _vm._l(_vm.addresses, function(address) {
                  return address.type == "SHIPPING"
                    ? _c(
                        "a-select-option",
                        { key: address.id, attrs: { value: address.id } },
                        [
                          _vm._v(
                            "\n                " +
                              _vm._s(address.address1) +
                              ", " +
                              _vm._s(address.address2) +
                              "\n                " +
                              _vm._s(address.city) +
                              " " +
                              _vm._s(address.state) +
                              "\n                " +
                              _vm._s(address.postcode) +
                              "\n            "
                          )
                        ]
                      )
                    : _vm._e()
                }),
                1
              )
            ],
            1
          )
        : _vm._e(),
      _vm._v(" "),
      _c("input", {
        directives: [
          {
            name: "model",
            rawName: "v-model",
            value: _vm.shippingAddress,
            expression: "shippingAddress"
          }
        ],
        attrs: { type: "hidden", name: "a_pos_user_shipping_address" },
        domProps: { value: _vm.shippingAddress },
        on: {
          input: function($event) {
            if ($event.target.composing) {
              return
            }
            _vm.shippingAddress = $event.target.value
          }
        }
      }),
      _vm._v(" "),
      _vm.addresses.length > 0
        ? _c(
            "a-form-item",
            { attrs: { label: "Default Billing Address" } },
            [
              _c(
                "a-select",
                {
                  attrs: {
                    "default-value": parseInt(
                      _vm.data.a_pos_user_billing_address
                    )
                  },
                  on: { change: _vm.billingAddressChange }
                },
                _vm._l(_vm.addresses, function(address) {
                  return address.type == "BILLING"
                    ? _c(
                        "a-select-option",
                        { key: address.id, attrs: { value: address.id } },
                        [
                          _vm._v(
                            "\n                " +
                              _vm._s(address.address1) +
                              ", " +
                              _vm._s(address.address2) +
                              "\n                " +
                              _vm._s(address.city) +
                              " " +
                              _vm._s(address.state) +
                              "\n                " +
                              _vm._s(address.postcode) +
                              "\n            "
                          )
                        ]
                      )
                    : _vm._e()
                }),
                1
              )
            ],
            1
          )
        : _vm._e(),
      _vm._v(" "),
      _c("input", {
        directives: [
          {
            name: "model",
            rawName: "v-model",
            value: _vm.billingAddress,
            expression: "billingAddress"
          }
        ],
        attrs: { type: "hidden", name: "a_pos_user_billing_address" },
        domProps: { value: _vm.billingAddress },
        on: {
          input: function($event) {
            if ($event.target.composing) {
              return
            }
            _vm.billingAddress = $event.target.value
          }
        }
      })
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



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

/***/ "./resources/components/PosConfig.vue":
/*!********************************************!*\
  !*** ./resources/components/PosConfig.vue ***!
  \********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _PosConfig_vue_vue_type_template_id_63844a15___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./PosConfig.vue?vue&type=template&id=63844a15& */ "./resources/components/PosConfig.vue?vue&type=template&id=63844a15&");
/* harmony import */ var _PosConfig_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./PosConfig.vue?vue&type=script&lang=js& */ "./resources/components/PosConfig.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _PosConfig_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _PosConfig_vue_vue_type_template_id_63844a15___WEBPACK_IMPORTED_MODULE_0__["render"],
  _PosConfig_vue_vue_type_template_id_63844a15___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/components/PosConfig.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/components/PosConfig.vue?vue&type=script&lang=js&":
/*!*********************************************************************!*\
  !*** ./resources/components/PosConfig.vue?vue&type=script&lang=js& ***!
  \*********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PosConfig_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../node_modules/babel-loader/lib??ref--4-0!../../node_modules/vue-loader/lib??vue-loader-options!./PosConfig.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/components/PosConfig.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PosConfig_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/components/PosConfig.vue?vue&type=template&id=63844a15&":
/*!***************************************************************************!*\
  !*** ./resources/components/PosConfig.vue?vue&type=template&id=63844a15& ***!
  \***************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PosConfig_vue_vue_type_template_id_63844a15___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../node_modules/vue-loader/lib??vue-loader-options!./PosConfig.vue?vue&type=template&id=63844a15& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/components/PosConfig.vue?vue&type=template&id=63844a15&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PosConfig_vue_vue_type_template_id_63844a15___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PosConfig_vue_vue_type_template_id_63844a15___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/pos.js":
/*!*****************************!*\
  !*** ./resources/js/pos.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

AvoRed.initialize(function (Vue) {
  //Vue.component('avored-cash-on-delivery', require('../components/AvoRedCashOnDelivery.vue').default)
  Vue.component('pos-config', __webpack_require__(/*! ../components/PosConfig.vue */ "./resources/components/PosConfig.vue")["default"]);
});

/***/ }),

/***/ 0:
/*!***********************************!*\
  !*** multi ./resources/js/pos.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/purvesh/code/ecommerce/modules/avored/pos/resources/js/pos.js */"./resources/js/pos.js");


/***/ })

/******/ });