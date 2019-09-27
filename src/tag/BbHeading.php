<?php

namespace CsrDelft\bb\tag;

use CsrDelft\bb\BbTag;

/**
 * Heading
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @param Integer $arguments ['h'] Heading level (1-6)
 * @param string optional $arguments['id'] ID attribute
 *
 * @example [h=1 id=special]Heading[/h]
 */
class BbHeading extends BbTag {

    private $id;
    /**
     * @var int
     */
    private $heading_level = 1;

    public static function getTagName() {
		return 'h';
	}
    public function parse($arguments= []) {
        if (isset($arguments['id'])) {
            $this->id = $arguments['id'];
        }
        if (isset($arguments['h'])) {
            $this->heading_level = (int)$arguments['h'];
        }
        $this->readContent(['h']);
        // remove trailing br (or even two)
        $next_tag = array_shift($this->parser->parseArray);

        if ($next_tag != '[br]') {
            array_unshift($this->parser->parseArray, $next_tag);
        } else {
            $next_tag = array_shift($this->parser->parseArray);
            if ($next_tag != '[br]') {
                array_unshift($this->parser->parseArray, $next_tag);
            }
        }
    }

	public function render() {
		$id = $this->id == null ? '' : ' id="' . htmlspecialchars($this->id) . '"';
		$text = "<h$this->heading_level$id class=\"bb-tag-h\">$this->content</h$this->heading_level>\n\n";
		return $text;
	}

	public static function isParagraphLess() {
		return true;
	}
}
