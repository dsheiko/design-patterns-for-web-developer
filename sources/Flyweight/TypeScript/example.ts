/*
 * @category Design Pattern Tutorial
 * @package flyweight Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

"use strict";

declare var window;
declare var document;
declare var console;
declare var escape;
declare var unescape;

// Abstract implementor
interface StorageApiInterface
{
    save( name: string, value: string ): void;
    get( name: string ): string;
}

module StorageApi {
    
    // Concrete implementor
    export class sessionStorage 
    {
        public save(name: string, value: string): void {
            console.log( 'Saved in SessionStorage' );
            window.sessionStorage[ name ] = value;
        }
        public get(name: string): string {
            return window.sessionStorage[ name ];
        }
    }

    // Concrete implementor
    export class cookies 
    {
        public save(name: string, value: string): void {
            console.log( 'Saved in Cookies' );
            document.cookie = name + "=" + escape( value );
        }
        public get(name: string): string {
            var key: string, 
                val: string, 
                cookieArr: string[] = document.cookie.split( ";" ),
                i: number = 0, 
                len: number = cookieArr.length;

            for ( ; i < len; i++) {
                  key = cookieArr[ i ].substr( 0, cookieArr[i].indexOf( "=" ) );
                  val = cookieArr[ i ].substr( cookieArr[i].indexOf( "=" ) + 1 );
                  key = key.replace( /^\s+|\s+$/g , "" );
                  if ( key === name ) {
                    return unescape( val );
                  }
            }
            return '';
        }
    }

}

class NotepadWidget
{ 
    private id: string = 'noteWidgetText';
    private api: StorageApiInterface;
    private text: string = 'Lorem ipsum';

    constructor( api: StorageApiInterface ) {
        this.api = api;
    };
    
    public getText(): string {
        return this.text;
    };
 
    public restoreState(): void {
        this.text = this.api.get( this.id );
    };

    public saveState(): void {
        this.api.save( this.id, this.text );
    };
    
}

/**
 * Usage
 */

var spiDelegate = new StorageApi.sessionStorage(),
    notepad = new NotepadWidget( spiDelegate );

notepad.saveState();
notepad.restoreState();
console.log( notepad.getText() );

/**
 * Output
 */

// Saved in SessionStorage
// Lorem ipsum