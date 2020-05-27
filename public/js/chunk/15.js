(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[15],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/components/ProductPage.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/components/ProductPage.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var lodash_isNil__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! lodash/isNil */ "./node_modules/lodash/isNil.js");
/* harmony import */ var lodash_isNil__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(lodash_isNil__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var lodash_isEqual__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! lodash/isEqual */ "./node_modules/lodash/isEqual.js");
/* harmony import */ var lodash_isEqual__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(lodash_isEqual__WEBPACK_IMPORTED_MODULE_1__);


/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['product', 'variations'],
  data: function data() {
    return {
      qty: 1,
      attributes: {},
      price: 0,
      productQty: 0,
      productMainImage: '',
      selectedAttributes: {}
    };
  },
  methods: {
    changeQty: function changeQty(value) {
      this.qty = value;
    },
    attributeDropdownOption: function attributeDropdownOption(val) {
      console.log(val);
      return 'attribute_dropdown_option_' + val;
    },
    checkIfSameVariation: function checkIfSameVariation(variations) {
      var comparableVariation = {};
      variations.forEach(function (variation) {
        if (lodash_isNil__WEBPACK_IMPORTED_MODULE_0___default()(comparableVariation[variation['attribute_id']])) {
          comparableVariation[variation['attribute_id']] = {};
        }

        comparableVariation[variation.attribute_id] = variation.attribute_dropdown_option_id;
      });
      return lodash_isEqual__WEBPACK_IMPORTED_MODULE_1___default()(comparableVariation, this.selectedAttributes);
    },
    changeAttributeVariable: function changeAttributeVariable(value) {
      var _this = this;

      if (!lodash_isNil__WEBPACK_IMPORTED_MODULE_0___default()(value.target)) {
        value = value.target.value;
      }

      var attributeValue = JSON.parse(value);
      var attributeRef = this.$refs['attribute-' + attributeValue.attribute_id];
      var attributeLength = JSON.parse(attributeRef.$attrs['data-attribute-length']);
      var app = this;
      this.selectedAttributes[attributeValue['attribute_id']] = attributeValue['attribute_dropdown_option_id'];
      var selectedVariationId = null;
      var selectedVariation = null;

      if (Object.keys(this.selectedAttributes).length === attributeLength) {
        Object.keys(app.variations).forEach(function (key) {
          var variation = app.variations[key];
          var result = app.checkIfSameVariation(variation);

          if (result) {
            selectedVariationId = key;
            selectedVariation = variation[0].variation;
          }
        });
        this.price = selectedVariation.price;
        this.productQty = selectedVariation['qty'];
        selectedVariation.images.forEach(function (image) {
          if (!lodash_isNil__WEBPACK_IMPORTED_MODULE_0___default()(image.is_main_image) && image.is_main_image == 1) {
            _this.productMainImage = '/storage/' + image.path;
          }
        });

        if (lodash_isNil__WEBPACK_IMPORTED_MODULE_0___default()(this.attributes['attribute_product_value_id'])) {
          this.attributes['attribute_product_value_id'] = [];
        }

        this.attributes['attribute_product_value_id'] = selectedVariation.id;
      }
    }
  },
  mounted: function mounted() {
    var _this2 = this;

    this.price = this.product['price'];
    this.productQty = this.product['qty'];
    this.product.images.forEach(function (image) {
      if (!lodash_isNil__WEBPACK_IMPORTED_MODULE_0___default()(image.is_main_image) && image.is_main_image == 1) {
        _this2.productMainImage = '/storage/' + image.path;
      }
    });
  }
});

/***/ }),

/***/ "./node_modules/lodash/isEqual.js":
/*!****************************************!*\
  !*** ./node_modules/lodash/isEqual.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var baseIsEqual = __webpack_require__(/*! ./_baseIsEqual */ "./node_modules/lodash/_baseIsEqual.js");

/**
 * Performs a deep comparison between two values to determine if they are
 * equivalent.
 *
 * **Note:** This method supports comparing arrays, array buffers, booleans,
 * date objects, error objects, maps, numbers, `Object` objects, regexes,
 * sets, strings, symbols, and typed arrays. `Object` objects are compared
 * by their own, not inherited, enumerable properties. Functions and DOM
 * nodes are compared by strict equality, i.e. `===`.
 *
 * @static
 * @memberOf _
 * @since 0.1.0
 * @category Lang
 * @param {*} value The value to compare.
 * @param {*} other The other value to compare.
 * @returns {boolean} Returns `true` if the values are equivalent, else `false`.
 * @example
 *
 * var object = { 'a': 1 };
 * var other = { 'a': 1 };
 *
 * _.isEqual(object, other);
 * // => true
 *
 * object === other;
 * // => false
 */
function isEqual(value, other) {
  return baseIsEqual(value, other);
}

module.exports = isEqual;


/***/ }),

/***/ "./resources/components/ProductPage.vue":
/*!**********************************************!*\
  !*** ./resources/components/ProductPage.vue ***!
  \**********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ProductPage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ProductPage.vue?vue&type=script&lang=js& */ "./resources/components/ProductPage.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");
var render, staticRenderFns




/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__["default"])(
  _ProductPage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"],
  render,
  staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/components/ProductPage.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/components/ProductPage.vue?vue&type=script&lang=js&":
/*!***********************************************************************!*\
  !*** ./resources/components/ProductPage.vue?vue&type=script&lang=js& ***!
  \***********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductPage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../node_modules/babel-loader/lib??ref--4-0!../../node_modules/vue-loader/lib??vue-loader-options!./ProductPage.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/components/ProductPage.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductPage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ })

}]);