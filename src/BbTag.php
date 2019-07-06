<?php
namespace CsrDelft\bb;

use stdClass;

abstract class BbTag {
    /**
     * @var Parser
     */
    protected $parser;

    /**
     * Environment that is available to every class.
     *
     * @var stdClass|BbEnv
     */
    protected $env;

    public function __construct(Parser $parser, $env) {
        $this->parser = $parser;
        $this->env = $env;
    }

    public function isParagraphLess() {
        return false;
    }
    /**
     * Read from the parser.
     *
     * NOTE: this consumes the input string.
     *
     * @param string[] $forbidden Tag names that cannot exist in this tag.
     * @return string|null
     */
    protected function getContent($forbidden = []) {
        $stoppers = [];

        if (is_array($this->getTagName())) {
            foreach ($this->getTagName() as $tagName) {
                $stoppers[] = $this->createStopper($tagName);
            }
        } else {
            $stoppers[] = $this->createStopper($this->getTagName());
        }

        return $this->parser->parseArray($stoppers, $forbidden);
    }

    /**
     * Get the main argument for this tag.
     *
     * [tag=123] or [tag]123[/tag]
     *
     * @param $arguments
     * @return string|null
     */
    protected function getArgument($arguments) {
        if (is_array($this->getTagName())) {
            foreach ($this->getTagName() as $tagName) {
                if (isset($arguments[$tagName])) {
                    return trim($arguments[$tagName]);
                }
            }
        } elseif (isset($arguments[$this->getTagName()])) {
            return trim($arguments[$this->getTagName()]);
        }

        return trim($this->getContent());
    }

    private function createStopper($tagName) {
        return "[/$tagName]";
    }

    abstract public function getTagName();

    /**
     * @param array $arguments
     * @return mixed
     * @throws BbException
     */
    abstract public function parse($arguments = []);

    /**
     * ParseLight defaults to parse
     *
     * @param array $arguments
     * @return mixed
     * @throws BbException
     */
    public function parseLight($arguments = []) {
        return $this->parse($arguments);
    }
}
