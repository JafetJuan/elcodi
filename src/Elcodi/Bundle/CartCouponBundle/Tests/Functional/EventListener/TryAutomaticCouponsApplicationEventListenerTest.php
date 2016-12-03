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

namespace Elcodi\Bundle\CartCouponBundle\Tests\Functional\EventListener;

use DateTime;

use Elcodi\Bundle\CartCouponBundle\Tests\Functional\EventListener\Abstracts\AbstractCartCouponEventListenerTest;
use Elcodi\Component\Coupon\ElcodiCouponTypes;

/**
 * Class TryAutomaticCouponsApplicationEventListenerTest.
 */
class TryAutomaticCouponsApplicationEventListenerTest extends AbstractCartCouponEventListenerTest
{
    /**
     * Test tryAutomaticCoupons.
     */
    public function testTryAutomaticCoupons()
    {
        $couponAutomatic = $this->create('elcodi:coupon');

        $couponAutomatic->setCode('automatic');
        $couponAutomatic->setName('50 percent discount');
        $couponAutomatic->setType(ElcodiCouponTypes::TYPE_PERCENT);
        $couponAutomatic->setDiscount(50);
        $couponAutomatic->setCount(100);
        $couponAutomatic->setEnabled(true);
        $couponAutomatic->setEnforcement(ElcodiCouponTypes::ENFORCEMENT_AUTOMATIC);
        $couponAutomatic->setValidFrom(new DateTime());
        $couponAutomatic->setValidTo(new DateTime('next month'));
        $this->save($couponAutomatic);

        $cart = $this->getLoadedCart(2);

        $this->assertEquals(1500, $cart
            ->getAmount()
            ->getAmount()
        );
    }
}
