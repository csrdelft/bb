<?php

namespace CsrDelft\bb\tag;

use CsrDelft\bb\BbTag;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 */
class BbUnderline extends BbTag{
	public static function getTagName() {
		return 'u';
	}
    public function parse($arguments = []) {
        $this->readContent();
    }
	public function render() {
		return '<ins class="onderstreept bb-tag-u">' . $this->getContent() . '</ins>';
	}
}
