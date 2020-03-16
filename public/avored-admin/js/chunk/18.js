(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[18],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./packages/framework/resources/components/catalog/product/ProductSave.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./packages/framework/resources/components/catalog/product/ProductSave.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var lodash_isNil__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! lodash/isNil */ "./node_modules/lodash/isNil.js");
/* harmony import */ var lodash_isNil__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(lodash_isNil__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var lodash_isObject__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! lodash/isObject */ "./node_modules/lodash/isObject.js");
/* harmony import */ var lodash_isObject__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(lodash_isObject__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var vue_quill_editor__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! vue-quill-editor */ "./node_modules/vue-quill-editor/dist/vue-quill-editor.js");
/* harmony import */ var vue_quill_editor__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(vue_quill_editor__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_3__);




var columns = [{
  dataIndex: 'name',
  key: 'name',
  title: 'Name',
  scopedSlots: {
    customRender: 'name'
  }
}, {
  title: 'Price',
  dataIndex: 'price',
  key: 'price',
  scopedSlots: {
    customRender: 'price'
  }
}, {
  title: 'Qty',
  dataIndex: 'qty',
  key: 'qty',
  scopedSlots: {
    customRender: 'qty'
  }
}, {
  title: 'Action',
  key: 'action',
  scopedSlots: {
    customRender: 'action'
  }
}];
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['product', 'baseUrl', 'productProperties', 'productAttributes', 'productVariations'],
  components: {
    'quil-editor': vue_quill_editor__WEBPACK_IMPORTED_MODULE_2__["quillEditor"]
  },
  data: function data() {
    return {
      productForm: this.$form.createForm(this),
      variationForm: this.$form.createForm(this),
      type: null,
      headers: {},
      description: null,
      status: 0,
      track_stock: 0,
      is_taxable: 0,
      categories: [],
      property: {},
      productImages: [],
      attributeIds: [],
      variationUploadImagePath: '',
      variationImageList: {},
      columns: columns,
      variationModelVisible: false,
      variationFields: ['id', 'name', 'slug', 'barcode', 'sku', 'qty', 'price', 'weight', 'length', 'width', 'height']
    };
  },
  methods: {
    handleUploadImageChange: function handleUploadImageChange() {},
    clickVariationSave: function clickVariationSave(e) {
      var _this = this;

      this.variationForm.validateFields(function (err, data) {
        if (lodash_isNil__WEBPACK_IMPORTED_MODULE_0___default()(err)) {
          var url = _this.baseUrl + '/variation/' + _this.product.id + '/save-variation';
          var app = _this;
          axios__WEBPACK_IMPORTED_MODULE_3___default.a.post(url, data).then(function (res) {
            if (res.data.success) {
              app.$notification.success({
                key: 'product.save.variation.success',
                message: res.data.message
              });
              window.location.reload();
            } else {
              alert('there is an error');
            }
          });
        }
      });
    },
    deleteVariation: function deleteVariation(model) {
      var url = this.baseUrl + '/variation/' + model.variation_id;
      var app = this;
      axios__WEBPACK_IMPORTED_MODULE_3___default.a["delete"](url).then(function (res) {
        if (res.data.success) {
          app.$notification.success({
            key: 'product.delete.variation.success',
            message: res.data.message
          });
          window.location.reload();
        } else {
          alert('there is an error');
        }
      });
    },
    getVariationUploadAction: function getVariationUploadAction() {},
    editVariationModel: function editVariationModel(model) {
      var _this2 = this;

      this.variationModelVisible = true;
      var variationModel = model.variation;
      this.variationFields.forEach(function (field) {
        _this2.variationForm.getFieldDecorator(field, {
          initialValue: variationModel[field]
        });
      });
      this.variationUploadImagePath = this.baseUrl + '/product-image/' + variationModel.id + '/upload';

      if (!lodash_isNil__WEBPACK_IMPORTED_MODULE_0___default()(variationModel.images[0])) {
        var fileName = variationModel.images[0].path.replace(/^.*[\\\/]/, '');
        this.variationImageList = [{
          uid: variationModel.images[0].id,
          name: fileName,
          status: 'done',
          url: '/storage/' + variationModel.images[0].path
        }];
      } else {
        this.variationImageList = [];
      }
    },
    handleSubmit: function handleSubmit(e) {
      this.productForm.validateFields(function (err, values) {
        if (err !== null) {
          e.preventDefault();
        }
      });
    },
    handleVariationBtnClick: function handleVariationBtnClick(e) {
      var data = {
        attributes: this.attributeIds
      };
      var url = this.baseUrl + '/variation/' + this.product.id + '/create-variation';
      var app = this;
      axios__WEBPACK_IMPORTED_MODULE_3___default.a.post(url, data).then(function (res) {
        if (res.data.success) {
          app.$notification.success({
            key: 'product.create.variation.success',
            message: res.data.message
          });
          window.location.reload();
        } else {
          alert('there is an error');
        }
      });
    },
    changeVariation: function changeVariation(values) {
      var app = this;
      values.forEach(function (val) {
        app.attributeIds.push(val);
      });
    },
    handlePropertyChange: function handlePropertyChange(id, val) {
      var propertyValue = '';
      propertyValue = val;

      if (lodash_isObject__WEBPACK_IMPORTED_MODULE_1___default()(val)) {
        propertyValue = val.target.value;
      }

      this.property[id] = propertyValue;
    },
    handleTypeChange: function handleTypeChange(val) {
      this.type = val;
    },
    handleStatusChange: function handleStatusChange(val) {
      if (val) {
        this.status = 1;
      } else {
        this.status = 0;
      }
    },
    handleCategoryChange: function handleCategoryChange(val) {
      this.categories = val;
    },
    handleTrackStockChange: function handleTrackStockChange(val) {
      if (val) {
        this.track_stock = 1;
      } else {
        this.track_stock = 0;
      }
    },
    handleIsTaxableChange: function handleIsTaxableChange(val) {
      if (val) {
        this.is_taxable = 1;
      } else {
        this.is_taxable = 0;
      }
    },
    cancelProduct: function cancelProduct() {
      window.location = this.baseUrl + '/product';
    },
    uploadFileChange: function uploadFileChange(file) {
      if (file.file.status == 'done') {
        this.productImages.push(file.file.response.image);
      }
    },
    deleteImage: function deleteImage(id) {
      var deleteImageUrl = this.baseUrl + '/product-image/' + id;
      var app = this;
      var imageId = id;
      axios__WEBPACK_IMPORTED_MODULE_3___default.a["delete"](deleteImageUrl).then(function (result) {
        if (result.data.success) {
          var index = app.productImages.findIndex(function (image) {
            return image.id === imageId;
          });
          app.productImages.splice(index, 1);
        }
      });
    }
  },
  mounted: function mounted() {
    var _this3 = this;

    this.headers = {
      'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
    };

    if (!lodash_isNil__WEBPACK_IMPORTED_MODULE_0___default()(this.product)) {
      this.type = this.product.type;
      this.description = this.product.description;
      this.productProperties.forEach(function (record) {
        _this3.property[record.id] = record.product_value.value;
      });
      this.productAttributes.forEach(function (record) {
        _this3.attributeIds.push(record.id);
      });
      this.product.images.forEach(function (record) {
        _this3.productImages.push(record);
      });
    }
  }
});

/***/ }),

/***/ "./packages/framework/resources/components/catalog/product/ProductSave.vue":
/*!*********************************************************************************!*\
  !*** ./packages/framework/resources/components/catalog/product/ProductSave.vue ***!
  \*********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ProductSave_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ProductSave.vue?vue&type=script&lang=js& */ "./packages/framework/resources/components/catalog/product/ProductSave.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");
var render, staticRenderFns




/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__["default"])(
  _ProductSave_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"],
  render,
  staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "packages/framework/resources/components/catalog/product/ProductSave.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./packages/framework/resources/components/catalog/product/ProductSave.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************!*\
  !*** ./packages/framework/resources/components/catalog/product/ProductSave.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductSave_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./ProductSave.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./packages/framework/resources/components/catalog/product/ProductSave.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductSave_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ })

}]);