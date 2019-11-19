(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[32],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/components/AvoRedStripe.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/components/AvoRedStripe.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _vendor_avored_framework_resources_js_app__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../vendor/avored/framework/resources/js/app */ "./vendor/avored/framework/resources/js/app.js");
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

/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'avored-stripe',
  props: [],
  data: function data() {
    return {};
  },
  methods: {
    handlePaymentChange: function handlePaymentChange(e, identifier) {
      _vendor_avored_framework_resources_js_app__WEBPACK_IMPORTED_MODULE_0__["EventBus"].$emit('selectedPaymentIdentifier', identifier);
    }
  },
  mounted: function mounted() {
    _vendor_avored_framework_resources_js_app__WEBPACK_IMPORTED_MODULE_0__["EventBus"];
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./vendor/avored/framework/resources/components/cms/page/PageSave.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./vendor/avored/framework/resources/components/cms/page/PageSave.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vue_quill_editor__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue-quill-editor */ "./node_modules/vue-quill-editor/dist/vue-quill-editor.js");
/* harmony import */ var vue_quill_editor__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vue_quill_editor__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var quill__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! quill */ "./node_modules/quill/dist/quill.js");
/* harmony import */ var quill__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(quill__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.common.js");
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(vue__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var lodash_isNil__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! lodash/isNil */ "./node_modules/lodash/isNil.js");
/* harmony import */ var lodash_isNil__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(lodash_isNil__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _widget__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./widget */ "./vendor/avored/framework/resources/components/cms/page/widget.js");
/* harmony import */ var _js_app__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../../js/app */ "./vendor/avored/framework/resources/js/app.js");






var container = [['bold', 'italic', 'underline', 'strike'], [{
  header: [1, 2, 3, 4, 5, 6, false]
}], ['widget']];
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['page', 'baseUrl'],
  components: {
    'quil-editor': vue_quill_editor__WEBPACK_IMPORTED_MODULE_0__["quillEditor"]
  },
  data: function data() {
    return {
      pageForm: this.$form.createForm(this),
      content: '',
      widgetModalVisible: false,
      selectedWidget: '',
      toolbar: null,
      editorOption: {
        modules: {
          toolbar: {
            container: container,
            handlers: {
              'widget': function widget() {
                _widget__WEBPACK_IMPORTED_MODULE_4__["Widget"].click(this);
              }
            }
          }
        }
      }
    };
  },
  methods: {
    handleSubmit: function handleSubmit() {
      this.pageForm.validateFields(function (err, values) {
        if (err) {
          e.preventDefault();
        }
      });
    },
    cancelPage: function cancelPage() {
      window.location = this.baseUrl + '/page';
    },
    widgetClick: function widgetClick(toolbar) {
      this.toolbar = toolbar;
      this.widgetModalVisible = true;
    },
    handleWidgetOk: function handleWidgetOk() {
      var selection = this.toolbar.quill.getSelection(); //this.toolbar.quill.insertEmbed(selection.index, 'image', 'http://placehold.it/250x250')

      this.toolbar.quill.insertText(selection.index, '%%%' + this.selectedWidget + '%%%');
      this.toolbar.quill.update();
      this.toolbar.quill.setSelection(selection.index + this.selectedWidget.length + 1);
      this.widgetModalVisible = false;
    }
  },
  mounted: function mounted() {
    var _this = this;

    if (!lodash_isNil__WEBPACK_IMPORTED_MODULE_3___default()(this.page)) {
      this.content = this.page.content;
    }

    _js_app__WEBPACK_IMPORTED_MODULE_5__["EventBus"].$on('widgetClick', function (toolbar) {
      _this.widgetClick(toolbar);
    });
  },
  beforeMount: function beforeMount() {
    var icons = quill__WEBPACK_IMPORTED_MODULE_1___default.a["import"]('ui/icons');
    icons['widget'] = '<i class="anticon widget-icon anticon-gold"><svg viewBox="64 64 896 896" data-icon="gold" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false" class=""><path d="M342 472h342c.4 0 .9 0 1.3-.1 4.4-.7 7.3-4.8 6.6-9.2l-40.2-248c-.6-3.9-4-6.7-7.9-6.7H382.2c-3.9 0-7.3 2.8-7.9 6.7l-40.2 248c-.1.4-.1.9-.1 1.3 0 4.4 3.6 8 8 8zm91.2-196h159.5l20.7 128h-201l20.8-128zm2.5 282.7c-.6-3.9-4-6.7-7.9-6.7H166.2c-3.9 0-7.3 2.8-7.9 6.7l-40.2 248c-.1.4-.1.9-.1 1.3 0 4.4 3.6 8 8 8h342c.4 0 .9 0 1.3-.1 4.4-.7 7.3-4.8 6.6-9.2l-40.2-248zM196.5 748l20.7-128h159.5l20.7 128H196.5zm709.4 58.7l-40.2-248c-.6-3.9-4-6.7-7.9-6.7H596.2c-3.9 0-7.3 2.8-7.9 6.7l-40.2 248c-.1.4-.1.9-.1 1.3 0 4.4 3.6 8 8 8h342c.4 0 .9 0 1.3-.1 4.3-.7 7.3-4.8 6.6-9.2zM626.5 748l20.7-128h159.5l20.7 128H626.5z"></path></svg></i>';
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./vendor/avored/framework/resources/components/system/admin-user/AdminUserSave.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./vendor/avored/framework/resources/components/system/admin-user/AdminUserSave.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var lodash_isNil__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! lodash/isNil */ "./node_modules/lodash/isNil.js");
/* harmony import */ var lodash_isNil__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(lodash_isNil__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var lodash_isEmpty__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! lodash/isEmpty */ "./node_modules/lodash/isEmpty.js");
/* harmony import */ var lodash_isEmpty__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(lodash_isEmpty__WEBPACK_IMPORTED_MODULE_1__);


