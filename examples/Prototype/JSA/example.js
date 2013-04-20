/*
 * @category Design Pattern Tutorial
 * @package Prototype Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 * @jscs standard:Jquery
 * Code style: http://docs.jquery.com/JQuery_Core_Style_Guidelines
 */

(function( window ){

"use strict";
 /*global console:false, require:false, escape:false, unescape:false */

var document = window.document,
    console = window.console,
    jsa = require("../../../vendors/jsa/jsa.umd"),
    Toolbar = {
        Button: function( options ) {
            var node = document.createElement( "button" );
            node.className = "btn-" + options.size + 
                " btn-" + options.display;
            
            return {
               addClass: function( className ) {
                    node.className += " btn-" + className;
                    return this;
                },
            
                setOnClickHandler: function( callback ) {
                    node.addEventListener( 'keypress', callback, false );
                    return this;
                },

                render: function() {
                    console.log( node );
                }
                
            }
            
        }
    };


/**
 * Usage
 */

var abstractBtn = Toolbar.Button.createInstance({ 
    size: "large", 
    display: "inline" 
}),
    
    // Clone abstract abstractBtn for saveBtn
    saveBtn = Object.create( abstractBtn )
        // saveBtn has specific state
        .addClass( "primary" ), 
    // Clone saveBtn for saveChangesBtn    
    saveChangesBtn = Object.create( saveBtn )
        // Specific handler for saveChangesBtn
        .setOnClickHandler(function( e ){ 
            e.preventDefault();
            console.log( "Changes saved" );
    }),
    // Clone saveBtn for saveDraftBtn
    saveDraftBtn = Object.create( saveBtn )
        // Specific handler for saveDraftBtn
        .setOnClickHandler(function( e ){
            e.preventDefault();
            console.log( "Draft saved" );
    });

saveDraftBtn.render();
saveChangesBtn.render();

// Output:
// <button class="btn-large btn-inline btn-primary">
// <button class="btn-large btn-inline btn-primary">

}( window ));
