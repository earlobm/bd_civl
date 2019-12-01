webpackJsonp([49],{

/***/ 194:
/***/ (function(module, exports) {

/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file.
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

module.exports = function normalizeComponent (
  rawScriptExports,
  compiledTemplate,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier /* server only */
) {
  var esModule
  var scriptExports = rawScriptExports = rawScriptExports || {}

  // ES6 modules interop
  var type = typeof rawScriptExports.default
  if (type === 'object' || type === 'function') {
    esModule = rawScriptExports
    scriptExports = rawScriptExports.default
  }

  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (compiledTemplate) {
    options.render = compiledTemplate.render
    options.staticRenderFns = compiledTemplate.staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = injectStyles
  }

  if (hook) {
    var functional = options.functional
    var existing = functional
      ? options.render
      : options.beforeCreate

    if (!functional) {
      // inject component registration as beforeCreate hook
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    } else {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functioal component in vue file
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return existing(h, context)
      }
    }
  }

  return {
    esModule: esModule,
    exports: scriptExports,
    options: options
  }
}


/***/ }),

<<<<<<< HEAD
/***/ 268:
=======
/***/ 194:
/***/ (function(module, exports, __webpack_require__) {

/*
  MIT License http://www.opensource.org/licenses/mit-license.php
  Author Tobias Koppers @sokra
  Modified by Evan You @yyx990803
*/

var hasDocument = typeof document !== 'undefined'

if (typeof DEBUG !== 'undefined' && DEBUG) {
  if (!hasDocument) {
    throw new Error(
    'vue-style-loader cannot be used in a non-browser environment. ' +
    "Use { target: 'node' } in your Webpack config to indicate a server-rendering environment."
  ) }
}

var listToStyles = __webpack_require__(195)

/*
type StyleObject = {
  id: number;
  parts: Array<StyleObjectPart>
}

type StyleObjectPart = {
  css: string;
  media: string;
  sourceMap: ?string
}
*/

var stylesInDom = {/*
  [id: number]: {
    id: number,
    refs: number,
    parts: Array<(obj?: StyleObjectPart) => void>
  }
*/}

var head = hasDocument && (document.head || document.getElementsByTagName('head')[0])
var singletonElement = null
var singletonCounter = 0
var isProduction = false
var noop = function () {}
var options = null
var ssrIdKey = 'data-vue-ssr-id'

// Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
// tags it will allow on a page
var isOldIE = typeof navigator !== 'undefined' && /msie [6-9]\b/.test(navigator.userAgent.toLowerCase())

module.exports = function (parentId, list, _isProduction, _options) {
  isProduction = _isProduction

  options = _options || {}

  var styles = listToStyles(parentId, list)
  addStylesToDom(styles)

  return function update (newList) {
    var mayRemove = []
    for (var i = 0; i < styles.length; i++) {
      var item = styles[i]
      var domStyle = stylesInDom[item.id]
      domStyle.refs--
      mayRemove.push(domStyle)
    }
    if (newList) {
      styles = listToStyles(parentId, newList)
      addStylesToDom(styles)
    } else {
      styles = []
    }
    for (var i = 0; i < mayRemove.length; i++) {
      var domStyle = mayRemove[i]
      if (domStyle.refs === 0) {
        for (var j = 0; j < domStyle.parts.length; j++) {
          domStyle.parts[j]()
        }
        delete stylesInDom[domStyle.id]
      }
    }
  }
}

function addStylesToDom (styles /* Array<StyleObject> */) {
  for (var i = 0; i < styles.length; i++) {
    var item = styles[i]
    var domStyle = stylesInDom[item.id]
    if (domStyle) {
      domStyle.refs++
      for (var j = 0; j < domStyle.parts.length; j++) {
        domStyle.parts[j](item.parts[j])
      }
      for (; j < item.parts.length; j++) {
        domStyle.parts.push(addStyle(item.parts[j]))
      }
      if (domStyle.parts.length > item.parts.length) {
        domStyle.parts.length = item.parts.length
      }
    } else {
      var parts = []
      for (var j = 0; j < item.parts.length; j++) {
        parts.push(addStyle(item.parts[j]))
      }
      stylesInDom[item.id] = { id: item.id, refs: 1, parts: parts }
    }
  }
}

function createStyleElement () {
  var styleElement = document.createElement('style')
  styleElement.type = 'text/css'
  head.appendChild(styleElement)
  return styleElement
}

function addStyle (obj /* StyleObjectPart */) {
  var update, remove
  var styleElement = document.querySelector('style[' + ssrIdKey + '~="' + obj.id + '"]')

  if (styleElement) {
    if (isProduction) {
      // has SSR styles and in production mode.
      // simply do nothing.
      return noop
    } else {
      // has SSR styles but in dev mode.
      // for some reason Chrome can't handle source map in server-rendered
      // style tags - source maps in <style> only works if the style tag is
      // created and inserted dynamically. So we remove the server rendered
      // styles and inject new ones.
      styleElement.parentNode.removeChild(styleElement)
    }
  }

  if (isOldIE) {
    // use singleton mode for IE9.
    var styleIndex = singletonCounter++
    styleElement = singletonElement || (singletonElement = createStyleElement())
    update = applyToSingletonTag.bind(null, styleElement, styleIndex, false)
    remove = applyToSingletonTag.bind(null, styleElement, styleIndex, true)
  } else {
    // use multi-style-tag mode in all other cases
    styleElement = createStyleElement()
    update = applyToTag.bind(null, styleElement)
    remove = function () {
      styleElement.parentNode.removeChild(styleElement)
    }
  }

  update(obj)

  return function updateStyle (newObj /* StyleObjectPart */) {
    if (newObj) {
      if (newObj.css === obj.css &&
          newObj.media === obj.media &&
          newObj.sourceMap === obj.sourceMap) {
        return
      }
      update(obj = newObj)
    } else {
      remove()
    }
  }
}

var replaceText = (function () {
  var textStore = []

  return function (index, replacement) {
    textStore[index] = replacement
    return textStore.filter(Boolean).join('\n')
  }
})()

function applyToSingletonTag (styleElement, index, remove, obj) {
  var css = remove ? '' : obj.css

  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = replaceText(index, css)
  } else {
    var cssNode = document.createTextNode(css)
    var childNodes = styleElement.childNodes
    if (childNodes[index]) styleElement.removeChild(childNodes[index])
    if (childNodes.length) {
      styleElement.insertBefore(cssNode, childNodes[index])
    } else {
      styleElement.appendChild(cssNode)
    }
  }
}

function applyToTag (styleElement, obj) {
  var css = obj.css
  var media = obj.media
  var sourceMap = obj.sourceMap

  if (media) {
    styleElement.setAttribute('media', media)
  }
  if (options.ssrId) {
    styleElement.setAttribute(ssrIdKey, obj.id)
  }

  if (sourceMap) {
    // https://developer.chrome.com/devtools/docs/javascript-debugging
    // this makes source maps inside style tags work properly in Chrome
    css += '\n/*# sourceURL=' + sourceMap.sources[0] + ' */'
    // http://stackoverflow.com/a/26603875
    css += '\n/*# sourceMappingURL=data:application/json;base64,' + btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))) + ' */'
  }

  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = css
  } else {
    while (styleElement.firstChild) {
      styleElement.removeChild(styleElement.firstChild)
    }
    styleElement.appendChild(document.createTextNode(css))
  }
}