/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['adminUser', 'baseUrl', 'token'],
  data: function data() {
    return {
      adminUserForm: this.$form.createForm(this),
      is_super_admin: 0,
      image_path: '',
      headers: {},
      role_id: 0,
      language: '',
      userImageList: []
    };
  },
  methods: {
    handleSubmit: function handleSubmit() {
      this.adminUserForm.validateFields(function (err, values) {
        if (err) {
          e.preventDefault();
        }
      });
    },
    isLanguageDefaultSwitchChange: function isLanguageDefaultSwitchChange(checked) {
      if (checked) {
        this.is_super_admin = 1;
      } else {
        this.is_super_admin = 0;
      }
    },
    cancelAdminUser: function cancelAdminUser() {
      window.location = this.baseUrl + '/admin-user';
    },
    handleUploadImageChange: function handleUploadImageChange(info) {
      if (info.file.status == "done") {
        this.image_path = info.file.response.path;
      }
    },
    handleRoleChange: function handleRoleChange(value) {
      this.role_id = value;
    },
    handleLanguageChange: function handleLanguageChange(value) {
      this.language = value;
    }
  },
  mounted: function mounted() {
    if (!lodash_isNil__WEBPACK_IMPORTED_MODULE_0___default()(this.adminUser)) {
      this.is_super_admin = this.adminUser.is_super_admin;
      this.language = this.adminUser.language;
      this.role_id = this.adminUser.role_id;

      if (!lodash_isEmpty__WEBPACK_IMPORTED_MODULE_1___default()(this.adminUser.image_path)) {
        this.userImageList.push({
          uid: this.adminUser.id,
          name: this.adminUser.image_path_name,
          status: 'done',
          url: this.adminUser.image_path_url
        });
      }
    }

    this.headers = {
      'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
    };
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./vendor/avored/framework/resources/components/system/admin-user/AdminUserSave.vue?vue&type=style&index=0&lang=css&":
/*!**********************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./vendor/avored/framework/resources/components/system/admin-user/AdminUserSave.vue?vue&type=style&index=0&lang=css& ***!
  \**********************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.ant-upload-select-picture-card i {\n  font-size: 32px;\n  color: #999;\n}\n.ant-upload-select-picture-card .ant-upload-text {\n  margin-top: 8px;\n  color: #666;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./vendor/avored/framework/resources/components/system/admin-user/AdminUserSave.vue?vue&type=style&index=0&lang=css&":
/*!**************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./vendor/avored/framework/resources/components/system/admin-user/AdminUserSave.vue?vue&type=style&index=0&lang=css& ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../../../node_modules/css-loader??ref--6-1!../../../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../../../node_modules/postcss-loader/src??ref--6-2!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./AdminUserSave.vue?vue&type=style&index=0&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./vendor/avored/framework/resources/components/system/admin-user/AdminUserSave.vue?vue&type=style&index=0&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/components/AvoRedStripe.vue?vue&type=template&id=4b77e5f5&":
/*!************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/components/AvoRedStripe.vue?vue&type=template&id=4b77e5f5& ***!
  \************************************************************************************************************************************************************************************************************/
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
    [
      _c("a-switch", {
        on: {
          change: function($event) {
            return _vm.handlePaymentChange($event, "a-stripe")
          }
        }
      }),
      _vm._v("\n    Stripe Payment\n    "),
      _vm._m(0)
    ],
    1
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "form-row" }, [
      _c("label", { attrs: { for: "card-element" } }, [
        _vm._v("\n        Credit or debit card\n        ")
      ]),
      _vm._v(" "),
      _c("div", { attrs: { id: "card-element" } }),
      _vm._v(" "),
      _c("div", { attrs: { id: "card-errors", role: "alert" } })
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/components/AvoRedStripe.vue":
/*!***********************************************!*\
  !*** ./resources/components/AvoRedStripe.vue ***!
  \***********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _AvoRedStripe_vue_vue_type_template_id_4b77e5f5___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./AvoRedStripe.vue?vue&type=template&id=4b77e5f5& */ "./resources/components/AvoRedStripe.vue?vue&type=template&id=4b77e5f5&");
