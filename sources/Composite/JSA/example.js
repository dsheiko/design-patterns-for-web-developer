/*
 * @category Design Pattern Tutorial
 * @package Composite Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @link http://dsheiko.com
 * @jscs standard:Jquery
 * Code style: http://docs.jquery.com/JQuery_Core_Style_Guidelines
 */
(function() {
"use strict";
/*global console:false, require:false */

// Composite
var jsa = require("../../../vendors/jsa/jsa.umd"),
    Graphic = function() {
        return {
            collection: [],
            render: function() {
                this.collection.forEach(function( el ){
                    el.render();
                });
            },
            add: function ( graphic ) {
                if ( !graphic instanceof Graphic ) {
                    throw new Error("Method argument must be an instance of Graphic");
                }
                this.collection.push( graphic );
            }
        };

    },
    // Primitive
    Rectangle = function( ctx, x, y, width, height ) {
        return {
            __extends__: Graphic,
            render: function() {
                console.log( 'Rectangle in context ' + ctx.name + 
                    ' at ' + x + ', ' + y + 
                    ' of ' + width + 'px width and ' + 
                    height + 'px height' );    
            }
            
        };

    },
    // Primitive
    Line = function( ctx, x1, y1, x2, y2 ) {
        return {
            __extends__: Graphic,
            render: function() {
                console.log( 'Line in context ' + ctx.name + 
                    ' from ' + x1 + ', ' + y1 + 
                    ' to ' + x2 + ', ' + y2 );
            }
        };
    },
    // Container
    Picture = function() {
        return {
            __extends__: Graphic
        };
    },

    client = {
        // Mock function which emulates canvas context
        getContext: function() {
            return { name: "2D" };
        },
        run: function() {
            var ctx = this.getContext(),
                rect1 = Rectangle.createInstance( ctx, 70, 70, 150, 150 ),
                line1 = Line.createInstance( ctx, 0, 0, 50, 50 ),
                line2 = Line.createInstance( ctx, 50, 0, 0, 50 ),
                pic1 = Picture.createInstance();

            pic1.add( rect1 );
            pic1.add( line1 );
            pic1.add( line2 );
            pic1.render();
        }
    };

client.run();


// Output:
// Rectangle in context 2D at 70, 70 of 150px width and 150px height
// Line in context 2D from 0, 0 to 50, 50
// Line in context 2D from 50, 0 to 0, 50

}());