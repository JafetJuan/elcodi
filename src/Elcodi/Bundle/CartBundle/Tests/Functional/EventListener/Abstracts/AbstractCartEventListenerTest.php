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

namespace Elcodi\Bundle\CartBundle\Tests\Functional\EventListener\Abstracts;

use Elcodi\Bundle\CartBundle\Tests\Functional\ElcodiCartFunctionalTest;
use Elcodi\Component\Cart\Entity\Interfaces\CartInterface;

/**
 * Class AbstractCartEventListenerTest.
 */
abstract class AbstractCartEventListenerTest extends ElcodiCartFunctionalTest
{
    /**
     * Get loaded cart.
     *
     * @param int $cartId Cart id
     *
     * @return CartInterface Cart loaded
     */
    public function getLoadedCart($cartId)
    {
        $cart = $this->find('elcodi:cart', $cartId);
        $this
            ->get('elcodi.event_dispatcher.cart')
            ->dispatchCartLoadEvents($cart);

        return $cart;
    }
}
