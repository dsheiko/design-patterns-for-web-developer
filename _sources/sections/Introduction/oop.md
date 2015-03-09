---
title: Why object-oriented programming?
id: oop-intro
---

OOP is meant to improve maintainability, make code easier to read and understand.
Object-oriented design patterns provide proved solution, recognizable by other developer by name.

So, to proceed with design patterns, would useful to remind the following
features of OOP: [abstraction](#abstraction), [encapsulation](#encapsulation), [modularity](#modularity), [polymorphism](#polymorphism), and [inheritance](#inheritance),
[separation of responsibilities](#srp).


When following OOP paradigm almost all the code is encapsulated into
so called objects. Each object can have members: properties (can be referred also as fields or instance variables)
and methods. Properties represent object state and methods describe its behavior.

Object members can be private (accessible only in the scope of the host object),
protected (accessible as for the host object as well as for all its derivates –
the objects that inherit from it) and public (accessible from outside).

In class-based OOP (C++, Java, SmallTalk, PHP5), first of all we define a class.
Later on we can use it as a prototype when creating new objects (instances).
In prototypal OOP (JavaScript, ActionScript, Self) there is no classes but objects.
Though, one objects can serve as prototypes while making new objects.

### Abstraction
{: #abstraction}

Abstraction is a technique to collect data and code similar in form under scopes named to express its meaning.
Well, let’s take an example from real life. We are to build a site, which consists of pages. Every page can have, beside the content, input forms and navigation. So, we can define abstract objects representing components of the application: Page, Form, Navigation. Thus, we can focus on top-level concepts rather than on details.
Let’s now put it graphically (we will use UML – quick introduction into UML 2.x):

![Abstraction Illustration](./assets/img/Introduction/abstraction.png)

E.g. [Strategy](#strategy) pattern

### Encapsulation
{: #encapsulation }

The user of an object can view the object as a black box that provides services. Instance properties and methods can be rewritten, but as far as object implements the same interfaces (exposed services stay unchanged), any code that uses the object doesn’t need to be changed.

E.g. we have object Form which consumes Captcha object. Form uses only 2 captcha services:
{% highlight php linenos %}
$captcha->getHtml(),
$captcha->isValid()
{% endhighlight %}

and knows nothing of internal implementation. If you decide to change captcha implementation, the code of the object can be fully rewritten, but the methods (getHtml and isValid) will still be used.  So you don’t need to make any changes to the consumer object (Form).

E.g. Observer pattern

### Modularity
{: #modularity}
As we examined above objects can be independent of each other.  The bigger degree of that independency (lose coupling) the better application design.  So to say, many Design Patterns are meant help with it (Façade, Mediator,..)

Objects also can be passed into other objects (see Dependency Injection). It’s used for example in Visitor pattern.



### Inheritance
{: #inheritance}
One objects can inherit from others. In class-based OOP one class can
extend another. So instance of the last will appear as an extended instance of base class.

E.g. we have <var>AbstractPage</var> class defining common properties and behavior for
any page on the site (<var>getPageByUrl</var>, <var>getTitle</var>). PageContact extends
AbstractPage with form property. PageNewsDetails – content, teaserImage, comments.



### Separation of responsibility
{: #srp}

Robert C. Martin collected the essential principles of good design under abbr.
SOLID. The first one (Single Responsibility Principle) can be considered
as a feature of OOP.  While designing your code you shall take care that
any member of the class serves to achieve the goal the class meant for.

E.g.
{% highlight php linenos %}
 <?php

class \Page\Contact
{
    private $_tpl = "./tpl/contact-page.phtml";
    private $_title = "Contact Page";
    private $_form = new \Form\Contact();

    public function getTitle()
    {
        return $this->_title;
    }
    public function getForm()
    {
        return $_form;
    }
    public function getHtml()
    {
        return strtr(file_get_contents($this->_tpl), array(
            "title" => $this->_title,
            s"form" => $this->_form,
        ));
    }
}
{% endhighlight %}