/***/ }),

/***/ 195:
/***/ (function(module, exports) {

/**
 * Translates the list format produced by css-loader into something
 * easier to manipulate.
 */
module.exports = function listToStyles (parentId, list) {
  var styles = []
  var newStyles = {}
  for (var i = 0; i < list.length; i++) {
    var item = list[i]
    var id = item[0]
    var css = item[1]
    var media = item[2]
    var sourceMap = item[3]
    var part = {
      id: parentId + ':' + i,
      css: css,
      media: media,
      sourceMap: sourceMap
    }
    if (!newStyles[id]) {
      styles.push(newStyles[id] = { id: id, parts: [part] })
    } else {
      newStyles[id].parts.push(part)
    }
  }
  return styles
}


/***/ }),

/***/ 282:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(283);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(194)("6a496680", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-a0be3278\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./UnidadPoiVista.vue", function() {
     var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-a0be3278\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./UnidadPoiVista.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 283:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(65)(false);
// imports


// module
exports.push([module.i, "\n.table-bordered th,\r\n.table-bordered td {\r\n  border: 1px solid rgb(204, 198, 198) !important;\n}\r\n", ""]);

// exports


/***/ }),

/***/ 284:
>>>>>>> 45fac07ff921f0e244292ee89b85f543933a11a8
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

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

