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

namespace Elcodi\Component\Product\Factory;

use Doctrine\Common\Collections\ArrayCollection;

use Elcodi\Component\Currency\Factory\Abstracts\AbstractPurchasableFactory;
use Elcodi\Component\Product\Entity\Interfaces\VariantInterface;

/**
 * Factory for Variant entities.
 */
class VariantFactory extends AbstractPurchasableFactory
{
    /**
     * Creates and returns a pristine Variant instance.
     *
     * Prices are initialized to "zero amount" Money value objects,
     * using injected CurrencyWrapper default Currency
     *
     * @return VariantInterface New Variant entity
     */
    public function create()
    {
        $zeroPrice = $this->createZeroAmountMoney();

        /**
         * @var VariantInterface $variant
         */
        $classNamespace = $this->getEntityNamespace();
        $variant = new $classNamespace();
        $variant->setSku('');
        $variant->setStock(0);
        $variant->setPrice($zeroPrice);
        $variant->setReducedPrice($zeroPrice);
        $variant->setImages(new ArrayCollection());
        $variant->setOptions(new ArrayCollection());
        $variant->setWidth(0);
        $variant->setHeight(0);
        $variant->setWidth(0);
        $variant->setDepth(0);
        $variant->setWeight(0);
        $variant->setShowInHome(false);
        $variant->setRecommended(false);
        $variant->setImagesSort('');
        $variant->enable();
        $variant->setCreatedAt($this->now());

        return $variant;
    }
}
