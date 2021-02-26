<?php


namespace CsrDelft\BbBundle\Renderer\Plain;


class PlainBold implements PlainRenderer
{
    public function getTag()
    {
        return 'b';
    }

    public function render($content, $arguments)
    {
        return '*' . $content . '*';
    }
}