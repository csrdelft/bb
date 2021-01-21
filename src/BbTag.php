<?php
namespace CsrDelft\bb;

use CsrDelft\bb\tag\Node;
use Error;
use stdClass;

abstract class BbTag implements Node {
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
     * @var string|null
     */
    protected $content = null;

    public function setParser(Parser $parser) {
        $this->parser = $parser;
    }

    public function setEnv($env) {
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
     */
    protected function readContent($forbidden = [], $parse_bb = true) {
        if ($this->content != NULL)
            throw new Error("Can not call readContent twice on the same tag");
        $stoppers = $this->getStoppers();
        $parse_bb_state_before = $this->parser->bb_mode;
        $this->parser->bb_mode &= $parse_bb;

        $result = $this->parser->parseArray($stoppers, $forbidden);

        $this->parser->bb_mode = $parse_bb_state_before;
        $this->children = $result;
    }

    /**
     * Get the main argument for this tag and return it.
     *
     * [tag=123] or [tag]123[/tag]
     *
     * @param $arguments
     * @return string
     */
    protected function readMainArgument($arguments) {
        if (is_array($this->getTagName())) {
            foreach ($this->getTagName() as $tagName) {
                if (isset($arguments[$tagName])) {
                    return trim($arguments[$tagName]);
                }
            }

            return '';
        } elseif (isset($arguments[$this->getTagName()])) {
            return trim($arguments[$this->getTagName()]);
        }
        else {
            $this->readContent([], false);
            // parse_bb is disabled in readContent, so all nodes should be BbString
            return trim(implode(array_map(function (Node $node) { return $node->render(); }, $this->children)));
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
     * @var Node[]|null
     */
    private $children;

    /**
     * @param Node[] $children
     */
    public function setChildren($children) {
        $this->children = $children;
    }

    /**
     * @return Node[]|null
     */
    public function getChildren()
    {
        return $this->children;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    /**
     * ParseLight defaults to parse
     *
     * @return mixed
     * @throws BbException
     */
    public function renderLight() {
        return $this->render();
    }

    /**
     * render plain will strip html tags by default.
     *
     * @return string
     */
    public function renderPlain() {
        return strip_tags($this->render());
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
        $stoppers[] = $this->createStopper('');
        return $stoppers;
    }
}
