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

namespace Elcodi\Bundle\CartBundle\DependencyInjection;

use Mmoreram\BaseBundle\DependencyInjection\BaseExtension;
use Mmoreram\BaseBundle\DependencyInjection\EntitiesOverridableExtension;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that loads and manages your bundle configuration.
 */
class ElcodiCartExtension extends BaseExtension implements EntitiesOverridableExtension
{
    /**
     * Returns the extension alias, same value as extension name.
     *
     * @return string The alias
     */
    public function getAlias()
    {
        return 'elcodi_cart';
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
        return new ElcodiCartConfiguration(
            $this->getAlias(),
            $this->mappingBagProvider
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
        return [
            'elcodi.cart_save_in_session' => $config['cart']['save_in_session'],
            'elcodi.cart_session_field_name' => $config['cart']['session_field_name'],

            'elcodi.order_payment_states_machine_states' => $config['payment_states_machine']['states'],
            'elcodi.order_payment_states_machine_identifier' => $config['payment_states_machine']['identifier'],
            'elcodi.order_payment_states_machine_point_of_entry' => $config['payment_states_machine']['point_of_entry'],

            'elcodi.order_shipping_states_machine_states' => $config['shipping_states_machine']['states'],
            'elcodi.order_shipping_states_machine_identifier' => $config['shipping_states_machine']['identifier'],
            'elcodi.order_shipping_states_machine_point_of_entry' => $config['shipping_states_machine']['point_of_entry'],
        ];
    }

    /**
     * Config files to load.
     *
     * @param array $config Config
     *
     * @return array Config files
     */
    public function getConfigFiles(array $config) : array
    {
        return [
            'eventListeners',
            'services',
            'wrappers',
            'factories',
            'directors',
            'transformers',
            'eventDispatchers',
            'stateMachine',
        ];
    }

    /**
     * Get entities overrides.
     *
     * Result must be an array with:
     * index: Original Interface
     * value: Parameter where class is defined.
     *
     * @return array Overrides definition
     */
    public function getEntitiesOverrides() : array
    {
        return [
            'Elcodi\Component\Cart\Entity\Interfaces\CartInterface' => 'elcodi.entity.cart.class',
            'Elcodi\Component\Cart\Entity\Interfaces\OrderInterface' => 'elcodi.entity.order.class',
            'Elcodi\Component\Cart\Entity\Interfaces\CartLineInterface' => 'elcodi.entity.cart_line.class',
            'Elcodi\Component\Cart\Entity\Interfaces\OrderLineInterface' => 'elcodi.entity.order_line.class',
        ];
    }
}
