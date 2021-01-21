<?php

namespace CsrDelft\bb\tag;

use CsrDelft\bb\BbTag;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 */
class BbBold extends BbTag {
    private $disabled = false;

	public static function getTagName() {
		return 'b';
	}

    public function parse($arguments = []) {
	    if ($this->env->nobold === true && $this->env->quote_level == 0) {
	        $this->disabled = true;
        }
        $this->readContent();
    }

    public function renderPlain() {
        if ($this->disabled) {
            return $this->getContent();
        } else {
            return '*' . $this->getContent() . '*';
        }
    }

    public function render() {
		if ($this->disabled) {
			return $this->getContent();
		} else {
			return '<strong class="dikgedrukt bb-tag-b">' . $this->getContent() . '</strong>';
		}
	}
}
