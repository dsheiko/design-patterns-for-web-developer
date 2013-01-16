/* 
 * @category Design Pattern Tutorial
 * @package Singleton Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */
(function( window ) {

"use strict";

var console = window.console,
    registry = (function(){
    var data = {};
    return {
        set : function( name, value ) {
            data[ name ] = value;
        },
        get : function( name ) {
            return data.hasOwnProperty( name ) && data[ name ];
        }
    };
})();

/*
 * Usage
 */
registry.set( 'aVar', 'aValue' );
console.log( registry.get( 'aVar' ) );

}( window ));