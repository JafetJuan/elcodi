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

namespace Elcodi\Component\Product\Entity\Traits;

use Elcodi\Component\Currency\Entity\Interfaces\CurrencyInterface;
use Elcodi\Component\Currency\Entity\Interfaces\MoneyInterface;
use Elcodi\Component\Currency\Entity\Money;

/**
 * Trait PurchasablePriceTrait.
 *
 * Trait that defines common price members for a Purchasable
 */
trait PurchasablePriceTrait
{
    /**
     * @var int
     *
     * Product price
     */
    protected $price;

    /**
     * @var CurrencyInterface
     *
     * Product price currency
     */
    protected $priceCurrency;

    /**
     * @var int
     *
     * Reduced price
     */
    protected $reducedPrice;

    /**
     * @var CurrencyInterface
     *
     * Reduced price currency
     */
    protected $reducedPriceCurrency;

    /**
     * Set price.
     *
     * @param MoneyInterface $price
     */
    public function setPrice(MoneyInterface $price)
    {
        $this->price = $price->getAmount();
        $this->priceCurrency = $price->getCurrency();
    }

    /**
     * Get price.
     *
     * @return MoneyInterface
     */
    public function getPrice() : MoneyInterface
    {
        return Money::create(
            $this->price,
            $this->priceCurrency
        );
    }

    /**
     * Set price.
     *
     * @param MoneyInterface $reducedPrice
     *
     * @return $this
     */
    public function setReducedPrice(MoneyInterface $reducedPrice)
    {
        $this->reducedPrice = $reducedPrice->getAmount();
        $this->reducedPriceCurrency = $reducedPrice->getCurrency();
    }

    /**
     * Get price.
     *
     * @return MoneyInterface
     */
    public function getReducedPrice() : MoneyInterface
    {
        return Money::create(
            $this->reducedPrice,
            $this->reducedPriceCurrency
        );
    }

    /**
     * Get price.
     *
     * @return MoneyInterface
     */
    public function getResolvedPrice() : MoneyInterface
    {
        return $this->inOffer()
            ? $this->getReducedPrice()
            : $this->getPrice();
    }

    /**
     * Is in offer.
     *
     * @return bool
     */
    public function inOffer() : bool
    {
        return
            $this->reducedPrice > 0 &&
            $this->reducedPrice < $this->price
            ;
    }
}
