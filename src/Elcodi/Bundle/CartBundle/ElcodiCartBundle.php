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

namespace Elcodi\Bundle\CartBundle;

use Mmoreram\BaseBundle\BaseBundle;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\KernelInterface;

use Elcodi\Bundle\CartBundle\CompilerPass\MappingCompilerPass;
use Elcodi\Bundle\CartBundle\DependencyInjection\ElcodiCartExtension;

/**
 * ElcodiCartBundle Bundle.
 */
class ElcodiCartBundle extends BaseBundle
{
    /**
     * Returns the bundle's container extension.
     *
     * @return ExtensionInterface The container extension
     */
    public function getContainerExtension()
    {
        return new ElcodiCartExtension($this);
    }

    /**
     * Return a CompilerPass instance array.
     *
     * @return CompilerPassInterface[]
     */
    public function getCompilerPasses()
    {
        return [
            new MappingCompilerPass(),
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
            'Elcodi\Bundle\UserBundle\ElcodiUserBundle',
            'Elcodi\Bundle\ProductBundle\ElcodiProductBundle',
            'Elcodi\Bundle\CurrencyBundle\ElcodiCurrencyBundle',
            'Elcodi\Bundle\StateTransitionMachineBundle\ElcodiStateTransitionMachineBundle',
            'Elcodi\Bundle\ShippingBundle\ElcodiShippingBundle',
            'Elcodi\Bundle\StoreBundle\ElcodiStoreBundle',
            'Elcodi\Bundle\CoreBundle\ElcodiCoreBundle',
            'Mmoreram\BaseBundle\BaseBundle',
        ];
    }
}
