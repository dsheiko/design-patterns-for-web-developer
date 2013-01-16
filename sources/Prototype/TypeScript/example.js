"use strict";
var Toolbar;
(function (Toolbar) {
    var Button = (function () {
        function Button(options) {
            this.node = document.createElement("button");
            this.node.className = "btn-" + options.size + " btn-" + options.display;
        }
        Button.prototype.addClass = function (className) {
            this.node.className += " btn-" + className;
            return this;
        };
        Button.prototype.setOnClickHandler = function (callback) {
            this.node.addEventListener('keypress', callback, false);
            return this;
        };
        Button.prototype.render = function () {
            console.log(this.node);
        };
        return Button;
    })();
    Toolbar.Button = Button;    
})(Toolbar || (Toolbar = {}));

var abstractBtn = new Toolbar.Button({
    size: "large",
    display: "inline"
});
var saveBtn = Object.create(abstractBtn).addClass("primary");
var saveChangesBtn = Object.create(saveBtn).setOnClickHandler(function (e) {
    e.preventDefault();
    console.log("Changes saved");
});
var saveDraftBtn = Object.create(saveBtn).setOnClickHandler(function (e) {
    e.preventDefault();
    console.log("Draft saved");
});

saveDraftBtn.render();
saveChangesBtn.render();
