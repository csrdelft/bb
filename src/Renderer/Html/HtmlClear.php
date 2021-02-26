<?php


namespace CsrDelft\BbBundle\Renderer\Html;


use CsrDelft\BbBundle\Parser\Tags\ClearParser;

class HtmlClear implements HtmlRenderer
{
    public static function getTag()
    {
        return ClearParser::class;
    }

    public function render($content, $arguments)
    {
        return '<div class="' . $arguments['clearClass'] . '">' . $content . '</div>';
    }
}