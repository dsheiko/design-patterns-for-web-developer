<?php
/*
 * @category Design Pattern Tutorial
 * @package AbstractFactory Sample
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */

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
