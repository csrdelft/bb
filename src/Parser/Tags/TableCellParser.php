<?php

namespace CsrDelft\BbBundle\Parser\Tags;

use CsrDelft\BbBundle\Parser\TagParser;

/**
 * Table cell
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @param integer optional $arguments['w'] CSS width in pixels
 * @example [td w=50]...[/td]
 */
class TableCellParser extends TagParser {

    private $width;

    public static function getTagName() {
		return 'td';
	}

	public function render($arguments = []) {
		$style = '';
		if ($this->width != null) {
			$style .= 'width: ' . (int)$this->width . 'px; ';
		}

		return '<td class="bb-tag-td" style="' . $style . '">' . $this->getContent() . '</td>';
	}

    public function parse(\CsrDelft\BbBundle\Parser\Parser $parser, $env, $arguments = [])
    {
        return $this->createTag($this->readContent($parser), ['width' => $arguments['w'] ?? null]);
    }
}
