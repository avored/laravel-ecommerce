(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[23],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./vendor/avored/framework/resources/components/promotion/promotion-code/PromotionCodeEdit.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./vendor/avored/framework/resources/components/promotion/promotion-code/PromotionCodeEdit.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vue_quill_editor__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue-quill-editor */ "./node_modules/vue-quill-editor/dist/vue-quill-editor.js");
/* harmony import */ var vue_quill_editor__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vue_quill_editor__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var lodash_isNil__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! lodash/isNil */ "./node_modules/lodash/isNil.js");
/* harmony import */ var lodash_isNil__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(lodash_isNil__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var moment__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! moment */ "./node_modules/moment/moment.js");
/* harmony import */ var moment__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(moment__WEBPACK_IMPORTED_MODULE_2__);



/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['promotionCode', 'baseUrl'],
  data: function data() {
    return {
      form: this.$form.createForm(this),
      status: 0,
      type: null,
      activeFrom: null,
      activeTill: null,
      dateFormat: 'DD-MM-Y',
      activeFromDefault: null,
      activeTillDefault: null
    };
  },
  methods: {
    handleSubmit: function handleSubmit() {
      this.form.validateFields(function (err, values) {
        if (err) {
          e.preventDefault();
        }
      });
    },
    onActiveFromChange: function onActiveFromChange(val) {
      this.activeFrom = val.format('Y-MM-DD');
    },
    onActiveTillChange: function onActiveTillChange(val) {
      this.activeTill = val.format('Y-MM-DD');
    },
    handleTypeChange: function handleTypeChange(val) {
      this.type = val;
    },
    changeStatus: function changeStatus(val) {
      if (val) {
        this.status = 1;
      } else {
        this.status = 0;
      }
    },
    clickCancelButton: function clickCancelButton() {
      window.location = this.baseUrl + '/promotion-code';
    }
  },
  mounted: function mounted() {
    if (!lodash_isNil__WEBPACK_IMPORTED_MODULE_1___default()(this.promotionCode)) {
      this.status = this.promotionCode.status;
      this.type = this.promotionCode.type;
    }

    if (!lodash_isNil__WEBPACK_IMPORTED_MODULE_1___default()(this.promotionCode.active_from)) {
      this.activeFromDefault = moment__WEBPACK_IMPORTED_MODULE_2___default()(this.promotionCode.active_from, 'Y-MM-DD');
      this.activeFrom = this.promotionCode.active_from;
    }

    if (!lodash_isNil__WEBPACK_IMPORTED_MODULE_1___default()(this.promotionCode.active_till)) {
      this.activeTillDefault = moment__WEBPACK_IMPORTED_MODULE_2___default()(this.promotionCode.active_till, 'Y-MM-DD');
      this.activeTill = this.promotionCode.active_till;
    }
  }
});

/***/ }),

/***/ "./vendor/avored/framework/resources/components/promotion/promotion-code/PromotionCodeEdit.vue":
/*!*****************************************************************************************************!*\
  !*** ./vendor/avored/framework/resources/components/promotion/promotion-code/PromotionCodeEdit.vue ***!
  \*****************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _PromotionCodeEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./PromotionCodeEdit.vue?vue&type=script&lang=js& */ "./vendor/avored/framework/resources/components/promotion/promotion-code/PromotionCodeEdit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");
var render, staticRenderFns




/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__["default"])(
  _PromotionCodeEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"],
  render,
  staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "vendor/avored/framework/resources/components/promotion/promotion-code/PromotionCodeEdit.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./vendor/avored/framework/resources/components/promotion/promotion-code/PromotionCodeEdit.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************!*\
  !*** ./vendor/avored/framework/resources/components/promotion/promotion-code/PromotionCodeEdit.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PromotionCodeEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./PromotionCodeEdit.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./vendor/avored/framework/resources/components/promotion/promotion-code/PromotionCodeEdit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PromotionCodeEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ })

}]);