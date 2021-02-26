<?php

namespace CsrDelft\BbBundle\Parser\Tags;

use CsrDelft\BbBundle\Parser\Parser;
use CsrDelft\BbBundle\Parser\TagParser;

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
class HeadingParser extends TagParser {

    private $id;
    /**
     * @var int
     */
    private $heading_level = 1;

    public static function getTagName() {
		return 'h';
	}
    public function parse(Parser $parser, $env, $arguments= []) {
        if (isset($arguments['id'])) {
            $this->id = $arguments['id'];
        }
        if (isset($arguments['h'])) {
            $this->heading_level = (int)$arguments['h'];
        }
        $content = $this->readContent($parser, ['h']);
        // remove trailing br (or even two)
        $next_tag = array_shift($parser->parseArray);

        if ($next_tag != '[br]') {
            array_unshift($parser->parseArray, $next_tag);
        } else {
            $next_tag = array_shift($parser->parseArray);
            if ($next_tag != '[br]') {
                array_unshift($parser->parseArray, $next_tag);
            }
        }

        return $this->createTag($content, ['id' => $this->id, 'heading_level' => $this->heading_level]);
    }

    public function getHeadingLevel() {
        return $this->heading_level;
    }


	public function renderPlain() {
        $lines = explode("\n", $this->getContent());
        return $this->getContent() . "\n" . str_repeat("-", strlen(end($lines)));
    }

    public static function isParagraphLess() {
		return true;
	}
}
