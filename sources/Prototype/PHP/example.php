<?php
/*
 * @category Design Pattern Tutorial
 * @package Prototype Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

/*
 Let's assume, we deal with micro-formats in our application. The application is built on the framework, which already has base class (Element) for HTML element objects. Thus, every element makes an instance of this class.
Micro-format elements are HTML elements, which are marked in special way by the class attribute. So, to get them, we could subclass Element. However, that would produce a lot of subclasses, which differ only by the micro-format type the derived objects represent. Besides, it would be inconsistent to the framework design.
How do we solve it? Instead of generalization we will use composition. We create an HTML element object by instantiating Element class.  We pass to the constructor tag name to specify which exact element it is. Now we have a state-full object, which we clone every time we need a new a micro-format element object.
 *
*/
namespace Framework\Html;

final class Element
{
    protected $_tag;
    protected $_class;
    protected $_content;
    protected $_childElements = array();


    public function __construct($tag)
    {
        $this->_tag = $tag;
    }
    public function setClass($class)
    {
        $this->_class = $class;
        return $this;
    }
    public function setContent($content)
    {
        $this->_content = $content;
        return $this;
    }
    public function addChild(array $elements)
    {
        $this->_childElements = $elements;
        return $this;
    }

    public function render()
    {
        return strtr('<%tag% class="%class%">'
            . '%content% %childElements%</%tag%>'
            . PHP_EOL, array(
            "%tag%" => $this->_tag,
            "%content%" => $this->_content,
            "%childElements%" => array_reduce($this->_childElements
                , function($res, $el) {
                $el && ($res .= PHP_EOL . $el->render());
                return $res;
            }, ""),
            "%class%" => $this->_class,
        ));
    }
}

/**
 * Usage
 */
$div = new \Framework\Html\Element("div");
$span = new \Framework\Html\Element("span");

$fn = clone $span;
$fn->setClass("fn")->setContent("John Snow");

$org = clone $span;
$org->setClass("org")->setContent("Night Watch");

$vcard = clone $div;
print $vcard->setClass("vcard")->addChild(array($fn, $org))->render();

// Output

// <div class="vcard">
// <span class="fn">John Snow </span>
//
// <span class="org">Night Watch </span>
// </div>
