/*
 * @category Design Pattern Tutorial
 * @package Composite Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @link http://dsheiko.com
 */
(function() {
"use strict";
/*global console:false */

// Composite
var Graphic = function() {
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
        this.ctx = ctx;
        this.x = x;
        this.y = y;
        this.width = width;
        this.height = height;

    },
    // Primitive
    Line = function( ctx, x1, y1, x2, y2 ) {
        this.ctx = ctx;
        this.x1 = x1;
        this.y1 = y1;
        this.x2 = x2;
        this.y2 = y2;
    },
    // Container
    Picture = function() {
    },
    client; 

Rectangle.prototype = new Graphic();
Rectangle.prototype.render = function() {
    console.log( 'Rectangle in context ' + this.ctx.name + 
        ' at ' + this.x + ', ' + this.y + 
        ' of ' + this.width + 'px width and ' + 
        this.height + 'px height' );    
};

Line.prototype = new Graphic();
Line.prototype.render = function() {
    console.log( 'Line in context ' + this.ctx.name + 
        ' from ' + this.x1 + ', ' + this.y1 + 
        ' to ' + this.x2 + ', ' + this.y2 );
};
Picture.prototype = new Graphic();

/**
 * Usage
 */

client = {
    // Mock function which emulates canvas context
    getContext: function() {
        return { name: "2D" };
    },
    run: function() {
        var ctx = this.getContext(),
            rect1 = new Rectangle( ctx, 70, 70, 150, 150 ),
            line1 = new Line( ctx, 0, 0, 50, 50 ),
            line2 = new Line( ctx, 50, 0, 0, 50 ),
            pic1 = new Picture();
        
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