<?php

namespace CsrDelft\Lib\Bb\Tag;

use CsrDelft\Lib\Bb\BbTag;

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
class BbList extends BbTag
{

    private $type;

    public static function getTagName(): array
    {
        return ['list', 'ulist'];
    }

    public function render(): string
    {
        if ($this->type == null) {
            return "<ul class=\"bb-tag-list\">{$this->getContent()}</ul>";
        } else {
            return "<ol class=\"bb-tag-list\" type=\"$this->type\" >{$this->getContent()}</ol>";
        }

    }

    public function parse($arguments = []): void
    {
        $this->readContent(['br']);
        $this->type = $arguments['list'] ?? null;
    }
}
