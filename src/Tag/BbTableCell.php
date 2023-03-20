<?php

namespace CsrDelft\Lib\Bb\Tag;

use CsrDelft\Lib\Bb\BbTag;

/**
 * Table cell
 *
 * @param integer optional $arguments['w'] CSS width in pixels
 * @since 27/03/2019
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @example [td w=50]...[/td]
 */
class BbTableCell extends BbTag
{

    private $width;

    public static function getTagName(): string
    {
        return 'td';
    }

    public function render($arguments = []): string
    {
        $style = '';
        if ($this->width != null) {
            $style .= 'width: ' . (int)$this->width . 'px; ';
        }

        return '<td class="bb-tag-td" style="' . $style . '">' . $this->getContent() . '</td>';
    }

    public function parse($arguments = []): void
    {
        $this->readContent();
        $this->width = $arguments['w'] ?? null;
    }
}
