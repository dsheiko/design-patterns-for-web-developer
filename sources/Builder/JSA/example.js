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
    /*global console:false, require:false */
    
var jsa = require("../../../vendors/jsa/jsa.umd"),
    // Widget is used to build a product
    AbstractWidgetClass = function() {},
    MockWidgetClass = function() {
        return {
            __extends__: AbstractWidgetClass,
            render: function() {
                return "The module has widget";
            }
        };
    },
    // Concrete product
    module = null,
    // Abstract builder
    AbstractBuilderClass = function() {
        return {
            markup: "",
            getModule: function() {
                return this.markup;
            }
        };
    },
    DirectorInterface = {
        construct: [ AbstractBuilderClass ]
    },
    // Director
    moduleManagerClass = function( options ) {
        return {
            __implements__: DirectorInterface,
            construct: function( builder ) {
                builder.buildWindow( options.title );
                options.widget && builder.attachWidget( options.widget );
                options.isClosable && builder.attachCloseButton();
                options.isResizable && builder.attachResizeControl();
                return builder.getModule();
            }
        };
    },
    BuilderInterface = {
        buildWindow: [ "string" ],
        attachCloseButton: [],
        attachWidget: [ AbstractWidgetClass ],
        attachResizeControl: []
    },
    // Concrete builder
    ThemeAClass = function() {
        return {
            __extends__: AbstractBuilderClass,
            __implements__: BuilderInterface,
            buildWindow: function( title ) {
                this.markup += "Module " + title + " represented with ThemeA theme\n";
            },
            attachCloseButton: function() {
                this.markup += "The module has close button\n";
            },
            attachWidget: function( widget ) {
                this.markup += widget.render();
            },
            attachResizeControl: function() {
                this.markup += "The module has resize control\n";
            }
        };
    };

/**
 * Usage
 */
    module = moduleManagerClass.createInstance({
        title: "Example",
        widget: MockWidgetClass.createInstance(),
        isClosable: true,
        isResizable: true
    }).construct( ThemeAClass.createInstance() );
    console.log( module );

// Output
// Module Example represented with ThemeA theme
// The module has widget
// The module has close button
// The module has resize control

}());