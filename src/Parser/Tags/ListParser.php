<?php

namespace CsrDelft\BbBundle\Parser\Tags;

use CsrDelft\BbBundle\Parser\TagParser;

/**
 * List
 *
 * @param optional String $arguments['list'] Type of ordered list
 *
 * @since 27/03/2019
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @example [list]Unordered list[/list]
 * @example [ulist]Unordered list[/ulist]
 * @example [list=a]Ordered list numbered with lowercase letters[/list]
 */
class ListParser extends TagParser
{

    private $type;

    public static function getTagName()
    {
        return 'list';
    }

    public function render()
    {
        if ($this->type == null) {
            return "<ul class=\"bb-tag-list\">{$this->getContent()}</ul>";
        } else {
            return "<ol class=\"bb-tag-list\" type=\"$this->type\" >{$this->getContent()}</ol>";
        }

    }


    public function parse(\CsrDelft\BbBundle\Parser\Parser $parser, $env, $arguments = [])
    {
        return $this->createTag($this->readContent($parser, ['br']), ['type' => $arguments['list'] ?? null]);
    }
}
