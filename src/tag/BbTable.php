<?php

namespace CsrDelft\bb\tag;

use CsrDelft\bb\BbTag;

/**
 * Table
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @param string optional $arguments['border'] CSS border style
 * @param string optional $arguments['color'] CSS color style
 * @param string optional $arguments['background-color'] CSS background-color style
 * @param string optional $arguments['border-collapse'] CSS border-collapse style
 *
 * @example [table border=1px_solid_blue]...[/table]
 */
class BbTable extends BbTag {
    private $styleProperties = [];
	public static function getTagName() {
		return 'table';
	}

	public function render($arguments = []) {
		$style = '';
		foreach ($this->styleProperties as $name => $value) {
		    $style .= $name . ': ' . str_replace('_', ' ', htmlspecialchars($value)) . '; ';
		}

		return '<table class="bb-table bb-tag-table" style="' . $style . '">' . $this->getContent() . '</table>';
	}

	public static function isParagraphLess() {
		return true;
	}

    public function parse($arguments = [])
    {
        $this->readContent(['br']);
        $tableProperties = array('border', 'color', 'background-color', 'border-collapse');
        foreach ($arguments as $name => $value) {
            if (in_array($name, $tableProperties)) {
                $this->styleProperties[$name] = $value;
            }
        }
    }
}
