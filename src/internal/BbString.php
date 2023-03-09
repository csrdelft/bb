<?php


namespace CsrDelft\bb\internal;

use CsrDelft\bb\tag\BbNode;

class BbString implements BbNode
{
    /**
     * @var string
     */
    private $string;

    public function __construct(string $string)
    {
        $this->string = $string;
    }

    public function isAllowed()
    {
        return true;
    }

    public function render()
    {
        return $this->string;
    }

    public function getChildren()
    {
        return [];
    }

    public function setContent($content)
    {
        // Nop
    }

    public function getContent()
    {
        return $this->string;
    }

    public function renderPlain()
    {
        return $this->render();
    }

    public function renderPreview()
    {
        return $this->render();
    }

    public function renderLight()
    {
        return $this->render();
    }
}