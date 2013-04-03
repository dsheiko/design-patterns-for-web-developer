/*
 * @category Design Pattern Tutorial
 * @package Bridge Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 * @jscs standard:Jquery
 * Code style: http://docs.jquery.com/JQuery_Core_Style_Guidelines
 */
(function ( global ) {

    "use strict";
    /*global console:false */
    // Implementer on the Bridge
var AbstractImplementor = function() {
        return {
            renderBorder: function() {
                console.log("Border");
            }
        };
    },
    // Concrete implementer
    themeA = Object.create( new AbstractImplementor(), {
        renderPaginator: { value: function() {
            console.log("Thumbnails");
        }}
    }),
    // Concrete implementer
    themeB = Object.create( new AbstractImplementor(), {
        renderPaginator: { value: function() {
            console.log("Bullets");
        }}
    }),
    // Abstraction on the Bridge
    // Abstraction forwards client requests to its Implementor object.
    AbstractSlideShow = function( imp ) {
        return {
            renderBorder: function() {
                return imp.renderBorder();
            },
            renderNavigation: function() {
                return imp.renderPaginator();
            }
        };
    },
    // Refined Abstraction
    onDesktopSlideShow = function( imp ) {
        return Object.create( new AbstractSlideShow( imp ), {
            bindNavigation: { value: function() {
                console.log("Navigation bound");
            }},
            render: { value: function() {
                this.renderBorder();
                this.renderNavigation();
                this.bindNavigation();
            }}
        });
    },
    // Refined Abstraction
    onMobileSlideShow = function( imp ) {
        return Object.create( new AbstractSlideShow( imp ), {
            bindTouchGestures: { value: function() {
                console.log("Touch gestures bound");
            }},
            render: { value: function() {
                this.renderBorder();
                this.bindTouchGestures();
            }}
        });
    };

/**
 * Usage
 */

onDesktopSlideShow( themeA ).render();
onDesktopSlideShow( themeB ).render();
onMobileSlideShow( themeA ).render();
/**
 * Output
 */

// Border
// Thumbnails
// Navigation bound
//
// Border
// Bullets
// Navigation bound
//
// Border
// Touch gestures bound

}( this ));