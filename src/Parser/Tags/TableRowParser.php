<?php

namespace CsrDelft\BbBundle\Parser\Tags;

use CsrDelft\BbBundle\Parser\TagParser;

/**
 * Table row
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @example [tr]...
 * @example [tr]...[/tr]
 */
class TableRowParser extends TagParser {

	public static function getTagName() {
		return 'tr';
	}

	public function render($arguments = []) {
		return '<tr class="bb-tag-tr">' . $this->getContent() . '</tr>';
	}

    public function parse(\CsrDelft\BbBundle\Parser\Parser $parser, $env, $arguments = [])
    {
        return $this->createTag($this->readContent($parser, ['br']));
    }
}
