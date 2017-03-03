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

namespace Elcodi\Component\Product\StockValidator;

use Elcodi\Component\Product\Entity\Interfaces\PurchasableInterface;
use Elcodi\Component\Product\Entity\Interfaces\VariantInterface;
use Elcodi\Component\Product\StockValidator\Interfaces\PurchasableStockValidatorInterface;
use Elcodi\Component\Product\StockValidator\Traits\SimplePurchasableStockValidatorTrait;

/**
 * Class VariantStockValidator.
 */
class VariantStockValidator implements PurchasableStockValidatorInterface
{
    use SimplePurchasableStockValidatorTrait;

    /**
     * Get the entity interface.
     *
     * @return string Namespace
     */
    public function getPurchasableNamespace()
    {
        return VariantInterface::class;
    }

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
    public function isStockAvailable(
        PurchasableInterface $purchasable,
        int $stockRequired,
        bool $useStock
    ) {
        $namespace = $this->getPurchasableNamespace();
        if (!$purchasable instanceof $namespace) {
            return false;
        }

        /**
         * @var VariantInterface $purchasable
         */
        return $this->isValidUsingSimplePurchasableValidation(
            $purchasable,
            $stockRequired,
            $useStock
        );
    }
}
