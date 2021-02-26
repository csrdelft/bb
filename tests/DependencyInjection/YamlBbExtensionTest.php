<?php


namespace CsrDelft\BbBundle\Tests\DependencyInjection;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

final class YamlBbExtensionTest extends BbExtensionTest
{
    protected function loadFixture(ContainerBuilder $container, string $fixture): void
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/Fixtures/yml'));
        $loader->load($fixture . '.yml');
    }
}