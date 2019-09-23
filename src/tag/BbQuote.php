<?php

namespace CsrDelft\bb\tag;

use CsrDelft\bb\BbTag;

/**
 * Quote
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @example [quote]Citaat[/quote]
 */
class BbQuote extends BbTag {
	public function getTagName() {
		return 'quote';
	}

	public function render($arguments = []) {
		return '<div class="citaatContainer bb-tag-quote"><strong>Citaat</strong>' .
			'<div class="citaat">' . $this->content . '</div></div>';
	}

	public function isParagraphLess() {
		return true;
	}

    public function parse($arguments = [])
    {
        if ($this->env->quote_level == 0) {
            $this->env->quote_level = 1;
            $this->readContent();
            $this->env->quote_level = 0;
        } else {
            $this->env->quote_level++;
            $this->readContent();
            $this->env->quote_level--;
            $this->content = '...';
        }
    }
}
