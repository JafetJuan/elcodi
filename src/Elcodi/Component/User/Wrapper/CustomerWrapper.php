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

namespace Elcodi\Component\User\Wrapper;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

use Elcodi\Component\User\Entity\Interfaces\CustomerInterface;
use Elcodi\Component\User\Factory\CustomerFactory;

/**
 * Cart to order service.
 */
class CustomerWrapper
{
    /**
     * @var CustomerInterface
     *
     * Customer
     */
    private $customer;

    /**
     * @var CustomerFactory
     *
     * Customer factory
     */
    private $customerFactory;

    /**
     * @var TokenStorageInterface
     *
     * Token storage
     */
    private $tokenStorage;

    /**
     * Construct method.
     *
     * This wrapper loads Customer from database if this exists and is authenticated.
     * Otherwise, this create new Guest without persisting it
     *
     * @param CustomerFactory       $customerFactory Customer factory
     * @param TokenStorageInterface $tokenStorage    TokenStorageInterface instance
     */
    public function __construct(
        CustomerFactory $customerFactory,
        TokenStorageInterface $tokenStorage = null
    ) {
        $this->customerFactory = $customerFactory;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * Get loaded object. If object is not loaded yet, then load it and save it
     * locally. Otherwise, just return the pre-loaded object.
     *
     * @return CustomerInterface|null
     */
    public function get() : ? CustomerInterface
    {
        if ($this->customer instanceof CustomerInterface) {
            return $this->customer;
        }

        $customer = $this->getCustomerFromToken();

        if (null === $customer) {
            $customer = $this->customerFactory->create();
        }

        $this->customer = $customer;

        return $customer;
    }

    /**
     * Clean loaded object in order to reload it again.
     */
    public function clean()
    {
        $this->customer = null;
    }

    /**
     * Set customer.
     *
     * @param CustomerInterface|null $customer
     */
    public function setCustomer( ? CustomerInterface $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Return the current user from security context.
     *
     * @return CustomerInterface|null
     */
    private function getCustomerFromToken() : ? CustomerInterface
    {
        if (!($this->tokenStorage instanceof TokenStorageInterface)) {
            return null;
        }

        $token = $this->tokenStorage->getToken();
        if (!($token instanceof TokenInterface)) {
            return null;
        }

        $customer = $token->getUser();
        if (!($customer instanceof CustomerInterface)) {
            return null;
        }

        return $customer;
    }
}
