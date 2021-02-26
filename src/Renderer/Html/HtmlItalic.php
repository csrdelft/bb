<?php


namespace CsrDelft\BbBundle\Renderer\Html;


use CsrDelft\BbBundle\Parser\Tags\ItalicParser;

class HtmlItalic implements HtmlRenderer
{
    public static function getTag()
    {
        return ItalicParser::class;
    }

    public function render($content, $arguments)
    {
        return '<em class="cursief bb-tag-i">' . $content . '</em>';
    }
}