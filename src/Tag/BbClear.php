<?php

namespace CsrDelft\Lib\Bb\Tag;

use CsrDelft\Lib\Bb\BbTag;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 */
class BbClear extends BbTag
{

    /**
     * @var string
     */
    private $clearClass;

    public static function getTagName(): string
    {
        return 'clear';
    }

    public function parse($arguments = []): void
    {
        $this->clearClass = 'clear';
        if (isset($arguments['clear']) && ($arguments['clear'] === 'left' || $arguments['clear'] === 'right')) {
            $this->clearClass .= '-' . $arguments['clear'];
        }
    }

    public function render(): string
    {
        return '<div class="' . $this->clearClass . '"></div>';
    }
}
