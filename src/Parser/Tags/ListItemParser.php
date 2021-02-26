<?php

namespace CsrDelft\BbBundle\Parser\Tags;

use CsrDelft\BbBundle\Parser\Parser;
use CsrDelft\BbBundle\Parser\TagParser;

/**
 * List item
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @example [li]Item[/li]
 */
class ListItemParser extends TagParser{

	public static function getTagName() {
		return 'li';
	}

	public function render() {
		return '<li class="bb-tag-li">' . $this->getContent() . '</li>';
	}

	public function renderPlain() {
        return " * " . $this->getContent();
    }

    public function parse(Parser $parser, $env, $arguments = [])
    {
        return $this->createTag($this->readContent($parser));
    }
}
