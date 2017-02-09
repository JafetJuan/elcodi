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

namespace Elcodi\Bundle\PluginBundle\DependencyInjection;

use Mmoreram\BaseBundle\DependencyInjection\BaseExtension;
use Mmoreram\BaseBundle\Mapping\MappingBagProvider;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Yaml\Yaml;

use Elcodi\Component\Plugin\Services\Traits\PluginUtilsTrait;

/**
 * Class ElcodiPluginExtension.
 */
class ElcodiPluginExtension extends BaseExtension
{
    use PluginUtilsTrait;

    /**
     * @var KernelInterface
     *
     * Kernel
     */
    private $kernel;

    /**
     * BaseExtension constructor.
     *
     * @param KernelInterface    $kernel
     * @param MappingBagProvider $mappingBagProvider
     */
    public function __construct(
        KernelInterface $kernel,
        MappingBagProvider $mappingBagProvider = null
    ) {
        parent::__construct($mappingBagProvider);

        $this->kernel = $kernel;
    }

    /**
     * Returns the extension alias, same value as extension name.
     *
     * @return string The alias
     */
    public function getAlias()
    {
        return 'elcodi_plugin';
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
        return new ElcodiPluginConfiguration(
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
            'services',
            'commands',
            'eventDispatchers',
            'formTypes',
            'twig',
        ];
    }

    /**
     * Hook after load the full container.
     *
     * @param array            $config    Configuration
     * @param ContainerBuilder $container Container
     */
    protected function postLoad(array $config, ContainerBuilder $container)
    {
        $plugins = $this->getInstalledPluginBundles($this->kernel);

        foreach ($plugins as $plugin) {
            $configuration = $this->processPlugin($plugin);
            foreach ($configuration as $name => $config) {
                $container
                    ->prependExtensionConfig(
                        $name,
                        $config
                    );
            }
        }
    }

    /**
     * Process plugin.
     *
     * @param Bundle $plugin Plugin
     *
     * @return array Plugin configuration
     */
    private function processPlugin(Bundle $plugin)
    {
        $resourcePath = $plugin->getPath() . '/Resources/config/external.yml';

        return file_exists($resourcePath)
            ? Yaml::parse(file_get_contents($resourcePath))
            : [];
    }
}
