<?php

namespace CsrDelft\bb\tag;

use CsrDelft\bb\BbTag;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 */
class BbLeet extends BbTag {

	public static function getTagName() {
		return '1337';
	}

	public function render() {
		$html = $this->getContent();
		$html = str_replace('er ', '0r ', $html);
		$html = str_replace('you', 'j00', $html);
		$html = str_replace('elite', '1337', $html);
		return strtr($html, "abelostABELOST", "48310574831057");
	}

    public function parse($arguments = [])
    {
        $this->readContent();
    }
}
