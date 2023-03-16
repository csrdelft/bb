<?php

namespace CsrDelft\BbParser\Tag;

use CsrDelft\BbParser\BbTag;

/**
 * List item (short)
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @example [lishort]First item
 * @example [*]Next item
 */
class BbLishort extends BbTag
{

    public static function getTagName(): array
    {
        return ['lishort', '*'];
    }

    public function render(): string
    {
        return '<li class="bb-tag-li">' . $this->getContent() . '</li>';
    }

    public function renderPlain(): string
    {
        return " * " . $this->getContent();
    }

    public function renderPreview(): string
    {
        return " - " . $this->getContent();
    }

    public function parse($arguments = []): void
    {
        $this->setChildren($this->parser->parseArray(['[br]']));
    }
}