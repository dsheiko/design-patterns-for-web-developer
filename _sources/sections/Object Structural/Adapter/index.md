---
title: Adapter
category: Object Structural
---

{% template "sections/includes/gof.html" %}
Convert the interface of a class into another interface clients expect. 
Adapter lets classes work together that couldn’t otherwise because of incompatible interfaces.
{% endtemplate %}


![Adapter pattern class diagram](./assets/img/Adapter/uml.png)

The pattern allows:

* classes with disparate interfaces to work together through an intermediate object

In real life we use adapters to convert attributes of one device to another otherwise incompatible. Foe example, 
a mains power plug adapter which allows British plugs to be connected to American sockets. 
The same in programming. We use adapters to reuse objects cooperating with 
incompatible interfaces. That can be unrelated classes or classes wit unpredictable interfaces.  
For instance, in Database Abstract Layer (DAL). You need an API
to access DB, but you don't want to be confined to a single driver. 
Every driver provides its own interface. So you work out your own API and make a 
target object which converts driver (adoptee) API into that of yours. 

### Related patterns

Bridge separates an interface from its implementation, when Adapter modifies interface of an existing object.

Decorator extends another object without changing its interface. Besides, it supports 
recursive composition, which is not achievable by Adapter.  

Proxy provides representative or surrogate for another object while not changing its interface.

###  PHP Example

Most of PHP frameworks implement DAL using the Adapter pattern. Thus, you are likely familiar with the approach 
and can easily follow the example. Here we provide DB access via MySQLi and PDO drivers. 
Each of them exposes its own API. So we define common API in AdapterInterface and 
make adapters per driver implementing it using object composition. The factory creates an instance of required adapter based 
on a supplied  configuration.

![Adapter pattern PHP example class diagram](./assets/img/Adapter/PHP/uml.png)


{% highlight php linenos %}
{% include "examples/Adapter/PHP/tutorial.php" %}
{% endhighlight %}


###  JavaScript Example

Imagine that we are to write a plugin which can be used with jQuery as well as with YUI libraries.
The plugin solves some task required DOM modification. Each of these libraries provides a distinct 
DOM manipulation API. We declare third one and adapters per library to make their 
interfaces compatible to that one of ours.  Node.factory returns instance of adapter depending on
which library is available in global scope.

![Adapter pattern EcmaScript example class diagram](./assets/img/Adapter/EcmaScript/uml.png)


{% highlight js linenos %}
{% include "examples/Adapter/JavaScript/example.js" %}
{% endhighlight %}



###  TypeScript Example


{% highlight js linenos %}
{% include "examples/Adapter/TypeScript/example.ts" %}
{% endhighlight %}
