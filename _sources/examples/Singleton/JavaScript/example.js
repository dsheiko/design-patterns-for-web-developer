/*
 * @category Design Pattern Tutorial
 * @package Singleton Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 * @jscs standard:Jquery
 * Code style: http://docs.jquery.com/JQuery_Core_Style_Guidelines
 */
(function() {

"use strict";
/*global console:false */

var o1,
    o2,
    Singleton = function() {
        if ( Singleton._selfInstance ) {
            return Singleton._selfInstance;
        }
        Singleton._selfInstance = this;
        this.foo = "value";
  };
/*
 * Usage
 */
o1 = new Singleton();
o2 = Singleton();
console.log( o1 === o2 );
/**
 * Output
 */
// true
}());