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

namespace Elcodi\Component\Product\StockValidator\Traits;

use Elcodi\Component\Product\Entity\Interfaces\PurchasableInterface;

/**
 * Trait SimplePurchasableStockValidatorTrait.
 */
trait SimplePurchasableStockValidatorTrait
{
    /**
     * Make a simple validation of a Purchasable instance. Return if the stock
     * is valid by returning a true or false if the entire stock is available.
     * Return the available stock otherwise.
     *
     * @param PurchasableInterface $purchasable
     * @param int                  $stockRequired
     * @param bool                 $useStock
     *
     * @return bool|int
     */
    public function isValidUsingSimplePurchasableValidation(
        PurchasableInterface $purchasable,
        int $stockRequired,
        bool $useStock
    ) {
        if (
            !$purchasable->isEnabled() ||
            $stockRequired <= 0 ||
            (
                $useStock &&
                $purchasable->getStock() <= 0
            )
        ) {
            return false;
        }

        if ($purchasable->getStock() < $stockRequired) {
            return $purchasable->getStock();
        }

        return true;
    }
}
