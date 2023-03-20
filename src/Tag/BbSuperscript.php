<?php

namespace CsrDelft\Lib\Bb\Tag;

use CsrDelft\Lib\Bb\BbTag;

/**
 * Superscript
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @example [sup]Superscript[/sup]
 */
class BbSuperscript extends BbTag
{

    public static function getTagName(): string
    {
        return 'sup';
    }

    public function render($arguments = []): string
    {
        return '<sup class="bb-tag-sup">' . $this->getContent() . '</sup>';
    }

    public function parse($arguments = []): void
    {
        $this->readContent(['sub', 'sup']);
    }
}
