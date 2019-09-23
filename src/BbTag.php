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
    /**
     * The content of the tag. Is empty at parse time. Can be filled by calling readContent()
     * @var $content
     */
    protected $content;

    public function __construct(Parser $parser, $env) {
        $this->parser = $parser;
        $this->env = $env;
    }

    public function isParagraphLess() {
        return false;
    }

    public function isAllowed()
    {
        return true;
    }

    /**
     * Read from the parser.
     *
     * NOTE: this consumes the input string.
     *
     * @param string[] $forbidden Tag names that cannot exist in this tag.
     * @return string|null
     */
    protected function readContent($forbidden = [], $parse_bb = true) {
        if ($this->content != NULL)
            throw new \Error("Can not call readContent twice on the same tag");
        $stoppers = [];

        if (is_array($this->getTagName())) {
            foreach ($this->getTagName() as $tagName) {
                $stoppers[] = $this->createStopper($tagName);
            }
        } else {
            $stoppers[] = $this->createStopper($this->getTagName());
        }

        $parse_bb_state_before = $parse_bb;
        $this->parser->bb_mode &= $parse_bb;

        $result = $this->parser->parseArray($stoppers, $forbidden);

        $this->parser->bb_mode = $parse_bb_state_before;
        $this->content = $result;
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

        return trim($this->readContent());
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
    abstract public function render();

    abstract public function parse($arguments = []);

    /**
     * ParseLight defaults to parse
     *
     * @param array $arguments
     * @return mixed
     * @throws BbException
     */
    public function renderLight($arguments = []) {
        return $this->render($arguments);
    }
}
