<?php

namespace CsrDelft\BbParser\Tag;

use CsrDelft\BbParser\BbTag;

/**
 * Heading
 *
 * @param Integer $arguments ['h'] Heading level (1-6)
 * @param string optional $arguments['id'] ID attribute
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @example [h=1 id=special]Heading[/h]
 */
class BbHeading extends BbTag
{

    private $id;
    /**
     * @var int
     */
    private $heading_level = 1;

    public static function getTagName(): string
    {
        return 'h';
    }

    public function parse($arguments = []): void
    {
        if (isset($arguments['id'])) {
            $this->id = $arguments['id'];
        }
        if (isset($arguments['h'])) {
            $this->heading_level = (int)$arguments['h'];
        }
        $this->readContent(['h']);
        // remove trailing br (or even two)
        $next_tag = array_shift($this->parser->parseArray);

        if ($next_tag != '[br]') {
            array_unshift($this->parser->parseArray, $next_tag);
        } else {
            $next_tag = array_shift($this->parser->parseArray);
            if ($next_tag != '[br]') {
                array_unshift($this->parser->parseArray, $next_tag);
            }
        }
    }

    public function getHeadingLevel(): int
    {
        return $this->heading_level;
    }

    public function render(): string
    {
        $id = $this->id == null ? '' : ' id="' . htmlspecialchars($this->id) . '"';
        $text = "<h$this->heading_level$id class=\"bb-tag-h\">{$this->getContent()}</h$this->heading_level>\n\n";
        return $text;
    }

    public function renderPlain(): string
    {
        $lines = explode("\n", $this->getContent());
        return $this->getContent() . "\n" . str_repeat("-", strlen(end($lines)));
    }

    public static function isParagraphLess(): bool
    {
        return true;
    }
}
