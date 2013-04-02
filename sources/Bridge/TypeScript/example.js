var __extends = this.__extends || function (d, b) {
    function __() { this.constructor = d; }
    __.prototype = b.prototype;
    d.prototype = new __();
}
"use strict";
var AbstractImplementor = (function () {
    function AbstractImplementor() { }
    AbstractImplementor.prototype.renderBorder = function () {
        console.log("Border");
    };
    AbstractImplementor.prototype.renderPaginator = function () {
    };
    return AbstractImplementor;
})();
var ThemeA = (function (_super) {
    __extends(ThemeA, _super);
    function ThemeA() {
        _super.apply(this, arguments);

    }
    ThemeA.prototype.renderPaginator = function () {
        console.log("Thumbnails");
    };
    return ThemeA;
})(AbstractImplementor);
var ThemeB = (function (_super) {
    __extends(ThemeB, _super);
    function ThemeB() {
        _super.apply(this, arguments);

    }
    ThemeB.prototype.renderPaginator = function () {
        console.log("Bullets");
    };
    return ThemeB;
})(AbstractImplementor);
var AbstractSlideShow = (function () {
    function AbstractSlideShow(imp) {
        this.imp = null;
        this.imp = imp;
    }
    AbstractSlideShow.prototype.renderBorder = function () {
        this.imp.renderBorder();
    };
    AbstractSlideShow.prototype.renderNavigation = function () {
        this.imp.renderPaginator();
    };
    return AbstractSlideShow;
})();
var OnDesktopSlideShow = (function (_super) {
    __extends(OnDesktopSlideShow, _super);
    function OnDesktopSlideShow(imp) {
        _super.call(this, imp);
    }
    OnDesktopSlideShow.prototype.bindNavigation = function () {
        console.log("Navigation bound");
    };
    OnDesktopSlideShow.prototype.render = function () {
        this.renderBorder();
        this.renderNavigation();
        this.bindNavigation();
    };
    return OnDesktopSlideShow;
})(AbstractSlideShow);
var OnMobileSlideShow = (function (_super) {
    __extends(OnMobileSlideShow, _super);
    function OnMobileSlideShow(imp) {
        _super.call(this, imp);
    }
    OnMobileSlideShow.prototype.bindTouchGestures = function () {
        console.log("Touch gestures bound");
    };
    OnMobileSlideShow.prototype.render = function () {
        this.renderBorder();
        this.bindTouchGestures();
    };
    return OnMobileSlideShow;
})(AbstractSlideShow);
var deskThemAImp = new OnDesktopSlideShow(new ThemeA());
var deskThemBImp = new OnDesktopSlideShow(new ThemeB());
var mobileThemAImp = new OnMobileSlideShow(new ThemeA());

deskThemAImp.render();
deskThemBImp.render();
mobileThemAImp.render();
