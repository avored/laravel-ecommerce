(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[25],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./packages/framework/resources/components/order/order/OrderTable.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./packages/framework/resources/components/order/order/OrderTable.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************************************/
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

/***/ "./packages/framework/resources/components/order/order/OrderTable.vue":
/*!****************************************************************************!*\
  !*** ./packages/framework/resources/components/order/order/OrderTable.vue ***!
  \****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _OrderTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./OrderTable.vue?vue&type=script&lang=js& */ "./packages/framework/resources/components/order/order/OrderTable.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");
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
component.options.__file = "packages/framework/resources/components/order/order/OrderTable.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./packages/framework/resources/components/order/order/OrderTable.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************!*\
  !*** ./packages/framework/resources/components/order/order/OrderTable.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./OrderTable.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./packages/framework/resources/components/order/order/OrderTable.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ })

}]);