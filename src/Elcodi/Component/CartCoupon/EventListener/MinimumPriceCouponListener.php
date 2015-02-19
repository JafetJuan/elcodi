<?php
/*
 * This file is part of the Elcodi package.
 *
 * Copyright (c) 2014 Elcodi.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 * @author Aldo Chiecchia <zimage@tiscali.it>
 */


namespace Elcodi\Component\CartCoupon\EventListener;

use Elcodi\Component\CartCoupon\Event\CartCouponOnCheckEvent;
use Elcodi\Component\Coupon\Exception\CouponBelowMinimumPurchaseException;
use Elcodi\Component\Currency\Services\CurrencyConverter;

/**
 * Class MinimumPriceCouponListener
 *
 * @author Berny Cantos <be@rny.cc>
 */
class MinimumPriceCouponListener
{
    /**
     * @var CurrencyConverter
     */
    protected $currencyConverter;

    /**
     * @param $currencyConverter
     */
    public function __construct($currencyConverter)
    {
        $this->currencyConverter = $currencyConverter;
    }

    /**
     * Check if cart meets minimum price requirements for a coupon
     *
     * @param CartCouponOnCheckEvent $event
     *
     * @throws CouponBelowMinimumPurchaseException
     */
    public function checkMinimumPrice(CartCouponOnCheckEvent $event)
    {
        $couponMinimumPrice = $event
            ->getCoupon()
            ->getMinimumPurchase();

        if ($couponMinimumPrice->getAmount() === 0) {

            return;
        }

        $productMoney = $event
            ->getCart()
            ->getProductAmount();

        if ($couponMinimumPrice->getCurrency() != $productMoney->getCurrency()) {
            $couponMinimumPrice = $this
                ->currencyConverter
                ->convertMoney(
                    $couponMinimumPrice,
                    $productMoney->getCurrency()
                );
        }

        if ($productMoney->isLessThan($couponMinimumPrice)) {

            throw new CouponBelowMinimumPurchaseException();
        }
    }
}