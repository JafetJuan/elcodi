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

use Elcodi\Component\Cart\Entity\Interfaces\OrderLineInterface;
use Elcodi\Component\Currency\Factory\Abstracts\AbstractPurchasableFactory;

/**
 * Class OrderLine.
 */
class OrderLineFactory extends AbstractPurchasableFactory
{
    /**
     * Creates an instance of an entity.
     *
     * This method must return always an empty instance for related entity
     *
     * @return OrderLineInterface New OrderLine instance
     */
    public function create()
    {
        /**
         * @var OrderLineInterface $orderLine
         */
        $classNamespace = $this->getEntityNamespace();
        $orderLine = new $classNamespace();

        $orderLine->setWidth(0);
        $orderLine->setHeight(0);
        $orderLine->setWidth(0);
        $orderLine->setWeight(0);
        $orderLine->setAmount($this->createZeroAmountMoney());
        $orderLine->setPurchasableAmount($this->createZeroAmountMoney());

        return $orderLine;
    }
}
