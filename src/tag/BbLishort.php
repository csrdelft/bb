<?php

namespace CsrDelft\bb\tag;

use CsrDelft\bb\BbTag;

/**
 * List item (short)
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @example [lishort]First item
 * @example [*]Next item
 */
class BbLishort extends BbTag {

	public static function getTagName() {
		return ['lishort', '*'];
	}

	public function render() {
		return '<li class="bb-tag-li">' . $this->getContent() . '</li>';
	}

	public function renderPlain() {
        return " * " . $this->getContent();
    }

	public function renderPreview() {
        return " - " . $this->getContent();
    }

    public function parse($arguments = [])
    {
        $this->setChildren($this->parser->parseArray(['[br]']));
    }
}
