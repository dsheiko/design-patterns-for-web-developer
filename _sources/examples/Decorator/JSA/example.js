/*
 * @category Design Pattern Tutorial
 * @package Bridge Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 * @jscs standard:Jquery
 * Code style: http://docs.jquery.com/JQuery_Core_Style_Guidelines
 */
(function () {

    "use strict";
    /*global console:false, require:false */
    
var jsa = require("../../../vendors/jsa/jsa.umd"),
    MacbookAbstract = function() {
        return {
            getPrice: function() {
                return "$" + this.price;
            },
            getSpec: function() {
                return "13-inch MacBook Air\nRAM: " + this.ram + "\nSDD: " + this.sdd;
            }
        };
    },
    // Object to be decorated
    MacbookAir = function() {
        return {
            __extends__: MacbookAbstract,
            ram: 4,
            sdd: 128,
            price: 1199
        };
    },
    // Decorator MacbookRamExtended, that represents 
    // Macbook configuration with extended RAM    
    ExtendedRam = function( macbookAir ) {
        macbookAir.price += 100;
        macbookAir.ram += 4;
        return macbookAir;
    }, 
    // Decorator MacbookSddExtended, that represents 
    // Macbook configuration with extended SDD
    ExtendedSdd = function( macbookAir ) {
        macbookAir.price += 200;
        macbookAir.sdd += 128;
        return macbookAir;
    };
        
 
/**
 * Usage
 */ 
 // Let's get maximum extended configuration
 var myMacbook = new ExtendedSdd(
    new ExtendedRam(MacbookAir.createInstance())
 );
 console.log( myMacbook.getSpec() );
 console.log( "Price: " + myMacbook.getPrice() );
 console.log( "Is myMacbook instance of MacbookAir: ", myMacbook instanceof MacbookAir );
/**
 * Output
 */
// 13-inch MacBook Air
// RAM: 8
// SDD: 256
// Price: $1499
// Is myMacbook instance of MacbookAir:  true

}());