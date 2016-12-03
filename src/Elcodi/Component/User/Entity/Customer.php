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

namespace Elcodi\Component\User\Entity;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\Role\Role;

use Elcodi\Component\Cart\Entity\Interfaces\CartInterface;
use Elcodi\Component\Cart\Entity\Interfaces\OrderInterface;
use Elcodi\Component\Geo\Entity\Interfaces\AddressInterface;
use Elcodi\Component\Language\Entity\Interfaces\LanguageInterface;
use Elcodi\Component\User\Entity\Interfaces\CustomerInterface;

/**
 * A Customer is a User with shopping capabilities and associations,
 * such as addresses, orders, carts.
 */
class Customer extends AbstractUser implements CustomerInterface
{
    /**
     * @var Collection
     *
     * Addresses
     */
    protected $addresses;

    /**
     * @var LanguageInterface
     *
     * Language
     */
    protected $language;

    /**
     * @var string
     *
     * Phone
     */
    protected $phone;

    /**
     * @var string
     *
     * Identity document
     */
    protected $identityDocument;

    /**
     * @var bool
     *
     * Is guest
     */
    protected $guest;

    /**
     * @var bool
     *
     * Has newsletter
     */
    protected $newsletter;

    /**
     * @var Collection
     *
     * Carts
     */
    protected $carts;

    /**
     * @var Collection
     *
     * Orders
     */
    protected $orders;

    /**
     * @var AddressInterface
     *
     * Delivery address
     */
    protected $deliveryAddress;

    /**
     * @var AddressInterface
     *
     * Invoice address
     */
    protected $invoiceAddress;

    /**
     * User roles.
     *
     * @return string[] Roles
     */
    public function getRoles()
    {
        return [
            new Role('ROLE_CUSTOMER'),
        ];
    }

    /**
     * Set phone.
     *
     * @param string|null $phone
     */
    public function setPhone( ? string $phone)
    {
        $this->phone = $phone;
    }

    /**
     * Get phone.
     *
     * @return string|null
     */
    public function getPhone() : ? string
    {
        return $this->phone;
    }

    /**
     * Set identity document.
     *
     * @param string|null $identityDocument
     */
    public function setIdentityDocument( ? string $identityDocument)
    {
        $this->identityDocument = $identityDocument;
    }

    /**
     * Get identity document.
     *
     * @return string
     */
    public function getIdentityDocument() : ? string
    {
        return $this->identityDocument;
    }

    /**
     * Sets Guest.
     *
     * @param bool $guest
     */
    public function setGuest(bool $guest)
    {
        $this->guest = $guest;
    }

    /**
     * Get Guest.
     *
     * @return bool
     */
    public function isGuest() : bool
    {
        return $this->guest;
    }

    /**
     * Sets Newsletter.
     *
     * @param bool $newsletter
     */
    public function setNewsletter(bool $newsletter)
    {
        $this->newsletter = $newsletter;
    }

    /**
     * Get Newsletter.
     *
     * @return bool
     */
    public function getNewsletter() : bool
    {
        return $this->newsletter;
    }

    /**
     * Add Order.
     *
     * @param OrderInterface $order Order
     */
    public function addOrder(OrderInterface $order)
    {
        if ($this
            ->orders
            ->contains($order)
        ) {
            return;
        }

        $this
            ->orders
            ->add($order);
    }

    /**
     * Remove Order.
     *
     * @param OrderInterface $order
     */
    public function removeOrder(OrderInterface $order)
    {
        $this
            ->orders
            ->removeElement($order);
    }

    /**
     * Set orders.
     *
     * @param Collection $orders
     */
    public function setOrders(Collection $orders)
    {
        $this->orders = $orders;
    }

    /**
     * Get user orders.
     *
     * @return Collection
     */
    public function getOrders() : Collection
    {
        return $this->orders;
    }

    /**
     * Add Cart.
     *
     * @param CartInterface $cart
     */
    public function addCart(CartInterface $cart)
    {
        if ($this
            ->carts
            ->contains($cart)
        ) {
            return;
        }

        $this
            ->carts
            ->add($cart);
    }

    /**
     * Remove Cart.
     *
     * @param CartInterface $cart
     */
    public function removeCart(CartInterface $cart)
    {
        $this->carts->removeElement($cart);
    }

    /**
     * Set carts.
     *
     * @param Collection $carts
     */
    public function setCarts(Collection $carts)
    {
        $this->carts = $carts;
    }

    /**
     * Get Cart collection.
     *
     * @return Collection
     */
    public function getCarts() : Collection
    {
        return $this->carts;
    }

    /**
     * Add address.
     *
     * @param AddressInterface $address
     */
    public function addAddress(AddressInterface $address)
    {
        if ($this
            ->addresses
            ->contains($address)
        ) {
            return;
        }

        $this
            ->addresses
            ->add($address);
    }

    /**
     * Remove address.
     *
     * @param AddressInterface $address
     */
    public function removeAddress(AddressInterface $address)
    {
        $this
            ->addresses
            ->removeElement($address);
    }

    /**
     * Set addresses.
     *
     * @param Collection $addresses
     */
    public function setAddresses(Collection $addresses)
    {
        $this->addresses = $addresses;
    }

    /**
     * Get addresses.
     *
     * @return Collection Addresses
     */
    public function getAddresses() : Collection
    {
        return $this->addresses;
    }

    /**
     * Set Delivery Address.
     *
     * @param AddressInterface|null $deliveryAddress
     */
    public function setDeliveryAddress( ? AddressInterface $deliveryAddress)
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    /**
     * Get Delivery address.
     *
     * @return AddressInterface|null
     */
    public function getDeliveryAddress() : ? AddressInterface
    {
        return $this->deliveryAddress;
    }

    /**
     * Set Invoice Address.
     *
     * @param AddressInterface|null $invoiceAddress
     */
    public function setInvoiceAddress( ? AddressInterface $invoiceAddress)
    {
        $this->invoiceAddress = $invoiceAddress;
    }

    /**
     * Get Invoice address.
     *
     * @return AddressInterface|null
     */
    public function getInvoiceAddress() : ? AddressInterface
    {
        return $this->invoiceAddress;
    }

    /**
     * Set language.
     *
     * @param LanguageInterface|null $language
     */
    public function setLanguage( ? LanguageInterface $language)
    {
        $this->language = $language;
    }

    /**
     * Get language.
     *
     * @return LanguageInterface|null
     */
    public function getLanguage() : ? LanguageInterface
    {
        return $this->language;
    }
}
