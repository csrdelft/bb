<?php

namespace CsrDelft\bb\tag;

use CsrDelft\bb\BbTag;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 */
class BbClear extends BbTag {

    /**
     * @var string
     */
    private $clearClass;

    public static function getTagName() {
		return 'clear';
	}

    public function parse($arguments = []) {
        $this->clearClass = 'clear';
        if (isset($arguments['clear']) && ($arguments['clear'] === 'left' || $arguments['clear'] === 'right')) {
            $this->clearClass .= '-' . $arguments['clear'];
        }
    }

	public function render() {
		return '<div class="' . $this->clearClass . '"></div>';
	}
}
