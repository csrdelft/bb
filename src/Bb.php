<?php


namespace CsrDelft\BbBundle;


use CsrDelft\BbBundle\Parser\Parser;
use CsrDelft\BbBundle\Renderer\GenericRenderer;

class Bb
{
    /**
     * @var Parser
     */
    private $parser;
    /**
     * @var GenericRenderer
     */
    private $renderer;

    public function __construct(Parser $parser, GenericRenderer $renderer) {
        $this->parser = $parser;
        $this->renderer = $renderer;
    }

    public function parse($string) {
        return $this->renderer->render($this->parser->parseString($string));
    }
}