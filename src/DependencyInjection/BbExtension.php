<?php


namespace CsrDelft\BbBundle\DependencyInjection;


use CsrDelft\BbBundle\Parser\Tags\BbParser;
use CsrDelft\BbBundle\Renderer\Html\HtmlRenderer;
use CsrDelft\BbBundle\Renderer\Plain\PlainRenderer;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Extension\Extension;

class BbExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $container->registerForAutoconfiguration(BbParser::class)->addTag('bb.tag');
        $container->registerForAutoconfiguration(HtmlRenderer::class)->addTag('bb.renderer.html');
        $container->registerForAutoconfiguration(PlainRenderer::class)->addTag('bb.renderer.plain');

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

    }
}