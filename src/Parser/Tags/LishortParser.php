<?php

namespace CsrDelft\BbBundle\Parser\Tags;

use CsrDelft\BbBundle\Parser\TagParser;

/**
 * List item (short)
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @example [lishort]First item
 * @example [*]Next item
 */
class LishortParser extends TagParser {

	public static function getTagName() {
		return 'lishort';
	}

	public function render() {
		return '<li class="bb-tag-li">' . $this->getContent() . '</li>';
	}

	public function renderPlain() {
        return " * " . $this->getContent();
    }

    public function parse(\CsrDelft\BbBundle\Parser\Parser $parser, $env, $arguments = [])
    {
        return $this->createTag($parser->parseArray(['[br]']));
    }
}
