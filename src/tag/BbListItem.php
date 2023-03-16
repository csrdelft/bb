<?php

namespace CsrDelft\bb\tag;

use CsrDelft\bb\BbTag;

/**
 * List item
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @example [li]Item[/li]
 */
class BbListItem extends BbTag
{

    public static function getTagName(): string
    {
        return 'li';
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
        $this->readContent();
    }
}
