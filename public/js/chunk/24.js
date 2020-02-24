(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[24],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/components/CartPage.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/components/CartPage.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_0__);

/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['items', 'couponUrl', 'cartDeleteUrl', 'cartUpdateUrl'],
  data: function data() {
    return {
      form: this.$form.createForm(this),
      showCartActionBtn: false,
      cartActionProducts: [],
      cartUpdateModalVisibility: false
    };
  },
  methods: {
    handleCouponSubmit: function handleCouponSubmit(e) {
      this.form.validateFields(function (err, values) {
        if (err) {
          e.preventDefault();
        }
      });
    },
    clickOnCheckBox: function clickOnCheckBox(e, product) {
      if (e.target.checked) {
        this.cartActionProducts.push(product);
      } else {
        var index = this.cartActionProducts.findIndex(function (ele) {
          return ele.slug === product.slug;
        });
        this.cartActionProducts.splice(index, 1);
      }

      if (this.cartActionProducts.length > 0) {
        this.showCartActionBtn = true;
      } else {
        this.showCartActionBtn = false;
      }
    },
    delteCartProductClick: function delteCartProductClick() {
      var app = this;
      axios__WEBPACK_IMPORTED_MODULE_0___default()({
        method: 'delete',
        url: this.cartDeleteUrl,
        data: {
          'products': this.cartActionProducts
        }
      }).then(function (response) {
        if (response.data.success == true) {
          app.$notification.success({
            key: 'cart.destroy.success',
            message: response.data.message
          });
          location.reload();
        } else {
          app.$notification.error({
            key: 'cart.destroy.error',
            message: response.data.message
          });
        }
      });
    },
    updateCartProductClick: function updateCartProductClick() {
      this.cartUpdateModalVisibility = !this.cartUpdateModalVisibility;
    },
    clickOnCartUpdateCancel: function clickOnCartUpdateCancel() {
      this.cartUpdateModalVisibility = false;
    },
    clickOnCartUpdateOk: function clickOnCartUpdateOk() {
      var app = this;
      axios__WEBPACK_IMPORTED_MODULE_0___default()({
        method: 'put',
        url: this.cartUpdateUrl,
        data: {
          'products': this.cartActionProducts
        }
      }).then(function (response) {
        if (response.data.success == true) {
          app.$notification.success({
            key: 'cart.update.success',
            message: response.data.message
          });
          location.reload();
        } else {
          app.$notification.error({
            key: 'cart.update.error',
            message: response.data.message
          });
        }
      });
    }
  },
  mounted: function mounted() {}
});

/***/ }),

/***/ "./resources/components/CartPage.vue":
/*!*******************************************!*\
  !*** ./resources/components/CartPage.vue ***!
  \*******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _CartPage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./CartPage.vue?vue&type=script&lang=js& */ "./resources/components/CartPage.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");
var render, staticRenderFns




/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__["default"])(
  _CartPage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"],
  render,
  staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/components/CartPage.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/components/CartPage.vue?vue&type=script&lang=js&":
/*!********************************************************************!*\
  !*** ./resources/components/CartPage.vue?vue&type=script&lang=js& ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CartPage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../node_modules/babel-loader/lib??ref--4-0!../../node_modules/vue-loader/lib??vue-loader-options!./CartPage.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/components/CartPage.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CartPage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ })

}]);