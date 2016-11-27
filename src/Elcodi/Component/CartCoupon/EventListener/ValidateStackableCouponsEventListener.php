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

namespace Elcodi\Component\CartCoupon\EventListener;

use Elcodi\Component\CartCoupon\Event\CartCouponOnApplyEvent;
use Elcodi\Component\CartCoupon\Services\StackableCouponValidator;

/**
 * Class ValidateStackableCouponsEventListener.
 */
final class ValidateStackableCouponsEventListener
{
    /**
     * @var StackableCouponValidator
     *
     * Stackable Coupon Validator
     */
    private $stackableCouponValidator;

    /**
     * Construct method.
     *
     * @param StackableCouponValidator $stackableCouponValidator Stackable Coupon Validator
     */
    public function __construct(StackableCouponValidator $stackableCouponValidator)
    {
        $this->stackableCouponValidator = $stackableCouponValidator;
    }

    /**
     * Check if this coupon can be applied when other coupons had previously
     * been applied.
     *
     * @param CartCouponOnApplyEvent $event Event
     */
    public function validateStackableCoupon(CartCouponOnApplyEvent $event)
    {
        $this
            ->stackableCouponValidator
            ->validateStackableCoupon(
                $event->getCart(),
                $event->getCoupon()
            );
    }
}
