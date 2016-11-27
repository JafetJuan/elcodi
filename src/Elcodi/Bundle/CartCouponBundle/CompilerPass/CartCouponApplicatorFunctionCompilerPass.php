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

namespace Elcodi\Bundle\CartCouponBundle\CompilerPass;

use Mmoreram\BaseBundle\CompilerPass\TagCompilerPass;

/**
 * Class CartCouponApplicatorFunctionCompilerPass.
 */
class CartCouponApplicatorFunctionCompilerPass extends TagCompilerPass
{
    /**
     * Get collector service name.
     *
     * @return string Collector service name
     */
    public function getCollectorServiceName() : string
    {
        return 'elcodi.cart_coupon_applicator_function_collector';
    }

    /**
     * Get collector method name.
     *
     * @return string Collector method name
     */
    public function getCollectorMethodName() : string
    {
        return 'addExpressionLanguageFunction';
    }

    /**
     * Get tag name.
     *
     * @return string Tag name
     */
    public function getTagName() : string
    {
        return 'elcodi.cart_coupon_applicator_function';
    }
}
