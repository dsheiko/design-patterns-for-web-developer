##  Builder

<blockquote cite="http://www.goodreads.com/book/show/85009.Design_Patterns">
<p>Separate the construction of a complex object from its representation so that the same construction process can create different representations.</p>
<footer>%26mdash; <cite><a title="Gamma, Erich; Helm, Richard; Johnson, Ralph; Vlissides, John (1994-10-31). Design Patterns: Elements of Reusable Object-Oriented Software" href="http://www.goodreads.com/book/show/85009.Design_Patterns">Gang of Four</a></cite></footer>
</blockquote>

![Builder pattern class diagram](./assets/img/Builder/uml.png)

The pattern allows:

* decoupling construction of complex objects from the module;
* multiple representations of object construction algorithm;
* run-time control over object construction process;
* an application design abstraction where one object acts as a Director and other as subordinated Builders.

###  PHP Example

Imagine that we have an object consisting of many parts which we
need to re-build into a new one so, that its parts had different representations.
For instance we work on a text convertor which is expected to process
properly all the parts of the original document. In following example you can
find Builder (<var>AbstractConvertor</var>) object with all the methods to convert every
property of the initial document (Author, Title, Chapter).
Concrete Builders <var>Epub</var> and <var>Pdf</var> implement Builder interface
for the responsive text formats. The Director (<var>Reader</var>) constructs
a new object (Product) from a given initial document (<var>Entity</var>) and using a Concrete Builder.

![Builder pattern PHP example class diagram](./assets/img/Builder/PHP/uml.png)


{% highlight php linenos %}
{% include "examples/Builder/PHP/tutorial.php" %}
{% endhighlight %}


###  JavaScript Example

In EcmaScript example we use Director (<var>moduleManager</var>) to build a widget based
on a supplied configuration and using a given Concrete Builder (<var>ThemeA</var>).
Thus if configuration changes toward an other theme, it's going to be transparent
for the client application.

![Builder pattern EcmaScript example class diagram](./assets/img/Builder/EcmaScript/uml.png)


{% highlight js linenos %}
{% include "examples/Builder/JavaScript/example.js" %}
{% endhighlight %}


###  JSA Example


{% highlight js linenos %}
{% include "examples/Builder/JSA/example.js" %}
{% endhighlight %}


###  TypeScript Example


{% highlight js linenos %}
{% include "examples/Builder/TypeScript/example.ts" %}
{% endhighlight %}
