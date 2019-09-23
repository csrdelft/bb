<?php

namespace CsrDelft\bb\tag;

use CsrDelft\bb\BbTag;

/**
 * Table row
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @example [tr]...
 * @example [tr]...[/tr]
 */
class BbTableRow extends BbTag {

	public function getTagName() {
		return 'tr';
	}

	public function render($arguments = []) {
		return '<tr class="bb-tag-tr">' . $this->content . '</tr>';
	}

    public function parse($arguments = [])
    {
        $this->readContent(['br']);
    }
}
