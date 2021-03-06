<?php

namespace CsrDelft\bb\tag;

use CsrDelft\bb\BbTag;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 */
class BbCommentaar extends BbTag {

	public static function getTagName() {
		return 'commentaar';
	}
    public function parse($arguments = []) {
        $this->readContent([], false);
    }
	public function render() {
		return '';
	}
}
