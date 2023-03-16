<?php

namespace CsrDelft\BbParser\Tag;

use CsrDelft\BbParser\BbTag;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 */
class BbNobold extends BbTag
{
    public static function getTagName(): string
    {
        return 'nobold';
    }

    public function render($arguments = []): string
    {
        return $this->getContent();
    }

    public function parse($arguments = []): void
    {
        $this->env->nobold = true;
        $this->readContent();
        $this->env->nobold = false;
    }
}
