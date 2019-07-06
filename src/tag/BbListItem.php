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

	public function getTagName() {
		return 'li';
	}

	public function parse($arguments = []) {
		return '<li class="bb-tag-li">' . $this->getContent() . '</li>';
	}
}