/* harmony import */ var _AvoRedStripe_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./AvoRedStripe.vue?vue&type=script&lang=js& */ "./resources/components/AvoRedStripe.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _AvoRedStripe_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _AvoRedStripe_vue_vue_type_template_id_4b77e5f5___WEBPACK_IMPORTED_MODULE_0__["render"],
  _AvoRedStripe_vue_vue_type_template_id_4b77e5f5___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/components/AvoRedStripe.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/components/AvoRedStripe.vue?vue&type=script&lang=js&":
/*!************************************************************************!*\
  !*** ./resources/components/AvoRedStripe.vue?vue&type=script&lang=js& ***!
  \************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AvoRedStripe_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../node_modules/babel-loader/lib??ref--4-0!../../node_modules/vue-loader/lib??vue-loader-options!./AvoRedStripe.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/components/AvoRedStripe.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AvoRedStripe_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/components/AvoRedStripe.vue?vue&type=template&id=4b77e5f5&":
/*!******************************************************************************!*\
  !*** ./resources/components/AvoRedStripe.vue?vue&type=template&id=4b77e5f5& ***!
  \******************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AvoRedStripe_vue_vue_type_template_id_4b77e5f5___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../node_modules/vue-loader/lib??vue-loader-options!./AvoRedStripe.vue?vue&type=template&id=4b77e5f5& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/components/AvoRedStripe.vue?vue&type=template&id=4b77e5f5&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AvoRedStripe_vue_vue_type_template_id_4b77e5f5___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AvoRedStripe_vue_vue_type_template_id_4b77e5f5___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./vendor/avored/framework/resources/components/cms/page/PageSave.vue":
/*!****************************************************************************!*\
  !*** ./vendor/avored/framework/resources/components/cms/page/PageSave.vue ***!
  \****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _PageSave_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./PageSave.vue?vue&type=script&lang=js& */ "./vendor/avored/framework/resources/components/cms/page/PageSave.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");
var render, staticRenderFns




/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__["default"])(
  _PageSave_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"],
  render,
  staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "vendor/avored/framework/resources/components/cms/page/PageSave.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./vendor/avored/framework/resources/components/cms/page/PageSave.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************!*\
  !*** ./vendor/avored/framework/resources/components/cms/page/PageSave.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PageSave_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./PageSave.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./vendor/avored/framework/resources/components/cms/page/PageSave.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PageSave_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./vendor/avored/framework/resources/components/cms/page/widget.js":
/*!*************************************************************************!*\
  !*** ./vendor/avored/framework/resources/components/cms/page/widget.js ***!
  \*************************************************************************/
/*! exports provided: Widget */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "Widget", function() { return Widget; });
/* harmony import */ var _PageSave_vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./PageSave.vue */ "./vendor/avored/framework/resources/components/cms/page/PageSave.vue");
/* harmony import */ var _js_app__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../js/app */ "./vendor/avored/framework/resources/js/app.js");


var Widget = {
  click: function click(toolbar) {
    window.x = _js_app__WEBPACK_IMPORTED_MODULE_1__["EventBus"];
    _js_app__WEBPACK_IMPORTED_MODULE_1__["EventBus"].$emit('widgetClick', toolbar);
  }
};

/***/ }),

