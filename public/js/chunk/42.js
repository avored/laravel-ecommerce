(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[42],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./vendor/avored/framework/resources/components/catalog/product/ProductIndex.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./vendor/avored/framework/resources/components/catalog/product/ProductIndex.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var columns = [{
  title: 'Name',
  dataIndex: 'name',
  key: 'name',
  sorter: true
}, {
  title: 'Slug',
  dataIndex: 'slug',
  key: 'slug',
  sorter: true
}, {
  title: 'Meta Title',
  dataIndex: 'meta_title',
  key: 'meta_title',
  sorter: true
}, {
  title: 'Action',
  key: 'action',
  scopedSlots: {
    customRender: 'action'
  },
  sorter: false,
  width: "10%"
}];
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['baseUrl'],
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
    deleteProduct: function deleteProduct(record) {
      var url = this.baseUrl + '/product/' + record.id;
      var app = this;
      this.$confirm({
        title: 'Do you Want to delete ' + record.name + ' product?',
        okType: 'danger',
        onOk: function onOk() {
          axios["delete"](url).then(function (response) {
            if (response.success === true) {
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

/***/ "./vendor/avored/framework/resources/components/catalog/product/ProductIndex.vue":
/*!***************************************************************************************!*\
  !*** ./vendor/avored/framework/resources/components/catalog/product/ProductIndex.vue ***!
  \***************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ProductIndex_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ProductIndex.vue?vue&type=script&lang=js& */ "./vendor/avored/framework/resources/components/catalog/product/ProductIndex.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");
var render, staticRenderFns




/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__["default"])(
  _ProductIndex_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"],
  render,
  staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "vendor/avored/framework/resources/components/catalog/product/ProductIndex.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./vendor/avored/framework/resources/components/catalog/product/ProductIndex.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************!*\
  !*** ./vendor/avored/framework/resources/components/catalog/product/ProductIndex.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductIndex_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./ProductIndex.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./vendor/avored/framework/resources/components/catalog/product/ProductIndex.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductIndex_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ })

}]);