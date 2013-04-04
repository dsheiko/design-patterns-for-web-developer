/*
 * @category Design Pattern Tutorial
 * @package Builder Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

"use strict";

declare var console;

interface WidgetOptions
{
    title: string;
    widget: AbstractWidget;
    isClosable: bool;
    isResizable: bool;
}

// Widget is used to build a product
interface AbstractWidget 
{
    render: () => string;
}

class MockWidget
{
    public render(): string {
        return "The module has widget";
    }
}

interface BuilderInterface
{
    buildWindow: ( title: string ) => void;
    attachCloseButton: () => void;
    attachWidget: ( widget: AbstractWidget ) => void;
    attachResizeControl: () => void;
    getModule: () => string;
}

class AbstractBuilder 
{
    public markup: string = "";
    public getModule(): string {
        return this.markup;          
    }
}


// Director
class moduleManager
{
    private options: WidgetOptions;

    constructor( options: WidgetOptions ) {
        this.options = options;
    }

    public construct( builder: BuilderInterface ) {
        builder.buildWindow( this.options.title );
        this.options.widget && builder.attachWidget( this.options.widget );
        this.options.isClosable && builder.attachCloseButton();
        this.options.isResizable && builder.attachResizeControl();
        return builder.getModule();
    }
}

// Concrete builder
class ThemeA extends AbstractBuilder 
{
  
    public buildWindow( title: string ) {
        this.markup += "Module " + title + " represented with ThemeA theme\n";
    }
    public attachCloseButton() {
        this.markup += "The module has close button\n";
    }
    public attachWidget( widget: AbstractWidget ) {
        this.markup += widget.render();
    }
    public attachResizeControl() {
        this.markup += "The module has resize control\n";
    }
        
}

/**
 * Usage
 */
    var pageModule = new moduleManager({
        title: "Example",
        widget: new MockWidget(),
        isClosable: true,
        isResizable: true
    });
    pageModule.construct( new ThemeA() );
    console.log( pageModule );

// Output
// Module Example represented with ThemeA theme
// The module has widget
// The module has close button
// The module has resize control