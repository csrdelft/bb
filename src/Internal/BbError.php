<?php


namespace CsrDelft\BbParser\Internal;


use CsrDelft\BbParser\BbException;
use CsrDelft\BbParser\Tag\BbNode;

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

    public function isAllowed(): bool
    {
        return true;
    }

    public function render(): string
    {
        return $this->error;
    }

    public function getChildren(): array
    {
        return [];
    }

    public function setContent($content): void
    {
        // Nop
    }

    /**
     * @throws BbException
     */
    public function getContent(): string
    {
        throw new BbException("Error heeft geen content");
    }

    public function renderPlain(): string
    {
        return $this->render();
    }

    public function renderPreview(): string
    {
        return $this->render();
    }

    public function renderLight(): string
    {
        return $this->render();
    }
}