//fecha bot
/* harmony default export */ __webpack_exports__["default"] = ({
<<<<<<< HEAD
    props: ['ruta'],
    data: function data() {
        return {
            authUser: 1

        };
    },
    paginaActual: function paginaActual() {
        this.listado = 1;
    },
    mounted: function mounted() {}
=======
    data: function data() {
        var _ref;

        return _ref = {
            clastab1: 'active', clastab2: '', clastab3: '', clastab4: '',
            clastabdetalle1: 'tab-pane active', clastabdetalle2: 'tab-pane', clastabdetalle3: 'tab-pane', clastabdetalle4: 'tab-pane',
            arrayZona: [],
            listUnitPoi: [],
            arrayEntrenador: [],
            arrayDataDetalle: [], califica: '',
            arrayCohort: [], datosArrayPbg: [], datosArraySunat: [],
            identrendor: '', idZona: '', authUser: '', datosRepresentante: [],
            zonactual: 'x', porcent: 50, empresa: '',
            listado: 1, duenio_parcela: '', participante: '',
            id_asesor_edit: '', localidad_edit: '', denominacion_edit: '',
            dni_dirigente_edit: '', dirigente_edit: '',
            comentario_edit: '', id_asesoramiento: '', id_pbg: '', estado_as: '',
            estado_plan: '', estado: '',
            //fechas
            fechaInicio: '01/01/2018'
        }, _defineProperty(_ref, 'authUser', 1), _defineProperty(_ref, 'fechaFin', '' + new Date().getDate() + '/' + (Number(new Date().getMonth()) + 1) + '/' + new Date().getFullYear()), _defineProperty(_ref, 'options', {
            format: 'DD/MM/YYYY',
            useCurrent: false,
            locale: 'es',
            showClose: true
        }), _defineProperty(_ref, 'fechaRegistro', ''), _defineProperty(_ref, 'verzona', false), _defineProperty(_ref, 'puede_editar', false), _defineProperty(_ref, 'verentrenador', false), _defineProperty(_ref, 'pagination', {
            'total': 0,
            'current_page': 0,
            'per_page': 0,
            'last_page': 0,
            'from': 0,
            'to': 0
        }), _defineProperty(_ref, 'offset', 3), _defineProperty(_ref, 'datosmapa', ''), _defineProperty(_ref, 'markers', []), _defineProperty(_ref, 'modal', 0), _defineProperty(_ref, 'center', { lat: 45.508, lng: -73.587 }), _defineProperty(_ref, 'code', ''), _defineProperty(_ref, 'name', ''), _defineProperty(_ref, 'id', -1), _defineProperty(_ref, 'errorClase', 0), _defineProperty(_ref, 'errors', {}), _defineProperty(_ref, 'errorInputActivity', 'form-group'), _defineProperty(_ref, 'errorInputActivity1', 'form-group'), _ref;
    },

    computed: {
        isActived: function isActived() {
            return this.pagination.current_page;
        },
        //Calcula los elementos de la paginación
        pagesNumber: function pagesNumber() {
            if (!this.pagination.to) {
                return [];
            }

            var from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }

            var to = from + this.offset * 2;
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }

            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },
    methods: {
        validarData: function validarData() {
            this.errors = {};
            this.errorClase = 0;
            this.errors.code = "";
            this.errors.name = "";
            //input
            this.errorInputActivity = 'form-group has-success';
            this.errorInputActivity1 = 'form-group has-success';

            if (!this.codig) {
                this.errors.codig = "Ingrese codigo";
                this.errorInputActivity = 'form-group has-error';
                this.errorClase = 1;
            }
            if (!this.name) {
                this.errors.name = "Ingrese nombre";
                this.errorInputActivity1 = 'form-group has-error';
                this.errorClase = 1;
            }
            return this.errorClase;
        },
        paginaActual: function paginaActual() {
            this.listado = 1;
        },
        cambiarPagina: function cambiarPagina(page, identrendor, idZona, empresa, estado, fechaInicio, fechaFin) {
            var me = this;
            me.pagination.current_page = page;
            //me.listado=1;
            me.listar(page, identrendor, idZona, empresa, estado, fechaInicio, fechaFin);
        },
        editar: function editar(id) {
            var me = this;
            me.listado = 2;
            me.limpiar();
            // this.nombre= '';
            var url = 'get_unitpoi?id_poi_unity=' + id;
            axios.get(url).then(function (response) {
                var respuesta = response.data;
                me.name = respuesta.datax[0].name;
                me.code = respuesta.datax[0].code;
                me.id = respuesta.datax[0].id_poi_unity;
            }).catch(function (error) {
                console.log(error);
            });
            //return;
        },
        guardar: function guardar() {
            var _this = this;

            if (this.validarData()) {
                return;
            }
            swal({
                title: 'Esta seguro de guardar la informacion?',
                type: 'warning',
                showCancelButton: true, confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33', confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar', confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger', buttonsStyling: false,
                reverseButtons: true
            }).then(function (result) {
                if (result.value) {

                    var me = _this;
                    axios.post('save_UnitPoi', {
                        'code': _this.code, 'name': _this.name,
                        'id': _this.id

                    }).then(function (response) {
                        me.limpiar();
                        me.listado = 1;
                        me.listar();
                        // me.listar(1,me.micohort);
                        // me.listado=1;
                        swal('¡Actualizado!', 'El registro ha sido guardado con éxito.', 'success');
                    }).catch(function (error) {
                        console.log(error);
                    });
                } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel) {}
            });
        },
        agregar: function agregar() {
            var me = this;
            me.listado = 2;
            me.limpiar();
        },
        volver: function volver() {
            var me = this;
            me.listado = 1;
            me.limpiar();
        },
        limpiar: function limpiar() {
            this.errorInputActivity = 'form-group';
            this.errorInputActivity1 = 'form-group';
            this.errors = {};
            this.errors.code = "";
            this.errors.name = "";
            this.name = "";
            this.code = "";
            //this.description="";
            this.id = -1;
        },
        listar: function listar() {
            var me = this;
            var url = 'get_unitpoi';
            axios.get(url).then(function (response) {
                var respuesta = response.data;
                me.listUnitPoi = respuesta.datax;
            }).catch(function (error) {
                console.log(error);
            });
        }
    },
    mounted: function mounted() {
        this.listar();
    }
