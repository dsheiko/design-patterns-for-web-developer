/*
 * @category Design Pattern Tutorial
 * @package Bridge Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

"use strict";

declare var console;

interface ImplementorInterface
{
    renderBorder(): void;
    renderPaginator(): void;
}

// Implementer on the Bridge
class AbstractImplementor implements ImplementorInterface
{
    public renderBorder(): void
    {
        console.log("Border");
    }
    // Workaround abstract method. This one is required
    // due to implemented interface but yet empty; is meant to be overriden
    public renderPaginator()
    {
    }
}

// Concrete implementer
class ThemeA extends AbstractImplementor
{
    public renderPaginator()
    {
        console.log("Thumbnails");
    }
}

// Concrete implementer
class ThemeB extends AbstractImplementor
{
    public renderPaginator()
    {
        console.log("Bullets");
    }
}

// Abstraction on the Bridge
// Abstraction forwards client requests to its Implementor object.
class AbstractSlideShow
{
    private imp = null;
    constructor(imp: AbstractImplementor)
    {
        this.imp = imp;
    }

    public renderBorder(): void
    {
        this.imp.renderBorder();
    }

    public renderNavigation(): void
    {
        this.imp.renderPaginator();
    }
}

// RefmedAbstraction
class OnDesktopSlideShow extends AbstractSlideShow
{
    constructor(imp: AbstractImplementor)
    {
        super( imp );
    }

    public bindNavigation(): void
    {
        console.log("Navigation bound");
    }
    public render(): void
    {
        this.renderBorder();
        this.renderNavigation();
        this.bindNavigation();
    }
}

// RefmedAbstraction
class OnMobileSlideShow extends AbstractSlideShow
{
    constructor(imp: AbstractImplementor)
    {
        super( imp );
    }

    public bindTouchGestures(): void
    {
        console.log("Touch gestures bound");
    }
    public render(): void
    {
        this.renderBorder();
        this.bindTouchGestures();
    }
}

/**
 * Usage
 */

var deskThemAImp = new OnDesktopSlideShow( new ThemeA() ),
    deskThemBImp = new OnDesktopSlideShow( new ThemeB() ),
    mobileThemAImp = new OnMobileSlideShow( new ThemeA() );

deskThemAImp.render();
deskThemBImp.render();
mobileThemAImp.render();


/**
 * Output
 */

/**
 * Output
 */
// Border
// Thumbnails
// Navigation bound
//
// Border
// Bullets
// Navigation bound
//
// Border
// Touch gestures bound