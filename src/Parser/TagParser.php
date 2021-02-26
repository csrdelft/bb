<?php

namespace CsrDelft\BbBundle\Parser;

use CsrDelft\BbBundle\Parser\Tags\BbParser;
use Error;
use stdClass;

abstract class TagParser implements BbParser
{
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
    private $content = null;
    /**
     * @var BbParser[]|null
     */
    private $children;

    public static function isParagraphLess()
    {
        return false;
    }

    public function isAllowed()
    {
        return true;
    }

    /**
     * @param Parser $parser
     * @param $env
     * @param array $arguments
     * @return BbTag
     * @throws BbException
     */
    abstract public function parse(Parser $parser, $env, $arguments = []);

    /**
     * @return BbParser[]|null
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param BbParser[] $children
     */
    public function setChildren($children)
    {
        $this->children = $children;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Get the main argument for this tag and return it.
     *
     * [tag=123] or [tag]123[/tag]
     *
     * @param $arguments
     * @return string
     */
    protected function readMainArgument(Parser $parser, $arguments)
    {
        if (is_array($this->getTagName())) {
            foreach ($this->getTagName() as $tagName) {
                if (isset($arguments[$tagName])) {
                    return trim($arguments[$tagName]);
                }
            }

            return '';
        } elseif (isset($arguments[$this->getTagName()])) {
            return trim($arguments[$this->getTagName()]);
        } else {
            $this->readContent($parser, [], false);
            // parse_bb is disabled in readContent, so all nodes should be BbString
            return trim(implode(array_map(function (BbParser $node) {
                return $node->render();
            }, $this->children)));
        }
    }

    abstract public static function getTagName();

    /**
     * Read from the parser.
     *
     * NOTE: this consumes the input string.
     *
     * @param Parser $parser
     * @param string[] $forbidden Tag names that cannot exist in this tag.
     * @param bool $parse_bb
     * @return BbTag[]
     */
    protected function readContent(Parser $parser, $forbidden = [], $parse_bb = true)
    {
        if ($this->content != NULL) {
            throw new Error("Can not call readContent twice on the same tag");
        }

        $stoppers = $this->getStoppers();
        $parse_bb_state_before = $parser->bb_mode;
        $parser->bb_mode &= $parse_bb;

        $result = $parser->parseArray($stoppers, $forbidden);

        $parser->bb_mode = $parse_bb_state_before;
        $this->children = $result;
        return $result;
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

    private function createStopper($tagName)
    {
        return "[/$tagName]";
    }

    protected function createTag($content, $arguments = []) {
        return new BbTag(static::class, $content, $arguments);
    }
}
