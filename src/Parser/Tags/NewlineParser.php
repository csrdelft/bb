<?php

namespace CsrDelft\BbBundle\Parser\Tags;

use CsrDelft\BbBundle\Parser\TagParser;
use CsrDelft\BbBundle\Parser\Parser;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 */
class NewlineParser extends TagParser {

	public static function getTagName() {
		return 'rn';
	}

	public function renderPlain() {
        return "\n";
    }

    public function parse(Parser $parser, $env, $arguments = [])
    {
        return $this->createTag([]);
    }
}
