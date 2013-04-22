---
title: Decorator
category: Object Structural
---

{% template "sections/includes/gof.html" %}
Attach additional responsibilities to an object dynamically. Decorators provide a flexible alternative to subclassing for extending functionality.
{% endtemplate %}

![Decorator pattern class diagram](./assets/img/Decorator/uml.png)

The pattern allows:

* for extending (decoration) the functionality of a certain object at run-time, independently of other instances of the same class.

When we need to enhance an individual object with a particular responsibility, use of inheritance may be impractical.
Let's say we have a widget class. In some cases we need this widget with border,
in some with scrollbar, in some with both. Relying on inheritance we would need
not only classes for every representation, but also classes for every combination, provided
number of possible combinations increases excessively with every new added representation. Using decorators
we can configure representation on the fly. So we make an instance of the concrete widget and pass it to the scrollbar decorator.
Then we pass derived object to the border decorator. Thus, we get the widget enhanced with both border and scrollbar.

Known uses
ZF 1.x utilizes the decorator pattern in order to render elements and forms.
So when you need a custom representation for a form element, you
can use one or more decorators on the element class to achieve exactly what you want.


###  PHP Example

In following example we have \Widget\Concrete class implementing \Widget\WidgetInterface and two
decorators (\Widget\Decorator\Scrollbar and \Widget\Decorator\StatusBar) that implement
interface of \Widget\Decorator\AbstractDecorator. When we need the widget with
scrollbar and status bar we just wrap widget instance with corresponding decorators.

![Decorator pattern PHP example class diagram](./assets/img/Decorator/PHP/uml.png)


{% highlight php linenos %}
{% include "examples/Decorator/PHP/tutorial.php" %}
{% endhighlight %}


###  JavaScript Example

This example shows Decorator pattern from an other prospective. We have here an object, which represents
a concrete product MacbookAir. It's one of the class defined by MacbookAbstract.
The object comprises the base product configuration and corresponding price.
Now we can specify decorators for extensible configuration properties (<var>RAM</var>, <var>SDD</var>).
Combination of decorators will give a product object of the intended configuration.
It can be used e.g. for price calculator.


![Decorator pattern EcmaScript example class diagram](./assets/img/Decorator/EcmaScript/uml.png)


{% highlight js linenos %}
{% include "examples/Decorator/JavaScript/example.js" %}
{% endhighlight %}


###  JSA Example


{% highlight js linenos %}
{% include "examples/Decorator/JSA/example.js" %}
{% endhighlight %}


###  TypeScript Example


{% highlight js linenos %}
{% include "examples/Decorator/TypeScript/example.ts" %}
{% endhighlight %}
