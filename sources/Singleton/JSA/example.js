/* 
 * @category Design Pattern Tutorial
 * @package Singleton Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 * @jscs standard:Jquery
 * Code style: http://docs.jquery.com/JQuery_Core_Style_Guidelines
 */
(function( global ) {

"use strict";
 /*global console:false, require:false, escape:false, unescape:false */

var jsa = require("../../../vendors/jsa/jsa.umd"),
    registryInterface = {
        set: [ "string", "any" ],
        get: [ "string" ]
    },
    registry = (function(){
    var Registry = function() {
        var data = {};
        return {
            __implements__: registryInterface,
            set : function( name, value ) {
                data[ name ] = value;
            },
            get : function( name ) {
                return data.hasOwnProperty( name ) && data[ name ];
            }
        };
    };
    return Registry.createInstance();
}());

/*
 * Usage
 */
registry.set( 'aVar', 'aValue' );
console.log( registry.get( 'aVar' ) );

}( this));