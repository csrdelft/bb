<?php

namespace CsrDelft\bb\tag;

use CsrDelft\bb\BbTag;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 */
class BbNewline extends BbTag {

	public function getTagName() {
		return 'rn';
	}

	public function parse($arguments = []) {
		return '<br />';
	}
}
