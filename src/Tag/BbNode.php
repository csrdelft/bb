<?php


namespace CsrDelft\Lib\Bb\Tag;


use CsrDelft\Lib\Bb\BbException;

interface BbNode
{
    /**
     * @throws BbException
     */
    public function renderPlain(): string;

    /**
     * @throws BbException
     */
    public function renderPreview(): string;

    /**
     * @throws BbException
     */
    public function renderLight(): string;

    /**
     * @throws BbException
     */
    public function render(): string;

    /**
     * @return BbNode[]|null
     */
    public function getChildren(): ?array;
    public function setContent(string $content): void;
    public function getContent(): string;
    public function isAllowed(): bool;
}
