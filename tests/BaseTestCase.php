<?php


namespace CsrDelft\BbBundle\Tests;


use CsrDelft\BbBundle\DependencyInjection\BbExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\ParameterBag\EnvPlaceholderParameterBag;

class BaseTestCase extends TestCase
{
    protected function createContainer(): ContainerBuilder
    {
        $container = new ContainerBuilder(new EnvPlaceholderParameterBag([
            'kernel.cache_dir' => __DIR__,
            'kernel.build_dir' => __DIR__,
            'kernel.project_dir' => __DIR__,
        ]));

        $container->registerExtension(new BbExtension());

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/DependencyInjection/Fixtures/yml'));
        $loader->load('full.yml');

        $container->compile();

        return $container;
    }
}