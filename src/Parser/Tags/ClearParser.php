<?php

namespace CsrDelft\BbBundle\Parser\Tags;

use CsrDelft\BbBundle\Parser\BbTag;
use CsrDelft\BbBundle\Parser\TagParser;
use CsrDelft\BbBundle\Parser\Parser;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 */
class ClearParser extends TagParser {
    public static function getTagName() {
		return 'clear';
	}

    public function parse(Parser $parser, $env, $arguments = []) {
        $clearClass = 'clear';
        if (isset($arguments['clear']) && ($arguments['clear'] === 'left' || $arguments['clear'] === 'right')) {
            $clearClass .= '-' . $arguments['clear'];
        }

        return $this->createTag([], ['clearClass' => $clearClass]);
    }
}
