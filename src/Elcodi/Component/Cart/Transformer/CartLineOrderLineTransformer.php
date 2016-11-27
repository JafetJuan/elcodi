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

namespace Elcodi\Component\Cart\Transformer;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Elcodi\Component\Cart\Entity\Interfaces\CartLineInterface;
use Elcodi\Component\Cart\Entity\Interfaces\OrderInterface;
use Elcodi\Component\Cart\Entity\Interfaces\OrderLineInterface;
use Elcodi\Component\Cart\EventDispatcher\OrderLineEventDispatcher;
use Elcodi\Component\Cart\Factory\OrderLineFactory;

/**
 * Class CartLineOrderLineTransformer.
 *
 * Api Methods:
 *
 * * createOrderLinesByCartLines(OrderInterface, Collection) : Collection
 * * createOrderLineFromCartLine(OrderInterface, CartLineInterface) : OrderLineInterface
 *
 * @api
 */
class CartLineOrderLineTransformer
{
    /**
     * @var OrderLineEventDispatcher
     *
     * OrderLineEventDispatcher
     */
    private $orderLineEventDispatcher;

    /**
     * @var OrderLineFactory
     *
     * OrderLine factory
     */
    private $orderLineFactory;

    /**
     * Construct method.
     *
     * @param OrderLineEventDispatcher $orderLineEventDispatcher Event dispatcher
     * @param OrderLineFactory         $orderLineFactory         OrderLineFactory
     */
    public function __construct(
        OrderLineEventDispatcher $orderLineEventDispatcher,
        OrderLineFactory $orderLineFactory
    ) {
        $this->orderLineEventDispatcher = $orderLineEventDispatcher;
        $this->orderLineFactory = $orderLineFactory;
    }

    /**
     * Given a set of CartLines, return a set of OrderLines.
     *
     * @param OrderInterface $order     Order
     * @param Collection     $cartLines Set of CartLines
     *
     * @return Collection Set of OrderLines
     */
    public function createOrderLinesByCartLines(
        OrderInterface $order,
        Collection $cartLines
    ) {
        $orderLines = new ArrayCollection();

        /**
         * @var CartLineInterface $cartLine
         */
        foreach ($cartLines as $cartLine) {
            $orderLine = $this
                ->createOrderLineByCartLine(
                    $order,
                    $cartLine
                );

            $cartLine->setOrderLine($orderLine);
            $orderLines->add($orderLine);
        }

        return $orderLines;
    }

    /**
     * Given a cart line, creates a new order line.
     *
     * @param OrderInterface    $order    Order
     * @param CartLineInterface $cartLine Cart Line
     *
     * @return OrderLineInterface OrderLine created
     */
    public function createOrderLineByCartLine(
        OrderInterface $order,
        CartLineInterface $cartLine
    ) {
        $orderLine = ($cartLine->getOrderLine() instanceof OrderLineInterface)
            ? $cartLine->getOrderLine()
            : $this->orderLineFactory->create();

        /**
         * @var OrderLineInterface $orderLine
         */
        $orderLine->setOrder($order);
        $orderLine->setPurchasable($cartLine->getPurchasable());
        $orderLine->setQuantity($cartLine->getQuantity());
        $orderLine->setPurchasableAmount($cartLine->getPurchasableAmount());
        $orderLine->setAmount($cartLine->getAmount());
        $orderLine->setHeight($cartLine->getHeight());
        $orderLine->setWidth($cartLine->getWidth());
        $orderLine->setDepth($cartLine->getDepth());
        $orderLine->setWeight($cartLine->getWeight());

        $this
            ->orderLineEventDispatcher
            ->dispatchOrderLineOnCreatedEvent(
                $order,
                $cartLine,
                $orderLine
            );

        return $orderLine;
    }
}
