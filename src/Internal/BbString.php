<?php


namespace CsrDelft\Lib\Bb\Internal;

use CsrDelft\Lib\Bb\Tag\BbNode;

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

    public function isAllowed(): bool
    {
        return true;
    }

    public function render(): string
    {
        return $this->string;
    }

    public function getChildren(): array
    {
        return [];
    }

    public function setContent($content): void
    {
        // Nop
    }

    public function getContent(): string
    {
        return $this->string;
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
