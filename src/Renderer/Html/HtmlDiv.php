<?php


namespace CsrDelft\BbBundle\Renderer\Html;


use CsrDelft\BbBundle\Parser\Tags\DivParser;

class HtmlDiv implements HtmlRenderer
{
    public static function getTag()
    {
        return DivParser::class;
    }

    public function render($content, $arguments)
    {
        $class = $arguments['class'];
        $style = $arguments['style'];
        $title = $arguments['title'];

        return '<div' . $class . $style . $title . '>' . $content . '</div>';
    }
}