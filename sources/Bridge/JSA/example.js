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
    /*global console:false, require:false */

var jsa = require("../../../vendors/jsa/jsa.umd"),
        // Implementer on the Bridge
    AbstractImplementor = function() {
        return {
            renderBorder: function() {
                console.log("Border");
            }
        };
    },
    // Concrete implementer
    ThemeA = function() {
        return {
            "__extends__": AbstractImplementor,
            renderPaginator: function(){
                console.log("Thumbnails");
            }
        };
    },
    // Concrete implementer
    ThemeB = function() {
        return {
            "__extends__": AbstractImplementor,
            renderPaginator: function(){
                console.log("Bullets");
            }
        };
    },
    // Abstraction on the Bridge
    // Abstraction forwards client requests to its Implementor object.
    AbstractSlideShow = function() {
        return {
            "__constructor__": function( imp ) {
                this.imp = imp;
            },
            imp: null,
            renderBorder: function() {
                return this.imp.renderBorder();
            },
            renderNavigation: function() {
                return this.imp.renderPaginator();
            }
        };
    },
    // RefmedAbstraction
    OnDesktopSlideShow = function( imp ) {
        return {
            "__extends__": AbstractSlideShow,
            bindNavigation: function() {
                console.log("Navigation bound");
            },
            render: function() {

                this.renderBorder();
                this.renderNavigation();
                this.bindNavigation();
            }
        };
    },
    // RefmedAbstraction
    OnMobileSlideShow = function( imp ) {
        return {
            "__extends__": AbstractSlideShow,
            bindTouchGestures: function() {
                console.log("Touch gestures bound");
            },
            render: function() {
                this.renderBorder();
                this.bindTouchGestures();
            }
        };
    };

/**
 * Usage
 */
var deskThemAImp = OnDesktopSlideShow.createInstance( ThemeA.createInstance() ),
    deskThemBImp = OnDesktopSlideShow.createInstance( ThemeB.createInstance() ),
    mobileThemAImp = OnMobileSlideShow.createInstance( ThemeA.createInstance() );

deskThemAImp.render();
deskThemBImp.render();
mobileThemAImp.render();

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