/* 
 * @category Design Pattern Tutorial
 * @package Singleton Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */


"use strict";

declare var console;

module Registry
{
    var data = {};
    export function set( name: string, value: any ) {
        data[ name ] = value;
    }
    export function get( name: string ) {
        return data.hasOwnProperty( name ) && data[ name ];
    }
}


/*
 * Usage
 */
Registry.set( 'aVar', 'aValue' );
console.log( Registry.get( 'aVar' ) );

