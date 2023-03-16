<?php

namespace CsrDelft\bb\tag;

use CsrDelft\bb\BbTag;

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
class BbMe extends BbTag
{

    private $name;

    public static function getTagName(): string
    {
        return 'me';
    }

    public function render($arguments = []): string
    {
        if ($this->name != null) {
            return '<span style="color:red;">* ' . $this->name . $this->getContent() . '</span>';
        } else {
            return '<span style="color:red;">/me' . $this->getContent() . '</span>';
        }
    }

    public function parse($arguments = []): void
    {
        $this->setChildren($this->parser->parseArray(['[br]']));
        array_unshift($this->parser->parseArray, '[br]');
        $this->name = $arguments['me'] ?? null;
    }
}
