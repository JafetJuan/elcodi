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

use Mmoreram\BaseBundle\DependencyInjection\BaseExtension;
use Mmoreram\BaseBundle\DependencyInjection\EntitiesOverridableExtension;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This class loads and manages your bundle configuration.
 */
class ElcodiEntityTranslatorExtension extends BaseExtension implements EntitiesOverridableExtension
{
    /**
     * Returns the extension alias, same value as extension name.
     *
     * @return string The alias
     */
    public function getAlias()
    {
        return 'elcodi_entity_translator';
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
        return new ElcodiEntityTranslatorConfiguration(
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
            'elcodi.entity_translator_configuration' => $config['configuration'],
            'elcodi.entity_translator_cache_prefix' => $config['cache_prefix'],
            'elcodi.entity_translator_auto_translate' => $config['auto_translate'],
            'elcodi.entity_translator_language_master_locale' => $config['language']['master_locale'],
            'elcodi.entity_translator_language_fallback' => $config['language']['fallback'],
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
            'factories',
            'services',
            'eventDispatchers',
            'eventListeners',
            ['autoloadEventListeners', $config['auto_translate']],
            'directors',
            'commands',
        ];
    }

    /**
     * @return array
     */
    public function getEntitiesOverrides() : array
    {
        return [
            'Elcodi\Component\EntityTranslator\Entity\Interfaces\EntityTranslationInterface' => 'elcodi.entity.entity_translation.class',
        ];
    }
}