>>>>>>> 45fac07ff921f0e244292ee89b85f543933a11a8
});

/***/ }),

<<<<<<< HEAD
/***/ 269:
=======
/***/ 285:
>>>>>>> 45fac07ff921f0e244292ee89b85f543933a11a8
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
<<<<<<< HEAD
  return _vm._m(0)
=======
  return _c("main", { staticClass: "main" }, [
    _vm._m(0),
    _vm._v(" "),
    _c("div", { staticClass: "box-body" }, [
      _c("div", { staticClass: "row" }, [
        _c("div", { staticClass: "col-md-12" }, [
          _c("div", { staticClass: "container-fluid" }, [
            _c("div", { staticClass: "card" }, [
              _c("div", { staticClass: "card-body" }, [
                _c("div", { staticClass: "row" }, [
                  _c(
                    "div",
                    { staticClass: "col-lg-12 col-md-12 col-sm-12 col-xs-12" },
                    [
                      _c(
                        "div",
                        { staticClass: "box-body" },
                        [
                          _vm.listado == 1
                            ? [
                                _c("div", { staticClass: "row" }, [
                                  _vm._m(1),
                                  _vm._v(" "),
                                  _c(
                                    "div",
                                    {
                                      staticClass:
                                        "col-xs-12 col-sm-8 col-md-8 col-lg-4"
                                    },
                                    [
                                      _c(
                                        "div",
                                        {
                                          staticClass: "btn-group",
                                          staticStyle: { float: "right" }
                                        },
                                        [
                                          _c(
                                            "button",
                                            {
                                              staticClass: "btn btn-import",
                                              attrs: { type: "button" },
                                              on: {
                                                click: function($event) {
                                                  return _vm.importar()
                                                }
                                              }
                                            },
                                            [
                                              _c("i", {
                                                staticClass: "fa fa-upload"
                                              }),
                                              _vm._v(
                                                " Importar actvidades\n                                                        "
                                              )
                                            ]
                                          ),
                                          _vm._v(" "),
                                          _c(
                                            "button",
                                            {
                                              staticClass: "btn btn-add",
                                              attrs: { type: "button" },
                                              on: {
                                                click: function($event) {
                                                  return _vm.agregar()
                                                }
                                              }
                                            },
                                            [
                                              _c("i", {
                                                staticClass: "fa fa-plus"
                                              }),
                                              _vm._v(
                                                " Agregar actividad\n                                                        "
                                              )
                                            ]
                                          )
                                        ]
                                      )
                                    ]
                                  )
                                ]),
                                _vm._v(" "),
                                _c("div", { staticClass: "row" }, [
                                  _c("div", { staticClass: "col-md-12" }, [
                                    _c(
                                      "div",
                                      {
                                        staticClass:
                                          "box-body table-responsive no-padding"
                                      },
                                      [
                                        _c(
                                          "table",
                                          {
                                            staticClass: "table table-hover",
                                            staticStyle: { "font-size": "12px" }
                                          },
                                          [
                                            _vm._m(2),
                                            _vm._v(" "),
                                            _c(
                                              "tbody",
                                              _vm._l(_vm.listUnitPoi, function(
                                                midata,
                                                index
                                              ) {
                                                return _c(
                                                  "tr",
                                                  { key: index },
                                                  [
                                                    _c(
                                                      "td",
                                                      {
                                                        staticStyle: {
                                                          "vertical-align":
                                                            "middle"
                                                        }
                                                      },
                                                      [
                                                        _vm._v(
                                                          _vm._s(index + 1)
                                                        )
                                                      ]
                                                    ),
                                                    _vm._v(" "),
                                                    _c("td", {
                                                      staticStyle: {
                                                        "vertical-align":
                                                          "middle"
                                                      },
                                                      domProps: {
                                                        textContent: _vm._s(
                                                          midata.code
                                                        )
                                                      }
                                                    }),
                                                    _vm._v(" "),
                                                    _c("td", {
                                                      staticStyle: {
                                                        "vertical-align":
                                                          "middle"
                                                      },
                                                      domProps: {
                                                        textContent: _vm._s(
                                                          midata.name
                                                        )
                                                      }
                                                    }),
                                                    _vm._v(" "),
                                                    _c(
                                                      "td",
                                                      {
                                                        staticStyle: {
                                                          "vertical-align":
                                                            "middle",
                                                          "text-align": "center"
                                                        }
                                                      },
                                                      [
                                                        _c(
                                                          "button",
                                                          {
                                                            staticClass:
                                                              "btn btn-editar btn-sm",
                                                            attrs: {
                                                              type: "button"
                                                            },
                                                            on: {
                                                              click: function(
                                                                $event
                                                              ) {
                                                                return _vm.editar(
                                                                  midata.id_poi_unity
                                                                )
                                                              }
                                                            }
                                                          },
                                                          [
                                                            _c("i", {
                                                              staticClass:
                                                                "fa fa-pencil"
                                                            })
                                                          ]
                                                        ),
                                                        _vm._v(" "),
                                                        _c(
                                                          "button",
                                                          {
                                                            staticClass:
                                                              "btn btn-eliminar btn-sm",
                                                            attrs: {
                                                              title: "Eliminar",
                                                              type: "button"
                                                            },
                                                            on: {
                                                              click: function(
                                                                $event
                                                              ) {
                                                                return _vm.eliminar(
                                                                  midata.id_poi_unity
                                                                )
                                                              }
                                                            }
                                                          },
                                                          [
                                                            _c("i", {
                                                              staticClass:
                                                                "fa fa-trash"
                                                            })
                                                          ]
                                                        )
                                                      ]
                                                    )
                                                  ]
                                                )
                                              }),
                                              0
                                            )
                                          ]
                                        )
                                      ]
                                    ),
                                    _vm._v(" "),
                                    _c(
                                      "div",
                                      {
                                        staticClass:
                                          "dataTables_paginate paging_simple_numbers",
                                        staticStyle: {
                                          float: "right !important"
                                        }
                                      },
                                      [
                                        _c("nav", [
                                          _c(
                                            "ul",
                                            { staticClass: "pagination" },
                                            [
                                              _vm.pagination.current_page > 1
                                                ? _c(
                                                    "li",
                                                    {
                                                      staticClass: "page-item"
                                                    },
                                                    [
                                                      _c(
                                                        "a",
                                                        {
                                                          staticClass:
                                                            "page-link",
                                                          attrs: { href: "#" },
                                                          on: {
                                                            click: function(
                                                              $event
                                                            ) {
                                                              $event.preventDefault()
                                                              _vm.cambiarPagina(
                                                                Number(
                                                                  _vm.pagination
                                                                    .current_page
                                                                ) - 1,
                                                                _vm.identrendor,
                                                                _vm.idZona,
                                                                _vm.empresa,
                                                                _vm.estado,
                                                                _vm.fechaInicio,
                                                                _vm.fechaFin
                                                              )
                                                            }
                                                          }
                                                        },
                                                        [_vm._v("Ant")]
                                                      )
                                                    ]
                                                  )
                                                : _vm._e(),
                                              _vm._v(" "),
                                              _vm._l(_vm.pagesNumber, function(
                                                page
                                              ) {
                                                return _c(
                                                  "li",
                                                  {
                                                    key: page,
                                                    staticClass: "page-item",
                                                    class: [
                                                      page == _vm.isActived
                                                        ? "active"
                                                        : ""
                                                    ]
                                                  },
                                                  [
                                                    _c("a", {
                                                      staticClass: "page-link",
                                                      attrs: { href: "#" },
                                                      domProps: {
                                                        textContent: _vm._s(
                                                          page
                                                        )
                                                      },
                                                      on: {
                                                        click: function(
                                                          $event
                                                        ) {
                                                          $event.preventDefault()
                                                          return _vm.cambiarPagina(
                                                            page,
                                                            _vm.identrendor,
                                                            _vm.idZona,
                                                            _vm.empresa,
                                                            _vm.estado,
                                                            _vm.fechaInicio,
                                                            _vm.fechaFin
                                                          )
                                                        }
                                                      }
                                                    })
                                                  ]
                                                )
                                              }),
                                              _vm._v(" "),
                                              _vm.pagination.current_page <
                                              _vm.pagination.last_page
                                                ? _c(
                                                    "li",
                                                    {
                                                      staticClass: "page-item"
                                                    },
                                                    [
                                                      _c(
                                                        "a",
                                                        {
                                                          staticClass:
                                                            "page-link",
                                                          attrs: { href: "#" },
                                                          on: {
                                                            click: function(
                                                              $event
                                                            ) {
                                                              $event.preventDefault()
                                                              _vm.cambiarPagina(
                                                                Number(
                                                                  _vm.pagination
                                                                    .current_page
                                                                ) + 1,
                                                                _vm.identrendor,
                                                                _vm.idZona,
                                                                _vm.empresa,
                                                                _vm.estado,
                                                                _vm.fechaInicio,
                                                                _vm.fechaFin
                                                              )
                                                            }
                                                          }
                                                        },
                                                        [_vm._v("Sig")]
                                                      )
                                                    ]
                                                  )
                                                : _vm._e()
                                            ],
                                            2
                                          )
                                        ])
                                      ]
                                    )
                                  ])
                                ])
                              ]
                            : _vm._e(),
                          _vm._v(" "),
                          _vm.listado == 2
                            ? [
                                _c("div", { staticClass: "row" }, [
                                  _c("div", { staticClass: "col-md-12" }, [
                                    _c(
                                      "div",
                                      {
                                        staticClass: "btn-group",
                                        staticStyle: { float: "right" }
                                      },
                                      [
                                        _c(
                                          "button",
                                          {
                                            staticClass: "btn btn-danger",
                                            attrs: { type: "button" },
                                            on: {
                                              click: function($event) {
                                                return _vm.volver()
                                              }
                                            }
                                          },
                                          [
                                            _c("i", {
                                              staticClass: "fa fa-arrow-left"
                                            }),
                                            _vm._v(
                                              " Volver a la lista\n                                                        "
                                            )
                                          ]
                                        ),
                                        _vm._v(" "),
                                        _c(
                                          "button",
                                          {
                                            staticClass: "btn btn-add",
                                            attrs: { type: "button" },
                                            on: {
                                              click: function($event) {
                                                return _vm.guardar()
                                              }
                                            }
                                          },
                                          [
                                            _c("i", {
                                              staticClass: "fa fa-save"
                                            }),
                                            _vm._v(
                                              " Guardar actividad\n                                                        "
                                            )
                                          ]
                                        )
                                      ]
                                    )
                                  ])
                                ]),
                                _vm._v(" "),
                                _c("div", { staticClass: "row" }, [
                                  _c("div", { staticClass: "col-md-12" }, [
                                    _c(
                                      "div",
                                      {
                                        staticClass: "form-horizontal",
                                        staticStyle: { "margin-top": "15px" }
                                      },
                                      [
                                        _c(
                                          "div",
                                          { staticClass: "form-group" },
                                          [
                                            _c(
                                              "div",
                                              { class: _vm.errorInputActivity },
                                              [
                                                _c(
                                                  "label",
                                                  {
                                                    staticClass:
                                                      "col-md-1 control-label"
                                                  },
                                                  [_vm._v("Código")]
                                                ),
                                                _vm._v(" "),
                                                _c(
                                                  "div",
                                                  { staticClass: "col-md-11" },
                                                  [
                                                    _c("input", {
                                                      directives: [
                                                        {
                                                          name: "model",
                                                          rawName: "v-model",
                                                          value: _vm.code,
                                                          expression: "code"
                                                        }
                                                      ],
                                                      staticClass:
                                                        "form-control",
                                                      staticStyle: {
                                                        "border-radius": "3px"
                                                      },
                                                      attrs: { rows: "1" },
                                                      domProps: {
                                                        value: _vm.code
                                                      },
                                                      on: {
                                                        keyup: function(
                                                          $event
                                                        ) {
                                                          return _vm.validarData()
                                                        },
                                                        input: function(
                                                          $event
                                                        ) {
                                                          if (
                                                            $event.target
                                                              .composing
                                                          ) {
                                                            return
                                                          }
                                                          _vm.code =
                                                            $event.target.value
                                                        }
                                                      }
                                                    }),
                                                    _vm._v(" "),
                                                    _c(
                                                      "em",
                                                      {
                                                        staticClass:
                                                          "has-error text-danger",
                                                        staticStyle: {
                                                          display: "inline"
                                                        },
                                                        attrs: {
                                                          for: "form:code"
                                                        }
                                                      },
                                                      [
                                                        _vm._v(
                                                          _vm._s(
                                                            _vm.errors.code
                                                          )
                                                        )
                                                      ]
                                                    )
                                                  ]
                                                )
                                              ]
                                            )
                                          ]
                                        ),
                                        _vm._v(" "),
                                        _c(
                                          "div",
                                          { staticClass: "form-group" },
                                          [
                                            _c(
                                              "div",
                                              {
                                                class: _vm.errorInputActivity1
                                              },
                                              [
                                                _c(
                                                  "label",
                                                  {
                                                    staticClass:
                                                      "col-md-1 control-label"
                                                  },
                                                  [_vm._v("NOMBRE")]
                                                ),
                                                _vm._v(" "),
                                                _c(
                                                  "div",
                                                  { staticClass: "col-md-11" },
                                                  [
                                                    _c("input", {
                                                      directives: [
                                                        {
                                                          name: "model",
                                                          rawName: "v-model",
                                                          value: _vm.name,
                                                          expression: "name"
                                                        }
                                                      ],
                                                      staticClass:
                                                        "form-control",
                                                      staticStyle: {
                                                        "border-radius": "3px"
                                                      },
                                                      attrs: { rows: "1" },
                                                      domProps: {
                                                        value: _vm.name
                                                      },
                                                      on: {
                                                        keyup: function(
                                                          $event
                                                        ) {
                                                          return _vm.validarData()
                                                        },
                                                        input: function(
                                                          $event
                                                        ) {
                                                          if (
                                                            $event.target
                                                              .composing
                                                          ) {
                                                            return
                                                          }
                                                          _vm.name =
                                                            $event.target.value
                                                        }
                                                      }
                                                    }),
                                                    _vm._v(" "),
                                                    _c(
                                                      "em",
                                                      {
                                                        staticClass:
                                                          "has-error text-danger",
                                                        staticStyle: {
                                                          display: "inline"
                                                        },
                                                        attrs: {
                                                          for: "form:code"
                                                        }
                                                      },
                                                      [
                                                        _vm._v(
                                                          _vm._s(
                                                            _vm.errors.name
                                                          )
                                                        )
                                                      ]
                                                    )
                                                  ]
                                                )
                                              ]
                                            )
                                          ]
                                        )
                                      ]
                                    )
                                  ])
                                ])
                              ]
                            : _vm._e()
                        ],
                        2
                      )
                    ]
                  )
                ])
              ])
            ])
          ])
        ])
      ])
    ])
  ])
