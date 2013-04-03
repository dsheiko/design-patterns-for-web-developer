/*
 * @category Design Pattern Tutorial
 * @package Bridge Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

"use strict";

declare var console;

interface Macbook
{
    getPrice(): number; // returns Macbook price in dollars
    getRam(): number; // returns size of RAM (GB)
    getSdd(): number; // returns size of SDD (GB)
}
// MacbookAir default configuration
class MacbookAir 
{
    private ram = 4;
    private sdd = 128;
    private price = 1199;

    public getPrice()
    {
        return this.price;
    }
    public getSdd()
    {
        return this.sdd;
    }
    public getRam()
    {
        return this.ram;
    }
}
// Abstract decorator class.  It implements Coffee Macbook
class AbstractMacbookDecorator 
{
    public macbook;

    constructor(macbook: Macbook)
    {
        this.macbook = macbook;
    }
    // implementing methods of the interface
    public getPrice()
    {
        return this.macbook.getPrice();
    }
    public getRam()
    {   
        return this.macbook.getRam();
    }
    public getSdd()
    {   
        return this.macbook.getSdd();
    }
}
// Decorator MacbookRamExtended, that represents 
// Macbook configuration with extended RAM
class MacbookRamExtendedDecorator extends AbstractMacbookDecorator
{
    
    constructor( macbook: Macbook )
    {
        super( macbook );
    }
    // overriding methods defined in the abstract superclass
    public getPrice()
    {
        return this.macbook.getPrice() + 100;
    }
    public getRam()
    {   
        return this.macbook.getRam() + 4;
    }
}
// Decorator MacbookSddExtended, that represents 
// Macbook configuration with extended SDD
class MacbookSddExtendedDecorator extends AbstractMacbookDecorator
{
    
    constructor( macbook: Macbook )
    {
        super( macbook );
    }
    public getPrice()
    {
        return this.macbook.getPrice() + 200;
    }
    public getSdd()
    {   
        return this.macbook.getSdd() + 128;
    }
}


/**
 * Usage
 */
// Let's get maximum extended configuration
var myMacbook = new MacbookSddExtendedDecorator(
    new MacbookRamExtendedDecorator(new MacbookAir())
);

console.log( "13-inch MacBook Air\nRAM: " + myMacbook.getRam() + "\nSDD: " + myMacbook.getSdd() );
console.log( "Price: $" + myMacbook.getPrice() );

/**
 * Output
 */

// 13-inch MacBook Air
// RAM: 8
// SDD: 256
// Price: $1499