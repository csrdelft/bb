<?php

namespace CsrDelft\Lib\Bb\Tag;

use CsrDelft\Lib\Bb\BbTag;

/**
 * Horizontal line
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @example [hr]
 */
class BbHorizontalRule extends BbTag
{

    public static function getTagName(): string
    {
        return 'hr';
    }

    public function render(): string
    {
        return '<hr class="bb-tag-hr" />';
    }

    public function renderPlain(): string
    {
        return "---";
    }

    public function renderPreview(): string
    {
        return "---";
    }

    public static function isParagraphLess(): bool
    {
        return true;
    }

    public function parse($arguments = []): void
    {
        // No arguments
    }
}
