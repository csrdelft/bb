<?php

namespace CsrDelft\bb\tag;

use CsrDelft\bb\BbTag;

/**
 * @param string optional $arguments['class'] Class attribute
 * @param boolean optional $arguments['clear'] CSS clear: both
 * @param string optional $arguments['float'] CSS float left or right
 * @param integer optional $arguments['w'] CSS width in pixels
 * @param integer optional $arguments['h'] CSS height in pixels
 *
 * @since 27/03/2019
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @example [div class=special clear float=left w=20 h=50]...[/div]
 */
class BbDiv extends BbTag
{
    /**
     * @var string
     */
    private $class;
    /**
     * @var string
     */
    private $style;
    /**
     * @var string
     */
    private $title;

    public static function getTagName(): string
    {
        return 'div';
    }

    public function parse($arguments = []): void
    {
        $this->readContent();
        $this->class = '';
        if (isset($arguments['class'])) {
            $this->class .= htmlspecialchars($arguments['class']);
        }
        if (isset($arguments['clear'])) {
            $this->class .= ' clear';
        } elseif (isset($arguments['float']) && $arguments['float'] == 'left') {
            $this->class .= ' float-left';
        } elseif (isset($arguments['float']) && $arguments['float'] == 'right') {
            $this->class .= ' float-right';
        }
        if ($this->class != '') {
            $this->class = ' class="bb-tag-div ' . $this->class . '"';
        }
        $this->style = '';
        if (isset($arguments['w'])) {
            $this->style .= 'width: ' . ((int)$arguments['w']) . 'px; ';
        }
        if (isset($arguments['h'])) {
            $this->style .= 'height: ' . ((int)$arguments['h']) . 'px; ';
        }
        if ($this->style != '') {
            $this->style = ' style="' . $this->style . '" ';
        }
        $this->title = '';
        if (isset($arguments['title'])) {
            $this->title = ' title="' . htmlspecialchars(trim(str_replace('_', ' ', $arguments['title']))) . '" ';
        }
    }

    public function render($arguments = []): string
    {
        return '<div' . $this->class . $this->style . $this->title . '>' . $this->getContent() . '</div>';
    }
}
