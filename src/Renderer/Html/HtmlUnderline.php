<?php


namespace CsrDelft\BbBundle\Renderer\Html;


use CsrDelft\BbBundle\Parser\Tags\UnderlineParser;

class HtmlUnderline implements HtmlRenderer
{

    public static function getTag()
    {
        return UnderlineParser::class;
    }

    public function render($content, $arguments)
    {
        return '<ins class="onderstreept bb-tag-u">' . $content . '</ins>';
    }
}