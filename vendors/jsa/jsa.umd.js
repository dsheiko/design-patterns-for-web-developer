/* @author  Dmitry Sheiko (dsheiko.com)  */
(function (root, factory) {
'use strict';

// Universal Module Definition (UMD) to support AMD, CommonJS/Node.js,
// Rhino, and plain browser loading.
if ( typeof define === 'function' && define.amd ) {
define( ['exports'], factory );
} else if (typeof exports !== 'undefined') {
factory( exports );
} else {
factory(( root.esprima = {} ));
}
}( this, function ( exports, undefined ) {
(function(a,b){a.jsa=a.jsa||{};a.jsa.isArray=function(c){return(Object.prototype.toString.call(c)==="[object Array]")};a.jsa.Hook=a.jsa.Hook||[];a.jsa.Hook=(function(d){var c=d;return{push:function(e){c.push(e)},invokeAll:function(f,g){var e=c.length,h=0;for(;h<e;h++){c[h](f,g)}}}}(a.jsa.Hook));a.jsa.createInstance=function(g,e){var f,c,d=g.apply(g,e)||{},h=function(){};if(d.hasOwnProperty("__extends__")&&d.__extends__){g.prototype=a.jsa.createInstance(d.__extends__,e)}h.prototype=g.prototype;for(f in d){if(d.hasOwnProperty(f)){h.prototype[f]=d[f]}}c=new h();d.hasOwnProperty("__constructor__")&&d.__constructor__.apply(c,e);return c};Function.prototype.createInstance=function(){var c=a.jsa.createInstance(this,arguments);a.jsa.Hook.invokeAll(c,arguments);return c}})(this);(function(a,b){a.jsa=a.jsa||{};a.jsa.querySelectorFn=a.jsa.querySelectorFn||a.jQuery;a.jsa.Hook.push(function(c,d){var f=d[0];if(c instanceof a.jsa.WidgetAbstract===false){return}if(f===b||f.boundingBox===b){throw new TypeError("Widget derivative is expected to get an argument, which contains settings object with boundingBox property")}c.settings=f;c.node={};c.node.boundingBox=a.jsa.querySelectorFn(f.boundingBox);if(c.HTML_PARSER){for(var e in c.HTML_PARSER){if(c.HTML_PARSER.hasOwnProperty(e)){c.node[e]=a.jsa.querySelectorFn(c.HTML_PARSER[e],c.node.boundingBox)}}}});a.jsa.Hook.push(function(d){if(d instanceof a.jsa.BaseAbstract===false){return}var f=["init","renderUI","syncUI"],e=0,c=f.length;for(;e<c;e++){d[f[e]]&&d[f[e]]()}});a.jsa.BaseAbstract=function(){return{}};a.jsa.WidgetAbstract=function(c){return{__extends__:a.jsa.BaseAbstract}}}(this));(function(a,b){a.jsa=a.jsa||{};a.jsa.Hook=a.jsa.Hook||[];a.jsa.Hook.push(function(d,e){if(d.__mixin__&&a.jsa.isArray(d.__mixin__)){for(var g=0,c=d.__mixin__.length;g<c;g++){var f=d.__mixin__[g];for(var h in f){if(f.hasOwnProperty(h)){d[h]=f[h]}}}}})}(this));(function(a,b){a.jsa=a.jsa||{};a.jsa.Hook=a.jsa.Hook||[];a.jsa.Hook.push(function(c,d){var e=function(h,i){if(typeof(i)==="string"){if(i in {string:null,number:null,"boolean":null,"function":null}){return typeof h===i}else{if(i==="array"){return a.jsa.isArray(h)}else{throw new SyntaxError("Invalid type hint '"+i+"'. Type hint can be a string ('string', 'number', 'boolean', 'array') or an object.")}}}else{return h instanceof i}return true},g=function(k,i,h){var j=h[k];h[k]=function(){for(var m=0,l=arguments.length;m<l;m++){if(arguments[m]&&i[m]&&!e(arguments[m],i[m])){throw new TypeError("Argument #"+(parseInt(m)+1)+" of method '"+k+"' "+(typeof i[m]==="string"?"is required to be a '"+i[m]+"'":" violates the implemented interface"))}}return j.apply(h,arguments)}};if(c.hasOwnProperty("__implements__")&&c.__implements__){for(var f in c.__implements__){if(c.__implements__.hasOwnProperty(f)){if(c[f]!==b){g(f,c.__implements__[f],c)}else{throw new SyntaxError("Implemented interface requires '"+f+"' method")}}}}})}(this));
exports.jsa = jsa;
}));
