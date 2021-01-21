<?php

namespace CsrDelft\bb\tag;

use CsrDelft\bb\BbTag;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 */
class BbNobold extends BbTag {
	public static function getTagName() {
		return 'nobold';
	}

	public function render($arguments = []) {
		return $this->getContent();
	}

    public function parse($arguments = [])
    {
        $this->env->nobold = true;
        $this->readContent();
        $this->env->nobold = false;
    }
}
