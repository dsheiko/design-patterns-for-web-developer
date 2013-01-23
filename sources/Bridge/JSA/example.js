/*
 * @category Design Pattern Tutorial
 * @package Bridge Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 * @jscs standard:Jquery
 * Code style: http://docs.jquery.com/JQuery_Core_Style_Guidelines
 */
(function ( window ) {

    "use strict";
    /*global console:false, require:false, escape:false, unescape:false */
    
var jsa = require("../../../vendors/jsa/jsa.core-interface.min"),
    document = window.document,
    console = window.console,

    StorageApiInterface = {
        save: [ "string", "string" ],
        get: [ "string" ]
    },
    
   
    StorageApi = {
         // Abstract implementor
        Abstract: function() {
            return {
                __implements__: StorageApiInterface
            };
        },
        // Concrete implementor
        SessionStorage: function() {
            return {
                __extends__: StorageApi.Abstract,
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
        }, 
        // Concrete implementor
        Cookie: function() {
            return {
                __extends__: StorageApi.Abstract,
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
            };
        }
    },
    
    NotepadInterface = {
        setDelegate: [ StorageApi.Abstract ],
        getText:  [],
        restoreState: [],
        saveState: []
    },
    // Refined abstraction
    NotepadWidget = function() {
        var api,
            id = 'noteWidgetText',
            text = 'Lorem ipsum';
        return {
            setDelegate: function( apiArg ) {
                api = apiArg;
            },
            getText: function() {
                return text;
            },
            restoreState: function() {
                text = api.get( id );
            },
            saveState: function() {
                api.save( id, text );
            }
        };
    };

/**
 * Usage
 */
var apiDelegate = StorageApi.SessionStorage.createInstance(),
    notepad = NotepadWidget.createInstance();

notepad.setDelegate( apiDelegate );
notepad.saveState();
notepad.restoreState();
console.log( notepad.getText() );

/**
 * Output
 */
// Saved in SessionStorage
// Lorem ipsum

}( window ));