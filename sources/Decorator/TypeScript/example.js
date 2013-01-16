var __extends = this.__extends || function (d, b) {
    function __() { this.constructor = d; }
    __.prototype = b.prototype;
    d.prototype = new __();
}
"use strict";
var MacbookAir = (function () {
    function MacbookAir() {
        this.ram = 4;
        this.sdd = 128;
        this.price = 1199;
    }
    MacbookAir.prototype.getPrice = function () {
        return this.price;
    };
    MacbookAir.prototype.getSdd = function () {
        return this.sdd;
    };
    MacbookAir.prototype.getRam = function () {
        return this.ram;
    };
    return MacbookAir;
})();
var AbstractMacbookDecorator = (function () {
    function AbstractMacbookDecorator(macbook) {
        this.macbook = macbook;
    }
    AbstractMacbookDecorator.prototype.getPrice = function () {
        return this.macbook.getPrice();
    };
    AbstractMacbookDecorator.prototype.getRam = function () {
        return this.macbook.getRam();
    };
    AbstractMacbookDecorator.prototype.getSdd = function () {
        return this.macbook.getSdd();
    };
    return AbstractMacbookDecorator;
})();
var MacbookRamExtendedDecorator = (function (_super) {
    __extends(MacbookRamExtendedDecorator, _super);
    function MacbookRamExtendedDecorator(macbook) {
        _super.call(this, macbook);
    }
    MacbookRamExtendedDecorator.prototype.getPrice = function () {
        return this.macbook.getPrice() + 100;
    };
    MacbookRamExtendedDecorator.prototype.getRam = function () {
        return this.macbook.getRam() + 4;
    };
    return MacbookRamExtendedDecorator;
})(AbstractMacbookDecorator);
var MacbookSddExtendedDecorator = (function (_super) {
    __extends(MacbookSddExtendedDecorator, _super);
    function MacbookSddExtendedDecorator(macbook) {
        _super.call(this, macbook);
    }
    MacbookSddExtendedDecorator.prototype.getPrice = function () {
        return this.macbook.getPrice() + 200;
    };
    MacbookSddExtendedDecorator.prototype.getSdd = function () {
        return this.macbook.getSdd() + 128;
    };
    return MacbookSddExtendedDecorator;
})(AbstractMacbookDecorator);
var myMacbook = new MacbookSddExtendedDecorator(new MacbookRamExtendedDecorator(new MacbookAir()));
console.log("13-inch MacBook Air\nRAM: " + myMacbook.getRam() + "\nSDD: " + myMacbook.getSdd());
console.log("Price: $" + myMacbook.getPrice());
