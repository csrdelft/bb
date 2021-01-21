<?php

namespace CsrDelft\bb\tag;

use CsrDelft\bb\BbTag;

/**
 * Horizontal line
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @example [hr]
 */
class BbHorizontalRule extends BbTag {

	public static function getTagName() {
		return 'hr';
	}

	public function render() {
		return '<hr class="bb-tag-hr" />';
	}

	public function renderPlain() {
        return "---";
    }

    public static function isParagraphLess() {
		return true;
	}

    public function parse($arguments = [])
    {
        // No arguments
    }
}
