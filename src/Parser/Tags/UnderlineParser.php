<?php

namespace CsrDelft\BbBundle\Parser\Tags;

use CsrDelft\BbBundle\Parser\TagParser;
use CsrDelft\BbBundle\Parser\Parser;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 */
class UnderlineParser extends TagParser
{
    public static function getTagName()
    {
        return "u";
    }

    public function parse(Parser $parser, $env, $arguments = [])
    {
        return $this->createTag($this->readContent($parser));
    }
}
