<?php


namespace CsrDelft\BbBundle\Renderer\Plain;


class PlainItalic implements PlainRenderer
{
    public function getTag()
    {
        return 'italic';
    }

    public function render($content, $arguments)
    {
        return '_' . $content . '_';
    }
}