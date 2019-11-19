(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[62],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./vendor/avored/framework/resources/components/system/language/LanguageTable.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./vendor/avored/framework/resources/components/system/language/LanguageTable.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var lodash_isNil__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! lodash/isNil */ "./node_modules/lodash/isNil.js");
/* harmony import */ var lodash_isNil__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(lodash_isNil__WEBPACK_IMPORTED_MODULE_0__);

var columns = [{
  title: 'Name',
  dataIndex: 'name',
  key: 'name',
  sorter: true
}, {
  title: 'Code',
  dataIndex: 'code',
  key: 'code',
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
  props: ['languages', 'baseUrl'],
  data: function data() {
    return {
      columns: columns
    };
  },
  methods: {
    handleTableChange: function handleTableChange(pagination, filters, sorter) {
      this.languages.sort(function (a, b) {
        var columnKey = sorter.columnKey;
        var order = sorter.order;

        if (lodash_isNil__WEBPACK_IMPORTED_MODULE_0___default()(a[columnKey])) {
          a[columnKey] = '';
        }

        if (lodash_isNil__WEBPACK_IMPORTED_MODULE_0___default()(b[columnKey])) {
          b[columnKey] = '';
        }

        if (order === 'ascend') {
          if (a[columnKey] < b[columnKey]) return -1;
          if (a[columnKey] > b[columnKey]) return 1;
        }

        if (order === 'descend') {
          if (a[columnKey] > b[columnKey]) return -1;
          if (a[columnKey] < b[columnKey]) return 1;
        }

        return 0;
      });
    },
    getEditUrl: function getEditUrl(record) {
      return this.baseUrl + '/language/' + record.id + '/edit';
    },
    getDeleteUrl: function getDeleteUrl(record) {
      return this.baseUrl + '/language/' + record.id;
    },
    deleteLanguage: function deleteLanguage(record) {
      var url = this.baseUrl + '/language/' + record.id;
      var app = this;
      this.$confirm({
        title: 'Do you Want to delete ' + record.name + ' languages?',
        okType: 'danger',
        onOk: function onOk() {
          axios["delete"](url).then(function (response) {
            if (response.data.success === true) {
              app.$notification.error({
                key: 'language.delete.success',
                message: response.data.message
              });
            }

            window.location.reload();
          })["catch"](function (errors) {
            app.$notification.error({
              key: 'language.delete.error',
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

/***/ "./vendor/avored/framework/resources/components/system/language/LanguageTable.vue":
/*!****************************************************************************************!*\
  !*** ./vendor/avored/framework/resources/components/system/language/LanguageTable.vue ***!
  \****************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _LanguageTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./LanguageTable.vue?vue&type=script&lang=js& */ "./vendor/avored/framework/resources/components/system/language/LanguageTable.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");
var render, staticRenderFns




/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__["default"])(
  _LanguageTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"],
  render,
  staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "vendor/avored/framework/resources/components/system/language/LanguageTable.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./vendor/avored/framework/resources/components/system/language/LanguageTable.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************!*\
  !*** ./vendor/avored/framework/resources/components/system/language/LanguageTable.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_LanguageTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./LanguageTable.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./vendor/avored/framework/resources/components/system/language/LanguageTable.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_LanguageTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ })

}]);