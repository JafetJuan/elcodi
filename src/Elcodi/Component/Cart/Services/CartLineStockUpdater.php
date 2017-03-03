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

namespace Elcodi\Component\Cart\Services;

use Elcodi\Component\Cart\Entity\Interfaces\CartLineInterface;
use Elcodi\Component\Product\StockUpdater\Interfaces\PurchasableStockUpdaterInterface;

/**
 * Class CartLineStockUpdater.
 *
 * Api Methods:
 *
 * * updatePurchasableStockByCartLine(CartLineInterface)
 *
 * @api
 */
class CartLineStockUpdater
{
    /**
     * @var PurchasableStockUpdaterInterface
     *
     * Purchasable stock updater
     */
    private $purchasableStockUpdater;

    /**
     * Built method.
     *
     * @param PurchasableStockUpdaterInterface $purchasableStockUpdater
     */
    public function __construct(PurchasableStockUpdaterInterface $purchasableStockUpdater)
    {
        $this->purchasableStockUpdater = $purchasableStockUpdater;
    }

    /**
     * Performs all processes to be performed after the order creation.
     *
     * Flushes all loaded order and related entities.
     *
     * @param CartLineInterface $cartLine
     */
    public function updatePurchasableStockByCartLine(CartLineInterface $cartLine)
    {
        $purchasable = $cartLine->getPurchasable();
        $this
            ->purchasableStockUpdater
            ->updateStock(
                $purchasable,
                $cartLine->getQuantity()
            );
    }
}
