<?php


namespace CsrDelft\BbBundle\Parser;


class BbTag
{
    /** @var string */
    private $tagName;
    /** @var BbTag[] */
    private $content;
    /** @var string[] */
    private $attributes;

    public function __construct(string $tagName, $content, array $attributes = [])
    {
        $this->tagName = $tagName;
        $this->content = $content;
        $this->attributes = $attributes;
    }

    /**
     * @return string
     */
    public function getTagName()
    {
        return $this->tagName;
    }

    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return string[]
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
}