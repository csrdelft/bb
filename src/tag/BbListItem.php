<?php

namespace CsrDelft\bb\tag;

use CsrDelft\bb\BbTag;

/**
 * List item
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @example [li]Item[/li]
 */
class BbListItem extends BbTag{

	public static function getTagName() {
		return 'li';
	}

	public function render() {
		return '<li class="bb-tag-li">' . $this->getContent() . '</li>';
	}

	public function renderPlain() {
        return " * " . $this->getContent();
    }

    public function parse($arguments = [])
    {
        $this->readContent();
    }
}
