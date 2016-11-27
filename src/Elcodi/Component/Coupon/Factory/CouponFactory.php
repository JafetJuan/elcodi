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

namespace Elcodi\Component\Coupon\Factory;

use Elcodi\Component\Coupon\ElcodiCouponTypes;
use Elcodi\Component\Coupon\Entity\Interfaces\CouponInterface;
use Elcodi\Component\Currency\Factory\Abstracts\AbstractPurchasableFactory;

/**
 * Class CouponFactory.
 */
class CouponFactory extends AbstractPurchasableFactory
{
    /**
     * Creates an instance of a simple coupon.
     *
     * This method must return always an empty instance for related entity
     *
     * @return CouponInterface Empty entity
     */
    public function create()
    {
        $now = $this->now();
        $zeroPrice = $this->createZeroAmountMoney();

        /**
         * @var CouponInterface $coupon
         */
        $classNamespace = $this->getEntityNamespace();
        $coupon = new $classNamespace();
        $coupon->setType(ElcodiCouponTypes::TYPE_AMOUNT);
        $coupon->setPrice($zeroPrice);
        $coupon->setAbsolutePrice($zeroPrice);
        $coupon->setMinimumPurchase($zeroPrice);
        $coupon->setEnforcement(ElcodiCouponTypes::ENFORCEMENT_MANUAL);
        $coupon->setUsed(0);
        $coupon->setCount(0);
        $coupon->setPriority(0);
        $coupon->setStackable(false);
        $coupon->disable();
        $coupon->setCreatedAt($now);
        $coupon->setValidFrom($now);

        return $coupon;
    }
}
