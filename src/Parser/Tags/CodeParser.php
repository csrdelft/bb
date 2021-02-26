<?php

namespace CsrDelft\BbBundle\Parser\Tags;

use CsrDelft\BbBundle\Parser\Parser;
use CsrDelft\BbBundle\Parser\TagParser;

/**
 * Code
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @param optional String $arguments['code'] Description of code type
 *
 * @example [code=PHP]phpinfo();[/code]
 */
class CodeParser extends TagParser {

    /**
     * @var string
     */
    private $code;

    public static function getTagName() {
		return 'code';
	}

    public function parse(Parser $parser, $env, $arguments = []) {
        $content = $this->readContent($parser, ['br'], false);
        $code = isset($arguments['code']) ? $arguments['code'] . ' ' : '';

        return $this->createTag($content, ['code' => $code]);
    }

    public function renderPlain() {
        return "$this->code\n\t" . str_replace("\n", "\n\t", $this->getContent());
    }
}
