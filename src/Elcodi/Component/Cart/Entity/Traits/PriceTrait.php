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

namespace Elcodi\Component\Cart\Entity\Traits;
use Elcodi\Component\Currency\Entity\Interfaces\CurrencyInterface;
use Elcodi\Component\Currency\Entity\Interfaces\MoneyInterface;
use Elcodi\Component\Currency\Entity\Money;

/**
 * Trait for entities that hold prices.
 *
 * CartLine and OrderLine entities usually will have this trait.
 *
 * A currency is needed so that a {@see Money} value object can be
 * exploited when doing currency arithmetics. When Currency is not
 * set, it is not possible to return a Money object, so getters
 * will return null
 */
trait PriceTrait
{
    /**
     * @var int
     *
     * Purchasable amount
     */
    protected $purchasableAmount;

    /**
     * @var CurrencyInterface
     *
     * Currency for the amounts stored in this entity
     */
    protected $purchasableCurrency;

    /**
     * @var int
     *
     * Total amount
     */
    protected $amount;

    /**
     * @var CurrencyInterface
     *
     * Currency for the amounts stored in this entity
     */
    protected $currency;

    /**
     * Gets the purchasable or purchasables amount with tax.
     *
     * @return MoneyInterface
     */
    public function getPurchasableAmount() : MoneyInterface
    {
        return Money::create(
            $this->purchasableAmount,
            $this->purchasableCurrency
        );
    }

    /**
     * Sets the purchasable or purchasables amount with tax.
     *
     * @param MoneyInterface $amount
     */
    public function setPurchasableAmount(MoneyInterface $amount)
    {
        $this->purchasableAmount = $amount->getAmount();
        $this->purchasableCurrency = $amount->getCurrency();
    }

    /**
     * Gets the total amount with tax.
     *
     * @return MoneyInterface
     */
    public function getAmount() : MoneyInterface
    {
        return Money::create(
            $this->amount,
            $this->currency
        );
    }

    /**
     * Sets the total amount with tax.
     *
     * @param MoneyInterface $amount
     */
    public function setAmount(MoneyInterface $amount)
    {
        $this->amount = $amount->getAmount();
        $this->currency = $amount->getCurrency();
    }
}
