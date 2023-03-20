<?php

namespace CsrDelft\Lib\Bb\Tag;

use CsrDelft\Lib\Bb\BbTag;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 */
class BbStrikethrough extends BbTag
{

    public static function getTagName(): string
    {
        return 's';
    }

    public function render($arguments = []): string
    {
        return '<del class="doorstreept bb-tag-s">' . $this->getContent() . '</del>';
    }

    public function renderPlain(): string
    {
        return "~" . $this->getContent() . "~";
    }

    public function parse($arguments = []): void
    {
        $this->readContent(['s']);
    }
}
