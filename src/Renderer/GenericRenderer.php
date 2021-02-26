<?php


namespace CsrDelft\BbBundle\Renderer;


use CsrDelft\BbBundle\Parser\BbString;
use CsrDelft\BbBundle\Parser\BbTag;
use Symfony\Component\DependencyInjection\ServiceLocator;

class GenericRenderer
{
    /**
     * @var ServiceLocator
     */
    private $renderers;

    public function __construct(ServiceLocator $renderers)
    {
        $this->renderers = $renderers;
    }

    /**
     * @param BbTag[] $tags
     * @return string
     * @throws \Exception
     */
    public function render(array $tags)
    {
        $output = '';

        foreach ($tags as $tag) {
            if ($tag instanceof BbString) {
                $output .= $tag->getContent();
            } else {
                if (!$this->renderers->has($tag->getTagName())) {
                    throw new \Exception("No renderer found for tag: " . $tag->getTagName());
                }

                /** @var Renderer $renderer */
                $renderer = $this->renderers->get($tag->getTagName());

                $output .= $renderer->render($this->render($tag->getContent()), $tag->getAttributes());
            }
        }

        return $output;
    }
}