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
use Elcodi\Component\Product\ElcodiProductTypes;
use Elcodi\Component\Product\Entity\Interfaces\PackInterface;
use Elcodi\Component\Product\Entity\Pack;

/**
 * Factory for Pack entities.
 */
class PackFactory extends AbstractPurchasableFactory
{
    /**
     * Creates and returns a pristine Pack instance.
     *
     * Prices are initialized to "zero amount" Money value objects,
     * using injected CurrencyWrapper default Currency
     *
     * @return PackInterface New Pack entity
     */
    public function create()
    {
        $zeroPrice = $this->createZeroAmountMoney();

        /**
         * @var PackInterface $pack
         */
        $classNamespace = $this->getEntityNamespace();
        $pack = new $classNamespace();

        $pack->setStock(0);
        $pack->setType(ElcodiProductTypes::TYPE_PRODUCT_PHYSICAL);
        $pack->setShowInHome(true);
        $pack->setRecommended(false);
        $pack->setPrice($zeroPrice);
        $pack->setReducedPrice($zeroPrice);
        $pack->setPurchasables(new ArrayCollection());
        $pack->setCategories(new ArrayCollection());
        $pack->setImages(new ArrayCollection());
        $pack->setWidth(0);
        $pack->setHeight(0);
        $pack->setDepth(0);
        $pack->setWidth(0);
        $pack->setWeight(0);
        $pack->setImagesSort('');
        $pack->enable();
        $pack->setCreatedAt($this->now());

        return $pack;
    }
}
