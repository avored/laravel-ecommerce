(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[14],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./vendor/avored/framework/resources/components/system/forms/AvoRedTable.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./vendor/avored/framework/resources/components/system/forms/AvoRedTable.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************************************/
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
/* harmony default export */ __webpack_exports__["default"] = ({
  name: "avored-table",
  props: {
    columns: {
      type: [Array],
      "default": function _default() {
        [];
      }
    },
    items: {
      type: [Array],
      "default": function _default() {
        [];
      }
    },
    from: {
      type: Number,
      "default": 0
    },
    to: {
      type: Number,
      "default": 0
    },
    total: {
      type: Number,
      "default": 0
    },
    prev_page_url: {
      type: String,
      "default": ''
    },
    next_page_url: {
      type: String,
      "default": ''
    },
    per_page: {
      type: Number,
      "default": 0
    }
  },
  data: function data() {
    return {};
  },
  methods: {
    nextButtonOnClick: function nextButtonOnClick() {
      location = this.next_page_url; // this.$emit('next')
    },
    prevButtonOnClick: function prevButtonOnClick() {
      location = this.prev_page_url; // this.$emit('prev')
    }
  },
  mounted: function mounted() {}
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./vendor/avored/framework/resources/components/system/forms/AvoRedTable.vue?vue&type=template&id=6ca82e34&":
/*!************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./vendor/avored/framework/resources/components/system/forms/AvoRedTable.vue?vue&type=template&id=6ca82e34& ***!
  \************************************************************************************************************************************************************************************************************************************************/
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
  return _c("div", [
    _c("table", { staticClass: "w-full" }, [
      _c("thead", { staticClass: "bg-gray-700 text-white" }, [
        _c(
          "tr",
          _vm._l(_vm.columns, function(column, index) {
            return _c(
              "th",
              {
                key: index,
                staticClass:
                  "px-6 py-3 border-b text-left border-gray-200 text-xs font-medium uppercase"
              },
              [_vm._v(_vm._s(column.label))]
            )
          }),
          0
        )
      ]),
      _vm._v(" "),
      _c(
        "tbody",
        { staticClass: "bg-white" },
        _vm._l(_vm.items, function(item, index) {
          return _c(
            "tr",
            { key: index },
            _vm._l(_vm.columns, function(column, index) {
              return _c(
                "td",
                {
                  key: index,
                  staticClass:
                    "px-6 py-4 text-sm leading-5 border-b border-gray-200"
                },
                [
                  _vm._t(
                    column.slotName,
                    [_vm._v(_vm._s(item[column.fieldKey]))],
                    { item: item }
                  )
                ],
                2
              )
            }),
            0
          )
        }),
        0
      )
    ]),
    _vm._v(" "),
    _c(
      "nav",
      {
        staticClass:
          "bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6"
      },
      [
        _c("div", { staticClass: "hidden sm:block" }, [
          _c("p", { staticClass: "text-sm leading-5 text-gray-700" }, [
            _vm._v("\n        Showing\n        "),
            _c("span", { staticClass: "font-medium" }, [
              _vm._v(_vm._s(_vm.from))
            ]),
            _vm._v("\n        to\n        "),
            _c("span", { staticClass: "font-medium" }, [
              _vm._v(_vm._s(_vm.to))
            ]),
            _vm._v("\n        of\n        "),
            _c("span", { staticClass: "font-medium" }, [
              _vm._v(_vm._s(_vm.total))
            ]),
            _vm._v("\n        results\n      ")
          ])
        ]),
        _vm._v(" "),
        _c(
          "div",
          { staticClass: "flex-1 flex justify-between sm:justify-end" },
          [
            _c(
              "button",
              {
                staticClass:
                  "relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700",
                class: !_vm.prev_page_url ? "opacity-50" : "",
                attrs: { type: "button", disabled: !_vm.prev_page_url },
                on: { click: _vm.prevButtonOnClick }
              },
              [_vm._v("Previous")]
            ),
            _vm._v(" "),
            _c(
              "button",
              {
                staticClass:
                  "ml-3 relative inline-flex items-center  px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700",
                class: !_vm.next_page_url ? "opacity-50" : "",
                attrs: { type: "button", disabled: !_vm.next_page_url },
                on: { click: _vm.nextButtonOnClick }
              },
              [_vm._v("Next")]
            )
          ]
        )
      ]
    )
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./vendor/avored/framework/resources/components/system/forms/AvoRedTable.vue":
/*!***********************************************************************************!*\
  !*** ./vendor/avored/framework/resources/components/system/forms/AvoRedTable.vue ***!
  \***********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _AvoRedTable_vue_vue_type_template_id_6ca82e34___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./AvoRedTable.vue?vue&type=template&id=6ca82e34& */ "./vendor/avored/framework/resources/components/system/forms/AvoRedTable.vue?vue&type=template&id=6ca82e34&");
/* harmony import */ var _AvoRedTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./AvoRedTable.vue?vue&type=script&lang=js& */ "./vendor/avored/framework/resources/components/system/forms/AvoRedTable.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _AvoRedTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _AvoRedTable_vue_vue_type_template_id_6ca82e34___WEBPACK_IMPORTED_MODULE_0__["render"],
  _AvoRedTable_vue_vue_type_template_id_6ca82e34___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "vendor/avored/framework/resources/components/system/forms/AvoRedTable.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./vendor/avored/framework/resources/components/system/forms/AvoRedTable.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************!*\
  !*** ./vendor/avored/framework/resources/components/system/forms/AvoRedTable.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AvoRedTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./AvoRedTable.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./vendor/avored/framework/resources/components/system/forms/AvoRedTable.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AvoRedTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./vendor/avored/framework/resources/components/system/forms/AvoRedTable.vue?vue&type=template&id=6ca82e34&":
/*!******************************************************************************************************************!*\
  !*** ./vendor/avored/framework/resources/components/system/forms/AvoRedTable.vue?vue&type=template&id=6ca82e34& ***!
  \******************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AvoRedTable_vue_vue_type_template_id_6ca82e34___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./AvoRedTable.vue?vue&type=template&id=6ca82e34& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./vendor/avored/framework/resources/components/system/forms/AvoRedTable.vue?vue&type=template&id=6ca82e34&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AvoRedTable_vue_vue_type_template_id_6ca82e34___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AvoRedTable_vue_vue_type_template_id_6ca82e34___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);