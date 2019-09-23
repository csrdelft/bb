<?php

namespace CsrDelft\bb\tag;

use CsrDelft\bb\BbTag;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 */
class BbNobold extends BbTag {
	public function getTagName() {
		return 'nobold';
	}

	public function render($arguments = []) {
		$this->env->nobold = true;
		$return = $this->readContent();
		$this->env->nobold = false;
		return $return;
	}

    public function parse($arguments = [])
    {
    }
}
