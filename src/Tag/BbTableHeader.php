<?php

namespace CsrDelft\BbParser\Tag;

use CsrDelft\BbParser\BbTag;

/**
 * Table header cell
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @example [th]...[/th]
 */
class BbTableHeader extends BbTag
{
    public static function getTagName(): string
    {
        return 'th';
    }

    public function render($arguments = []): string
    {
        return '<th class="bb-tag-th">' . $this->getContent() . '</th>';
    }

    public function parse($arguments = []): void
    {
        $this->readContent();
    }
}
