<?php

namespace CsrDelft\BbBundle\Parser\Tags;

use CsrDelft\BbBundle\Parser\BbTag;
use CsrDelft\BbBundle\Parser\TagParser;
use CsrDelft\BbBundle\Parser\Parser;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 */
class NoboldParser extends TagParser {
	public static function getTagName() {
		return 'nobold';
	}

	public function render($arguments = []) {
		return $this->getContent();
	}

    public function parse(Parser $parser, $env, $arguments = [])
    {
        $parser->getEnv()->nobold = true;
        $content = $this->readContent($parser);
        $parser->getEnv()->nobold = false;

        return new BbTag('nobold', $content);
    }
}