/***/ "./vendor/avored/framework/resources/components/system/admin-user/AdminUserSave.vue":
/*!******************************************************************************************!*\
  !*** ./vendor/avored/framework/resources/components/system/admin-user/AdminUserSave.vue ***!
  \******************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _AdminUserSave_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./AdminUserSave.vue?vue&type=script&lang=js& */ "./vendor/avored/framework/resources/components/system/admin-user/AdminUserSave.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _AdminUserSave_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./AdminUserSave.vue?vue&type=style&index=0&lang=css& */ "./vendor/avored/framework/resources/components/system/admin-user/AdminUserSave.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");
var render, staticRenderFns





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _AdminUserSave_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"],
  render,
  staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "vendor/avored/framework/resources/components/system/admin-user/AdminUserSave.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./vendor/avored/framework/resources/components/system/admin-user/AdminUserSave.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************!*\
  !*** ./vendor/avored/framework/resources/components/system/admin-user/AdminUserSave.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminUserSave_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./AdminUserSave.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./vendor/avored/framework/resources/components/system/admin-user/AdminUserSave.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminUserSave_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./vendor/avored/framework/resources/components/system/admin-user/AdminUserSave.vue?vue&type=style&index=0&lang=css&":
/*!***************************************************************************************************************************!*\
  !*** ./vendor/avored/framework/resources/components/system/admin-user/AdminUserSave.vue?vue&type=style&index=0&lang=css& ***!
  \***************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminUserSave_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/style-loader!../../../../../../../node_modules/css-loader??ref--6-1!../../../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../../../node_modules/postcss-loader/src??ref--6-2!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./AdminUserSave.vue?vue&type=style&index=0&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./vendor/avored/framework/resources/components/system/admin-user/AdminUserSave.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminUserSave_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminUserSave_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminUserSave_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminUserSave_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminUserSave_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./vendor/avored/framework/resources/js/app.js":
/*!*****************************************************!*\
  !*** ./vendor/avored/framework/resources/js/app.js ***!
  \*****************************************************/
/*! exports provided: EventBus */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "EventBus", function() { return EventBus; });
/* harmony import */ var _avored__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./avored */ "./vendor/avored/framework/resources/js/avored.js");
/* harmony import */ var _avored__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_avored__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var ant_design_vue_lib_layout__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ant-design-vue/lib/layout */ "./node_modules/ant-design-vue/lib/layout/index.js");
/* harmony import */ var ant_design_vue_lib_layout__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(ant_design_vue_lib_layout__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var ant_design_vue_lib_menu__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ant-design-vue/lib/menu */ "./node_modules/ant-design-vue/lib/menu/index.js");
/* harmony import */ var ant_design_vue_lib_menu__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(ant_design_vue_lib_menu__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var ant_design_vue_lib_form__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ant-design-vue/lib/form */ "./node_modules/ant-design-vue/lib/form/index.js");
/* harmony import */ var ant_design_vue_lib_form__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(ant_design_vue_lib_form__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var ant_design_vue_lib_select__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ant-design-vue/lib/select */ "./node_modules/ant-design-vue/lib/select/index.js");
/* harmony import */ var ant_design_vue_lib_select__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(ant_design_vue_lib_select__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var ant_design_vue_lib_breadcrumb__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ant-design-vue/lib/breadcrumb */ "./node_modules/ant-design-vue/lib/breadcrumb/index.js");
/* harmony import */ var ant_design_vue_lib_breadcrumb__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(ant_design_vue_lib_breadcrumb__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var ant_design_vue_lib_tabs__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ant-design-vue/lib/tabs */ "./node_modules/ant-design-vue/lib/tabs/index.js");
/* harmony import */ var ant_design_vue_lib_tabs__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(ant_design_vue_lib_tabs__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var ant_design_vue_lib_modal__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ant-design-vue/lib/modal */ "./node_modules/ant-design-vue/lib/modal/index.js");
/* harmony import */ var ant_design_vue_lib_modal__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(ant_design_vue_lib_modal__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var ant_design_vue_lib_notification__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ant-design-vue/lib/notification */ "./node_modules/ant-design-vue/lib/notification/index.js");
/* harmony import */ var ant_design_vue_lib_notification__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(ant_design_vue_lib_notification__WEBPACK_IMPORTED_MODULE_8__);
/* harmony import */ var ant_design_vue_lib_dropdown__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ant-design-vue/lib/dropdown */ "./node_modules/ant-design-vue/lib/dropdown/index.js");
/* harmony import */ var ant_design_vue_lib_dropdown__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(ant_design_vue_lib_dropdown__WEBPACK_IMPORTED_MODULE_9__);
/* harmony import */ var vddl__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! vddl */ "./node_modules/vddl/dist/vddl.runtime.js");
/* harmony import */ var vddl__WEBPACK_IMPORTED_MODULE_10___default = /*#__PURE__*/__webpack_require__.n(vddl__WEBPACK_IMPORTED_MODULE_10__);
window.axios = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
var token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}


