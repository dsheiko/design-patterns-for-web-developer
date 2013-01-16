/*
 * @category Design Pattern Tutorial
 * @package Adapter Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

module Adapter
{
    export interface AbstractAdapter
    {
        find( selector: string ): AbstractAdapter;
        setAttr( attr: string, value: string ): void;
        getAttr( attr: string ): string;
    }
    export class Jquery
    {
        private _node;
        private _qs;
        constructor( $ )
        {
            this._qs = $;
        }
        public find( selector: string )
        {
            this._node = this._qs( selector );
            return this;
        }
        public setAttr( attr: string, value: string ) {
            this._node.attr( attr, value );
        }
        public getAttr( attr: string ) {
            return this._node.attr( attr );
        }
    }
    export class Yui
    {
        private _node;
        private _qs;
        constructor( Y )
        {
            this._qs = Y;
        }
        public find( selector: string )
        {
            this._node = this._qs.one( selector );
            return this;
        }
        public setAttr( attr: string, value: string ) {
            this._node.set( attr, value );
        }
        public getAttr( attr: string ) {
            return this._node.get( attr );
        }
    }
}

module Framework
{
    export function factory()
    {
        var instance = null;
        if ( jQuery !== undefined ) {
            instance = new Adapter.Jquery( jQuery );
        } else if ( YUI !== undefined ) {
            instance = new Adapter.Yui( YUI );
        } 
        if ( instance === null ) {
            throw new Error( "Neither jQuery nor YUI library available" );
        }
        return instance;
    }
}

/**
 * Usage
 */
declare var jQuery;
declare var YUI;
Framework.factory().find( 'div' ).set( 'id', 'something' );