<?php

namespace CsrDelft\BbParser\Tag;

use CsrDelft\BbParser\BbTag;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 */
class BbUnderline extends BbTag
{
    public static function getTagName(): string
    {
        return 'u';
    }

    public function parse($arguments = []): void
    {
        $this->readContent();
    }

    public function render(): string
    {
        return '<ins class="onderstreept bb-tag-u">' . $this->getContent() . '</ins>';
    }
}
