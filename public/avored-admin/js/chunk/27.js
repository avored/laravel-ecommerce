(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[27],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./packages/framework/resources/components/system/LoginFields.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./packages/framework/resources/components/system/LoginFields.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************************/
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
/* harmony default export */ __webpack_exports__["default"] = ({
  props: {
    name: 'loginpost',
    type: String
  },
  data: function data() {
    return {
      loginForm: this.$form.createForm(this),
      loadingSubmitBtn: false
    };
  },
  methods: {
    handleSubmit: function handleSubmit(e) {
      var _this = this;

      this.loadingSubmitBtn = true;
      this.loginForm.validateFields(function (err, values) {
        if (err) {
          _this.loadingSubmitBtn = false;
          e.preventDefault();
        }
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./packages/framework/resources/components/system/LoginFields.vue?vue&type=template&id=2bcd53e8&":
/*!*************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./packages/framework/resources/components/system/LoginFields.vue?vue&type=template&id=2bcd53e8& ***!
  \*************************************************************************************************************************************************************************************************************************************/
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
      _c(
        "a-row",
        { attrs: { type: "flex", align: "middle" } },
        [
          _c(
            "a-col",
            { attrs: { span: 12 } },
            [
              _c(
                "a-row",
                { attrs: { type: "flex" } },
                [
                  _c(
                    "a-col",
                    { attrs: { span: 20, offset: 2 } },
                    [
                      _c(
                        "a-card",
                        { attrs: { title: "Card title" } },
                        [
                          _c(
                            "a-form",
                            {
                              attrs: {
                                form: _vm.loginForm,
                                method: "post",
                                action: "#admin/login/post/url"
                              },
                              on: { submit: _vm.handleSubmit }
                            },
                            [
                              _c(
                                "a-form-item",
                                { attrs: { label: "Email Address" } },
                                [
                                  _c("a-input", {
                                    directives: [
                                      {
                                        name: "decorator",
                                        rawName: "v-decorator",
                                        value: [
                                          "email",
                                          {
                                            rules: [
                                              {
                                                required: true,
                                                message:
                                                  "Email Address is required"
                                              }
                                            ]
                                          }
                                        ],
                                        expression:
                                          "[\n                              'email',\n                              {\n                                  rules: [\n                                      {   required: true, \n                                          message: 'Email Address is required' \n                                      }\n                                  ]\n                              }\n                              ]"
                                      }
                                    ],
                                    attrs: { "auto-focus": true, name: "email" }
                                  })
                                ],
                                1
                              ),
                              _vm._v(" "),
                              _c(
                                "a-form-item",
                                { attrs: { label: "Password Label" } },
                                [
                                  _c("a-input", {
                                    directives: [
                                      {
                                        name: "decorator",
                                        rawName: "v-decorator",
                                        value: [
                                          "password",
                                          {
                                            rules: [
                                              {
                                                required: true,
                                                message: "Password is required"
                                              }
                                            ]
                                          }
                                        ],
                                        expression:
                                          "[\n                                  'password',\n                                  {rules: [{ required: true, message: 'Password is required' }]}\n                                  ]"
                                      }
                                    ],
                                    attrs: {
                                      name: "password",
                                      type: "password"
                                    }
                                  })
                                ],
                                1
                              ),
                              _vm._v(" "),
                              _c(
                                "a-form-item",
                                [
                                  _c(
                                    "a-button",
                                    {
                                      attrs: {
                                        type: "primary",
                                        loading: _vm.loadingSubmitBtn,
                                        "html-type": "submit"
                                      }
                                    },
                                    [
                                      _vm._v(
                                        "\n                                  Login Button\n                              "
                                      )
                                    ]
                                  ),
                                  _vm._v(" "),
                                  _c(
                                    "a",
                                    {
                                      staticClass: "ml-1",
                                      attrs: { href: "#forgot-password-url" }
                                    },
                                    [_vm._v("Forgot password?")]
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
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "a-col",
            { attrs: { span: 12 } },
            [
              _c(
                "a-row",
                {
                  staticClass: "h-100 text-center",
                  attrs: { type: "flex", align: "middle" }
                },
                [
                  _c("a-col", { attrs: { span: 24 } }, [
                    _c("img", {
                      staticClass: "height-100",
                      attrs: {
                        src: "/avored-admin/images/avored_admin_login.svg",
                        width: "55%",
                        alt: "AvoRed Admin Login"
                      }
                    })
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
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./packages/framework/resources/components/system/LoginFields.vue":
/*!************************************************************************!*\
  !*** ./packages/framework/resources/components/system/LoginFields.vue ***!
  \************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _LoginFields_vue_vue_type_template_id_2bcd53e8___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./LoginFields.vue?vue&type=template&id=2bcd53e8& */ "./packages/framework/resources/components/system/LoginFields.vue?vue&type=template&id=2bcd53e8&");
/* harmony import */ var _LoginFields_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./LoginFields.vue?vue&type=script&lang=js& */ "./packages/framework/resources/components/system/LoginFields.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _LoginFields_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _LoginFields_vue_vue_type_template_id_2bcd53e8___WEBPACK_IMPORTED_MODULE_0__["render"],
  _LoginFields_vue_vue_type_template_id_2bcd53e8___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "packages/framework/resources/components/system/LoginFields.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./packages/framework/resources/components/system/LoginFields.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************!*\
  !*** ./packages/framework/resources/components/system/LoginFields.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_LoginFields_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./LoginFields.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./packages/framework/resources/components/system/LoginFields.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_LoginFields_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./packages/framework/resources/components/system/LoginFields.vue?vue&type=template&id=2bcd53e8&":
/*!*******************************************************************************************************!*\
  !*** ./packages/framework/resources/components/system/LoginFields.vue?vue&type=template&id=2bcd53e8& ***!
  \*******************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_LoginFields_vue_vue_type_template_id_2bcd53e8___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./LoginFields.vue?vue&type=template&id=2bcd53e8& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./packages/framework/resources/components/system/LoginFields.vue?vue&type=template&id=2bcd53e8&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_LoginFields_vue_vue_type_template_id_2bcd53e8___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_LoginFields_vue_vue_type_template_id_2bcd53e8___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);