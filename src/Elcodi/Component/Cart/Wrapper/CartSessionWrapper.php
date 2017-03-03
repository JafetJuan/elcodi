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

namespace Elcodi\Component\Cart\Wrapper;

use Elcodi\Component\Cart\Entity\Interfaces\CartInterface;
use Elcodi\Component\Cart\Repository\CartRepository;
use Elcodi\Component\Cart\Services\CartSessionManager;

/**
 * Class CartSessionWrapper.
 *
 * Api Methods:
 *
 * * get()
 * * clean()
 * * loadCartFromSession()
 *
 * @api
 */
class CartSessionWrapper
{
    /**
     * @var CartSessionManager
     *
     * CartSessionManager
     */
    private $cartSessionManager;

    /**
     * @var CartRepository
     *
     * Cart repository
     */
    private $cartRepository;

    /**
     * @var CartInterface
     *
     * Cart loaded
     */
    private $cart;

    /**
     * Construct method.
     *
     * @param CartSessionManager $cartSessionManager
     * @param CartRepository     $cartRepository
     */
    public function __construct(
        CartSessionManager $cartSessionManager,
        CartRepository $cartRepository
    ) {
        $this->cartSessionManager = $cartSessionManager;
        $this->cartRepository = $cartRepository;
    }

    /**
     * Get loaded object. If object is not loaded yet, then load it and save it
     * locally. Otherwise, just return the pre-loaded object.
     *
     * @return CartInterface|null
     */
    public function get() : ? CartInterface
    {
        if ($this->cart instanceof CartInterface) {
            return $this->cart;
        }

        $this->cart = $this->loadCartFromSession();

        return $this->cart;
    }

    /**
     * Clean loaded object in order to reload it again.
     */
    public function clean()
    {
        $this->cart = null;
    }

    /**
     * Get cart from session.
     *
     * @return null|CartInterface
     */
    protected function loadCartFromSession() : ? CartInterface
    {
        $cartIdInSession = $this
            ->cartSessionManager
            ->get();

        if (!$cartIdInSession) {
            return null;
        }

        $cart = $this
            ->cartRepository
            ->findOneBy([
                'id' => $cartIdInSession,
                'ordered' => false,
            ]);

        return ($cart instanceof CartInterface)
            ? $cart
            : null;
    }
}