>>>>>>> 45fac07ff921f0e244292ee89b85f543933a11a8
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
<<<<<<< HEAD
    return _c("main", { staticClass: "main" }, [
      _c("section", { staticClass: "content-header" }, [
        _c("h1", [
          _vm._v("\n              Bienvenido\n              "),
          _c("small", [_vm._v("al Sistema de Préstamo y Empeño")])
=======
    return _c("div", { staticClass: "box-header with-border" }, [
      _c("section", { staticClass: "content-header" }, [
        _c("h3", { staticClass: "box-title" }, [
          _c("strong", [_vm._v(" \n                UNIDAD POI")])
>>>>>>> 45fac07ff921f0e244292ee89b85f543933a11a8
        ]),
        _vm._v(" "),
        _c("ol", { staticClass: "breadcrumb" }, [
          _c("li", [
            _c("a", { attrs: { href: "#" } }, [
<<<<<<< HEAD
              _c("i", { staticClass: "fa fa-home" }),
              _vm._v(" Inicio")
            ])
          ])
        ])
      ]),
      _vm._v(" "),
      _c("section", { staticClass: "content" }, [
        _c("div", { staticClass: "row" }, [
          _c("div", { staticClass: "col-md-12" }, [
            _c("div", { staticClass: "box box-primary" }, [
              _c("div", { staticClass: "box-body" }, [
                _c("div", { staticClass: "row" }, [
                  _c("div", { staticClass: "col-md-12" }, [
                    _c("div", { staticClass: "container-fluid" }, [
                      _c("div", { staticClass: "card" }, [
                        _c("div", { staticClass: "card-body" }, [
                          _c("div", { staticClass: "row" }, [
                            _c(
                              "div",
                              {
                                staticClass:
                                  "col-lg-12 col-md-12 col-sm-12 col-xs-12"
                              },
                              [
                                _c("div", { staticClass: "box-body" }, [
                                  _c("div", { staticClass: "row" }, [
                                    _c(
                                      "section",
                                      { attrs: { id: "widget-grid" } },
                                      [
                                        _c("div", { staticClass: "row" }, [
                                          _c(
                                            "article",
                                            { staticClass: "col-sm-12" },
                                            [
                                              _c("img", {
                                                staticStyle: {
                                                  "border-radius": "3px"
                                                },
                                                attrs: {
                                                  width: "100%",
                                                  src: "img/LOGO-TUMIFINAL.png"
                                                }
                                              })
                                            ]
                                          )
                                        ])
                                      ]
                                    )
                                  ])
                                ])
                              ]
                            )
                          ])
                        ])
                      ])
                    ])
                  ])
                ])
              ])
            ])
          ])
        ])
      ])
    ])
=======
              _c("i", { staticClass: "fa fa-shopping-cart" }),
              _vm._v("Acceso a Mercados")
            ])
          ]),
          _vm._v(" "),
          _c("li", [_c("a", { attrs: { href: "#" } }, [_vm._v("PBG")])]),
          _vm._v(" "),
          _c("li", [_c("a", { attrs: { href: "#" } }, [_vm._v("Emergente")])]),
          _vm._v(" "),
          _c("li", { staticClass: "active" }, [_vm._v("Estado de Plan")])
        ])
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "box-tools pull-right" })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-xs-12 col-sm-4 col-md-4 col-lg-8" }, [
      _c(
        "div",
        {
          staticClass: "input-group input-group-sm",
          staticStyle: { "margin-bottom": "15px" }
        },
        [
          _c("input", {
            staticClass: "form-control",
            attrs: {
              type: "text",
              placeholder: "Buscar por código o nombre..."
            }
          }),
          _vm._v(" "),
          _c("span", { staticClass: "input-group-btn" }, [
            _c(
              "button",
              {
                staticClass: "btn btn-mostrar btn-flat",
                attrs: { type: "submit" }
              },
              [_c("i", { staticClass: "fa fa-search" }), _vm._v(" Buscar")]
            )
          ])
        ]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "thead",
      { staticStyle: { background: "#90a4ae", color: "#fff" } },
      [
        _c("tr"),
        _c("tr", [
          _c("th", { staticStyle: { "vertical-align": "middle" } }, [
            _vm._v("#")
          ]),
          _vm._v(" "),
          _c("th", { staticStyle: { "vertical-align": "middle" } }, [
            _vm._v("CODIGO")
          ]),
          _vm._v(" "),
          _c("th", { staticStyle: { "vertical-align": "middle" } }, [
            _vm._v("NOMBRE")
          ]),
          _vm._v(" "),
          _c(
            "th",
            {
              staticStyle: {
                "text-align": "center",
                "vertical-align": "middle"
              },
              attrs: { colspan: "2" }
            },
            [_vm._v("ACCIONES")]
          )
        ])
      ]
    )
