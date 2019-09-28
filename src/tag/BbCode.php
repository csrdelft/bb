<?php

namespace CsrDelft\bb\tag;

use CsrDelft\bb\BbTag;

/**
 * Code
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @param optional String $arguments['code'] Description of code type
 *
 * @example [code=PHP]phpinfo();[/code]
 */
class BbCode extends BbTag {

    /**
     * @var string
     */
    private $code;

    public static function getTagName() {
		return 'code';
	}

    public function parse($arguments = []) {
        $this->readContent(['br'], false);
        $this->code = isset($arguments['code']) ? $arguments['code'] . ' ' : '';
    }

	public function render() {
		return '<div class="bb-tag-code"><sub>' . $this->code . 'code:</sub><pre class="bbcode">' . $this->content . '</pre></div>';
	}
}
