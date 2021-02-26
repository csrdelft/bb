<?php

namespace CsrDelft\BbBundle\Parser\Tags;

use CsrDelft\BbBundle\Parser\Parser;
use CsrDelft\BbBundle\Parser\TagParser;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 *
 * @param string optional $arguments['class'] Class attribute
 * @param boolean optional $arguments['clear'] CSS clear: both
 * @param string optional $arguments['float'] CSS float left or right
 * @param integer optional $arguments['w'] CSS width in pixels
 * @param integer optional $arguments['h'] CSS height in pixels
 *
 * @example [div class=special clear float=left w=20 h=50]...[/div]
 */
class DivParser extends TagParser {
    public static function getTagName() {
		return 'div';
	}

	public function parse(Parser $parser, $env, $arguments = []) {
        $content = $this->readContent($parser);

        $class = '';
        if (isset($arguments['class'])) {
            $class .= htmlspecialchars($arguments['class']);
        }
        if (isset($arguments['clear'])) {
            $class .= ' clear';
        } elseif (isset($arguments['float']) && $arguments['float'] == 'left') {
            $class .= ' float-left';
        } elseif (isset($arguments['float']) && $arguments['float'] == 'right') {
            $class .= ' float-right';
        }
        if ($class != '') {
            $class = ' class="bb-tag-div ' . $class . '"';
        }
        $style = '';
        if (isset($arguments['w'])) {
            $style .= 'width: ' . ((int)$arguments['w']) . 'px; ';
        }
        if (isset($arguments['h'])) {
            $style .= 'height: ' . ((int)$arguments['h']) . 'px; ';
        }
        if ($style != '') {
            $style = ' style="' . $style . '" ';
        }
        $title = '';
        if (isset($arguments['title'])) {
            $title = ' title="' . htmlspecialchars(trim(str_replace('_', ' ', $arguments['title']))) . '" ';
        }

        return $this->createTag($content, [
            'class' => $class,
            'style' => $style,
            'title' => $title,
        ]);
    }
}
