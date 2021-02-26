<?php


namespace CsrDelft\BbBundle\Parser\Tags;


use CsrDelft\BbBundle\Parser\BbTag;

interface BbParser
{
    /**
     * @return BbTag[]
     */
    public function getChildren();

    /**
     * @param string $content
     * @return void
     */
    public function setContent($content);

    /**
     * @return void
     */
    public function getContent();

    /**
     * @return bool
     */
    public function isAllowed();
}