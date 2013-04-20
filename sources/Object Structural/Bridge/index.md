##  Bridge

<blockquote cite="http://www.goodreads.com/book/show/85009.Design_Patterns">
<p>Decouple an abstraction from its implementation so that the two can vary independently.</p>
<footer>%26mdash; <cite><a title="Gamma, Erich; Helm, Richard; Johnson, Ralph; Vlissides, John (1994-10-31). Design Patterns: Elements of Reusable Object-Oriented Software" href="http://www.goodreads.com/book/show/85009.Design_Patterns">Gang of Four</a></cite></footer>
</blockquote>

![Bridge pattern class diagram](./assets/img/Bridge/uml.png)

The pattern allows:

* to avoid permanent binding between abstraction and its implementation;
* deferring the presence of the implementation to the point where the abstraction is utilized

Alike Abstract Factory and Bridge decouples an abstraction from its implementation.
Actually Abstract Factory can be used to build a particular Bridge.
But what is unique about Bridge - it provides an architecture where abstraction
and implementation are in separate class hierarchies.

###  PHP Example

PHP example shows the case where web statistics data can be retrieved from different sources
(Google Analytics and local DB) and be presented in table or graphic form.
Using inheritance we define <var>ImpAbstract</var> and subclasses <var>GoogleAnalytics</var> and <var>LocalAnalytics</var>
which implement <var>ImpAbstract</var> interface for both data sources.
<var>AnalyticsAbstract</var> consumes API provided by <var>ImpAbstract</var> and expose own
methods to subsclasses <var>GraphViewData</var> and <var>TableViewData</var>.

![Bridge pattern PHP example class diagram](./assets/img/Bridge/PHP/uml.png)


{% highlight php linenos %}
{% include "examples/Bridge/PHP/tutorial.php" %}
{% endhighlight %}


###  JavaScript Example

EcmaScript examples describe a solution for themable widget (slideshow).
Consider a slideshow which is meant to have thumbnail- or bullets-like
pagination depending on a theme and act differently on desktop and mobile devices.
Here the slideshow doesn't have pagination on mobiles devices, but supports
touch gestures to navigate slides.

<var>AbstractImplementor</var> implies an interface to be implemented by by all its derivatives:
theme classes and subclasses. <var>AbstractSlideShow</var> is a client to <var>AbstractImplementor</var>,
which forward the API to subclasses <var>OnDesktopSlideShow</var> and <var>OnMobileSlideShow</var>.

![Bridge pattern EcmaScript example class diagram](./assets/img/Bridge/EcmaScript/uml.png)


{% highlight js linenos %}
{% include "examples/Bridge/JavaScript/example.js" %}
{% endhighlight %}


###  JSA Example


{% highlight js linenos %}
{% include "examples/Bridge/JSA/example.js" %}
{% endhighlight %}


###  TypeScript Example


{% highlight js linenos %}
{% include "examples/Bridge/TypeScript/example.ts" %}
{% endhighlight %}
