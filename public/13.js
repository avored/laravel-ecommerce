(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[13],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./vendor/avored/framework/resources/components/order/order/OrderTable.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./vendor/avored/framework/resources/components/order/order/OrderTable.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************************************************/
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
var columns = [{
  label: "ID",
  fieldKey: "id"
}, {
  label: "Shipping Options",
  fieldKey: "shipping_option"
}, {
  label: "Payment Options",
  fieldKey: "payment_option"
}, {
  label: "User",
  slotName: "orderUser"
}, {
  label: "Actions",
  slotName: "action"
}];
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ["baseUrl", "initOrders"],
  data: function data() {
    return {
      columns: columns,
      changeStatusId: null,
      track_code: "",
      track_code_modal_visibility: false,
      change_status_modal_visibility: false,
      currentRecord: {}
    };
  },
  methods: {
    orderShowAction: function orderShowAction(record) {
      return this.baseUrl + "/order/" + record.id;
    },
    handleTrackCodeOk: function handleTrackCodeOk(e) {
      var data = {
        track_code: this.track_code
      };
      var url = this.baseUrl + "/save-order-track-code/" + this.currentRecord.id;
      var app = this;
      axios.post(url, data).then(function (response) {
        if (response.data.success === true) {
          app.$notification.success({
            key: "save.order.track.code.success",
            message: response.data.message
          });
        }

        window.location.reload();
        app.track_code_modal_visibility = false;
      })["catch"](function (errors) {
        app.$notification.error({
          key: "save.order.track.code.error",
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
    getShowUrl: function getShowUrl(record) {
      return this.baseUrl + "/order/" + record.id;
    },
    changeStatusDropdown: function changeStatusDropdown(val) {
      this.changeStatusId = val;
    },
    downloadOrderAction: function downloadOrderAction(record) {
      return this.baseUrl + "/order-download-invoice/" + record.id;
    },
    getOrderStatus: function getOrderStatus(statusId) {
      var index;
      index = this.orderStatus.findIndex(function (ele) {
        return ele.id === statusId;
      });

      if (index >= 0) {
        return this.orderStatus[index].name;
      }

      return "";
    },
    emailInvoiceOrderAction: function emailInvoiceOrderAction(record) {
      return this.baseUrl + "/order-email-invoice/" + record.id;
    },
    shippingLabelOrderAction: function shippingLabelOrderAction(record) {
      return this.baseUrl + "/order-shipping-label/" + record.id;
    },
    handleChangeStatusOk: function handleChangeStatusOk() {
      var data = {
        order_status_id: this.changeStatusId
      };
      var url = this.baseUrl + "/order-change-status/" + this.currentRecord.id;
      var app = this;
      axios.post(url, data).then(function (response) {
        if (response.data.success === true) {
          app.$notification.success({
            key: "order.delete.success",
            message: response.data.message
          });
        }

        window.location.reload();
      })["catch"](function (errors) {
        app.$notification.error({
          key: "order.delete.error",
          message: errors.message
        });
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./vendor/avored/framework/resources/components/order/order/OrderTable.vue?vue&type=template&id=435c0791&":
/*!**********************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./vendor/avored/framework/resources/components/order/order/OrderTable.vue?vue&type=template&id=435c0791& ***!
  \**********************************************************************************************************************************************************************************************************************************************/
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
    { staticClass: "mt-3" },
    [
      _c("avored-table", {
        attrs: {
          columns: _vm.columns,
          from: _vm.initOrders.from,
          to: _vm.initOrders.to,
          total: _vm.initOrders.total,
          prev_page_url: _vm.initOrders.prev_page_url,
          next_page_url: _vm.initOrders.next_page_url,
          items: _vm.initOrders.data
        },
        scopedSlots: _vm._u([
          {
            key: "orderUser",
            fn: function(ref) {
              var item = ref.item
              return [_vm._v(_vm._s(item.user.name))]
            }
          },
          {
            key: "action",
            fn: function(ref) {
              var item = ref.item
              return [
                _c(
                  "div",
                  { staticClass: "flex items-center" },
                  [
                    _c(
                      "a-dropdown",
                      [
                        _c(
                          "a",
                          {
                            staticClass: "ant-dropdown-link",
                            attrs: { href: "#" }
                          },
                          [
                            _vm._v("\n            Actions\n            "),
                            _c("a-icon", { attrs: { type: "down" } })
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "a-menu",
                          { attrs: { slot: "overlay" }, slot: "overlay" },
                          [
                            _c("a-menu-item", [
                              _c(
                                "a",
                                { attrs: { href: _vm.orderShowAction(item) } },
                                [_vm._v("Show")]
                              )
                            ]),
                            _vm._v(" "),
                            _c("a-menu-item", [
                              _c(
                                "a",
                                {
                                  on: {
                                    click: function($event) {
                                      $event.preventDefault()
                                      return _vm.changeStatusMenuClick(
                                        item,
                                        $event
                                      )
                                    }
                                  }
                                },
                                [_vm._v("Change Status")]
                              )
                            ]),
                            _vm._v(" "),
                            _c("a-menu-item", [
                              _c(
                                "a",
                                {
                                  on: {
                                    click: function($event) {
                                      $event.preventDefault()
                                      return _vm.addTrackingCodeMenuClick(
                                        item,
                                        $event
                                      )
                                    }
                                  }
                                },
                                [_vm._v("Add Tracking")]
                              )
                            ]),
                            _vm._v(" "),
                            _c("a-menu-item", [
                              _c(
                                "a",
                                {
                                  attrs: { href: _vm.downloadOrderAction(item) }
                                },
                                [_vm._v("Download Invoice")]
                              )
                            ]),
                            _vm._v(" "),
                            _c("a-menu-item", [
                              _c(
                                "a",
                                {
                                  attrs: {
                                    href: _vm.emailInvoiceOrderAction(item)
                                  }
                                },
                                [_vm._v("Email Invoice")]
                              )
                            ]),
                            _vm._v(" "),
                            _c("a-menu-item", [
                              _c(
                                "a",
                                {
                                  attrs: {
                                    href: _vm.shippingLabelOrderAction(item)
                                  }
                                },
                                [_vm._v("Shipping Label")]
                              )
                            ])
                          ],
                          1
                        )
                      ],
                      1
                    )
                  ],
                  1
                )
              ]
            }
          }
        ])
      }),
      _vm._v(" "),
      _c(
        "a-modal",
        {
          attrs: { title: "Change Track Code", "ok-text": "Save" },
          on: { cancel: _vm.handleTrackCodeCancel, ok: _vm.handleTrackCodeOk },
          model: {
            value: _vm.track_code_modal_visibility,
            callback: function($$v) {
              _vm.track_code_modal_visibility = $$v
            },
            expression: "track_code_modal_visibility"
          }
        },
        [
          _c(
            "a-form-item",
            { attrs: { label: "Track Code" } },
            [
              _c("a-input", {
                attrs: { "auto-focus": true, name: "track_code" },
                model: {
                  value: _vm.track_code,
                  callback: function($$v) {
                    _vm.track_code = $$v
                  },
                  expression: "track_code"
                }
              })
            ],
            1
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "a-modal",
        {
          attrs: { title: "Order Status", "ok-text": "Save" },
          on: {
            cancel: _vm.handleChangeStatusCancel,
            ok: _vm.handleChangeStatusOk
          },
          model: {
            value: _vm.change_status_modal_visibility,
            callback: function($$v) {
              _vm.change_status_modal_visibility = $$v
            },
            expression: "change_status_modal_visibility"
          }
        },
        [
          _c(
            "a-row",
            [
              _c(
                "a-col",
                { attrs: { span: 24 } },
                [
                  _c(
                    "a-form-item",
                    { attrs: { label: "Order Status" } },
                    [
                      _c(
                        "a-select",
                        {
                          style: { width: "100%" },
                          on: { change: _vm.changeStatusDropdown }
                        },
                        [_c("option", [_vm._v("Test")])]
                      ),
                      _vm._v(" "),
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.changeStatusId,
                            expression: "changeStatusId"
                          }
                        ],
                        attrs: { type: "hidden" },
                        domProps: { value: _vm.changeStatusId },
                        on: {
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.changeStatusId = $event.target.value
                          }
                        }
                      })
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          )
        ],
        1
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./vendor/avored/framework/resources/components/order/order/OrderTable.vue":
/*!*********************************************************************************!*\
  !*** ./vendor/avored/framework/resources/components/order/order/OrderTable.vue ***!
  \*********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _OrderTable_vue_vue_type_template_id_435c0791___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./OrderTable.vue?vue&type=template&id=435c0791& */ "./vendor/avored/framework/resources/components/order/order/OrderTable.vue?vue&type=template&id=435c0791&");
/* harmony import */ var _OrderTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./OrderTable.vue?vue&type=script&lang=js& */ "./vendor/avored/framework/resources/components/order/order/OrderTable.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _OrderTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _OrderTable_vue_vue_type_template_id_435c0791___WEBPACK_IMPORTED_MODULE_0__["render"],
  _OrderTable_vue_vue_type_template_id_435c0791___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
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

/***/ }),

/***/ "./vendor/avored/framework/resources/components/order/order/OrderTable.vue?vue&type=template&id=435c0791&":
/*!****************************************************************************************************************!*\
  !*** ./vendor/avored/framework/resources/components/order/order/OrderTable.vue?vue&type=template&id=435c0791& ***!
  \****************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderTable_vue_vue_type_template_id_435c0791___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./OrderTable.vue?vue&type=template&id=435c0791& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./vendor/avored/framework/resources/components/order/order/OrderTable.vue?vue&type=template&id=435c0791&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderTable_vue_vue_type_template_id_435c0791___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderTable_vue_vue_type_template_id_435c0791___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);