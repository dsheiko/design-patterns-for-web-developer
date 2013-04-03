"use strict";
var StorageApi;
(function (StorageApi) {
    var sessionStorage = (function () {
        function sessionStorage() { }
        sessionStorage.prototype.save = function (name, value) {
            console.log('Saved in SessionStorage');
            window.sessionStorage[name] = value;
        };
        sessionStorage.prototype.get = function (name) {
            return window.sessionStorage[name];
        };
        return sessionStorage;
    })();
    StorageApi.sessionStorage = sessionStorage;    
    var cookies = (function () {
        function cookies() { }
        cookies.prototype.save = function (name, value) {
            console.log('Saved in Cookies');
            document.cookie = name + "=" + escape(value);
        };
        cookies.prototype.get = function (name) {
            var key;
            var val;
            var cookieArr = document.cookie.split(";");
            var i = 0;
            var len = cookieArr.length;

            for(; i < len; i++) {
                key = cookieArr[i].substr(0, cookieArr[i].indexOf("="));
                val = cookieArr[i].substr(cookieArr[i].indexOf("=") + 1);
                key = key.replace(/^\s+|\s+$/g, "");
                if(key === name) {
                    return unescape(val);
                }
            }
            return '';
        };
        return cookies;
    })();
    StorageApi.cookies = cookies;    
})(StorageApi || (StorageApi = {}));

var NotepadWidget = (function () {
    function NotepadWidget(api) {
        this.id = 'noteWidgetText';
        this.text = 'Lorem ipsum';
        this.api = api;
    }
    NotepadWidget.prototype.getText = function () {
        return this.text;
    };
    NotepadWidget.prototype.restoreState = function () {
        this.text = this.api.get(this.id);
    };
    NotepadWidget.prototype.saveState = function () {
        this.api.save(this.id, this.text);
    };
    return NotepadWidget;
})();
var spiDelegate = new StorageApi.sessionStorage();
var notepad = new NotepadWidget(spiDelegate);

notepad.saveState();
notepad.restoreState();
console.log(notepad.getText());
