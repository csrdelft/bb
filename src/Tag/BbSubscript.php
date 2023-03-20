<?php

namespace CsrDelft\Lib\Bb\Tag;

use CsrDelft\Lib\Bb\BbTag;

/**
 * Subscript
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @example [sub]Subscript[/sub]
 */
class BbSubscript extends BbTag
{

    public static function getTagName(): string
    {
        return 'sub';
    }

    public function render($arguments = []): string
    {
        return '<sub class="bb-tag-sub">' . $this->getContent() . '</sub>';
    }

    public function parse($arguments = []): void
    {
        $this->readContent(['sub', 'sup']);
    }
}