window.Vue = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.common.js");
window.AvoRed = _avored__WEBPACK_IMPORTED_MODULE_0___default.a;









Vue.use(ant_design_vue_lib_layout__WEBPACK_IMPORTED_MODULE_1___default.a);
Vue.use(ant_design_vue_lib_menu__WEBPACK_IMPORTED_MODULE_2___default.a);
Vue.use(ant_design_vue_lib_form__WEBPACK_IMPORTED_MODULE_3___default.a);
Vue.use(ant_design_vue_lib_select__WEBPACK_IMPORTED_MODULE_4___default.a);
Vue.use(ant_design_vue_lib_breadcrumb__WEBPACK_IMPORTED_MODULE_5___default.a);
Vue.use(ant_design_vue_lib_tabs__WEBPACK_IMPORTED_MODULE_6___default.a);
Vue.use(ant_design_vue_lib_modal__WEBPACK_IMPORTED_MODULE_7___default.a);
Vue.use(ant_design_vue_lib_dropdown__WEBPACK_IMPORTED_MODULE_9___default.a);
Vue.component('a-date-picker', function () {
  return Promise.all(/*! import() */[__webpack_require__.e(29), __webpack_require__.e(31), __webpack_require__.e(73)]).then(__webpack_require__.t.bind(null, /*! ant-design-vue/lib/date-picker */ "./node_modules/ant-design-vue/lib/date-picker/index.js", 7));
});
Vue.component('a-icon', function () {
  return Promise.resolve(/*! import() */).then(__webpack_require__.t.bind(null, /*! ant-design-vue/lib/icon */ "./node_modules/ant-design-vue/lib/icon/index.js", 7));
});
Vue.component('a-avatar', function () {
  return __webpack_require__.e(/*! import() */ 2).then(__webpack_require__.t.bind(null, /*! ant-design-vue/lib/avatar */ "./node_modules/ant-design-vue/lib/avatar/index.js", 7));
});
Vue.component('a-row', function () {
  return __webpack_require__.e(/*! import() */ 25).then(__webpack_require__.t.bind(null, /*! ant-design-vue/lib/row */ "./node_modules/ant-design-vue/lib/row/index.js", 7));
});
Vue.component('a-col', function () {
  return __webpack_require__.e(/*! import() */ 24).then(__webpack_require__.t.bind(null, /*! ant-design-vue/lib/col */ "./node_modules/ant-design-vue/lib/col/index.js", 7));
});
Vue.component('a-icon', function () {
  return Promise.resolve(/*! import() */).then(__webpack_require__.t.bind(null, /*! ant-design-vue/lib/icon */ "./node_modules/ant-design-vue/lib/icon/index.js", 7));
});
Vue.component('a-drawer', function () {
  return __webpack_require__.e(/*! import() */ 35).then(__webpack_require__.t.bind(null, /*! ant-design-vue/lib/drawer */ "./node_modules/ant-design-vue/lib/drawer/index.js", 7));
});
Vue.component('a-card', function () {
  return __webpack_require__.e(/*! import() */ 0).then(__webpack_require__.t.bind(null, /*! ant-design-vue/lib/card */ "./node_modules/ant-design-vue/lib/card/index.js", 7));
});
Vue.component('a-table', function () {
  return Promise.all(/*! import() */[__webpack_require__.e(10), __webpack_require__.e(30)]).then(__webpack_require__.t.bind(null, /*! ant-design-vue/lib/table */ "./node_modules/ant-design-vue/lib/table/index.js", 7));
});
Vue.component('a-button', function () {
  return Promise.resolve(/*! import() */).then(__webpack_require__.t.bind(null, /*! ant-design-vue/lib/button */ "./node_modules/ant-design-vue/lib/button/index.js", 7));
});
Vue.component('a-upload', function () {
  return __webpack_require__.e(/*! import() */ 3).then(__webpack_require__.t.bind(null, /*! ant-design-vue/lib/upload */ "./node_modules/ant-design-vue/lib/upload/index.js", 7));
});
Vue.component('a-upload', function () {
  return __webpack_require__.e(/*! import() */ 3).then(__webpack_require__.t.bind(null, /*! ant-design-vue/lib/upload */ "./node_modules/ant-design-vue/lib/upload/index.js", 7));
});
Vue.component('a-input', function () {
  return __webpack_require__.e(/*! import() */ 1).then(__webpack_require__.t.bind(null, /*! ant-design-vue/lib/input */ "./node_modules/ant-design-vue/lib/input/index.js", 7));
});
Vue.component('a-switch', function () {
  return __webpack_require__.e(/*! import() */ 15).then(__webpack_require__.t.bind(null, /*! ant-design-vue/lib/switch */ "./node_modules/ant-design-vue/lib/switch/index.js", 7));
});
Vue.component('a-tag', function () {
  return __webpack_require__.e(/*! import() */ 37).then(__webpack_require__.t.bind(null, /*! ant-design-vue/lib/tag */ "./node_modules/ant-design-vue/lib/tag/index.js", 7));
});
Vue.prototype.$notification = ant_design_vue_lib_notification__WEBPACK_IMPORTED_MODULE_8___default.a;
Vue.prototype.$confirm = ant_design_vue_lib_modal__WEBPACK_IMPORTED_MODULE_7___default.a.confirm;
Vue.prototype.$info = ant_design_vue_lib_modal__WEBPACK_IMPORTED_MODULE_7___default.a.info;
Vue.prototype.$success = ant_design_vue_lib_modal__WEBPACK_IMPORTED_MODULE_7___default.a.success;
Vue.prototype.$error = ant_design_vue_lib_modal__WEBPACK_IMPORTED_MODULE_7___default.a.error;
Vue.prototype.$warning = ant_design_vue_lib_modal__WEBPACK_IMPORTED_MODULE_7___default.a.warning;
Vue.prototype.$confirm = ant_design_vue_lib_modal__WEBPACK_IMPORTED_MODULE_7___default.a.confirm;

