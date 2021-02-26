<?php

namespace CsrDelft\BbBundle\Parser\Tags;

use CsrDelft\BbBundle\Parser\TagParser;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 */
class StrikethroughParser extends TagParser {

	public static function getTagName() {
		return 's';
	}

	public function render($arguments = []) {
		return '<del class="doorstreept bb-tag-s">' . $this->getContent() . '</del>';
	}

	public function renderPlain() {
        return "~" . $this->getContent() . "~";
    }

    public function parse(\CsrDelft\BbBundle\Parser\Parser $parser, $env, $arguments = [])
    {
        return $this->createTag($this->readContent($parser, ['s']));
    }
}
