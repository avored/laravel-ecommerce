(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[23],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./packages/framework/resources/components/order/order-status/OrderStatusSave.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./packages/framework/resources/components/order/order-status/OrderStatusSave.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var lodash_isNil__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! lodash/isNil */ "./node_modules/lodash/isNil.js");
/* harmony import */ var lodash_isNil__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(lodash_isNil__WEBPACK_IMPORTED_MODULE_0__);

/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['orderStatus', 'baseUrl'],
  data: function data() {
    return {
      orderStatusForm: this.$form.createForm(this),
      is_default: ''
    };
  },
  methods: {
    handleSubmit: function handleSubmit() {
      this.orderStatusForm.validateFields(function (err, values) {
        if (err) {
          e.preventDefault();
        }
      });
    },
    isOrderStatusDefaultSwitchChange: function isOrderStatusDefaultSwitchChange(checked) {
      if (checked) {
        this.is_default = 1;
      } else {
        this.is_default = 0;
      }
    },
    cancelOrderStatus: function cancelOrderStatus() {
      window.location = this.baseUrl + '/order-status';
    }
  },
  mounted: function mounted() {
    if (!lodash_isNil__WEBPACK_IMPORTED_MODULE_0___default()(this.orderStatus)) {
      this.is_default = this.orderStatus.is_default;
    }
  }
});

/***/ }),

/***/ "./packages/framework/resources/components/order/order-status/OrderStatusSave.vue":
/*!****************************************************************************************!*\
  !*** ./packages/framework/resources/components/order/order-status/OrderStatusSave.vue ***!
  \****************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _OrderStatusSave_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./OrderStatusSave.vue?vue&type=script&lang=js& */ "./packages/framework/resources/components/order/order-status/OrderStatusSave.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");
var render, staticRenderFns




/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__["default"])(
  _OrderStatusSave_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"],
  render,
  staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "packages/framework/resources/components/order/order-status/OrderStatusSave.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./packages/framework/resources/components/order/order-status/OrderStatusSave.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************!*\
  !*** ./packages/framework/resources/components/order/order-status/OrderStatusSave.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderStatusSave_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./OrderStatusSave.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./packages/framework/resources/components/order/order-status/OrderStatusSave.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderStatusSave_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ })

}]);