(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[9],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./vendor/avored/framework/resources/components/catalog/product/ProductTable.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./vendor/avored/framework/resources/components/catalog/product/ProductTable.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var lodash_isNil__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! lodash/isNil */ "./node_modules/lodash/isNil.js");
/* harmony import */ var lodash_isNil__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(lodash_isNil__WEBPACK_IMPORTED_MODULE_0__);
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
  label: "Name",
  fieldKey: "name"
}, {
  label: "Type",
  slotName: "productType"
}, {
  label: "Slug",
  fieldKey: "slug"
}, {
  label: "Actions",
  slotName: "action"
}];
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['baseUrl', 'initProducts'],
  data: function data() {
    return {
      columns: columns
    };
  },
  methods: {
    getEditUrl: function getEditUrl(record) {
      return this.baseUrl + '/product/' + record.id + '/edit';
    },
    getDeleteUrl: function getDeleteUrl(record) {
      return this.baseUrl + '/product/' + record.id;
    },
    deleteOnClick: function deleteOnClick(record) {
      var url = this.baseUrl + '/product/' + record.id;
      var app = this;
      this.$confirm({
        title: 'Do you Want to delete ' + record.name + ' product?',
        okType: 'danger',
        onOk: function onOk() {
          axios["delete"](url).then(function (response) {
            if (response.data.success === true) {
              app.$notification.error({
                key: 'product.delete.success',
                message: response.data.message
              });
            }

            window.location.reload();
          })["catch"](function (errors) {
            app.$notification.error({
              key: 'product.delete.error',
              message: errors.message
            });
          });
        },
        onCancel: function onCancel() {// Do nothing
        }
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./vendor/avored/framework/resources/components/catalog/product/ProductTable.vue?vue&type=template&id=70c1cf24&":
/*!****************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./vendor/avored/framework/resources/components/catalog/product/ProductTable.vue?vue&type=template&id=70c1cf24& ***!
  \****************************************************************************************************************************************************************************************************************************************************/
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
      _c(
        "avored-table",
        {
          attrs: {
            columns: _vm.columns,
            from: _vm.initProducts.from,
            to: _vm.initProducts.to,
            total: _vm.initProducts.total,
            prev_page_url: _vm.initProducts.prev_page_url,
            next_page_url: _vm.initProducts.next_page_url,
            items: _vm.initProducts.data
          },
          scopedSlots: _vm._u([
            {
              key: "productType",
              fn: function(ref) {
                var item = ref.item
                return [_vm._v("\n        " + _vm._s(item.type) + "\n      ")]
              }
            },
            {
              key: "action",
              fn: function(ref) {
                var item = ref.item
                return [
                  _c("div", { staticClass: "flex items-center" }, [
                    _c("a", { attrs: { href: _vm.getEditUrl(item) } }, [
                      _c(
                        "svg",
                        {
                          staticClass: "h-6 w-6",
                          attrs: { fill: "currentColor" }
                        },
                        [
                          _c("path", {
                            staticClass: "heroicon-ui",
                            attrs: {
                              d:
                                "M6.3 12.3l10-10a1 1 0 011.4 0l4 4a1 1 0 010 1.4l-10 10a1 1 0 01-.7.3H7a1 1 0 01-1-1v-4a1 1 0 01.3-.7zM8 16h2.59l9-9L17 4.41l-9 9V16zm10-2a1 1 0 012 0v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6c0-1.1.9-2 2-2h6a1 1 0 010 2H4v14h14v-6z"
                            }
                          })
                        ]
                      )
                    ]),
                    _vm._v(" "),
                    _c(
                      "button",
                      {
                        attrs: { type: "button" },
                        on: {
                          click: function($event) {
                            $event.preventDefault()
                            return _vm.deleteOnClick(item)
                          }
                        }
                      },
                      [
                        _c(
                          "svg",
                          {
                            staticClass: "h-6 w-6",
                            attrs: { fill: "currentColor" }
                          },
                          [
                            _c("path", {
                              staticClass: "heroicon-ui",
                              attrs: {
                                d:
                                  "M8 6V4c0-1.1.9-2 2-2h4a2 2 0 012 2v2h5a1 1 0 010 2h-1v12a2 2 0 01-2 2H6a2 2 0 01-2-2V8H3a1 1 0 110-2h5zM6 8v12h12V8H6zm8-2V4h-4v2h4zm-4 4a1 1 0 011 1v6a1 1 0 01-2 0v-6a1 1 0 011-1zm4 0a1 1 0 011 1v6a1 1 0 01-2 0v-6a1 1 0 011-1z"
                              }
                            })
                          ]
                        )
                      ]
                    )
                  ])
                ]
              }
            }
          ])
        },
        [_vm._v("\n      >\n      ")]
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./vendor/avored/framework/resources/components/catalog/product/ProductTable.vue":
/*!***************************************************************************************!*\
  !*** ./vendor/avored/framework/resources/components/catalog/product/ProductTable.vue ***!
  \***************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ProductTable_vue_vue_type_template_id_70c1cf24___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ProductTable.vue?vue&type=template&id=70c1cf24& */ "./vendor/avored/framework/resources/components/catalog/product/ProductTable.vue?vue&type=template&id=70c1cf24&");
/* harmony import */ var _ProductTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ProductTable.vue?vue&type=script&lang=js& */ "./vendor/avored/framework/resources/components/catalog/product/ProductTable.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ProductTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ProductTable_vue_vue_type_template_id_70c1cf24___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ProductTable_vue_vue_type_template_id_70c1cf24___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "vendor/avored/framework/resources/components/catalog/product/ProductTable.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./vendor/avored/framework/resources/components/catalog/product/ProductTable.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************!*\
  !*** ./vendor/avored/framework/resources/components/catalog/product/ProductTable.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./ProductTable.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./vendor/avored/framework/resources/components/catalog/product/ProductTable.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./vendor/avored/framework/resources/components/catalog/product/ProductTable.vue?vue&type=template&id=70c1cf24&":
/*!**********************************************************************************************************************!*\
  !*** ./vendor/avored/framework/resources/components/catalog/product/ProductTable.vue?vue&type=template&id=70c1cf24& ***!
  \**********************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductTable_vue_vue_type_template_id_70c1cf24___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./ProductTable.vue?vue&type=template&id=70c1cf24& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./vendor/avored/framework/resources/components/catalog/product/ProductTable.vue?vue&type=template&id=70c1cf24&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductTable_vue_vue_type_template_id_70c1cf24___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductTable_vue_vue_type_template_id_70c1cf24___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);