<?php

namespace CsrDelft\BbParser\Tag;

use CsrDelft\BbParser\BbTag;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 */
class BbItalic extends BbTag
{
    public static function getTagName(): string
    {
        return 'i';
    }

    public function render(): string
    {
        return '<em class="cursief bb-tag-i">' . $this->getContent() . '</em>';
    }

    public function renderPlain(): string
    {
        return "_" . $this->getContent() . "_";
    }

    public function parse($arguments = []): void
    {
        $this->readContent(['i']);
    }
}
