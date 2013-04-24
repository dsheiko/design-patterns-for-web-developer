/*
 * @category Design Pattern Tutorial
 * @package Composite Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

"use strict";

declare var console;
// Composite
class Graphic
{
    private collection:Graphic[] = [];

    public render():void
    {
        this.collection.forEach(function( el ){
            el.render();
        });
    }
    public add(graphic: Graphic):void
    {
        this.collection.push( graphic );
    }
}
// Primitive
class Rectangle extends Graphic
{
    private ctx: CanvasContext;
    private x: number;
    private y: number;
    private width: number;
    private height: number;
    constructor( ctx: CanvasContext, x: number, y: number, width: number, height: number )
    {
        this.ctx = ctx;
        this.x = x;
        this.y = y;
        this.width = width;
        this.height = height;
    }
    public render()
    {
        console.log( 'Rectangle in context ' + this.ctx.name +
            ' at ' + this.x + ', ' + this.y +
            ' of ' + this.width + 'px width and ' +
            this.height + 'px height' );
    }
}
// Primitive
class Line extends Graphic
{
    private ctx: CanvasContext;
    private x1: number;
    private y1: number;
    private x2: number;
    private y2: number;
    constructor( ctx: CanvasContext, x1:number, y1:number, x2:number, y2:number )
    {
        this.ctx = ctx;
        this.x = x;
        this.y = y;
        this.width = width;
        this.height = height;
    }
    public render()
    {
         console.log( 'Line in context ' + ctx.name +
            ' from ' + x1 + ', ' + y1 +
            ' to ' + x2 + ', ' + y2 );
    }
}
// Composite
class Picture extends Graphic
{
}

interface CanvasContext
{
    name: string;
}

module client
{
    // Mock function which emulates canvas context
    function getContext(): CanvasContext
    {
        return { name: "2D" };
    }
    export function run() {
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
}

client.run();


// Output:
// Rectangle in context 2D at 70, 70 of 150px width and 150px height
// Line in context 2D from 0, 0 to 50, 50
// Line in context 2D from 50, 0 to 0, 50