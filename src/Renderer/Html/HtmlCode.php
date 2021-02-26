<?php


namespace CsrDelft\BbBundle\Renderer\Html;


use CsrDelft\BbBundle\Parser\Tags\CodeParser;

class HtmlCode implements HtmlRenderer
{

    public static function getTag()
    {
        return CodeParser::class;
    }

    public function render($content, $arguments)
    {
        return '<div class="bb-tag-code"><sub>' . $arguments['code'] . 'code:</sub><pre class="bbcode">' . $content . '</pre></div>';
    }
}