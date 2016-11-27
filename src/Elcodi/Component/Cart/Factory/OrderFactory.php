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

namespace Elcodi\Component\Cart\Factory;

use Doctrine\Common\Collections\ArrayCollection;

use Elcodi\Component\Cart\Entity\Interfaces\OrderInterface;
use Elcodi\Component\Currency\Factory\Abstracts\AbstractPurchasableFactory;
use Elcodi\Component\StateTransitionMachine\Entity\StateLineStack;
use Elcodi\Component\StateTransitionMachine\Machine\MachineManager;

/**
 * Class Order.
 */
class OrderFactory extends AbstractPurchasableFactory
{
    /**
     * @var MachineManager
     *
     * Machine Manager for Payment
     */
    protected $paymentMachineManager;

    /**
     * @var MachineManager
     *
     * Machine Manager for Shipping
     */
    protected $shippingMachineManager;

    /**
     * Sets PaymentMachineManager.
     *
     * @param MachineManager $paymentMachineManager PaymentMachineManager
     *
     * @return $this Self object
     */
    public function setPaymentMachineManager(MachineManager $paymentMachineManager)
    {
        $this->paymentMachineManager = $paymentMachineManager;

        return $this;
    }

    /**
     * Sets ShippingMachineManager.
     *
     * @param MachineManager $shippingMachineManager ShippingMachineManager
     *
     * @return $this Self object
     */
    public function setShippingMachineManager(MachineManager $shippingMachineManager)
    {
        $this->shippingMachineManager = $shippingMachineManager;

        return $this;
    }

    /**
     * Creates an instance of an entity.
     *
     * This method must return always an empty instance for related entity
     *
     * @return OrderInterface New Order instance
     */
    public function create()
    {
        /**
         * @var OrderInterface $order
         */
        $classNamespace = $this->getEntityNamespace();
        $order = new $classNamespace();
        $order->setQuantity(0);
        $order->setWidth(0);
        $order->setHeight(0);
        $order->setWidth(0);
        $order->setWeight(0);
        $order->setCreatedAt($this->now());
        $order->setPurchasableAmount($this->createZeroAmountMoney());
        $order->setAmount($this->createZeroAmountMoney());
        $order->setCouponAmount($this->createZeroAmountMoney());
        $order->setShippingAmount($this->createZeroAmountMoney());

        $paymentStateLineStack = $this
            ->paymentMachineManager
            ->initialize(
                $order,
                StateLineStack::create(
                    new ArrayCollection(),
                    null
                ),
                'Order not paid'
            );

        $order->setPaymentStateLineStack($paymentStateLineStack);

        $shippingStateLineStack = $this
            ->shippingMachineManager
            ->initialize(
                $order,
                StateLineStack::create(
                    new ArrayCollection(),
                    null
                ),
                'Preparing Order'
            );

        $order->setShippingStateLineStack($shippingStateLineStack);

        return $order;
    }
}
