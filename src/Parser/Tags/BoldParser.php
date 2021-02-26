<?php

namespace CsrDelft\BbBundle\Parser\Tags;

use CsrDelft\BbBundle\Parser\BbTag;
use CsrDelft\BbBundle\Parser\TagParser;
use CsrDelft\BbBundle\Parser\Parser;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 */
class BoldParser extends TagParser
{
    public static function getTagName()
    {
        return 'b';
    }

    public function parse(Parser $parser, $env, $arguments = [])
    {
        $disabled = false;

        if ($parser->getEnv()->nobold === true && $parser->getEnv()->quote_level == 0) {
            $disabled = true;
        }

        $content = $this->readContent($parser);

        return $this->createTag($content, ['disabled' => $disabled]);
    }
}
