<?php

namespace CsrDelft\BbBundle\Tests\DependencyInjection;

use CsrDelft\BbBundle\DependencyInjection\BbExtension;
use CsrDelft\BbBundle\Parser\Tags\BbParser;
use CsrDelft\BbBundle\Renderer\Html\HtmlRenderer;
use CsrDelft\BbBundle\Renderer\Renderer;
use CsrDelft\BbBundle\Tests\BaseTestCase;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ParameterBag\EnvPlaceholderParameterBag;

abstract class BbExtensionTest extends BaseTestCase
{
    public function testHtmlRendererComplete()
    {
        $this->testRendererComplete('bb.renderer.html');
    }

    public function testPlainRendererComplete() {
        $this->testRendererComplete('bb.renderer.plain');
    }

    public function testLightRendererComplete() {
        $this->testRendererComplete('bb.renderer.light');
    }

    private function testRendererComplete($tag) {
        $container = $this->createContainer();

        $htmlRenderers = $container->findTaggedServiceIds($tag);

        $tags = $container->findTaggedServiceIds('bb.tag');

        foreach ($htmlRenderers as $htmlRenderer => $instance) {
            /** @var Renderer $htmlRenderer */
            $tagClass = $htmlRenderer::getTag();

            $this->assertTrue(isset($tags[$tagClass]), "Renderer of type \"" . $tag . "\" for nonexisting class: " . $tagClass);

            unset($tags[$tagClass]);
        }

        $this->assertEmpty(array_keys($tags), "No renderers of type \"" . $tag . "\" for classes: " . implode(", ", array_keys($tags)));
    }



    abstract protected function loadFixture(ContainerBuilder $container, string $fixture);
}