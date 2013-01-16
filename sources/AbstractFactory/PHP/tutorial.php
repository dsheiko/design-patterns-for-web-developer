<?php
/*
 * @category Design Pattern Tutorial
 * @package AbstractFactory Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */


// File: ./Application.php

// Client
class Application
{
    private $_config;
    public function __construct($config)
    {
        $this->_config = $config;
    }
    private function _createPlaformSpecificFactory()
    {
        $className = "\\Widget\\Factory\\" . ucfirst($this->_config->platform);
        return new $className;
    }
    public function build()
    {
        $factory = $this->_createPlaformSpecificFactory();
        $dialog = $factory->makeDialog();
        $dialog->render();
        $button = $factory->makeButton();
        $button->render();
    }
}


// File: ./Config.php

// Object specifiers
class Config
{
    public $platform;
}


// File: ./Widget/Button/Desktop.php

namespace Widget\Button;

// Concrete Product
class Desktop implements \Widget\Button\iButton
{
    public function render()
    {
        print "jQueryUI based button";
    }
}

// File: ./Widget/Button/iButton.php
namespace Widget\Button;

// Abstract Product
interface iButton
{
    public function render();
}

// File: ./Widget/Button/Mobile.php

namespace Widget\Button;

// Concrete Product
class Mobile implements \Widget\Button\iButton
{
    public function render()
    {
        print "jQueryMobile based button";
    }
}

// File: ./Widget/Dialog/Desktop.php
namespace Widget\Dialog;

// Concrete Product
class Desktop implements \Widget\Dialog\iDialog
{
    public function render()
    {
        print "jQueryUI based dialog";
    }
}

// File: ./Widget/Dialog/iDialog.php

namespace Widget\Dialog;

// Abstract Product
interface iDialog
{
    public function render();
}

// File: ./Widget/Dialog/Mobile.php

namespace Widget\Dialog;

// Concrete Product
class Mobile implements \Widget\Dialog\iDialog
{
    public function render()
    {
        print "jQueryMobile based dialog";
    }
}

// File: ./Widget/Factory/AbstractFactory.php

namespace Widget\Factory;

// Abstract Factory
abstract class AbstractFactory
{
    abstract public function makeDialog();
    abstract public function makeButton();
}

// File: ./Widget/Factory/Desktop.php

namespace Widget\Factory;

// Concrete Factory
class Desktop extends AbstractFactory
{
    public function makeDialog()
    {
        return new \Widget\Dialog\Desktop();
    }
    public function makeButton()
    {
        return new \Widget\Button\Desktop();
    }
}

// File: ./Widget/Factory/Mobile.php

namespace Widget\Factory;

// Concrete Factory
class Mobile extends AbstractFactory
{
    public function makeDialog()
    {
        return new \Widget\Dialog\Mobile();
    }
    public function makeButton()
    {
        return new \Widget\Button\Mobile();
    }
}
//File: example.php

/**
 * Usage
 */
include "./Widget/Factory/AbstractFactory.php";
include "./Widget/Factory/Desktop.php";
include "./Widget/Factory/Mobile.php";
include "./Widget/Dialog/iDialog.php";
include "./Widget/Dialog/Desktop.php";
include "./Widget/Dialog/Mobile.php";
include "./Widget/Button/iButton.php";
include "./Widget/Button/Desktop.php";
include "./Widget/Button/Mobile.php";
include "./Config.php";
include "./Application.php";

$config = new Config();
$config->platform = "mobile";
$app = new Application($config);
$app->build();

/*
 * Output
 */
// jQueryMobile based dialog
// jQueryMobile based button