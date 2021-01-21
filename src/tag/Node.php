<?php


namespace CsrDelft\bb\tag;


interface Node
{
    public function renderPlain();
    public function renderLight();
    public function render();
    public function getChildren();

    public function setContent($content);
    public function getContent();

    public function isAllowed();
}