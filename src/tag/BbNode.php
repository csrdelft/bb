<?php


namespace CsrDelft\bb\tag;


use CsrDelft\bb\BbException;

interface BbNode
{
    /**
     * @return string
     * @throws BbException
     */
    public function renderPlain();

    /**
     * @return string
     * @throws BbException
     */
    public function renderPreview();

    /**
     * @return string
     * @throws BbException
     */
    public function renderLight();

    /**
     * @return string
     * @throws BbException
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