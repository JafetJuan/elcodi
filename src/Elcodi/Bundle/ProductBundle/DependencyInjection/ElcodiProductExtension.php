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

namespace Elcodi\Bundle\ProductBundle\DependencyInjection;

use Mmoreram\BaseBundle\DependencyInjection\BaseExtension;
use Mmoreram\BaseBundle\DependencyInjection\EntitiesOverridableExtension;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class ElcodiProductExtension.
 */
class ElcodiProductExtension extends BaseExtension implements EntitiesOverridableExtension
{
    /**
     * Returns the extension alias, same value as extension name.
     *
     * @return string The alias
     */
    public function getAlias()
    {
        return 'elcodi_product';
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
     * purchasable_pack bundle config definitions.
     *
     * Also will call getParametrizationValues method to load some config values
     * to internal parameters.
     *
     * @return ConfigurationInterface Configuration file
     */
    protected function getConfigurationInstance() : ? ConfigurationInterface
    {
        return new ElcodiProductConfiguration(
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
            'elcodi.core.product.use_stock' => $config['products']['use_stock'],
            'elcodi.core.product.load_only_categories_with_products' => $config['categories']['load_only_categories_with_products'],
            'elcodi.core.product.cache_key' => $config['categories']['cache_key'],
        ];
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
            'services',
            'factories',
            'twig',
            'directors',
            'eventListeners',
            'adapters',
            'nameResolvers',
            'stockUpdaters',
            'stockValidators',
            'imageResolvers',
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
            'Elcodi\Component\Product\Entity\Interfaces\PurchasableInterface' => 'elcodi.entity.purchasable.class',
            'Elcodi\Component\Product\Entity\Interfaces\ProductInterface' => 'elcodi.entity.product.class',
            'Elcodi\Component\Product\Entity\Interfaces\VariantInterface' => 'elcodi.entity.product_variant.class',
            'Elcodi\Component\Product\Entity\Interfaces\PackInterface' => 'elcodi.entity.purchasable_pack.class',
            'Elcodi\Component\Product\Entity\Interfaces\ManufacturerInterface' => 'elcodi.entity.manufacturer.class',
            'Elcodi\Component\Product\Entity\Interfaces\CategoryInterface' => 'elcodi.entity.category.class',
        ];
    }

    /**
     * Post load implementation.
     *
     * @param array            $config    Parsed configuration
     * @param ContainerBuilder $container A ContainerBuilder instance
     */
    protected function postLoad(array $config, ContainerBuilder $container)
    {
        parent::postLoad($config, $container);

        $relatedProductsAdapterId = $config['related_purchasables_provider']['adapter'];
        $container->setAlias(
            'elcodi.related_purchasables_provider',
            $relatedProductsAdapterId
        );
    }
}
