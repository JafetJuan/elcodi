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

use Elcodi\Component\Cart\Entity\Interfaces\CartInterface;
use Elcodi\Component\Cart\Entity\Interfaces\CartLineInterface;
use Elcodi\Component\Cart\EventDispatcher\CartEventDispatcher;
use Elcodi\Component\Product\StockValidator\Interfaces\PurchasableStockValidatorInterface;

/**
 * Class CartIntegrityValidator.
 *
 * Api Methods:
 *
 * * validateCartIntegrity(CartInterface)
 *
 * @api
 */
class CartIntegrityValidator
{
    /**
     * @var CartEventDispatcher
     *
     * Cart EventDispatcher
     */
    private $cartEventDispatcher;

    /**
     * @var PurchasableStockValidatorInterface
     *
     * Purchasable stock validator
     */
    private $purchasableStockValidator;

    /**
     * @var CartManager
     *
     * Cart Manager
     */
    private $cartManager;

    /**
     * @var bool
     *
     * Uses stock
     */
    private $useStock;

    /**
     * Built method.
     *
     * @param CartEventDispatcher                $cartEventDispatcher
     * @param PurchasableStockValidatorInterface $purchasableStockValidator
     * @param CartManager                        $cartManager
     * @param bool                               $useStock
     */
    public function __construct(
        CartEventDispatcher $cartEventDispatcher,
        PurchasableStockValidatorInterface $purchasableStockValidator,
        CartManager $cartManager,
        bool $useStock = false
    ) {
        $this->cartEventDispatcher = $cartEventDispatcher;
        $this->purchasableStockValidator = $purchasableStockValidator;
        $this->cartManager = $cartManager;
        $this->useStock = $useStock;
    }

    /**
     * Validate cart integrity.
     *
     * @param CartInterface $cart
     */
    public function validateCartIntegrity(CartInterface $cart)
    {
        /**
         * Check every CartLine.
         *
         * @var CartLineInterface $cartLine
         */
        foreach ($cart->getCartLines() as $cartLine) {
            $this->validateCartLine($cartLine);
        }
    }

    /**
     * Check CartLine integrity.
     *
     * When a purchasable is not enabled or its quantity is <=0,
     * the line is discarded and a ElcodiCartEvents::CART_INCONSISTENT
     * event is fired.
     *
     * A further check on stock availability is performed so that when
     * $quantity is greater that the available units, $quantity for this
     * CartLine is set to Purchasable::$stock number
     *
     * @param CartLineInterface $cartLine
     */
    private function validateCartLine(CartLineInterface $cartLine)
    {
        $cart = $cartLine->getCart();
        $purchasable = $cartLine->getPurchasable();
        $realStockAvailable = $this
            ->purchasableStockValidator
            ->isStockAvailable(
                $purchasable,
                $cartLine->getQuantity(),
                $this->useStock
            );

        if (
            false === $realStockAvailable ||
            $realStockAvailable === 0
        ) {
            $this->cartManager->silentRemoveLine(
                $cart,
                $cartLine
            );

            /**
             * An inconsistent cart event is dispatched.
             */
            $this
                ->cartEventDispatcher
                ->dispatchCartInconsistentEvent(
                    $cart,
                    $cartLine
                );

            return;
        }

        if (is_int($realStockAvailable)) {
            $cartLine->setQuantity($realStockAvailable);
        }
    }
}
