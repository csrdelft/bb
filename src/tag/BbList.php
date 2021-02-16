<?php

namespace CsrDelft\bb\tag;

use CsrDelft\bb\BbTag;

/**
 * List
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @param optional String $arguments['list'] Type of ordered list
 *
 * @example [list]Unordered list[/list]
 * @example [ulist]Unordered list[/ulist]
 * @example [list=a]Ordered list numbered with lowercase letters[/list]
 */
class BbList extends BbTag {

    private $type;

    public static function getTagName() {
		return ['list', 'ulist'];
	}

	public function render() {
        if ($this->type == null) {
            return "<ul class=\"bb-tag-list\">{$this->getContent()}</ul>";
        } else {
            return "<ol class=\"bb-tag-list\" type=\"$this->type\" >{$this->getContent()}</ol>";
        }

	}


    public function parse($arguments = [])
    {
        $this->readContent(['br']);
        $this->type = $arguments['list'] ?? null;
    }
}
