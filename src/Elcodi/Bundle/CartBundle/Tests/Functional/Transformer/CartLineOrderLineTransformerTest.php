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

namespace Elcodi\Bundle\CartBundle\Tests\Functional\Transformer;

use Elcodi\Bundle\CartBundle\Tests\Functional\ElcodiCartFunctionalTest;
use Elcodi\Component\Cart\Entity\Interfaces\CartInterface;
use Elcodi\Component\Cart\Entity\Interfaces\CartLineInterface;
use Elcodi\Component\Cart\Entity\OrderLine;
use Elcodi\Component\Cart\Transformer\CartLineOrderLineTransformer;
use Elcodi\Component\Cart\Transformer\CartOrderTransformer;

/**
 * Class CartLineOrderLineTransformer.
 */
class CartLineOrderLineTransformerTest extends ElcodiCartFunctionalTest
{
    /**
     * test create orderLine by CartLine.
     */
    public function testCreateOrderLineByCartLine()
    {
        /**
         * @var CartLineOrderLineTransformer $cartLineOrderLineTransformer
         * @var CartOrderTransformer         $cartOrderTransformer
         */
        $cartLineOrderLineTransformer = $this->get('elcodi.transformer.cart_line_order_line');
        $cartOrderTransformer = $this->get('elcodi.transformer.cart_order');

        /**
         * @var CartInterface     $cart
         * @var CartLineInterface $cartLine
         * @var OrderLine         $orderLine
         */
        $cart = $this->find('elcodi:cart', 2);

        $this
            ->get('elcodi.event_dispatcher.cart')
            ->dispatchCartLoadEvents($cart);

        $cartLine = $cart->getCartLines()->first();
        $order = $cartOrderTransformer->createOrderFromCart($cart);
        $orderLine = $cartLineOrderLineTransformer
            ->createOrderLineByCartLine(
                $order,
                $cartLine
            );

        $this->assertInstanceOf('Elcodi\Component\Cart\Entity\Interfaces\OrderLineInterface', $orderLine);
    }
}
