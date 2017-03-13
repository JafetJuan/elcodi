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

namespace Elcodi\Bundle\EntityTranslatorBundle\DependencyInjection;

use Mmoreram\BaseBundle\DependencyInjection\BaseConfiguration;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * Class ElcodiEntityTranslatorConfiguration.
 */
class ElcodiEntityTranslatorConfiguration extends BaseConfiguration
{
    /**
     * Configure the root node.
     *
     * @param ArrayNodeDefinition $rootNode
     */
    protected function setupTree(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
                ->scalarNode('cache_prefix')
                    ->defaultValue('translation')
                ->end()
                ->booleanNode('auto_translate')
                    ->defaultTrue()
                ->end()
                ->arrayNode('language')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('master_locale')
                            ->defaultValue('en')
                        ->end()
                        ->scalarNode('fallback')
                            ->defaultTrue()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('configuration')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('alias')
                                ->isRequired()
                                ->cannotBeEmpty()
                            ->end()
                            ->scalarNode('idGetter')
                                ->defaultValue('getId')
                            ->end()
                            ->arrayNode('fields')
                                ->prototype('array')
                                    ->children()
                                        ->scalarNode('setter')->end()
                                        ->scalarNode('getter')->end()
                                    ->end()
                                ->end()
                                ->beforeNormalization()
                                ->always(function ($fields) {
                                    foreach ($fields as $fieldName => $fieldConfiguration) {
                                        if (!is_array($fieldConfiguration)) {
                                            $fieldConfiguration = [];
                                        }

                                        if (!isset($fieldConfiguration['getter'])) {
                                            $fields[$fieldName]['getter'] = 'get' . ucfirst($fieldName);
                                        }

                                        if (!isset($fieldConfiguration['setter'])) {
                                            $fields[$fieldName]['setter'] = 'set' . ucfirst($fieldName);
                                        }
                                    }

                                    return $fields;
                                })
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}