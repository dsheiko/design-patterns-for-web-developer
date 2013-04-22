var __extends = this.__extends || function (d, b) {
    function __() { this.constructor = d; }
    __.prototype = b.prototype;
    d.prototype = new __();
}
"use strict";
var Graphic = (function () {
    function Graphic() {
        this.collection = [];
    }
    Graphic.prototype.render = function () {
        this.collection.forEach(function (el) {
            el.render();
        });
    };
    Graphic.prototype.add = function (graphic) {
        this.collection.push(graphic);
    };
    return Graphic;
})();
var Rectangle = (function (_super) {
    __extends(Rectangle, _super);
    function Rectangle(ctx, x, y, width, height) {
    }
    Rectangle.prototype.render = function () {
        console.log('Rectangle in context ' + ctx.name + ' at ' + x + ', ' + y + ' of ' + width + 'px width and ' + height + 'px height');
    };
    return Rectangle;
})(Graphic);
var Line = (function (_super) {
    __extends(Line, _super);
    function Line(ctx, x1, y1, x2, y2) {
    }
    Line.prototype.render = function () {
        console.log('Line in context ' + ctx.name + ' from ' + x1 + ', ' + y1 + ' to ' + x2 + ', ' + y2);
    };
    return Line;
})(Graphic);
var Picture = (function (_super) {
    __extends(Picture, _super);
    function Picture() {
        _super.apply(this, arguments);

    }
    return Picture;
})(Graphic);
var client;
(function (client) {
    function getContext() {
        return {
            name: "2D"
        };
    }
    function run() {
        var ctx = this.getContext();
        var rect1 = new Rectangle(ctx, 70, 70, 150, 150);
        var line1 = new Line(ctx, 0, 0, 50, 50);
        var line2 = new Line(ctx, 50, 0, 0, 50);
        var pic1 = new Picture();

        pic1.add(rect1);
        pic1.add(line1);
        pic1.add(line2);
        pic1.render();
    }
    client.run = run;
})(client || (client = {}));

client.run();
