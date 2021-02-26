<?php

namespace CsrDelft\BbBundle\Parser\Tags;

use CsrDelft\BbBundle\Parser\BbTag;
use CsrDelft\BbBundle\Parser\TagParser;
use CsrDelft\BbBundle\Parser\Parser;

/**
 * Quote
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @example [quote]Citaat[/quote]
 */
class QuoteParser extends TagParser
{
    public static function getTagName()
    {
        return 'quote';
    }

    public static function isParagraphLess()
    {
        return true;
    }

    public function renderPlain()
    {
        return "> " . str_replace("\n", "\n> ", $this->getContent());
    }

    public function render($arguments = [])
    {
        return '<div class="citaatContainer bb-tag-quote"><strong>Citaat</strong>' .
            '<div class="citaat">' . $this->getContent() . '</div></div>';
    }

    public function parse(Parser $parser, $env, $arguments = [])
    {
        $parser->getEnv()->quote_level++;
        $content = $this->readContent($parser);
        $parser->getEnv()->quote_level--;

        return $this->createTag($content);
    }
}
