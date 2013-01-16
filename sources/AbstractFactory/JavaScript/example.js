/*
 * @category Design Pattern Tutorial
 * @package AbstractFactory Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

(function() {
    "use strict";
    /*global console:false */
    
     // Abstract product
var AbstractWidget = function() {

    },
    
    // Concrete product
    carousel = Object.create( new AbstractWidget(), {
        render: {
            value: function() {
                console.log('Carousel widget rendered');
            }
        }
    }),
    // Concrete product
    mockCarousel = Object.create( new AbstractWidget(), {
        render: {
            value: function() {
                console.log('Mock carousel widget rendered');
            }
        }
    }),
    
    // Abstract factory
    AbstractWidgetFactory = function() {
    },
    // Concrete factory
    mockWidgetFactory = Object.create( new AbstractWidgetFactory(), {
        makeCarousel: {
            value: function() {
                return mockCarousel;
            }
        }
    }),
    // Concrete factory
    widgetFactory = Object.create( new AbstractWidgetFactory(), {
        makeCarousel: {
            value: function() {
                return carousel;
            }
        }
    }),
   
    // Client
    page = (function() {
        return {
            render: function( options ) {
                var widget,
                    factory = ( options.testing ? mockWidgetFactory : widgetFactory );

                if ( factory instanceof AbstractWidgetFactory === false ) {
                    throw new TypeError( "Argument must be an instance of AbstractWidgetFactory" );
                }
                widget = factory.makeCarousel();
                if ( widget instanceof AbstractWidget === false ) {
                    throw new TypeError( "Argument must be an instance of AbstractWidget" );
                }
                widget.render();
            }
        };
    }());

/**
 * Usage
 */
page.render({ "testing": true });
page.render({ "testing": false });

// Output
// Mock carousel widget rendered
// Carousel widget rendered

}());