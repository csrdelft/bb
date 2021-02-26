<?php


namespace CsrDelft\BbBundle\Parser;

class BbString
{
    private $content;

    public function __construct(string $string)
    {
        $this->content = $string;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
}