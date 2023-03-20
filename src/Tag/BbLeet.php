<?php

namespace CsrDelft\Lib\Bb\Tag;

use CsrDelft\Lib\Bb\BbTag;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 */
class BbLeet extends BbTag
{

    public static function getTagName(): string
    {
        return '1337';
    }

    public function render(): string
    {
        $html = $this->getContent();
        $html = str_replace('er ', '0r ', $html);
        $html = str_replace('you', 'j00', $html);
        $html = str_replace('elite', '1337', $html);
        return strtr($html, "abelostABELOST", "48310574831057");
    }

    public function parse($arguments = []): void
    {
        $this->readContent();
    }
}
