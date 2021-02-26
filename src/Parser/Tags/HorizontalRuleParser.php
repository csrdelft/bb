<?php

namespace CsrDelft\BbBundle\Parser\Tags;

use CsrDelft\BbBundle\Parser\Parser;
use CsrDelft\BbBundle\Parser\TagParser;

/**
 * Horizontal line
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @example [hr]
 */
class HorizontalRuleParser extends TagParser {

	public static function getTagName() {
		return 'hr';
	}

	public function render() {
		return '<hr class="bb-tag-hr" />';
	}

	public function renderPlain() {
        return "---";
    }

    public static function isParagraphLess() {
		return true;
	}

    public function parse(Parser $parser, $env, $arguments = [])
    {
        // No arguments
        return $this->createTag([]);
    }
}
