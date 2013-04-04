var Adapter;
(function (Adapter) {
    var Jquery = (function () {
        function Jquery($) {
            this._qs = $;
        }
        Jquery.prototype.find = function (selector) {
            this._node = this._qs(selector);
            return this;
        };
        Jquery.prototype.setAttr = function (attr, value) {
            this._node.attr(attr, value);
            return this;
        };
        Jquery.prototype.getAttr = function (attr) {
            return this._node.attr(attr);
        };
        return Jquery;
    })();
    Adapter.Jquery = Jquery;    
    var Yui = (function () {
        function Yui(Y) {
            this._qs = Y;
        }
        Yui.prototype.find = function (selector) {
            this._node = this._qs.one(selector);
            return this;
        };
        Yui.prototype.setAttr = function (attr, value) {
            this._node.set(attr, value);
            return this;
        };
        Yui.prototype.getAttr = function (attr) {
            return this._node.get(attr);
        };
        return Yui;
    })();
    Adapter.Yui = Yui;    
})(Adapter || (Adapter = {}));

var node;
(function (node) {
    function factory() {
        var instance = null;
        if(jQuery !== undefined) {
            instance = new Adapter.Jquery(jQuery);
        } else {
            if(YUI !== undefined) {
                instance = new Adapter.Yui(YUI);
            }
        }
        if(instance === null) {
            throw new Error("Neither jQuery nor YUI library available");
        }
        return instance;
    }
    node.factory = factory;
})(node || (node = {}));

node.factory().find('div').set('id', 'something');
