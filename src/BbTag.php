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
    protected $content = null;

    public function __construct(Parser $parser, $env) {
        $this->parser = $parser;
        $this->env = $env;
    }

    public static function isParagraphLess() {
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
        $stoppers = $this->getStoppers();
        $parse_bb_state_before = $this->parser->bb_mode;
        $this->parser->bb_mode &= $parse_bb;

        $result = $this->parser->parseArray($stoppers, $forbidden);

        $this->parser->bb_mode = $parse_bb_state_before;
        $this->content = $result;
    }

    /**
     * Get the main argument for this tag and put it in $this->content.
     *
     * [tag=123] or [tag]123[/tag]
     *
     * @param $arguments
     */
    protected function readMainArgument($arguments) {
        if (is_array($this->getTagName())) {
            foreach ($this->getTagName() as $tagName) {
                if (isset($arguments[$tagName])) {
                    $this->content = trim($arguments[$tagName]);
                }
            }
        } elseif (isset($arguments[$this->getTagName()])) {
            $this->content = trim($arguments[$this->getTagName()]);
        }
        else {
            $this->readContent([], false);
            $this->content = trim($this->content);
        }
    }

    private function createStopper($tagName) {
        return "[/$tagName]";
    }

    abstract public static function getTagName();

    /**
     * @param array $arguments
     * @return mixed
     * @throws BbException
     */
    abstract public function parse($arguments = []);

    abstract public function render();

    /**
     * ParseLight defaults to parse
     *
     * @param array $arguments
     * @return mixed
     * @throws BbException
     */
    public function renderLight() {
        return $this->render();
    }

    protected function getStoppers()
    {
        $stoppers = [];

        if (is_array($this->getTagName())) {
            foreach ($this->getTagName() as $tagName) {
                $stoppers[] = $this->createStopper($tagName);
            }
        } else {
            $stoppers[] = $this->createStopper($this->getTagName());
        }
        $stoppers[] = [$this->createStopper('')];
        return $stoppers;
    }
}
