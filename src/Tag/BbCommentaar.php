<?php

namespace CsrDelft\BbParser\Tag;

use CsrDelft\BbParser\BbTag;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 */
class BbCommentaar extends BbTag
{

    public static function getTagName(): string
    {
        return 'commentaar';
    }

    public function parse($arguments = []): void
    {
        $this->readContent([], false);
    }

    public function render(): string
    {
        return '';
    }
}
