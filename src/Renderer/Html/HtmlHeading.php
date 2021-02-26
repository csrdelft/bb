<?php


namespace CsrDelft\BbBundle\Renderer\Html;


use CsrDelft\BbBundle\Parser\Tags\HeadingParser;

class HtmlHeading implements HtmlRenderer
{
    public static function getTag()
    {
        return HeadingParser::class;
    }

    public function render($content, $arguments)
    {
        $id = $arguments['id'] == null ? '' : ' id="' . htmlspecialchars($arguments['id']) . '"';

        return "<h{$arguments['heading_level']}$id class=\"bb-tag-h\">{$content}</h{$arguments['heading_level']}>\n\n";
    }
}