<?php

namespace CsrDelft\BbBundle\Parser\Tags;

use CsrDelft\BbBundle\Parser\TagParser;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 */
class LeetParser extends TagParser {

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

    public function parse(\CsrDelft\BbBundle\Parser\Parser $parser, $env, $arguments = [])
    {
        return $this->createTag($this->readContent($parser));
    }
}
