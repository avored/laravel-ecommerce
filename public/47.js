(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[47],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./packages/framework/resources/components/system/forms/AvoRedSelect.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./packages/framework/resources/components/system/forms/AvoRedSelect.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var v_click_outside__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! v-click-outside */ "./node_modules/v-click-outside/dist/v-click-outside.umd.js");
/* harmony import */ var v_click_outside__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(v_click_outside__WEBPACK_IMPORTED_MODULE_0__);
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
  name: "avored-select",
  components: {},
  directives: {
    clickOutside: v_click_outside__WEBPACK_IMPORTED_MODULE_0___default.a.directive
  },
  props: {
    labelClass: {
      type: [String],
      "default": ""
    },
    labelText: {
      type: [String],
      "default": ""
    },
    initValue: {
      type: [String],
      "default": ""
    },
    onhover: {
      type: [Boolean],
      "default": false
    },
    options: {
      type: [Array, Object],
      "default": function _default() {
        return [];
      }
    }
  },
  data: function data() {
    return {
      changeValue: this.initValue,
      displayText: '',
      dropdownToggle: false
    };
  },
  methods: {
    selectedOption: function selectedOption(event) {
      this.changeValue = event.target.getAttribute('value');
      this.displayText = this.options[event.target.getAttribute('value')];
      this.dropdownToggle = !this.dropdownToggle;
    }
  },
  watch: {
    changeValue: function changeValue(newValue) {
      this.$emit("input", newValue);
    }
  },
  mounted: function mounted() {
    if (this.onhover) {
      this.dropdownToggle = true;
    }
  }
});

/***/ }),

