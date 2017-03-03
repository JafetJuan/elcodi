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
use Elcodi\Component\Cart\EventDispatcher\CartLineEventDispatcher;
use Elcodi\Component\Cart\Factory\CartFactory;
use Elcodi\Component\Cart\Factory\CartLineFactory;
use Elcodi\Component\Product\Entity\Interfaces\PurchasableInterface;

/**
 * Cart manager service.
 *
 * This service hosts all cart and cartLine related actions.
 *
 * Some of these methods also can dispatch some Cart events
 *
 * Api Methods:
 *
 * * addLine(AbstractCart, CartLine)
 * * removeLine(AbstractCart, CartLine)
 * * silentRemoveLine(AbstractCart, CartLine)
 * * emptyLines()
 *
 * * increaseCartLineQuantity(CartLine, int $quantity)
 * * decreaseCartLineQuantity(CartLine, int $quantity)
 * * setCartLineQuantity(CartLine, int $quantity)
 *
 * * addPurchasable(AbstractCart, PurchasableInterface, int $quantity)
 * * removePurchasable(AbstractCart, PurchasableInterface, int $quantity)
 *
 * @api
 */
class CartManager
{
    /**
     * @var CartEventDispatcher
     *
     * Cart Event Dispatcher
     */
    private $cartEventDispatcher;

    /**
     * @var CartLineEventDispatcher
     *
     * CartLine Event Dispatcher
     */
    private $cartLineEventDispatcher;

    /**
     * @var CartFactory
     *
     * cartFactory
     */
    private $cartFactory;

    /**
     * @var CartLineFactory
     *
     * CartLine Factory
     */
    private $cartLineFactory;

    /**
     * Construct method.
     *
     * @param CartEventDispatcher     $cartEventDispatcher
     * @param CartLineEventDispatcher $cartLineEventDispatcher
     * @param CartFactory             $cartFactory
     * @param CartLineFactory         $cartLineFactory
     */
    public function __construct(
        CartEventDispatcher $cartEventDispatcher,
        CartLineEventDispatcher $cartLineEventDispatcher,
        CartFactory $cartFactory,
        CartLineFactory $cartLineFactory
    ) {
        $this->cartEventDispatcher = $cartEventDispatcher;
        $this->cartLineEventDispatcher = $cartLineEventDispatcher;
        $this->cartFactory = $cartFactory;
        $this->cartLineFactory = $cartLineFactory;
    }

    /**
     * Adds cartLine to Cart.
     *
     * This method dispatches all Cart Check and Load events
     * It should NOT be used to add a Purchasable to a Cart,
     * by manually passing a newly crafted CartLine, since
     * no product duplication check is performed: in that
     * case CartManager::addProduct should be used
     *
     * @param CartInterface     $cart
     * @param CartLineInterface $cartLine
     */
    private function addLine(
        CartInterface $cart,
        CartLineInterface $cartLine
    ) {
        $cartLine->setCart($cart);
        $cart->addCartLine($cartLine);

        $this
            ->cartLineEventDispatcher
            ->dispatchCartLineOnAddEvent(
                $cart,
                $cartLine
            );

        $this
            ->cartEventDispatcher
            ->dispatchCartLoadEvents($cart);
    }

    /**
     * Removes CartLine from Cart.
     *
     * This method dispatches all Cart Load events, if defined.
     * If this method is called in CartCheckEvents, $dispatchEvents should be
     * set to false
     *
     * @param CartInterface     $cart
     * @param CartLineInterface $cartLine
     */
    public function removeLine(
        CartInterface $cart,
        CartLineInterface $cartLine
    ) {
        $this->silentRemoveLine($cart, $cartLine);

        $this
            ->cartEventDispatcher
            ->dispatchCartLoadEvents($cart);
    }

    /**
     * Removes CartLine from Cart.
     *
     * @param CartInterface     $cart
     * @param CartLineInterface $cartLine
     */
    public function silentRemoveLine(
        CartInterface $cart,
        CartLineInterface $cartLine
    ) {
        $cart->removeCartLine($cartLine);

        $this
            ->cartLineEventDispatcher
            ->dispatchCartLineOnRemoveEvent(
                $cart,
                $cartLine
            );
    }

    /**
     * Empty cart.
     *
     * This method dispatches all Cart Load events
     *
     * @param CartInterface $cart
     */
    public function emptyLines(CartInterface $cart)
    {
        $cart
            ->getCartLines()
            ->map(function (CartLineInterface $cartLine) use ($cart) {
                $this->silentRemoveLine($cart, $cartLine);
            });

        $this
            ->cartEventDispatcher
            ->dispatchCartOnEmptyEvent($cart);

        $this
            ->cartEventDispatcher
            ->dispatchCartLoadEvents($cart);
    }

    /**
     * Edit CartLine.
     *
     * The line is updated only if it belongs to a Cart
     *
     * This method dispatches all Cart Check and Load events
     *
     * @param CartLineInterface    $cartLine
     * @param PurchasableInterface $purchasable
     * @param int                  $quantity
     */
    public function editCartLine(
        CartLineInterface $cartLine,
        PurchasableInterface $purchasable,
        int $quantity
    ) {
        $cart = $cartLine->getCart();

        if (!($cart instanceof CartInterface)) {
            return;
        }

        $cartLine->setPurchasable($purchasable);
        $this->setCartLineQuantity($cartLine, $quantity);
    }

