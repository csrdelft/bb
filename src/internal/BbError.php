<?php


namespace CsrDelft\bb\internal;


use CsrDelft\bb\tag\BbNode;

class BbError implements BbNode
{
    /**
     * @var string
     */
    private $error;

    public function __construct(string $error)
    {
        $this->error = $error;
    }

    public function isAllowed()
    {
        return true;
    }

    public function render()
    {
        return $this->error;
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
        return null;
    }

    public function renderPlain()
    {
        return $this->render();
    }

    public function renderLight()
    {
        return $this->render();
    }
}