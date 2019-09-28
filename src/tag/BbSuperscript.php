<?php

namespace CsrDelft\bb\tag;

use CsrDelft\bb\BbTag;

/**
 * Superscript
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @example [sup]Superscript[/sup]
 */
class BbSuperscript extends BbTag {

	public static function getTagName() {
		return 'sup';
	}

	public function render($arguments = []) {
		return '<sup class="bb-tag-sup">' . $this->content . '</sup>';
	}

    public function parse($arguments = [])
    {
        $this->readContent(['sub', 'sup']);
    }
}
