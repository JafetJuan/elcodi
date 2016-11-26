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

namespace Elcodi\Bundle\UserBundle;

use Mmoreram\BaseBundle\BaseBundle;
use Mmoreram\BaseBundle\CompilerPass\MappingCompilerPass;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\KernelInterface;

use Elcodi\Bundle\UserBundle\DependencyInjection\ElcodiUserExtension;
use Elcodi\Bundle\UserBundle\Mapping\ElcodiUserMappingBagProvider;

/**
 * ElcodiUserBundle Bundle.
 */
class ElcodiUserBundle extends BaseBundle
{
    /**
     * Returns the bundle's container extension.
     *
     * @return ExtensionInterface The container extension
     */
    public function getContainerExtension()
    {
        return new ElcodiUserExtension(
            new ElcodiUserMappingBagProvider()
        );
    }

    /**
     * Return a CompilerPass instance array.
     *
     * @return CompilerPassInterface[]
     */
    public function getCompilerPasses()
    {
        return [
            new MappingCompilerPass(
                new ElcodiUserMappingBagProvider()
            ),
        ];
    }

    /**
     * Create instance of current bundle, and return dependent bundle namespaces.
     *
     * @return array Bundle instances
     */
    public static function getBundleDependencies(KernelInterface $kernel)
    {
        return [
            'Elcodi\Bundle\GeoBundle\ElcodiGeoBundle',
            'Elcodi\Bundle\LanguageBundle\ElcodiLanguageBundle',
            'Elcodi\Bundle\CartBundle\ElcodiCartBundle',
            'Elcodi\Bundle\CoreBundle\ElcodiCoreBundle',
        ];
    }
}
