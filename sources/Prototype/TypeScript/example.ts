/*
 * @category Design Pattern Tutorial
 * @package Prototype Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

"use strict";

declare var window;
declare var document;
declare var console;

interface ButtonOptions
{
    size: string; 
    display: string;
}

module Toolbar
{
    export interface ButtonInterface
    {
        node: HTMLElement;
        addClass( className: string ): ButtonInterface;
        setOnClickHandler( callback: ( e: Event ) => Toolbar.Button ): 
            ButtonInterface;
    }

    export class Button
    {
        private node: HTMLElement;

        constructor( options: ButtonOptions ) {
            this.node = document.createElement( "button" );
            this.node.className = "btn-" + options.size + 
                " btn-" + options.display;
        }

        public addClass( className: string ): ButtonInterface {
            this.node.className += " btn-" + className;
            return this;
        }
        public setOnClickHandler( 
            callback: ( e: Event ) => Toolbar.Button ): ButtonInterface {
            this.node.addEventListener( 'keypress', callback, false );
            return this;
        }

        public render() {
            console.log( this.node );
        }
    }
}



/**
 * Usage
 */

var abstractBtn = new Toolbar.Button({ 
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
        .setOnClickHandler(function( e: Event ){ 
            e.preventDefault();
            console.log( "Changes saved" );
    }),
    // Clone saveBtn for saveDraftBtn
    saveDraftBtn = Object.create( saveBtn )
        // Specific handler for saveDraftBtn
        .setOnClickHandler(function( e: Event ){
            e.preventDefault();
            console.log( "Draft saved" );
    });

saveDraftBtn.render();
saveChangesBtn.render();

// Output:
// <button class="btn-large btn-inline btn-primary">
// <button class="btn-large btn-inline btn-primary">

