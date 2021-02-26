<?php


namespace CsrDelft\BbBundle\Renderer;


interface Renderer
{
    public static function getTag();
    public function render($content, $arguments);
}