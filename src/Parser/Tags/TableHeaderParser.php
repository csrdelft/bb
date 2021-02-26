<?php

namespace CsrDelft\BbBundle\Parser\Tags;

use CsrDelft\BbBundle\Parser\Parser;
use CsrDelft\BbBundle\Parser\TagParser;

/**
 * Table header cell
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @example [th]...[/th]
 */
class TableHeaderParser extends TagParser {
	public static function getTagName() {
		return 'th';
	}

	public function render($arguments = []) {
		return '<th class="bb-tag-th">' . $this->getContent() . '</th>';
	}

    public function parse(Parser $parser, $env, $arguments = [])
    {
        return $this->createTag($this->readContent($parser));
    }
}
