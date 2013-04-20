##  Prototype

<blockquote cite="http://www.goodreads.com/book/show/85009.Design_Patterns">
<p>Specify the kinds of objects to create using a prototypical instance, and create new objects by copying this prototype.</p>
<footer>%26mdash; <cite><a title="Gamma, Erich; Helm, Richard; Johnson, Ralph; Vlissides, John (1994-10-31). Design Patterns: Elements of Reusable Object-Oriented Software" href="http://www.goodreads.com/book/show/85009.Design_Patterns">Gang of Four</a></cite></footer>
</blockquote>

![Prototype pattern class diagram](./assets/img/Prototype/uml.png)

The pattern allows:

* creating new objects identical or closely resembling existing ones;
* avoiding expense operation when it is required for the initial creating of an object;
* to decouple composition, creating and representation of objects.

Usually when we need one object to extend another we bring into play inheritance. 
So we declare a class or a base object in prototype-based languages per every 
kind of derived objects, even if they scarcely differ. However using Prototype 
we can reduce the number of classes. 

###  PHP Example

Let's assume, we deal with micro-formats in our application. 
The application is built on the framework, which already has base class (<var>Element</var>) 
for HTML element objects. Thus, every element makes an instance of this class.
Micro-format elements are HTML elements, which are marked in a particular way 
by the class attribute. So, to get them, we could subclass <var>Element</var>. 
However, that would produce a lot of subclasses, which differ only by 
the micro-format type the derived objects represent. Besides, it would be inconsistent to the framework design.
How do we solve it? Instead of generalization we will use composition. 
We create an HTML element object by instantiating <var>Element</var> class.  
We pass to the constructor tag name to specify which exact element it is. 
Now we have a state-full object, which we clone every time we need a new a micro-format element object.


![Prototype pattern PHP example class diagram](./assets/img/Prototype/PHP/uml.png)


{% highlight php linenos %}
{% include "examples/Prototype/PHP/tutorial.php" %}
{% endhighlight %}


###  JavaScript Example

In this imaginable application we need a button to submit the form (Save changes) 
 and a button to preserve the form data (Save draft). The framework comprises 
 an object representing an abstract button (<var>Toolbar.Button</var>). The object's 
 constructor receives configuration object as an argument (object specifiers). Thus, any instance
 of <var>Toolbar.Button</var> makes a configured button. Any button meant for saving has 
 a particular appearance. In [Twitter Bootstrap 2](http://twitter.github.com/bootstrap) it is gained by adding class
 <var>btn-primary</var>. So, we clone default button object and add the class to it. 
 Save changes button and Save draft button differ only by onClick event 
 handlers. In everything else they are the same as default save button. So 
 we can clone saveBtn object and, then, assign the handler to each.  

![Prototype pattern EcmaScript example class diagram](./assets/img/Prototype/EcmaScript/uml.png)


{% highlight js linenos %}
{% include "examples/Prototype/JavaScript/example.js" %}
{% endhighlight %}


###  JSA Example


{% highlight js linenos %}
{% include "examples/Prototype/JSA/example.js" %}
{% endhighlight %}


###  TypeScript Example


{% highlight js linenos %}
{% include "examples/Prototype/TypeScript/example.ts" %}
{% endhighlight %}