/***/ "./node_modules/v-click-outside/dist/v-click-outside.umd.js":
/*!******************************************************************!*\
  !*** ./node_modules/v-click-outside/dist/v-click-outside.umd.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

!function(e,n){ true?module.exports=n():undefined}(this,function(){var e="__v-click-outside",n="undefined"!=typeof window,t="undefined"!=typeof navigator,i=n&&("ontouchstart"in window||t&&navigator.msMaxTouchPoints>0)?["touchstart"]:["click"];function o(n,t){var o=function(e){var n="function"==typeof e;if(!n&&"object"!=typeof e)throw new Error("v-click-outside: Binding value must be a function or an object");return{handler:n?e:e.handler,middleware:e.middleware||function(e){return e},events:e.events||i,isActive:!(!1===e.isActive)}}(t.value),r=o.handler,d=o.middleware;o.isActive&&(n[e]=o.events.map(function(e){return{event:e,handler:function(e){return function(e){var n=e.el,t=e.event,i=e.handler,o=e.middleware,r=t.path||t.composedPath&&t.composedPath(),d=r?r.indexOf(n)<0:!n.contains(t.target);t.target!==n&&d&&o(t)&&i(t)}({event:e,el:n,handler:r,middleware:d})}}}),n[e].forEach(function(t){var i=t.event,o=t.handler;return setTimeout(function(){n[e]&&document.documentElement.addEventListener(i,o,!1)},0)}))}function r(n){(n[e]||[]).forEach(function(e){return document.documentElement.removeEventListener(e.event,e.handler,!1)}),delete n[e]}var d=n?{bind:o,update:function(e,n){var t=n.value,i=n.oldValue;JSON.stringify(t)!==JSON.stringify(i)&&(r(e),o(e,{value:t}))},unbind:r}:{};return{install:function(e){e.directive("click-outside",d)},directive:d}});
//# sourceMappingURL=v-click-outside.umd.js.map


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./packages/framework/resources/components/system/forms/AvoRedSelect.vue?vue&type=template&id=77f774f9&":
/*!********************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./packages/framework/resources/components/system/forms/AvoRedSelect.vue?vue&type=template&id=77f774f9& ***!
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
  return _c(
    "div",
    {
      directives: [
        {
          name: "click-outside",
          rawName: "v-click-outside",
          value: function() {
            _vm.dropdownToggle = false
          },
          expression: "()=>{dropdownToggle=false}"
        }
      ],
      staticClass: "mt-6"
    },
    [
      _vm.labelText
        ? _c(
            "label",
            { staticClass: "text-sm text-gray-600", class: _vm.labelClass },
            [_vm._v(_vm._s(_vm.labelText))]
          )
        : _vm._e(),
      _vm._v(" "),
      _c("div", { staticClass: "relative" }, [
        _c(
          "button",
          {
            staticClass:
              "border border-gray-500 w-full flex text-gray-700 font-semibold py-2 px-4 rounded inline-flex items-center",
            attrs: { type: "button" },
            on: {
              click: function($event) {
                _vm.dropdownToggle = !_vm.dropdownToggle
              }
            }
          },
          [
            _c("span", { staticClass: "flex-1 text-left" }, [
              _vm._v(_vm._s(_vm.changeValue))
            ]),
            _vm._v(" "),
            _c("span", { staticClass: "ml-auto" }, [
              _c(
                "svg",
                {
                  staticClass: "fill-current text-gray-400 h-4 w-4",
                  attrs: {
                    xmlns: "http://www.w3.org/2000/svg",
                    viewBox: "0 0 20 20"
                  }
                },
                [
                  _c("path", {
                    attrs: {
                      d:
                        "M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                    }
                  })
                ]
              )
            ])
          ]
        ),
        _vm._v(" "),
        _vm.dropdownToggle
          ? _c(
              "ul",
              {
                staticClass:
                  "w-full mt-1 z-10 bg-white border border-gray-500 absolute rounded shadow text-gray-700",
                on: { click: _vm.selectedOption }
              },
              [
                _vm._l(_vm.options, function(optionLabel, optionValue) {
                  return [
                    _c(
                      "li",
                      {
                        key: optionValue,
                        staticClass:
                          "px-2 py-1 hover:bg-gray-300 cursor-pointer",
                        attrs: { value: optionValue }
                      },
                      [
                        _vm._v(
                          "\n                    " +
                            _vm._s(optionLabel) +
                            "\n                "
                        )
                      ]
                    )
                  ]
                })
              ],
              2
            )
          : _vm._e()
      ]),
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
        attrs: { type: "hidden" },
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
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./packages/framework/resources/components/system/forms/AvoRedSelect.vue":
/*!*******************************************************************************!*\
  !*** ./packages/framework/resources/components/system/forms/AvoRedSelect.vue ***!
  \*******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _AvoRedSelect_vue_vue_type_template_id_77f774f9___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./AvoRedSelect.vue?vue&type=template&id=77f774f9& */ "./packages/framework/resources/components/system/forms/AvoRedSelect.vue?vue&type=template&id=77f774f9&");
/* harmony import */ var _AvoRedSelect_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./AvoRedSelect.vue?vue&type=script&lang=js& */ "./packages/framework/resources/components/system/forms/AvoRedSelect.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _AvoRedSelect_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _AvoRedSelect_vue_vue_type_template_id_77f774f9___WEBPACK_IMPORTED_MODULE_0__["render"],
  _AvoRedSelect_vue_vue_type_template_id_77f774f9___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "packages/framework/resources/components/system/forms/AvoRedSelect.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./packages/framework/resources/components/system/forms/AvoRedSelect.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************!*\
  !*** ./packages/framework/resources/components/system/forms/AvoRedSelect.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AvoRedSelect_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./AvoRedSelect.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./packages/framework/resources/components/system/forms/AvoRedSelect.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AvoRedSelect_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./packages/framework/resources/components/system/forms/AvoRedSelect.vue?vue&type=template&id=77f774f9&":
/*!**************************************************************************************************************!*\
  !*** ./packages/framework/resources/components/system/forms/AvoRedSelect.vue?vue&type=template&id=77f774f9& ***!
  \**************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AvoRedSelect_vue_vue_type_template_id_77f774f9___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./AvoRedSelect.vue?vue&type=template&id=77f774f9& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./packages/framework/resources/components/system/forms/AvoRedSelect.vue?vue&type=template&id=77f774f9&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AvoRedSelect_vue_vue_type_template_id_77f774f9___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AvoRedSelect_vue_vue_type_template_id_77f774f9___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);