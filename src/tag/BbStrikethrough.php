<?php

namespace CsrDelft\bb\tag;

use CsrDelft\bb\BbTag;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 */
class BbStrikethrough extends BbTag {

	public static function getTagName() {
		return 's';
	}

	public function render($arguments = []) {
		return '<del class="doorstreept bb-tag-s">' . $this->content . '</del>';
	}

    public function parse($arguments = [])
    {
        $this->readContent(['s']);
    }
}
