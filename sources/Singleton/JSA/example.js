/* 
 * @category Design Pattern Tutorial
 * @package Singleton Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 * @jscs standard:Jquery
 * Code style: http://docs.jquery.com/JQuery_Core_Style_Guidelines
 */
(function( window ) {

"use strict";
 /*global console:false, require:false, escape:false, unescape:false */

var console = window.console,
    jsa = require("../../../vendors/jsa/jsa.core-interface.min"),
    registry =(function(){
    var Registry = function() {
        var data = {};
        return {
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

}( window ));