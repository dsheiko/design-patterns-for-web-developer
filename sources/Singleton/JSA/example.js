/*
 * @category Design Pattern Tutorial
 * @package Singleton Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 * @jscs standard:Jquery
 * Code style: http://docs.jquery.com/JQuery_Core_Style_Guidelines
 */
(function( global ) {

"use strict";
 /*global console:false, require:false */

var jsa = require("../../../vendors/jsa/jsa.umd"),
    o1,
    o2,
    Singleton = function() {
        if ( Singleton._selfInstance ) {
            return Singleton._selfInstance;
        }
        return ( Singleton._selfInstance = {
            foo: "initialValue"
        });
  };


/*
 * Usage
 */
Singleton.createInstance();
o1 = new Singleton();
o2 = Singleton();
o2.foo = "changedValue";
console.log( o1.foo === o2.foo );
/**
 * Output
 */
// true

}( this));