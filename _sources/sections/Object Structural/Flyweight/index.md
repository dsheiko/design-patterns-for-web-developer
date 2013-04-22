---
title: Flyweight
category: Object Structural
---

{% template "sections/includes/gof.html" %}
Use sharing to support large numbers of fine-grained objects efficiently.
{% endtemplate %}


![Flyweight pattern class diagram](./assets/img/Flyweight/uml.png)

The pattern allows:

* to reuse of many objects so, to make the utilization of large numbers of objects more efficient.

Flyweight is an object which can be shared. The trick is to split object state into: intrinsic and extrinsic ones.
Flyweight stores its intrinsic state, but extrinsic one is kept by the flyweight context. Thus, being reused
the same object instance can have different aggregate states depending on the given flyweight context.

###  PHP Example

If we were to build a text editor, it would take unacceptably much of memory to allocate all the objects graphically representing characters in the document.
Except we use flyweights. Character flyweight stores only character code. All the related attributes are kept by flyweight context.
So, we declare Glyph interface to be implemented by any glyph (character, row, maybe column etc.).
Row represents a sequence of characters. Logically it is a Composite. <var>GlyphContext</var> is an iterator, which maps glyph sequence
extracts to some extrinsic state. For an instance, all the glyphs of a sequence from index A till index B are associated with
Times Roman 12 font. <var>GlyphContext</var> must be kept informed of the current position in the glyph structure during traversal.
E.g. when Row performs insert, <var>GlyphContext::next</var> is called.
<var>GlyphContext</var> sequence index increments with every Row::insert call.
For <var>Row::render</var>, <var>GlyphContext</var> index is set on the beginning of the sequence and with every <var>Character::render</var> request it iterates.
Thus, Character has <var>GlyphContext</var> with index set up according to the Character location in the sequence.
During Character rendering <var>GlyphContext::getFont</var> returns the font object we expect.

As you see <var>GlyphContext</var> acts as extrinsic state repository.
Besides, it's glyph representation context. You can have many <var>GlyphContext</var> instances keeping different
rendering attributes for the same glyph structure. So by switching context you choose representation strategy for the structure.

Flyweights are created by means a factory, which ensures they are shared properly.
<var>GlyphFactory</var> caches statically <var>Character</var> instances while they are being created. If instance corresponding to the requested one
 already exists in the cache, it is used instead of creation of a new instance.

![Flyweight pattern PHP example class diagram](./assets/img/Flyweight/PHP/uml.png)


{% highlight php linenos %}
{% include "examples/Flyweight/PHP/tutorial.php" %}
{% endhighlight %}


###  JavaScript Example

Error log entries can be numerous, though the number of error messages they store is limited.
We can define error message code as intrinsic state of <var>ErrorLogEntry</var> flyweight and datetime stamp as extrinsic state.
Whatever many errors are passed to <var>ErrorLogger</var>, it operates limited set of <var>ErrorLogEntry</var> instances, but
stores datetime stamps in <var>ErrorLogEntryContext</var>. So, the same instances of <var>ErrorLogEntry</var>, but in different contexts provide
the required information.

![Flyweight pattern EcmaScript example class diagram](./assets/img/Flyweight/EcmaScript/uml.png)


{% highlight js linenos %}
{% include "examples/Flyweight/JavaScript/example.js" %}
{% endhighlight %}


###  JSA Example


{% highlight js linenos %}
{% include "examples/Flyweight/JSA/example.js" %}
{% endhighlight %}


###  TypeScript Example


{% highlight js linenos %}
{% include "examples/Flyweight/TypeScript/example.ts" %}
{% endhighlight %}
