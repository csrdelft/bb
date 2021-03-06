<?php

namespace CsrDelft\bb\tag;

use CsrDelft\bb\BbTag;

/**
 * Slash me
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @param optional String $arguments['me'] Name of who is me
 *
 * @example [me] waves
 * @example [me=Name] waves
 */
class BbMe extends BbTag {

    private $name;

    public static function getTagName() {
		return 'me';
	}

	public function render($arguments = []) {
		if ($this->name != null) {
			return '<span style="color:red;">* ' . $this->name . $this->getContent() . '</span>';
		} else {
			return '<span style="color:red;">/me' . $this->getContent() . '</span>';
		}
	}

    public function parse($arguments = [])
    {
        $this->setChildren($this->parser->parseArray(['[br]']));
        array_unshift($this->parser->parseArray, '[br]');
        $this->name = $arguments['me'] ?? null;
    }
}