>>>>>>> 45fac07ff921f0e244292ee89b85f543933a11a8
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
<<<<<<< HEAD
    require("vue-hot-reload-api")      .rerender("data-v-cb7b9974", module.exports)
=======
    require("vue-hot-reload-api")      .rerender("data-v-a0be3278", module.exports)
>>>>>>> 45fac07ff921f0e244292ee89b85f543933a11a8
  }
}

/***/ }),

<<<<<<< HEAD
/***/ 55:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(194)
/* script */
var __vue_script__ = __webpack_require__(268)
/* template */
var __vue_template__ = __webpack_require__(269)
=======
/***/ 58:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(282)
}
var normalizeComponent = __webpack_require__(193)
/* script */
var __vue_script__ = __webpack_require__(284)
/* template */
var __vue_template__ = __webpack_require__(285)
>>>>>>> 45fac07ff921f0e244292ee89b85f543933a11a8
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
<<<<<<< HEAD
Component.options.__file = "resources/assets/js/components/DashboardMain.vue"
=======
Component.options.__file = "resources/assets/js/components/planoperativo/unidadpoi/UnidadPoiVista.vue"
>>>>>>> 45fac07ff921f0e244292ee89b85f543933a11a8

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
<<<<<<< HEAD
    hotAPI.createRecord("data-v-cb7b9974", Component.options)
  } else {
    hotAPI.reload("data-v-cb7b9974", Component.options)
=======
    hotAPI.createRecord("data-v-a0be3278", Component.options)
  } else {
    hotAPI.reload("data-v-a0be3278", Component.options)
>>>>>>> 45fac07ff921f0e244292ee89b85f543933a11a8
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 65:
/***/ (function(module, exports) {

/*
	MIT License http://www.opensource.org/licenses/mit-license.php
	Author Tobias Koppers @sokra
*/
// css base code, injected by the css-loader
module.exports = function(useSourceMap) {
	var list = [];

	// return the list of modules as css string
	list.toString = function toString() {
		return this.map(function (item) {
			var content = cssWithMappingToString(item, useSourceMap);
			if(item[2]) {
				return "@media " + item[2] + "{" + content + "}";
			} else {
				return content;
			}
		}).join("");
	};

	// import a list of modules into the list
	list.i = function(modules, mediaQuery) {
		if(typeof modules === "string")
			modules = [[null, modules, ""]];
		var alreadyImportedModules = {};
		for(var i = 0; i < this.length; i++) {
			var id = this[i][0];
			if(typeof id === "number")
				alreadyImportedModules[id] = true;
		}
		for(i = 0; i < modules.length; i++) {
			var item = modules[i];
			// skip already imported module
			// this implementation is not 100% perfect for weird media query combinations
			//  when a module is imported multiple times with different media queries.
			//  I hope this will never occur (Hey this way we have smaller bundles)
			if(typeof item[0] !== "number" || !alreadyImportedModules[item[0]]) {
				if(mediaQuery && !item[2]) {
					item[2] = mediaQuery;
				} else if(mediaQuery) {
					item[2] = "(" + item[2] + ") and (" + mediaQuery + ")";
				}
				list.push(item);
			}
		}
	};
	return list;
};

function cssWithMappingToString(item, useSourceMap) {
	var content = item[1] || '';
	var cssMapping = item[3];
	if (!cssMapping) {
		return content;
	}

	if (useSourceMap && typeof btoa === 'function') {
		var sourceMapping = toComment(cssMapping);
		var sourceURLs = cssMapping.sources.map(function (source) {
			return '/*# sourceURL=' + cssMapping.sourceRoot + source + ' */'
		});

		return [content].concat(sourceURLs).concat([sourceMapping]).join('\n');
	}

	return [content].join('\n');
}

// Adapted from convert-source-map (MIT)
function toComment(sourceMap) {
	// eslint-disable-next-line no-undef
	var base64 = btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap))));
	var data = 'sourceMappingURL=data:application/json;charset=utf-8;base64,' + base64;

	return '/*# ' + data + ' */';
}


/***/ })

});