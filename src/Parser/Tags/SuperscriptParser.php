<?php

namespace CsrDelft\BbBundle\Parser\Tags;

use CsrDelft\BbBundle\Parser\TagParser;
use CsrDelft\BbBundle\Parser\Parser;

/**
 * Superscript
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @example [sup]Superscript[/sup]
 */
class SuperscriptParser extends TagParser {

	public static function getTagName() {
		return 'sup';
	}

	public function render($arguments = []) {
		return '<sup class="bb-tag-sup">' . $this->getContent() . '</sup>';
	}

    public function parse(Parser $parser, $env, $arguments = [])
    {
        return $this->createTag($this->readContent($parser, ['sub', 'sup']));
    }
}
