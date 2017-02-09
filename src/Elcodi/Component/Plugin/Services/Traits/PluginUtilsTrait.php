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

namespace Elcodi\Component\Plugin\Services\Traits;
use Elcodi\Component\Plugin\Interfaces\PluginInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Trait PluginUtilsTrait.
 */
trait PluginUtilsTrait
{
    /**
     * Load installed plugin bundles and return an array with them, indexed by
     * their namespaces.
     *
     * @return Bundle[]
     */
    protected function getInstalledPluginBundles(KernelInterface $kernel)
    {
        $plugins = [];
        $bundles = $kernel->getBundles();

        foreach ($bundles as $bundle) {
            if (
                $bundle instanceof Bundle &&
                $bundle instanceof PluginInterface
            ) {
                $pluginNamespace = $bundle->getNamespace();
                $plugins[$pluginNamespace] = $bundle;
            }
        }

        return $plugins;
    }
}
