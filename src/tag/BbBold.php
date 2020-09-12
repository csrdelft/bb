<?php

namespace CsrDelft\bb\tag;

use CsrDelft\bb\BbTag;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 */
class BbBold extends BbTag {
	public static function getTagName() {
		return 'b';
	}

    public function parse($arguments = []) {
        $this->readContent();
    }

    public function renderPlain() {
        if ($this->env->nobold === true && $this->env->quote_level == 0) {
            return $this->content;
        } else {
            return '*' . $this->content . '*';
        }
    }

    public function render() {
		if ($this->env->nobold === true && $this->env->quote_level == 0) {
			return $this->content;
		} else {
			return '<strong class="dikgedrukt bb-tag-b">' . $this->content . '</strong>';
		}
	}
}
