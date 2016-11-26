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

namespace Elcodi\Bundle\LanguageBundle\DependencyInjection;

use Mmoreram\BaseBundle\DependencyInjection\BaseConfiguration;
use Mmoreram\BaseBundle\DependencyInjection\BaseExtension;
use Mmoreram\BaseBundle\DependencyInjection\EntitiesOverridableExtension;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class ElcodiLanguageExtension.
 */
class ElcodiLanguageExtension extends BaseExtension implements EntitiesOverridableExtension
{
    /**
     * Returns the extension alias, same value as extension name.
     *
     * @return string The alias
     */
    public function getAlias()
    {
        return 'elcodi_language';
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
        return new BaseConfiguration(
            $this->getAlias(),
            $this->mappingBagProvider
        );
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
            'directors',
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
            'Elcodi\Component\Language\Entity\Interfaces\LanguageInterface' => 'elcodi.entity.language.class',
        ];
    }
}
