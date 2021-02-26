<?php


namespace CsrDelft\BbBundle\Renderer\Html;


use CsrDelft\BbBundle\Parser\Tags\NewlineParser;

class HtmlNewline implements HtmlRenderer
{
    public static function getTag()
    {
        return NewlineParser::class;
    }

    public function render($content, $arguments)
    {
        return '<br />';
    }
}