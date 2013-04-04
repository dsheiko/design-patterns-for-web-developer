"use strict";
var Singleton = (function () {
    function Singleton() {
        this.foo = "value";
    }
    Singleton.instance = null;
    Singleton.getInstance = function getInstance() {
        return Singleton.instance || (Singleton.instance = new Singleton());
    }
    return Singleton;
})();
console.log(Singleton.getInstance() === Singleton.getInstance());
