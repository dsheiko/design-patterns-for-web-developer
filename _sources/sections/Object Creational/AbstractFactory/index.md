---
title: Abstract Factory
category: Object Creational
---

{% template "sections/includes/gof.html" %}
Provide an interface for creating families of related or dependent objects without specifying their concrete classes.
{% endtemplate %}

![Abstract Factory pattern class diagram](./assets/img/AbstractFactory/uml.png)

The pattern allows:

* the system to be independent of how its products are created, composed, and represented;
* to use families of objects together;
* to decouple concrete class from the clients;
* run-time control over object creation process.

Abstract factory declares an interface to be implemented by every concrete factory responsible
for creation of product objects (usually belonging to a family). So the client using
concrete factories is isolated from implementation classes. Client doesn't know product class names; that's responsibility
of a concrete factory. The pattern also makes it easy to switch between product families. Since concrete factories
implement the same interface, simply change of the concrete factory on the client will bring to a different product family.

AbstractFactory classes are often implemented with factory methods ({var|Factory Method}),
but they can also be implemented via Prototype.

A concrete factory is usually designed as a [Singleton](#Singleton).

###  PHP Example

Let's imagine we are required to build a UI, which is represented differently depending on the configuration.
If the page is requested on a desktop PC it uses jQuery UI framework. If it's on a mobile device - jQuery Mobile.
In this example we have two interfaces <var>\Widget\Button\iButton</var> and <var>\Widget\Dialog\iDialog</var> and
implementations of those for desktop PC and mobile devices. To create a widget object we use factories: <var>Widget\Factory\Desktop</var> and
<var>Widget\Factory\Mobile</var>. Thus the client (<var>\Application</var>) picks out the required factory (here based on passed in configuration object)
and further deals with interfaces, not concrete implementations.
As soon as configuration changed (e.g according user agent) the application gets widgets represented respectevly

![Abstract Factory pattern PHP example class diagram](./assets/img/AbstractFactory/PHP/uml.png)


{% highlight php linenos %}
{% include "examples/AbstractFactory/PHP/tutorial.php" %}
{% endhighlight %}


###  JavaScript Example

Here we solve the same task as above: the application builds widgets based on supplied configuration. Although in here
we either get real widgets or mock ones for unit-testing.
We will use <var>Object.create</var> to extend abstract objects.

![Abstract Factory pattern EcmaScript example class diagram](./assets/img/AbstractFactory/EcmaScript/uml.png)


{% highlight js linenos %}
{% include "examples/AbstractFactory/JavaScript/example.js" %}
{% endhighlight %}


###  JSA Example


{% highlight js linenos %}
{% include "examples/AbstractFactory/JSA/example.js" %}
{% endhighlight %}


###  TypeScript Example


{% highlight js linenos %}
{% include "examples/AbstractFactory/TypeScript/example.ts" %}
{% endhighlight %}
