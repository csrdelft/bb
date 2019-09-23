<?php

namespace CsrDelft\bb\tag;

use CsrDelft\bb\BbTag;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 */
class BbItalic extends BbTag {
	public function getTagName() {
		return 'i';
	}

	public function render() {
		return '<em class="cursief bb-tag-i">' . $this->content . '</em>';
	}

    public function parse($arguments = [])
    {
        $this->readContent(['i']);
    }
}
