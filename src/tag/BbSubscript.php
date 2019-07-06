<?php

namespace CsrDelft\bb\tag;

use CsrDelft\bb\BbTag;

/**
 * Subscript
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @example [sub]Subscript[/sub]
 */
class BbSubscript extends BbTag {

	public function getTagName() {
		return 'sub';
	}

	public function parse($arguments = []) {
		return '<sub class="bb-tag-sub">' . $this->getContent(['sub', 'sup']) . '</sub>';
	}
}
