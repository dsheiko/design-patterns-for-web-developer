/*
 * @category Design Pattern Tutorial
 * @package AbstractFactory Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

(function() {
    "use strict";
    /*global console:false, require:false */
    
var jsa = require("../../../lib/jsa.core.min"),
    // Client
    PageClass = function( options ) {
        return {
            render: function() {
                var widget,
                    factory = ( options.testing ?
                        MockWidgetFactory.createInstance() : 
                        WidgetFactory.createInstance() );

                widget = factory.makeCarousel();
                widget.render();
            }
        };
    },
    // Abstract factory
    AbstractWidgetFactory = function() {
    },
    // Concrete factory
    MockWidgetFactory = function() {
        return {
            __extends__: AbstractWidgetFactory,
            makeCarousel: function() {
                return MockCarousel.createInstance();
            }
        };
    },
    // Concrete factory
    WidgetFactory = function() {
        return {
            __extends__: AbstractWidgetFactory,
            makeCarousel: function() {
                return Carousel.createInstance();
            }
        };
    },
    
    
    
    // Abstract product
    AbstractWidget = function() {
        return {
            render: function() {
                
            }
        };
    },
    Carousel = function() {
        return {
            __extends__: AbstractWidget,
            render: function() {
                console.log('Carousel widget rendered');
            }
        };
    },
    MockCarousel = function() {
        return {
            __extends__: AbstractWidget,
            render: function() {
                console.log('Mock carousel widget rendered');
            }
        };
    };

/**
 * Usage
 */
PageClass.createInstance({ "testing": true }).render();
PageClass.createInstance({ "testing": false }).render();

// Output
// Mock carousel widget rendered
// Carousel widget rendered

}());