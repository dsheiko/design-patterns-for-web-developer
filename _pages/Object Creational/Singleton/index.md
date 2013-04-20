##  Singleton

<blockquote cite="http://www.goodreads.com/book/show/85009.Design_Patterns">
<p>Ensure a class only has one instance, and provide a global point of access to it.</p>
<footer>%26mdash; <cite><a title="Gamma, Erich; Helm, Richard; Johnson, Ralph; Vlissides, John (1994-10-31). Design Patterns: Elements of Reusable Object-Oriented Software" href="http://www.goodreads.com/book/show/85009.Design_Patterns">Gang of Four</a></cite></footer>
</blockquote>

![Singleton pattern class diagram](./assets/img/Singleton/uml.png)

The pattern allows:

* control over concrete class instantiating so that the only instance could be obtained.

Singleton is used to restrict instantiation of a class to one object.
This is useful when exactly one object is needed to coordinate actions across the system.

###  PHP Example

![Singleton pattern PHP example class diagram](./assets/img/Singleton/PHP/uml.png)


{% highlight php linenos %}
{% include "examples/Singleton/PHP/tutorial.php" %}
{% endhighlight %}


###  JavaScript Example

![Singleton pattern EcmaScript example class diagram](./assets/img/Singleton/EcmaScript/uml.png)


{% highlight js linenos %}
{% include "examples/Singleton/JavaScript/example.js" %}
{% endhighlight %}


###  JSA Example


{% highlight js linenos %}
{% include "examples/Singleton/JSA/example.js" %}
{% endhighlight %}


###  TypeScript Example


{% highlight js linenos %}
{% include "examples/Singleton/TypeScript/example.ts" %}
{% endhighlight %}
