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

namespace Elcodi\Component\CartCoupon\Factory;

use Elcodi\Component\CartCoupon\Entity\Interfaces\CartCouponInterface;
use Elcodi\Component\Core\Factory\Abstracts\AbstractFactory;

/**
 * Class CartCoupon.
 */
class CartCouponFactory extends AbstractFactory
{
    /**
     * Creates an instance of an entity.
     *
     * This method must return always an empty instance for related entity
     *
     * @return CartCouponInterface New CartCoupon instance
     */
    public function create()
    {
        /**
         * @var CartCouponInterface $cartCoupon
         */
        $classNamespace = $this->getEntityNamespace();
        $cartCoupon = new $classNamespace();

        return $cartCoupon;
    }
}
