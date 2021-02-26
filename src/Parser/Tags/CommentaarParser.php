<?php

namespace CsrDelft\BbBundle\Parser\Tags;

use CsrDelft\BbBundle\Parser\Parser;
use CsrDelft\BbBundle\Parser\TagParser;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 */
class CommentaarParser extends TagParser
{
    public static function getTagName()
    {
        return 'commentaar';
    }

    public function parse(Parser $parser, $env, $arguments = [])
    {
        $content = $this->readContent($parser, [], false);

        return $this->createTag($content);
    }
}
