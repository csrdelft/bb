<?php

namespace CsrDelft\BbBundle\Parser\Tags;

use CsrDelft\BbBundle\Parser\Parser;
use CsrDelft\BbBundle\Parser\TagParser;

/**
 * Slash me
 *
 * @param optional String $arguments['me'] Name of who is me
 *
 * @since 27/03/2019
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @example [me] waves
 * @example [me=Name] waves
 */
class MeParser extends TagParser
{

    private $name;

    public static function getTagName()
    {
        return 'me';
    }

    public function render($arguments = [])
    {
        if ($this->name != null) {
            return '<span style="color:red;">* ' . $this->name . $this->getContent() . '</span>';
        } else {
            return '<span style="color:red;">/me' . $this->getContent() . '</span>';
        }
    }

    public function parse(Parser $parser, $env, $arguments = [])
    {
        return $this->createTag($this->readContent($parser, ['br']), ['name' => $arguments['me'] ?? null]);
    }
}