    /**
     * Adds quantity to cartLine.
     *
     * If quantity is higher than item stock, throw exception
     *
     * This method dispatches all Cart Check and Load events
     *
     * @param CartLineInterface $cartLine
     * @param int               $quantity
     */
    public function increaseCartLineQuantity(
        CartLineInterface $cartLine,
        $quantity
    ) {
        if (!is_int($quantity) || empty($quantity)) {
            return;
        }

        $newQuantity = $cartLine->getQuantity() + $quantity;

        $this->setCartLineQuantity(
            $cartLine,
            $newQuantity
        );
    }

    /**
     * Removes quantity to cartLine.
     *
     * If quantity is 0, deletes whole line
     *
     * This method dispatches all Cart Check and Load events
     *
     * @param CartLineInterface $cartLine
     * @param int               $quantity
     */
    public function decreaseCartLineQuantity(
        CartLineInterface $cartLine,
        int $quantity
    ) {
        if (!is_int($quantity) || empty($quantity)) {
            return;
        }

        $this->increaseCartLineQuantity(
            $cartLine,
            ($quantity * -1)
        );
    }

    /**
     * Sets quantity to cartLine.
     *
     * If quantity is higher than item stock, throw exception
     *
     * This method dispatches all Cart Check and Load events
     *
     * @param CartLineInterface $cartLine
     * @param int               $quantity
     */
    public function setCartLineQuantity(
        CartLineInterface $cartLine,
        int $quantity
    ) {
        $cart = $cartLine->getCart();

        if (!($cart instanceof CartInterface)) {
            return;
        }

        /**
         * If $quantity is an integer and is less or equal than 0, means that
         * full line must be removed.
         *
         * Otherwise, $quantity can have two values:
         * * null or false - Quantity is not affected
         * * integer higher than 0, quantity is edited and all changes are
         *   recalculated.
         */
        if (is_int($quantity) && $quantity <= 0) {
            $this->silentRemoveLine($cart, $cartLine);
        } elseif (is_int($quantity)) {
            $cartLine->setQuantity($quantity);

            $this
                ->cartLineEventDispatcher
                ->dispatchCartLineOnEditEvent(
                    $cart,
                    $cartLine
                );
        } else {

            /**
             * Nothing to do here. Quantity value is not an integer, so will not
             * be treated as such.
             */

            return;
        }

        $this
            ->cartEventDispatcher
            ->dispatchCartLoadEvents($cart);
    }

    /**
     * Add a Purchasable to Cart as a new CartLine.
     *
     * This method creates a new CartLine and set item quantity
     * correspondingly.
     *
     * If the Purchasable is already in the Cart, it just increments
     * item quantity by $quantity
     *
     * @param CartInterface        $cart
     * @param PurchasableInterface $purchasable
     * @param int                  $quantity
     */
    public function addPurchasable(
        CartInterface $cart,
        PurchasableInterface $purchasable,
        int $quantity
    ) {
        /**
         * If quantity is not a number or is 0 or less, product is not added
         * into cart.
         */
        if (!is_int($quantity) || $quantity <= 0) {
            return;
        }

        foreach ($cart->getCartLines() as $cartLine) {

            /**
             * @var CartLineInterface $cartLine
             */
            if (
                (get_class($cartLine->getPurchasable()) === get_class($purchasable)) &&
                ($cartLine->getPurchasable()->getId() == $purchasable->getId())
            ) {

                /**
                 * Product already in the Cart, increase quantity.
                 */

                $this->increaseCartLineQuantity($cartLine, $quantity);
            }
        }

        $cartLine = $this->cartLineFactory->create();
        $cartLine->setPurchasable($purchasable);
        $cartLine->setQuantity($quantity);

        $this->addLine($cart, $cartLine);
    }

    /**
     * Remove a Purchasable from Cart.
     *
     * This method removes a Purchasable from the Cart.
     *
     * If the Purchasable is already in the Cart, it just decreases
     * item quantity by $quantity
     *
     * @param CartInterface        $cart
     * @param PurchasableInterface $purchasable
     * @param int                  $quantity
     */
    public function removePurchasable(
        CartInterface $cart,
        PurchasableInterface $purchasable,
        int $quantity
    ) {
        /**
         * If quantity is not a number or is 0 or less, product is not removed
         * from cart.
         */
        if (!is_int($quantity) || $quantity <= 0) {
            return;
        }

        foreach ($cart->getCartLines() as $cartLine) {
            /**
             * @var CartLineInterface $cartLine
             */
            if (
                (get_class($cartLine->getPurchasable()) === get_class($purchasable)) &&
                ($cartLine->getPurchasable()->getId() == $purchasable->getId())
            ) {
                /**
                 * Product already in the Cart, decrease quantity.
                 */

                $this->decreaseCartLineQuantity($cartLine, $quantity);
            }
        }

        return;
    }
}
