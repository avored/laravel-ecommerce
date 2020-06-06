(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[48],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./packages/framework/resources/components/system/forms/AvoRedToggle.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./packages/framework/resources/components/system/forms/AvoRedToggle.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************************************/
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
/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'avored-toggle',
  props: {
    labelText: {
      type: [String],
      "default": ''
    },
    labelClass: {
      type: [String],
      "default": ''
    },
    inputClass: {
      type: [String],
      "default": ''
    },
    initValue: {
      type: [String],
      "default": ''
    },
    errorText: {
      type: [String],
      "default": ''
    },
    fieldName: {
      type: [String],
      "default": ''
    },
    toggleOnValue: {
      type: [String, Number],
      "default": 1
    }
  },
  data: function data() {
    return {
      changeValue: this.initValue,
      toggle: false,
      toggleTransitionClass: 'translate-x-0',
      toggleBgClass: 'bg-gray-200'
    };
  },
  methods: {
    toggleChange: function toggleChange() {
      if (this.toggle) {
        this.toggle = false;
        this.changeValue = 0;
        this.toggleBgClass = 'bg-gray-200';
        this.toggleTransitionClass = 'translate-x-0';
      } else if (!this.toggle) {
        this.toggle = true;
        this.changeValue = this.toggleOnValue;
        this.toggleBgClass = 'bg-red-600';
        this.toggleTransitionClass = 'translate-x-6';
      }
    }
  },
  watch: {
    changeValue: function changeValue(newValue) {
      this.$emit('input', newValue);
    }
  },
  mounted: function mounted() {
    if (this.errorText) {
      this.inputClass += ' border-red-500';
    }

    if (this.toggleOnValue == this.initValue) {
      this.toggle = true;
      this.changeValue = this.toggleOnValue;
      this.toggleBgClass = 'bg-red-600';
      this.toggleTransitionClass = 'translate-x-6';
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./packages/framework/resources/components/system/forms/AvoRedToggle.vue?vue&type=template&id=b047e15e&":
/*!********************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./packages/framework/resources/components/system/forms/AvoRedToggle.vue?vue&type=template&id=b047e15e& ***!
  \********************************************************************************************************************************************************************************************************************************************/
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
  return _c("div", { staticClass: "relative w-full mb-6" }, [
    _vm.labelText
      ? _c(
          "label",
          {
            staticClass: "text-sm pb-2 w-full text-gray-600",
            class: _vm.labelClass,
            attrs: { for: _vm.fieldName }
          },
          [_vm._v("\n        " + _vm._s(_vm.labelText) + "\n    ")]
        )
      : _vm._e(),
    _vm._v(" "),
    _c(
      "div",
      {
        staticClass: "w-full flex items-center mt-2",
        on: { click: _vm.toggleChange }
      },
      [
        _c(
          "span",
          {
            staticClass:
              "relative inline-block flex-shrink-0 h-4 w-12 \n                rounded-full border border-2 cursor-pointer transition-colors ease-in-out duration-200 \n                outline-none",
            class: _vm.toggleBgClass,
            attrs: { role: "checkbox", tabindex: "0", "aria-checked": "false" }
          },
          [
            _c("span", {
              staticClass:
                "translate-x-0 inline-block -mt-1 h-6 w-6 rounded-full bg-white shadow transform transition ease-in-out duration-200",
              class: _vm.toggleTransitionClass
            })
          ]
        )
      ]
    ),
    _vm._v(" "),
    _c("input", {
      directives: [
        {
          name: "model",
          rawName: "v-model",
          value: _vm.changeValue,
          expression: "changeValue"
        }
      ],
      attrs: { type: "hidden", name: _vm.fieldName },
      domProps: { value: _vm.changeValue },
      on: {
        input: function($event) {
          if ($event.target.composing) {
            return
          }
          _vm.changeValue = $event.target.value
        }
      }
    }),
    _vm._v(" "),
    _vm.errorText
      ? _c("div", { staticClass: "text-sm ml-1 text-red-500 absolute" }, [
          _vm._v("\n        " + _vm._s(_vm.errorText) + "\n    ")
        ])
      : _vm._e()
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./packages/framework/resources/components/system/forms/AvoRedToggle.vue":
/*!*******************************************************************************!*\
  !*** ./packages/framework/resources/components/system/forms/AvoRedToggle.vue ***!
  \*******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _AvoRedToggle_vue_vue_type_template_id_b047e15e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./AvoRedToggle.vue?vue&type=template&id=b047e15e& */ "./packages/framework/resources/components/system/forms/AvoRedToggle.vue?vue&type=template&id=b047e15e&");
/* harmony import */ var _AvoRedToggle_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./AvoRedToggle.vue?vue&type=script&lang=js& */ "./packages/framework/resources/components/system/forms/AvoRedToggle.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _AvoRedToggle_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _AvoRedToggle_vue_vue_type_template_id_b047e15e___WEBPACK_IMPORTED_MODULE_0__["render"],
  _AvoRedToggle_vue_vue_type_template_id_b047e15e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "packages/framework/resources/components/system/forms/AvoRedToggle.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./packages/framework/resources/components/system/forms/AvoRedToggle.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************!*\
  !*** ./packages/framework/resources/components/system/forms/AvoRedToggle.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AvoRedToggle_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./AvoRedToggle.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./packages/framework/resources/components/system/forms/AvoRedToggle.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AvoRedToggle_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./packages/framework/resources/components/system/forms/AvoRedToggle.vue?vue&type=template&id=b047e15e&":
/*!**************************************************************************************************************!*\
  !*** ./packages/framework/resources/components/system/forms/AvoRedToggle.vue?vue&type=template&id=b047e15e& ***!
  \**************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AvoRedToggle_vue_vue_type_template_id_b047e15e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./AvoRedToggle.vue?vue&type=template&id=b047e15e& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./packages/framework/resources/components/system/forms/AvoRedToggle.vue?vue&type=template&id=b047e15e&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AvoRedToggle_vue_vue_type_template_id_b047e15e___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AvoRedToggle_vue_vue_type_template_id_b047e15e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);