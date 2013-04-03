/*
 * @category Design Pattern Tutorial
 * @package AbstractFactory Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

"use strict";

declare var console;

module Widget
{
    // Abstract product
    export interface AbstractWidget
    {
        render: () => void;
    }
    // Concrete product
    export class Carousel
    {
        public render(): void {
            console.log('Carousel widget rendered');
        }
    }
    // Concrete product
    export class MockCarousel
    {
        public render(): void {
            console.log('Mock carousel widget rendered');
        }
    }
}


module WidgetFactory
{
    // Abstract factory
    export interface AbstractFactory
    {
        makeCarousel: () => Widget.AbstractWidget;
    }
    // Concrete factory
    export class Mock
    {
        public makeCarousel(): Widget.AbstractWidget {
            return new Widget.MockCarousel();
        }
    }
    // Concrete factory
    export class Regular
    {
        public makeCarousel(): Widget.AbstractWidget {
            return new Widget.Carousel();
        }
    }
}

// Abstraction for configuration object
interface PageOptions
{
    testing: bool;
}

// Client
class Page
{
    private options: PageOptions;

    constructor( options: PageOptions ) {
        this.options = options;
    }

    public render(): void {
        var widget: Widget.AbstractWidget,
            factory: WidgetFactory.AbstractFactory;

        if ( this.options.testing ) {
            factory = new WidgetFactory.Mock();
        } else {
            factory = new WidgetFactory.Regular();
        }
        
        widget = factory.makeCarousel();
        widget.render();
    }
}


/**
 * Usage
 */

var testPage = new Page({ "testing": true }),
    page = new Page({ "testing": true });

testPage.render();
page.render();


// Output
// Mock carousel widget rendered
// Carousel widget rendered

