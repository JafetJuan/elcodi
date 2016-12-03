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

namespace Elcodi\Bundle\CartBundle\Tests\Functional\EventListener;

use Elcodi\Bundle\CartBundle\Tests\Functional\ElcodiCartFunctionalTest;
use Elcodi\Component\Cart\Entity\Interfaces\CartInterface;
use Elcodi\Component\Cart\Entity\Interfaces\CartLineInterface;
use Elcodi\Component\Cart\Transformer\CartOrderTransformer;

/**
 * Class OrderLineCreationEventListenerTest.
 */
class OrderLineCreationEventListenerTest extends ElcodiCartFunctionalTest
{
    /**
     * Test update stock positive.
     *
     * @dataProvider dataUpdateStock
     */
    public function testUpdateStock(
        $stock,
        $quantity,
        $finalStock
    ) {
        $this->reloadFixtures();

        /**
         * @var CartOrderTransformer $cartOrderTransformer
         */
        $cartOrderTransformer = $this->get('elcodi.transformer.cart_order');

        /**
         * @var CartInterface     $cart
         * @var CartLineInterface $cartLine
         */
        $cart = $this->find('elcodi:cart', 2);
        $cartLine = $cart
            ->getCartLines()
            ->first();
        $cartLine->setQuantity($quantity);
        $this->save($cartLine);

        $purchasable = $cartLine->getPurchasable();
        $purchasable->setStock($stock);

        $this->save($purchasable);

        $this
            ->get('elcodi.event_dispatcher.cart')
            ->dispatchCartLoadEvents($cart);

        $cartOrderTransformer->createOrderFromCart($cart);
        $this->assertEquals($finalStock, $purchasable->getStock());
    }

    /**
     * Data for testUpdateStock.
     */
    public function dataUpdateStock()
    {
        return [
            [5, 2, 3],
            [5, 5, 0],
            [5, 6, 0],
            [null, 10, null],
            [null, 100, null],
            [null, 1, null],
        ];
    }
}