Vue.use(vddl__WEBPACK_IMPORTED_MODULE_10___default.a);
Vue.component('order-table', function () {
  return __webpack_require__.e(/*! import() */ 50).then(__webpack_require__.bind(null, /*! ../components/order/order/OrderTable.vue */ "./vendor/avored/framework/resources/components/order/order/OrderTable.vue"));
});
Vue.component('language-table', function () {
  return __webpack_require__.e(/*! import() */ 62).then(__webpack_require__.bind(null, /*! ../components/system/language/LanguageTable.vue */ "./vendor/avored/framework/resources/components/system/language/LanguageTable.vue"));
});
Vue.component('language-save', function () {
  return __webpack_require__.e(/*! import() */ 61).then(__webpack_require__.bind(null, /*! ../components/system/language/LanguageSave.vue */ "./vendor/avored/framework/resources/components/system/language/LanguageSave.vue"));
});
Vue.component('user-group-table', function () {
  return __webpack_require__.e(/*! import() */ 72).then(__webpack_require__.bind(null, /*! ../components/user/user-group/UserGroupTable.vue */ "./vendor/avored/framework/resources/components/user/user-group/UserGroupTable.vue"));
});
Vue.component('user-group-save', function () {
  return __webpack_require__.e(/*! import() */ 71).then(__webpack_require__.bind(null, /*! ../components/user/user-group/UserGroupSave.vue */ "./vendor/avored/framework/resources/components/user/user-group/UserGroupSave.vue"));
});
Vue.component('tax-group-table', function () {
  return __webpack_require__.e(/*! import() */ 68).then(__webpack_require__.bind(null, /*! ../components/system/tax-group/TaxGroupTable.vue */ "./vendor/avored/framework/resources/components/system/tax-group/TaxGroupTable.vue"));
});
Vue.component('tax-group-save', function () {
  return __webpack_require__.e(/*! import() */ 67).then(__webpack_require__.bind(null, /*! ../components/system/tax-group/TaxGroupSave.vue */ "./vendor/avored/framework/resources/components/system/tax-group/TaxGroupSave.vue"));
});
Vue.component('tax-rate-table', function () {
  return __webpack_require__.e(/*! import() */ 70).then(__webpack_require__.bind(null, /*! ../components/system/tax-rate/TaxRateTable.vue */ "./vendor/avored/framework/resources/components/system/tax-rate/TaxRateTable.vue"));
});
Vue.component('tax-rate-save', function () {
  return __webpack_require__.e(/*! import() */ 69).then(__webpack_require__.bind(null, /*! ../components/system/tax-rate/TaxRateSave.vue */ "./vendor/avored/framework/resources/components/system/tax-rate/TaxRateSave.vue"));
});
Vue.component('attribute-table', function () {
  return __webpack_require__.e(/*! import() */ 39).then(__webpack_require__.bind(null, /*! ../components/catalog/attribute/AttributeTable.vue */ "./vendor/avored/framework/resources/components/catalog/attribute/AttributeTable.vue"));
});
Vue.component('attribute-save', function () {
  return __webpack_require__.e(/*! import() */ 38).then(__webpack_require__.bind(null, /*! ../components/catalog/attribute/AttributeSave.vue */ "./vendor/avored/framework/resources/components/catalog/attribute/AttributeSave.vue"));
});
Vue.component('property-table', function () {
  return __webpack_require__.e(/*! import() */ 45).then(__webpack_require__.bind(null, /*! ../components/catalog/property/PropertyTable.vue */ "./vendor/avored/framework/resources/components/catalog/property/PropertyTable.vue"));
});
Vue.component('property-save', function () {
  return __webpack_require__.e(/*! import() */ 44).then(__webpack_require__.bind(null, /*! ../components/catalog/property/PropertySave.vue */ "./vendor/avored/framework/resources/components/catalog/property/PropertySave.vue"));
});
Vue.component('product-table', function () {
  return __webpack_require__.e(/*! import() */ 42).then(__webpack_require__.bind(null, /*! ../components/catalog/product/ProductIndex.vue */ "./vendor/avored/framework/resources/components/catalog/product/ProductIndex.vue"));
});
Vue.component('product-save', function () {
  return __webpack_require__.e(/*! import() */ 43).then(__webpack_require__.bind(null, /*! ../components/catalog/product/ProductSave.vue */ "./vendor/avored/framework/resources/components/catalog/product/ProductSave.vue"));
});
Vue.component('state-table', function () {
  return __webpack_require__.e(/*! import() */ 66).then(__webpack_require__.bind(null, /*! ../components/system/state/StateTable.vue */ "./vendor/avored/framework/resources/components/system/state/StateTable.vue"));
});
Vue.component('state-save', function () {
  return __webpack_require__.e(/*! import() */ 65).then(__webpack_require__.bind(null, /*! ../components/system/state/StateSave.vue */ "./vendor/avored/framework/resources/components/system/state/StateSave.vue"));
});
Vue.component('currency-table', function () {
  return __webpack_require__.e(/*! import() */ 59).then(__webpack_require__.bind(null, /*! ../components/system/currency/CurrencyIndex.vue */ "./vendor/avored/framework/resources/components/system/currency/CurrencyIndex.vue"));
});
Vue.component('currency-save', function () {
  return __webpack_require__.e(/*! import() */ 60).then(__webpack_require__.bind(null, /*! ../components/system/currency/CurrencySave.vue */ "./vendor/avored/framework/resources/components/system/currency/CurrencySave.vue"));
});
Vue.component('category-table', function () {
  return __webpack_require__.e(/*! import() */ 41).then(__webpack_require__.bind(null, /*! ../components/catalog/category/CategoryTable.vue */ "./vendor/avored/framework/resources/components/catalog/category/CategoryTable.vue"));
});
Vue.component('category-save', function () {
  return __webpack_require__.e(/*! import() */ 40).then(__webpack_require__.bind(null, /*! ../components/catalog/category/CategorySave.vue */ "./vendor/avored/framework/resources/components/catalog/category/CategorySave.vue"));
});
Vue.component('configuration-save', function () {
  return __webpack_require__.e(/*! import() */ 58).then(__webpack_require__.bind(null, /*! ../components/system/configuration/ConfigurationSave.vue */ "./vendor/avored/framework/resources/components/system/configuration/ConfigurationSave.vue"));
});
Vue.component('menu-save', function () {
  return __webpack_require__.e(/*! import() */ 34).then(__webpack_require__.bind(null, /*! ../components/cms/menu/MenuSave.vue */ "./vendor/avored/framework/resources/components/cms/menu/MenuSave.vue"));
});
Vue.component('menu-table', function () {
  return __webpack_require__.e(/*! import() */ 46).then(__webpack_require__.bind(null, /*! ../components/cms/menu/MenuTable.vue */ "./vendor/avored/framework/resources/components/cms/menu/MenuTable.vue"));
});
Vue.component('page-table', function () {
  return __webpack_require__.e(/*! import() */ 47).then(__webpack_require__.bind(null, /*! ../components/cms/page/PageTable.vue */ "./vendor/avored/framework/resources/components/cms/page/PageTable.vue"));
});
Vue.component('page-save', __webpack_require__(/*! ../components/cms/page/PageSave.vue */ "./vendor/avored/framework/resources/components/cms/page/PageSave.vue")["default"]);
Vue.component('order-status-table', function () {
  return __webpack_require__.e(/*! import() */ 49).then(__webpack_require__.bind(null, /*! ../components/order/order-status/OrderStatusTable.vue */ "./vendor/avored/framework/resources/components/order/order-status/OrderStatusTable.vue"));
});
Vue.component('order-status-save', function () {
  return __webpack_require__.e(/*! import() */ 48).then(__webpack_require__.bind(null, /*! ../components/order/order-status/OrderStatusSave.vue */ "./vendor/avored/framework/resources/components/order/order-status/OrderStatusSave.vue"));
});
Vue.component('role-index', function () {
  return __webpack_require__.e(/*! import() */ 64).then(__webpack_require__.bind(null, /*! ../components/system/role/RoleTable.vue */ "./vendor/avored/framework/resources/components/system/role/RoleTable.vue"));
});
Vue.component('system-role-save', function () {
  return __webpack_require__.e(/*! import() */ 63).then(__webpack_require__.bind(null, /*! ../components/system/role/RoleSave.vue */ "./vendor/avored/framework/resources/components/system/role/RoleSave.vue"));
});
Vue.component('admin-user-table', function () {
  return __webpack_require__.e(/*! import() */ 57).then(__webpack_require__.bind(null, /*! ../components/system/admin-user/AdminUserTable.vue */ "./vendor/avored/framework/resources/components/system/admin-user/AdminUserTable.vue"));
});
Vue.component('admin-user-save', __webpack_require__(/*! ../components/system/admin-user/AdminUserSave.vue */ "./vendor/avored/framework/resources/components/system/admin-user/AdminUserSave.vue")["default"]);
Vue.component('promotion-code-table', function () {
  return __webpack_require__.e(/*! import() */ 51).then(__webpack_require__.bind(null, /*! ../components/promotion/promotion-code/PromotionCodeTable.vue */ "./vendor/avored/framework/resources/components/promotion/promotion-code/PromotionCodeTable.vue"));
});
Vue.component('promotion-code-edit', function () {
  return Promise.all(/*! import() */[__webpack_require__.e(29), __webpack_require__.e(36)]).then(__webpack_require__.bind(null, /*! ../components/promotion/promotion-code/PromotionCodeEdit.vue */ "./vendor/avored/framework/resources/components/promotion/promotion-code/PromotionCodeEdit.vue"));
});
Vue.component('avored-layout', function () {
  return __webpack_require__.e(/*! import() */ 53).then(__webpack_require__.bind(null, /*! ../components/system/Layout.vue */ "./vendor/avored/framework/resources/components/system/Layout.vue"));
});
Vue.component('avored-flash', function () {
  return __webpack_require__.e(/*! import() */ 52).then(__webpack_require__.bind(null, /*! ../components/system/Flash.vue */ "./vendor/avored/framework/resources/components/system/Flash.vue"));
});
Vue.component('login-fields', function () {
  return __webpack_require__.e(/*! import() */ 54).then(__webpack_require__.bind(null, /*! ../components/system/LoginFields.vue */ "./vendor/avored/framework/resources/components/system/LoginFields.vue"));
});
Vue.component('password-reset-page', function () {
  return __webpack_require__.e(/*! import() */ 56).then(__webpack_require__.bind(null, /*! ../components/system/PasswordResetPage.vue */ "./vendor/avored/framework/resources/components/system/PasswordResetPage.vue"));
});
Vue.component('password-new-page', function () {
  return __webpack_require__.e(/*! import() */ 55).then(__webpack_require__.bind(null, /*! ../components/system/PasswordNewPage.vue */ "./vendor/avored/framework/resources/components/system/PasswordNewPage.vue"));
});
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

var app = new Vue({
  el: '#app'
});
var EventBus = new Vue();

/***/ }),

/***/ "./vendor/avored/framework/resources/js/avored.js":
/*!********************************************************!*\
  !*** ./vendor/avored/framework/resources/js/avored.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var AvoRed = function () {
  return {
    initialize: function initialize(callback) {
      callback(Vue);
    }
  };
}();

exports = module.exports = AvoRed;

/***/ })

}]);