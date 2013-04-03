"use strict";
var Widget;
(function (Widget) {
    var Carousel = (function () {
        function Carousel() { }
        Carousel.prototype.render = function () {
            console.log('Carousel widget rendered');
        };
        return Carousel;
    })();
    Widget.Carousel = Carousel;    
    var MockCarousel = (function () {
        function MockCarousel() { }
        MockCarousel.prototype.render = function () {
            console.log('Mock carousel widget rendered');
        };
        return MockCarousel;
    })();
    Widget.MockCarousel = MockCarousel;    
})(Widget || (Widget = {}));

var WidgetFactory;
(function (WidgetFactory) {
    var Mock = (function () {
        function Mock() { }
        Mock.prototype.makeCarousel = function () {
            return new Widget.MockCarousel();
        };
        return Mock;
    })();
    WidgetFactory.Mock = Mock;    
    var Regular = (function () {
        function Regular() { }
        Regular.prototype.makeCarousel = function () {
            return new Widget.Carousel();
        };
        return Regular;
    })();
    WidgetFactory.Regular = Regular;    
})(WidgetFactory || (WidgetFactory = {}));

var Page = (function () {
    function Page(options) {
        this.options = options;
    }
    Page.prototype.render = function () {
        var widget;
        var factory;

        if(this.options.testing) {
            factory = new WidgetFactory.Mock();
        } else {
            factory = new WidgetFactory.Regular();
        }
        widget = factory.makeCarousel();
        widget.render();
    };
    return Page;
})();
var testPage = new Page({
    "testing": true
});
var page = new Page({
    "testing": true
});

testPage.render();
page.render();
