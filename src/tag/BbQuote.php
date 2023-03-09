<?php

namespace CsrDelft\bb\tag;

use CsrDelft\bb\BbTag;
use CsrDelft\bb\internal\BbString;

/**
 * Quote
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @example [quote]Citaat[/quote]
 */
class BbQuote extends BbTag {
	public static function getTagName() {
		return 'quote';
	}

	public function renderPlain() {
        return "> " . str_replace("\n", "\n> ", $this->getContent());
    }

	public function renderPreview() {
        return "\"" . str_replace("\n", "\n> ", $this->getContent()) . "\"";
    }

    public function render($arguments = []) {
		return '<div class="citaatContainer bb-tag-quote"><strong>Citaat</strong>' .
			'<div class="citaat">' . $this->getContent() . '</div></div>';
	}

	public static function isParagraphLess() {
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
            $this->setChildren([new BbString("...")]);
        }
    }
}
