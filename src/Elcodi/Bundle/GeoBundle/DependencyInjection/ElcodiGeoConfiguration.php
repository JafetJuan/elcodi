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
 * @author Elcodi Team <tech@elcodi.com>
 */

namespace Elcodi\Bundle\GeoBundle\DependencyInjection;

use Mmoreram\BaseBundle\DependencyInjection\BaseConfiguration;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * Class ElcodiGeoConfiguration.
 */
class ElcodiGeoConfiguration extends BaseConfiguration
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
                ->arrayNode('location')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('populator_adapter')
                            ->defaultValue('elcodi.location_populator_adapter.geonames')
                        ->end()
                        ->scalarNode('loader_adapter')
                            ->defaultValue('elcodi.location_loader_adapter.github')
                        ->end()
                        ->scalarNode('provider_adapter')
                            ->defaultValue('elcodi.location_provider_adapter.service')
                        ->end()
                        ->scalarNode('api_host')
                            ->defaultNull()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
