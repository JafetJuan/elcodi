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

namespace Elcodi\Component\User\Entity\Interfaces;

use Doctrine\Common\Collections\Collection;

use Elcodi\Component\Cart\Entity\Interfaces\CartInterface;
use Elcodi\Component\Cart\Entity\Interfaces\OrderInterface;
use Elcodi\Component\Geo\Entity\Interfaces\AddressInterface;
use Elcodi\Component\Language\Entity\Interfaces\LanguageInterface;

/**
 * Interface CustomerInterface.
 *
 * Entities depending on CustomerInterfaces must implement shopping
 * capabilities and associations, such as addresses, orders, carts
 */
interface CustomerInterface extends AbstractUserInterface
{
    /**
     * Set phone.
     *
     * @param string|null $phone
     */
    public function setPhone( ? string $phone);

    /**
     * Get phone.
     *
     * @return string|null
     */
    public function getPhone() : ? string;

    /**
     * Set identity document.
     *
     * @param string|null $identityDocument
     */
    public function setIdentityDocument( ? string $identityDocument);

    /**
     * Get identity document.
     *
     * @return string|null
     */
    public function getIdentityDocument() : ? string;

    /**
     * Sets Guest.
     *
     * @param bool $guest
     */
    public function setGuest(bool $guest);

    /**
     * Get Guest.
     *
     * @return bool
     */
    public function isGuest() : bool;

    /**
     * Sets Newsletter.
     *
     * @param bool $newsletter
     */
    public function setNewsletter(bool $newsletter);

    /**
     * Get Newsletter.
     *
     * @return bool
     */
    public function getNewsletter() : bool;

    /**
     * Add Order.
     *
     * @param OrderInterface $order
     */
    public function addOrder(OrderInterface $order);

    /**
     * Remove Order.
     *
     * @param OrderInterface $order
     */
    public function removeOrder(OrderInterface $order);

    /**
     * Set orders.
     *
     * @param Collection $orders
     */
    public function setOrders(Collection $orders);

    /**
     * Get user orders.
     *
     * @return Collection
     */
    public function getOrders() : Collection;

    /**
     * Add Cart.
     *
     * @param CartInterface $cart
     */
    public function addCart(CartInterface $cart);

    /**
     * Remove Cart.
     *
     * @param CartInterface $cart
     */
    public function removeCart(CartInterface $cart);

    /**
     * @param Collection $carts
     */
    public function setCarts(Collection $carts);

    /**
     * Get Cart collection.
     *
     * @return Collection
     */
    public function getCarts() : Collection;

    /**
     * Add address.
     *
     * @param AddressInterface $address
     */
    public function addAddress(AddressInterface $address);

    /**
     * Remove address.
     *
     * @param AddressInterface $address
     */
    public function removeAddress(AddressInterface $address);

    /**
     * Set addresses.
     *
     * @param Collection $addresses
     */
    public function setAddresses(Collection $addresses);

    /**
     * Get addresses.
     *
     * @return Collection
     */
    public function getAddresses() : Collection;

    /**
     * Set Delivery Address.
     *
     * @param AddressInterface|null $deliveryAddress
     */
    public function setDeliveryAddress( ? AddressInterface $deliveryAddress);

    /**
     * Get Delivery address.
     *
     * @return AddressInterface|null
     */
    public function getDeliveryAddress() : ? AddressInterface;

    /**
     * Set Invoice Address.
     *
     * @param AddressInterface|null $invoiceAddress
     */
    public function setInvoiceAddress( ? AddressInterface $invoiceAddress);

    /**
     * Get Invoice address.
     *
     * @return AddressInterface|null
     */
    public function getInvoiceAddress() : ? AddressInterface;

    /**
     * Set language.
     *
     * @param LanguageInterface|null $language
     */
    public function setLanguage( ? LanguageInterface $language);

    /**
     * Get language.
     *
     * @return LanguageInterface|null
     */
    public function getLanguage() : ? LanguageInterface;
}
