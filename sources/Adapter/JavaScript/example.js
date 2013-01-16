/*
 * @category Design Pattern Tutorial
 * @package Adapter Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

/*global window:true, jQuery:false */

(function( window, undefined ) {

"use strict";
var $ = window.jQuery,
    YUI = window.YUI,
    Jquery_Adapter = function( $ ) {
        var _node;
        return {
            find : function( selector ) {
                _node = $( selector );
                return this;
            },
            setAttr : function( attr, value ) {
                _node.attr( attr, value );
            },
            getAttr : function( attr ) {
                return _node.attr( attr );
            }
        };
    },
    
    Yui_Adapter = function( Y ) {
        var _node;
        return {
            find : function( selector ) {
                _node = Y.one( selector );
                return this;
            },
            setAttr : function( attr, value ) {
                _node.set( attr, value );
            },
            getAttr : function( attr ) {
                return _node.get( attr );
            }
        };
    },
    
    Framework = (function() {
        if ( window.jQuery !== undefined ) {
            return new Jquery_Adapter( window.jQuery );
        } else if ( window.YUI !== undefined ) {
            return new Yui_Adapter( window.YUI );
        } else {
            throw new Error( "Neither jQuery nor YUI library available" );
        }
    }());

/**
 * Usage
 */
Framework.find( 'div' ).set( 'id', 'something' );

}( window ));