<?php


namespace CsrDelft\BbBundle\Renderer\Html;


use CsrDelft\BbBundle\Parser\Tags\CommentaarParser;

class HtmlCommentaar implements HtmlRenderer
{
    public static function getTag()
    {
        return CommentaarParser::class;
    }

    public function render($content, $arguments)
    {
        return '';
    }
}