/*
 * @category Design Pattern Tutorial
 * @package Prototype Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 * @jscs standard:Jquery
 * Code style: http://docs.jquery.com/JQuery_Core_Style_Guidelines
 * 
 * In this application we need a button to submit the form (Save changes) 
 * and a button to preserve the form data (Save draft). The framework comprises 
 * an object representing an abstract button (Toolbar.Button). The object's 
 * constructor receives configuration object as an argument (object specifiers). Thus, any instance
 * of Toolbar.Button makes a configured button. Any button meant for saving has 
 * a particular appearence. In Twitter Bootstrap 2 it is gained by adding class
 * btn-primary. So, we clone default button object and add the class to it. 
 * Save changes button and Save draft button differ only by onClick event 
 * handlers. In everything else they are the same as default save button. So 
 * we can clone saveBtn object and, then, assign the handler to each.    
 */

(function( window ){

"use strict";
/*global console:false */

var document = window.document,
    console = window.console,
    Toolbar = {
        Button: function( options ) {
            this.node = document.createElement("button");
            this.node.className = "btn-" + options.size + 
                " btn-" + options.display;

            this.addClass = function( className ) {
                this.node.className += " btn-" + className;
                return this;
            };
            
            this.setOnClickHandler = function( callback ) {
                this.node.addEventListener( 'keypress', callback, false );
                return this;
            };
            
            this.render = function() {
                console.log( this.node );
            };
            
        }
    };


/**
 * Usage
 */

var abstractBtn = new Toolbar.Button({ size: "large", display: "inline" }),
    // Clone abstract abstractBtn for saveBtn
    saveBtn = Object.create( abstractBtn )
        // saveBtn has specific state
        .addClass("primary"), 
    // Clone saveBtn for saveChangesBtn    
    saveChangesBtn = Object.create( saveBtn )
        // Specific handler for saveChangesBtn
        .setOnClickHandler(function( e ){ 
            e.preventDefault();
            console.log("Changes saved");
    }),
    // Clone saveBtn for saveDraftBtn
    saveDraftBtn = Object.create( saveBtn )
        // Specific handler for saveDraftBtn
        .setOnClickHandler(function( e ){
            e.preventDefault();
            console.log("Draft saved");
    });

saveDraftBtn.render();
saveChangesBtn.render();

// Output:
// <button class="btn-large btn-inline btn-primary">
// <button class="btn-large btn-inline btn-primary">

}( window ));
