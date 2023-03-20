<?php

namespace CsrDelft\Lib\Bb\Tag;

use CsrDelft\Lib\Bb\BbTag;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 */
class BbNewline extends BbTag
{

    public static function getTagName(): string
    {
        return 'rn';
    }

    public function render($arguments = []): string
    {
        return '<br />';
    }

    public function renderPlain(): string
    {
        return "\n";
    }

    public function renderPreview(): string
    {
        return " ";
    }

    public function parse($arguments = []): void
    {
        // No arguments
    }
}
