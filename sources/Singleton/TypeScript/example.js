"use strict";
var Registry;
(function (Registry) {
    var data = {
    };
    function set(name, value) {
        data[name] = value;
    }
    Registry.set = set;
    function get(name) {
        return data.hasOwnProperty(name) && data[name];
    }
    Registry.get = get;
})(Registry || (Registry = {}));

Registry.set('aVar', 'aValue');
console.log(Registry.get('aVar'));
