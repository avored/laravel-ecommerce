(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[35],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./vendor/avored/framework/resources/components/order/order/OrderTable.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./vendor/avored/framework/resources/components/order/order/OrderTable.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_0__);
var columns = [{
  title: 'Payment Options',
  dataIndex: 'payment_option',
  key: 'payment_option',
  sorter: true
}, {
  title: 'Shipping Options',
  dataIndex: 'shipping_option',
  key: 'shipping_option',
  sorter: true
}, {
  title: 'Status',
  dataIndex: 'order_status_id',
  scopedSlots: {
    customRender: 'order_status'
  },
  key: 'order_status_id',
  sorter: true
}, {
  title: 'Action',
  key: 'action',
  scopedSlots: {
    customRender: 'action'
  },
  sorter: false,
  width: "20%"
}];

/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['baseUrl', 'orderStatus'],
  data: function data() {
    return {
      columns: columns,
      changeStatusId: null,
      track_code: '',
      track_code_modal_visibility: false,
      change_status_modal_visibility: false,
      currentRecord: {}
    };
  },
  methods: {
    getShowUrl: function getShowUrl(record) {
      return this.baseUrl + '/order/' + record.id;
    },
    changeStatusDropdown: function changeStatusDropdown(val) {
      this.changeStatusId = val;
    },
    downloadOrderAction: function downloadOrderAction(record) {
      return this.baseUrl + '/order-download-invoice/' + record.id;
    },
    getOrderStatus: function getOrderStatus(statusId) {
      var index;
      index = this.orderStatus.findIndex(function (ele) {
        return ele.id === statusId;
      });

      if (index >= 0) {
        return this.orderStatus[index].name;
      }

      return '';
    },
    emailInvoiceOrderAction: function emailInvoiceOrderAction(record) {
      return this.baseUrl + '/order-email-invoice/' + record.id;
    },
    shippingLabelOrderAction: function shippingLabelOrderAction(record) {
      return this.baseUrl + '/order-shipping-label/' + record.id;
    },
    orderShowAction: function orderShowAction(record) {
      return this.baseUrl + '/order/' + record.id;
    },
    handleTrackCodeOk: function handleTrackCodeOk(e) {
      var data = {
        track_code: this.track_code
      };
      var url = this.baseUrl + '/save-order-track-code/' + this.currentRecord.id;
      var app = this;
      axios__WEBPACK_IMPORTED_MODULE_0___default.a.post(url, data).then(function (response) {
        if (response.data.success === true) {
          app.$notification.success({
            key: 'save.order.track.code.success',
            message: response.data.message
          });
        }

        window.location.reload();
        app.track_code_modal_visibility = false;
      })["catch"](function (errors) {
        app.$notification.error({
          key: 'save.order.track.code.error',
          message: errors.message
        });
      });
    },
    changeStatusMenuClick: function changeStatusMenuClick(record, e) {
      e.preventDefault();
      this.currentRecord = record;
      this.change_status = record.order_Status_id;
      this.change_status_modal_visibility = true;
    },
    addTrackingCodeMenuClick: function addTrackingCodeMenuClick(record, e) {
      e.preventDefault();
      this.currentRecord = record;
      this.track_code = record.track_code;
      this.track_code_modal_visibility = true;
    },
    handleTrackCodeCancel: function handleTrackCodeCancel() {
      this.track_code_modal_visibility = false;
    },
    handleChangeStatusCancel: function handleChangeStatusCancel() {
      this.change_status_modal_visibility = false;
    },
    handleChangeStatusOk: function handleChangeStatusOk() {
      var data = {
        order_status_id: this.changeStatusId
      };
      var url = this.baseUrl + '/order-change-status/' + this.currentRecord.id;
      var app = this;
      axios__WEBPACK_IMPORTED_MODULE_0___default.a.post(url, data).then(function (response) {
        if (response.data.success === true) {
          app.$notification.success({
            key: 'order.delete.success',
            message: response.data.message
          });
        }

        window.location.reload();
      })["catch"](function (errors) {
        app.$notification.error({
          key: 'order.delete.error',
          message: errors.message
        });
      });
    }
  }
});

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

/***/ "./vendor/avored/framework/resources/components/order/order/OrderTable.vue":
/*!*********************************************************************************!*\
  !*** ./vendor/avored/framework/resources/components/order/order/OrderTable.vue ***!
  \*********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _OrderTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./OrderTable.vue?vue&type=script&lang=js& */ "./vendor/avored/framework/resources/components/order/order/OrderTable.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");
var render, staticRenderFns




/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__["default"])(
  _OrderTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"],
  render,
  staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "vendor/avored/framework/resources/components/order/order/OrderTable.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./vendor/avored/framework/resources/components/order/order/OrderTable.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************!*\
  !*** ./vendor/avored/framework/resources/components/order/order/OrderTable.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./OrderTable.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./vendor/avored/framework/resources/components/order/order/OrderTable.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ })

}]);