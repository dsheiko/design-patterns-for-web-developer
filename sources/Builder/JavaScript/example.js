/*
 * @category Design Pattern Tutorial
 * @package Builder Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 * @jscs standard:Jquery
 * Code style: http://docs.jquery.com/JQuery_Core_Style_Guidelines
 */
(function() {
    "use strict";
    /*global console:false */

    // Widget is used to build a product
var AbstractWidget = function() {
    },
    mockWidget = Object.create( new AbstractWidget(), {
        render: {
            value: function() {
                return "The module has widget";
            }
        }
    }),
    // Concrete product
    module = null,
    // Director
    moduleManager = (function() {
        var _options = {
            title: "",
            widget: null,
            isClosable: false,
            isResizable: false
        };
        return {
            init: function( options ) {
                _options = options;
            },
            construct: function( builder ) {
                if ( builder instanceof AbstractBuilder === false ) {
                    throw new TypeError( "Argument must be an instance of AbstractBuilder" );
                }
                builder.buildWindow( _options.title );
                _options.widget && builder.attachWidget( _options.widget );
                _options.isClosable && builder.attachCloseButton();
                _options.isResizable && builder.attachResizeControl();
                return builder.getModule();
            }
        };
    }()),
    // Abstract builder
    AbstractBuilder = function() {
    },
    // Concrete builder
    themeA;
    // Members to be inherited by every theme
    AbstractBuilder.prototype = {
        markup: "",
        getModule: function() {
            return this.markup;
        }
    };

    themeA = Object.create( new AbstractBuilder(), {
        buildWindow: {
            value: function( title ) {
                this.markup += "Module " + title + " represented with ThemeA theme\n";
            }
        },
        attachCloseButton: {
            value: function() {
                this.markup += "The module has close button\n";
            }
        },
        attachWidget: {
            value: function( widget ) {
                if ( widget instanceof AbstractWidget === false ) {
                    throw new TypeError( "Argument must be an instance of AbstractWidget" );
                }
                this.markup += widget.render();
            }
        },
        attachResizeControl: {
            value: function() {
                this.markup += "The module has resize control\n";
            }
        }
    });

/**
 * Usage
 */
    moduleManager.init({
        title: "Example",
        widget: mockWidget,
        isClosable: true,
        isResizable: true
    });

    module = moduleManager.construct( themeA );
    console.log( module );

// Output
// Module Example represented with ThemeA theme
// The module has widget
// The module has close button
// The module has resize control

}());
