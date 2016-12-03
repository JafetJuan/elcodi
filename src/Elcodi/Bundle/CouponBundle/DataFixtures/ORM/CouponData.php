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

namespace Elcodi\Bundle\CouponBundle\DataFixtures\ORM;

use DateTime;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Elcodi\Bundle\CoreBundle\DataFixtures\ORM\ElcodiFixture;
use Elcodi\Component\CartCoupon\Applicator\AbsoluteCartCouponApplicator;
use Elcodi\Component\CartCoupon\Applicator\Abstracts\AbstractMxNCartCouponApplicator;
use Elcodi\Component\CartCoupon\Applicator\PercentCartCouponApplicator;
use Elcodi\Component\Core\Services\ObjectDirector;
use Elcodi\Component\Coupon\Entity\Interfaces\CouponInterface;
use Elcodi\Component\Currency\Entity\Interfaces\CurrencyInterface;
use Elcodi\Component\Currency\Entity\Money;

/**
 * Class CouponData.
 */
class CouponData extends ElcodiFixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        /**
         * @var CurrencyInterface $currency
         * @var ObjectDirector    $couponDirector
         */
        $couponDirector = $this->getDirector('coupon');
        $currency = $this->getReference('currency-dollar');

        /**
         * Coupon with 12% of discount.
         *
         * Valid from now without expire time
         *
         * Customer only can redeem it 5 times in all life
         *
         * Only 100 available
         *
         * @var CouponInterface $couponPercent
         */
        $couponPercent = $couponDirector->create();
        $couponPercent->setCode('percent');
        $couponPercent->setName('10 percent discount');
        $couponPercent->setType(PercentCartCouponApplicator::id());
        $couponPercent->setDiscount(12);
        $couponPercent->setCount(100);
        $couponPercent->setValidFrom(new DateTime());
        $couponPercent->setValidTo(new DateTime('next month'));

        $couponDirector->save($couponPercent);
        $this->addReference('coupon-percent', $couponPercent);

        /**
         * Coupon with 5 USD of discount.
         *
         * Valid from now without expire time
         *
         * Customer only can redeem it n times in all life
         *
         * Only 20 available
         *
         * Prices are stored in cents. @see \Elcodi\Component\Currency\Entity\Money
         *
         * @var CouponInterface $couponAmount
         */
        $couponAmount = $couponDirector->create();
        $couponAmount->setCode('amount');
        $couponAmount->setName('5 USD discount');
        $couponAmount->setType(AbsoluteCartCouponApplicator::id());
        $couponAmount->setPrice(Money::create(500, $currency));
        $couponAmount->setCount(20);
        $couponAmount->setValidFrom(new DateTime());
        $couponDirector->save($couponAmount);
        $this->addReference('coupon-amount', $couponAmount);

        /**
         * Stackable Coupon with 10% of discount.
         *
         * Valid from now without expire time
         *
         * Customer only can redeem it 5 times in all life
         *
         * Only 100 available
         *
         * @var CouponInterface $couponPercent
         */
        $stackableCouponPercent = $couponDirector->create();
        $stackableCouponPercent->setCode('stackable-percent');
        $stackableCouponPercent->setName('12 percent discount - stackable');
        $stackableCouponPercent->setType(PercentCartCouponApplicator::id());
        $stackableCouponPercent->setDiscount(12);
        $stackableCouponPercent->setCount(100);
        $stackableCouponPercent->setStackable(true);
        $stackableCouponPercent->setValidFrom(new DateTime());
        $stackableCouponPercent->setValidTo(new DateTime('next month'));
        $couponDirector->save($stackableCouponPercent);
        $this->addReference('stackable-coupon-percent', $stackableCouponPercent);

        /**
         * Stackable Coupon with 2 USD of discount.
         *
         * Valid from now without expire time
         *
         * Customer only can redeem it n times in all life
         *
         * Only 20 available
         *
         * Prices are stored in cents. @see \Elcodi\Component\Currency\Entity\Money
         *
         * @var CouponInterface $couponAmount
         */
        $stackableCouponAmount = $couponDirector->create();
        $stackableCouponAmount->setCode('stackable-amount');
        $stackableCouponAmount->setName('2 USD discount - stackable');
        $stackableCouponAmount->setType(AbsoluteCartCouponApplicator::id());
        $stackableCouponAmount->setPrice(Money::create(200, $currency));
        $stackableCouponAmount->setCount(20);
        $stackableCouponAmount->setStackable(true);
        $stackableCouponAmount->setValidFrom(new DateTime());
        $couponDirector->save($stackableCouponAmount);
        $this->addReference('stackable-coupon-amount', $stackableCouponAmount);

        /**
         * Coupon MxN. Valid for products with category 1.
         *
         * Valid from now without expire time
         *
         * Customer only can redeem it n times in all life
         *
         * Only 20 available
         *
         * Prices are stored in cents. @see \Elcodi\Component\Currency\Entity\Money
         *
         * @var CouponInterface $couponAmount
         */
        $coupon2x1Category1 = $couponDirector->create();
        $coupon2x1Category1->setCode('2x1category1');
        $coupon2x1Category1->setEnabled(true);
        $coupon2x1Category1->setName('2x1 in products from category1');
        $coupon2x1Category1->setType(AbstractMxNCartCouponApplicator::id());
        $coupon2x1Category1->setValue('2x1:cat(1):P');
        $coupon2x1Category1->setCount(20);
        $coupon2x1Category1->setValidFrom(new DateTime());
        $couponDirector->save($coupon2x1Category1);
        $this->addReference('coupon-2x1-category1', $coupon2x1Category1);
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on.
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            'Elcodi\Bundle\CurrencyBundle\DataFixtures\ORM\CurrencyData',
        ];
    }
}
