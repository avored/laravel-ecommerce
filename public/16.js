(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[16],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./packages/framework/resources/components/system/forms/AvoRedInput.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./packages/framework/resources/components/system/forms/AvoRedInput.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************************************/
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
/* harmony default export */ __webpack_exports__["default"] = ({
  name: "avored-input",
  props: {
    labelText: {
      type: [String],
      "default": ""
    },
    labelClass: {
      type: [String],
      "default": ""
    },
    inputClass: {
      type: [String],
      "default": ""
    },
    inputType: {
      type: [String],
      "default": "text"
    },
    initValue: {
      type: [String],
      "default": ""
    },
    errorText: {
      type: [String],
      "default": ""
    },
    fieldName: {
      type: [String],
      "default": ""
    }
  },
  data: function data() {
    return {
      changeValue: this.initValue
    };
  },
  watch: {
    changeValue: function changeValue(newValue) {
      this.$emit("input", newValue);
    }
  },
  mounted: function mounted() {
    if (this.errorText) {
      this.inputClass += " border-red-500";
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./packages/framework/resources/components/system/forms/AvoRedInput.vue?vue&type=template&id=4bb3295d&":
/*!*******************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./packages/framework/resources/components/system/forms/AvoRedInput.vue?vue&type=template&id=4bb3295d& ***!
  \*******************************************************************************************************************************************************************************************************************************************/
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
  return _c("div", { staticClass: "w-full" }, [
    _vm.labelText
      ? _c(
          "label",
          {
            staticClass: "block text-sm leading-5 text-gray-500",
            attrs: { for: _vm.fieldName }
          },
          [_vm._v("\n         " + _vm._s(_vm.labelText) + "\n  ")]
        )
      : _vm._e(),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "mt-1 flex rounded-md shadow-sm" },
      [
        _c("div", { staticClass: "relative flex-grow focus-within:z-10" }, [
          _c(
            "div",
            {
              staticClass:
                "absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
            },
            [_vm._t("addOnBefore")],
            2
          ),
          _vm._v(" "),
          _vm.inputType === "checkbox"
            ? _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.changeValue,
                    expression: "changeValue"
                  }
                ],
                staticClass:
                  "px-3 flex-1 w-full py-2 outline-none focus:shadow focus:border rounded border block border-gray-400",
                class: _vm.inputClass,
                attrs: {
                  id: _vm.fieldName,
                  name: _vm.fieldName,
                  type: "checkbox"
                },
                domProps: {
                  checked: Array.isArray(_vm.changeValue)
                    ? _vm._i(_vm.changeValue, null) > -1
                    : _vm.changeValue
                },
                on: {
                  change: function($event) {
                    var $$a = _vm.changeValue,
                      $$el = $event.target,
                      $$c = $$el.checked ? true : false
                    if (Array.isArray($$a)) {
                      var $$v = null,
                        $$i = _vm._i($$a, $$v)
                      if ($$el.checked) {
                        $$i < 0 && (_vm.changeValue = $$a.concat([$$v]))
                      } else {
                        $$i > -1 &&
                          (_vm.changeValue = $$a
                            .slice(0, $$i)
                            .concat($$a.slice($$i + 1)))
                      }
                    } else {
                      _vm.changeValue = $$c
                    }
                  }
                }
              })
            : _vm.inputType === "radio"
            ? _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.changeValue,
                    expression: "changeValue"
                  }
                ],
                staticClass:
                  "px-3 flex-1 w-full py-2 outline-none focus:shadow focus:border rounded border block border-gray-400",
                class: _vm.inputClass,
                attrs: {
                  id: _vm.fieldName,
                  name: _vm.fieldName,
                  type: "radio"
                },
                domProps: { checked: _vm._q(_vm.changeValue, null) },
                on: {
                  change: function($event) {
                    _vm.changeValue = null
                  }
                }
              })
            : _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.changeValue,
                    expression: "changeValue"
                  }
                ],
                staticClass:
                  "px-3 flex-1 w-full py-2 outline-none focus:shadow focus:border rounded border block border-gray-400",
                class: _vm.inputClass,
                attrs: {
                  id: _vm.fieldName,
                  name: _vm.fieldName,
                  type: _vm.inputType
                },
                domProps: { value: _vm.changeValue },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.changeValue = $event.target.value
                  }
                }
              })
        ]),
        _vm._v(" "),
        _vm._t("addOnAfter")
      ],
      2
    )
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./packages/framework/resources/components/system/forms/AvoRedInput.vue":
/*!******************************************************************************!*\
  !*** ./packages/framework/resources/components/system/forms/AvoRedInput.vue ***!
  \******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _AvoRedInput_vue_vue_type_template_id_4bb3295d___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./AvoRedInput.vue?vue&type=template&id=4bb3295d& */ "./packages/framework/resources/components/system/forms/AvoRedInput.vue?vue&type=template&id=4bb3295d&");
/* harmony import */ var _AvoRedInput_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./AvoRedInput.vue?vue&type=script&lang=js& */ "./packages/framework/resources/components/system/forms/AvoRedInput.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _AvoRedInput_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _AvoRedInput_vue_vue_type_template_id_4bb3295d___WEBPACK_IMPORTED_MODULE_0__["render"],
  _AvoRedInput_vue_vue_type_template_id_4bb3295d___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "packages/framework/resources/components/system/forms/AvoRedInput.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./packages/framework/resources/components/system/forms/AvoRedInput.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************!*\
  !*** ./packages/framework/resources/components/system/forms/AvoRedInput.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AvoRedInput_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./AvoRedInput.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./packages/framework/resources/components/system/forms/AvoRedInput.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AvoRedInput_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./packages/framework/resources/components/system/forms/AvoRedInput.vue?vue&type=template&id=4bb3295d&":
/*!*************************************************************************************************************!*\
  !*** ./packages/framework/resources/components/system/forms/AvoRedInput.vue?vue&type=template&id=4bb3295d& ***!
  \*************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AvoRedInput_vue_vue_type_template_id_4bb3295d___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./AvoRedInput.vue?vue&type=template&id=4bb3295d& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./packages/framework/resources/components/system/forms/AvoRedInput.vue?vue&type=template&id=4bb3295d&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AvoRedInput_vue_vue_type_template_id_4bb3295d___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AvoRedInput_vue_vue_type_template_id_4bb3295d___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);