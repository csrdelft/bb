<?php

namespace CsrDelft\bb\tag;

use CsrDelft\bb\BbTag;

/**
 * Table row
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @example [tr]...
 * @example [tr]...[/tr]
 */
class BbTableRow extends BbTag
{

    public static function getTagName(): string
    {
        return 'tr';
    }

    public function render($arguments = []): string
    {
        return '<tr class="bb-tag-tr">' . $this->getContent() . '</tr>';
    }

    public function parse($arguments = []): void
    {
        $this->readContent(['br']);
    }
}
