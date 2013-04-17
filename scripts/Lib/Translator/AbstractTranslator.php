<?php
/**
 *
 * @package scripts
 * @author Dmitry Sheiko <me@dsheiko.com>
 * @licence MIT
 */
namespace Translator;
abstract class AbstractTranslator
{
    abstract public function translate($markup);
}