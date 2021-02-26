<?php


namespace CsrDelft\BbBundle\Renderer\Html;


use CsrDelft\BbBundle\Parser\Tags\BoldParser;

class HtmlBold implements HtmlRenderer
{

    public static function getTag()
    {
        return BoldParser::class;
    }

    public function render($content, $arguments)
    {
        if ($arguments['disabled']) {
            return $content;
        } else {
            return '<strong class="dikgedrukt bb-tag-b">' . $content . '</strong>';
        }
    }
}