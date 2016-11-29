<?php

/*
 * This file is part of the Elcodi package.
 *
 * Copyright (c) 2014-2016 Elcodi Networks S.L.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 * @author Aldo Chiecchia <zimage@tiscali.it>
 */

declare(strict_types=1);

namespace Elcodi\Bundle\SitemapBundle\DependencyInjection;

use Mmoreram\BaseBundle\DependencyInjection\BaseExtension;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class ElcodiSitemapExtension.
 */
class ElcodiSitemapExtension extends BaseExtension
{
    /**
     * Returns the extension alias, same value as extension name.
     *
     * @return string The alias
     */
    public function getAlias()
    {
        return 'elcodi_sitemap';
    }

    /**
     * Get the Config file location.
     *
     * @return string Config file location
     */
    public function getConfigFilesLocation() : string
    {
        return __DIR__ . '/../Resources/config';
    }

    /**
     * Return a new Configuration instance.
     *
     * If object returned by this method is an instance of
     * ConfigurationInterface, extension will use the Configuration to read all
     * bundle config definitions.
     *
     * Also will call getParametrizationValues method to load some config values
     * to internal parameters.
     *
     * @return ConfigurationInterface Configuration file
     */
    protected function getConfigurationInstance() : ? ConfigurationInterface
    {
        return new ElcodiSitemapConfiguration(
            $this->getAlias()
        );
    }

    /**
     * Load Parametrization definition.
     *
     * return array(
     *      'parameter1' => $config['parameter1'],
     *      'parameter2' => $config['parameter2'],
     *      ...
     * );
     *
     * @param array $config Bundles config values
     *
     * @return array Parametrization values
     */
    protected function getParametrizationValues(array $config) : array
    {
        return [];
    }

    /**
     * Hook after load the full container.
     *
     * @param array            $config    Configuration
     * @param ContainerBuilder $container Container
     */
    protected function postLoad(array $config, ContainerBuilder $container)
    {
        $this
            ->loadBlocks($config['blocks'], $container)
            ->loadStatics($config['statics'], $container)
            ->loadBuilders($config['builders'], $container)
            ->loadDumpers($config['builders'], $container)
            ->loadProfiles($config['profiles'], $container);
    }

    /**
     * Load blocks.
     *
     * @param array            $blocks    Blocks
     * @param ContainerBuilder $container Container
     */
    protected function loadBlocks(array $blocks, ContainerBuilder $container)
    {
        foreach ($blocks as $blockName => $block) {
            $container
                ->register(
                    'elcodi.sitemap_element_provider.entity_' . $blockName,
                    'Elcodi\Component\Sitemap\Element\EntitySitemapElementProvider'
                )
                ->addArgument(new Reference($block['repository_service']))
                ->addArgument($block['method'])
                ->addArgument($block['arguments'])
                ->setPublic(false);

            $container
                ->register(
                    'elcodi.sitemap_element_generator.entity_' . $blockName,
                    'Elcodi\Component\Sitemap\Element\EntitySitemapElementGenerator'
                )
                ->addArgument(new Reference('elcodi.factory.sitemap_element'))
                ->addArgument(new Reference($block['transformer']))
                ->addArgument(new Reference('elcodi.sitemap_element_provider.entity_' . $blockName))
                ->addArgument($block['changeFrequency'])
                ->addArgument($block['priority'])
                ->setPublic(false);
        }
    }

    /**
     * Load statics.
     *
     * @param array            $statics   Statics
     * @param ContainerBuilder $container Container
     */
    protected function loadStatics(array $statics, ContainerBuilder $container)
    {
        foreach ($statics as $staticName => $static) {
            $container
                ->register(
                    'elcodi.sitemap_element_generator.static_' . $staticName,
                    'Elcodi\Component\Sitemap\Element\StaticSitemapElementGenerator'
                )
                ->addArgument(new Reference('elcodi.factory.sitemap_element'))
                ->addArgument(new Reference($static['transformer']))
                ->addArgument($staticName)
                ->addArgument($static['changeFrequency'])
                ->addArgument($static['priority'])
                ->setPublic(false);
        }
    }

    /**
     * Load builders.
     *
     * @param array            $builders  Builders
     * @param ContainerBuilder $container Container
     */
    protected function loadBuilders(array $builders, ContainerBuilder $container)
    {
        foreach ($builders as $builderName => $builder) {
            $definition = $container
                ->register(
                    'elcodi.sitemap_builder.' . $builderName,
                    'Elcodi\Component\Sitemap\Builder\SitemapBuilder'
                )
                ->addArgument(new Reference($builder['renderer']))
                ->addArgument($builder['path'])
                ->setPublic(true);

            $this
                ->addBuilderElements(
                    $definition,
                    $builder['statics'],
                    'static'
                )
                ->addBuilderElements(
                    $definition,
                    $builder['blocks'],
                    'entity'
                );
        }
    }

    /**
     * Load builder blocks.
     *
     * @param Definition $builderDefinition Block definition
     * @param array      $elements          Elements
     * @param string     $elementType       Element type
     */
    protected function addBuilderElements(
        Definition $builderDefinition,
        array $elements,
        $elementType

    ) {
        foreach ($elements as $blockReference) {
            $builderDefinition->addMethodCall(
                'addSitemapElementGenerator',
                [new Reference('elcodi.sitemap_element_generator.' . $elementType . '_' . $blockReference)]
            );
        }
    }

    /**
     * Load dumpers.
     *
     * @param array            $builders  Builders
     * @param ContainerBuilder $container Container
     */
    protected function loadDumpers(array $builders, ContainerBuilder $container)
    {
        foreach ($builders as $builderName => $builder) {
            $container
                ->register(
                    'elcodi.sitemap_dumper.' . $builderName,
                    'Elcodi\Component\Sitemap\Dumper\SitemapDumper'
                )
                ->addArgument(new Reference('elcodi.sitemap_builder.' . $builderName))
                ->addArgument(new Reference($builder['dumper']))
                ->addArgument($builder['path'])
                ->setPublic(true);
        }
    }

    /**
     * Load profiles.
     *
     * @param array            $profiles  Profiles
     * @param ContainerBuilder $container Container
     */
    protected function loadProfiles(array $profiles, ContainerBuilder $container)
    {
        foreach ($profiles as $profileName => $profile) {
            $definition = $container
                ->register(
                    'elcodi.sitemap_profile.' . $profileName,
                    'Elcodi\Component\Sitemap\Profile\SitemapProfile'
                )
                ->addArgument(new Reference($profile['languages']))
                ->setPublic(true);

            foreach ($profile['builders'] as $builderReference) {
                $definition->addMethodCall(
                    'addSitemapDumper',
                    [new Reference('elcodi.sitemap_dumper.' . $builderReference)]
                );
            }
        }
    }

    /**
     * Config files to load.
     *
     * @param array $config Configuration
     *
     * @return array Config files
     */
    public function getConfigFiles(array $config) : array
    {
        return [
            'renderers',
            'eventDispatchers',
            'commands',
            'sitemapTransformers',
            'factories',
            'dumpers',
        ];
    }
}
