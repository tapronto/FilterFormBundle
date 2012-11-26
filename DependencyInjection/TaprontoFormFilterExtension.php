<?php

namespace Tapronto\FormFilterBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Reference;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class TaprontoFormFilterExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $container->getDefinition('tapronto.filterform')->addMethodCall('setEntityManager', array(
            new Reference(sprintf('doctrine.orm.%s_entity_manager', $config['entity_manager']))
        ));

        if ($this->isMongoDbConfigured($container)) {
            $container->getDefinition('tapronto.filterform')->addMethodCall('setDocumentManager', array(
                new Reference(sprintf('doctrine_mongodb.odm.%s_document_manager', $config['document_manager']))
            ));
        }
    }

    private static function isMongoDBConfigured(ContainerBuilder $container) {
        return $container->hasParameter('doctrine_mongodb.odm.document_managers');
    }
}
