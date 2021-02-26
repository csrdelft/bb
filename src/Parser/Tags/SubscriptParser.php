<?php

namespace CsrDelft\BbBundle\Parser\Tags;

use CsrDelft\BbBundle\Parser\Parser;
use CsrDelft\BbBundle\Parser\TagParser;

/**
 * Subscript
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @example [sub]Subscript[/sub]
 */
class SubscriptParser extends TagParser {

	public static function getTagName() {
		return 'sub';
	}

	public function render($arguments = []) {
		return '<sub class="bb-tag-sub">' . $this->getContent() . '</sub>';
	}

    public function parse(Parser $parser, $env, $arguments = [])
    {
        return $this->createTag($this->readContent($parser, ['sub', 'sup']));
    }
}
