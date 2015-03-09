##  Registry

<blockquote cite="http://www.goodreads.com/book/show/70156.Patterns_of_Enterprise_Application_Architecture">
<p>A well-known object that other objects can use to find common objects and services.</p>
<footer>%26mdash; <cite><a title="Fowler, Martin (2002-11-05). Patterns of Enterprise Application Architecture" href="http://www.goodreads.com/book/show/70156.Patterns_of_Enterprise_Application_Architecture">Martin Fowler</a></cite></footer>
</blockquote>

![Registry pattern class diagram](./assets/img/Registry/uml.png)

The pattern allows:

* simple way of sharing common objects across the application

Registry is a container where we can store objects and values in the application scope.
That makes common objects available throughout the application. This pattern is often
presented as an alternative to using global storage. You can find example of Registry implementation
[in Zend Framework 1.xx Zend_Registry library](http://framework.zend.com/manual/1.12/en/zend.registry.using.html)

###  Antipattern
While unit testing we are supposed to deal small,
discrete units of code that do not have dependencies.
This requires us to either remove dependencies or
mock them in such a way that the dependencies are neutralized.
If you retrieve an object from the registry, and then modify it, every subsequent retrieval
from the registry will reflect that modification.
This creates a significant issue for it prevents from testing a discrete unit of code.

Registry pattern promotes poorer design overall. Using the pattern
we just take an object without any knowledge of where, when and how the object is meant to be accessed.
This leads to developers being lazy about their architecture, and eventually leads to poorer code.

###  PHP Example

In the example Registry is implemented as a [Singleton](#Singleton).
That's a very common case of Registry. You can use it share any types
of objects and values like you otherwise would do it with <var>$GLOBALS</var>.
It's especailly easy to use while you can set and access Registry properties dynamically
by means [PHP overloading](http://php.net/manual/en/language.oop5.overloading.php).

![Registry pattern PHP example class diagram](./assets/img/Registry/PHP/uml.png)


{% highlight php linenos %}
{% include "examples/Registry/PHP/tutorial.php" %}
{% endhighlight %}


###  JavaScript Example

To get an object in EcmaScript one doesn't need a class. We can access Registry
without instantiating it. Thus we don't need it to be a [Singleton](#Singleton).

![Registry pattern EcmaScript example class diagram](./assets/img/Registry/EcmaScript/uml.png)


{% highlight js linenos %}
{% include "examples/Registry/JavaScript/example.js" %}
{% endhighlight %}


###  JSA Example


{% highlight js linenos %}
{% include "examples/Registry/JSA/example.js" %}
{% endhighlight %}


###  TypeScript Example


{% highlight js linenos %}
{% include "examples/Registry/TypeScript/example.ts" %}
{% endhighlight %}


