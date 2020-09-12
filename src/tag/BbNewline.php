<?php

namespace CsrDelft\bb\tag;

use CsrDelft\bb\BbTag;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 */
class BbNewline extends BbTag {

	public static function getTagName() {
		return 'rn';
	}

	public function render($arguments = []) {
		return '<br />';
	}

	public function renderPlain() {
        return "\n";
    }

    public function parse($arguments = [])
    {
    }
}
