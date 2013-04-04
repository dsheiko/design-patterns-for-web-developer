var __extends = this.__extends || function (d, b) {
    function __() { this.constructor = d; }
    __.prototype = b.prototype;
    d.prototype = new __();
}
"use strict";
var MockWidget = (function () {
    function MockWidget() { }
    MockWidget.prototype.render = function () {
        return "The module has widget";
    };
    return MockWidget;
})();
var AbstractBuilder = (function () {
    function AbstractBuilder() {
        this.markup = "";
    }
    AbstractBuilder.prototype.getModule = function () {
        return this.markup;
    };
    return AbstractBuilder;
})();
var moduleManager = (function () {
    function moduleManager(options) {
        this.options = options;
    }
    moduleManager.prototype.construct = function (builder) {
        builder.buildWindow(this.options.title);
        this.options.widget && builder.attachWidget(this.options.widget);
        this.options.isClosable && builder.attachCloseButton();
        this.options.isResizable && builder.attachResizeControl();
        return builder.getModule();
    };
    return moduleManager;
})();
var ThemeA = (function (_super) {
    __extends(ThemeA, _super);
    function ThemeA() {
        _super.apply(this, arguments);

    }
    ThemeA.prototype.buildWindow = function (title) {
        this.markup += "Module " + title + " represented with ThemeA theme\n";
    };
    ThemeA.prototype.attachCloseButton = function () {
        this.markup += "The module has close button\n";
    };
    ThemeA.prototype.attachWidget = function (widget) {
        this.markup += widget.render();
    };
    ThemeA.prototype.attachResizeControl = function () {
        this.markup += "The module has resize control\n";
    };
    return ThemeA;
})(AbstractBuilder);
var pageModule = new moduleManager({
    title: "Example",
    widget: new MockWidget(),
    isClosable: true,
    isResizable: true
});
pageModule.construct(new ThemeA());
console.log(pageModule);
