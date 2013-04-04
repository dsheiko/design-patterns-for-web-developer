/*
 * @category Design Pattern Tutorial
 * @package Singleton Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */


"use strict";

declare var console;

class Singleton
{
    public foo = "value";
    static instance = null;
    static getInstance(): Singleton
    {
        return instance || ( instance = new Singleton() );
    }
}
/*
 * Usage
 */
console.log(Singleton.getInstance() === Singleton.getInstance());

/**
 * Output
 */
// true

