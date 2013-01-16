/*
 * @category Design Pattern Tutorial
 * @package Bridge Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */
(function ( window ) {

    "use strict";
    /*global console:false */

var document = window.document,
    // Concrete implementor
    sessionStorageApi = (function() {
        return {
            // Operation implementation
            save: function ( name, value ) {
                console.log( 'Saved in SessionStorage' );
                window.sessionStorage[ name ] = value;
            },
            // Operation implementation
            get: function ( name ) {
                return window.sessionStorage[ name ];
            }
        };
    }()), 
    // Concrete implementor
    cookieApi = (function() {
        return {
            // Operation implementation
            save: function ( name, value ) {
                console.log( 'Saved in Cookies' );
                document.cookie = name + "=" + escape( value );
            },
            // Operation implementation
            get: function ( name ) {
                var key, 
                    val, 
                    cookieArr = document.cookie.split( ";" ),
                    i = 0, 
                    len = cookieArr.length;
                    
                for ( ; i < len; i++) {
                      key = cookieArr[ i ].substr( 0, cookieArr[i].indexOf( "=" ) );
                      val = cookieArr[ i ].substr( cookieArr[i].indexOf( "=" ) + 1 );
                      key = key.replace( /^\s+|\s+$/g , "" );
                      if ( key === name ) {
                        return unescape( val );
                      }
                  }
            }
        }
    }()),
    // Refined abstraction
    NotepadWidget = function( api ) {
        var id = 'noteWidgetText',
            text = 'Lorem ipsum';
        return {
            getText: function() {
                return text;
            },
            restoreState: function() {
                text = api.get( id );
            },
            saveState: function() {
                api.save( id, text );
            }
        }
    }

/**
 * Usage
 */
var apiDelegate = sessionStorageApi,
    notepad = new NotepadWidget( apiDelegate );

notepad.saveState();
notepad.restoreState();
console.log( notepad.getText() );

/**
 * Output
 */
// Saved in SessionStorage
// Lorem ipsum

}( window ));