<?php

namespace CsrDelft\BbBundle\Parser\Tags;

use CsrDelft\BbBundle\Parser\BbTag;
use CsrDelft\BbBundle\Parser\TagParser;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 */
class ItalicParser extends TagParser
{
    public static function getTagName()
    {
        return 'i';
    }

    public function parse(\CsrDelft\BbBundle\Parser\Parser $parser, $env, $arguments = [])
    {
        $content = $this->readContent($parser, ['i']);

        return new BbTag('i', $content);
    }
}
