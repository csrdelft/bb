<?php


namespace CsrDelft\bb\tag;


interface BbNode
{
    /**
     * @return string
     */
    public function renderPlain();

    /**
     * @return string
     */
    public function renderLight();

    /**
     * @return string
     */
    public function render();

    /**
     * @return BbNode[]
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