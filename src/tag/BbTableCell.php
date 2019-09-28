<?php

namespace CsrDelft\bb\tag;

use CsrDelft\bb\BbTag;

/**
 * Table cell
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @param integer optional $arguments['w'] CSS width in pixels
 * @example [td w=50]...[/td]
 */
class BbTableCell extends BbTag {

    private $width;

    public static function getTagName() {
		return 'td';
	}

	public function render($arguments = []) {
		$style = '';
		if ($this->width != null) {
			$style .= 'width: ' . (int)$this->width . 'px; ';
		}

		return '<td class="bb-tag-td" style="' . $style . '">' . $this->content . '</td>';
	}

    public function parse($arguments = [])
    {
        $this->readContent();
        $this->width = $arguments['w'] ?? null;
    }
}
