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

namespace Elcodi\Bundle\CartCouponBundle;

use Mmoreram\BaseBundle\BaseBundle;
use Mmoreram\BaseBundle\CompilerPass\MappingCompilerPass;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\KernelInterface;

use Elcodi\Bundle\CartCouponBundle\CompilerPass\CartCouponApplicatorCompilerPass;
use Elcodi\Bundle\CartCouponBundle\CompilerPass\CartCouponApplicatorFunctionCompilerPass;
use Elcodi\Bundle\CartCouponBundle\DependencyInjection\ElcodiCartCouponExtension;
use Elcodi\Bundle\CartCouponBundle\Mapping\ElcodiCartCouponMappingBagProvider;

/**
 * Class ElcodiCartCouponBundle.
 */
class ElcodiCartCouponBundle extends BaseBundle
{
    /**
     * Returns the bundle's container extension.
     *
     * @return ExtensionInterface The container extension
     */
    public function getContainerExtension()
    {
        return new ElcodiCartCouponExtension(
            new ElcodiCartCouponMappingBagProvider()
        );
    }

    /**
     * Return a CompilerPass instance array.
     *
     * @return CompilerPassInterface[]
     */
    public function getCompilerPasses() : array
    {
        return [
            new MappingCompilerPass(
                new ElcodiCartCouponMappingBagProvider()
            ),
            new CartCouponApplicatorCompilerPass(),
            new CartCouponApplicatorFunctionCompilerPass(),
        ];
    }

    /**
     * Return all bundle dependencies.
     *
     * Values can be a simple bundle namespace or its instance
     * 
     * @param KernelInterface $kernel
     *
     * @return array
     */
    public static function getBundleDependencies(KernelInterface $kernel) : array
    {
        return [
            'Symfony\Bundle\FrameworkBundle\FrameworkBundle',
            'Doctrine\Bundle\DoctrineBundle\DoctrineBundle',
            'Elcodi\Bundle\CartBundle\ElcodiCartBundle',
            'Elcodi\Bundle\CouponBundle\ElcodiCouponBundle',
            'Elcodi\Bundle\RuleBundle\ElcodiRuleBundle',
            'Elcodi\Bundle\CoreBundle\ElcodiCoreBundle',
            'Mmoreram\BaseBundle\BaseBundle',
        ];
    }
}
