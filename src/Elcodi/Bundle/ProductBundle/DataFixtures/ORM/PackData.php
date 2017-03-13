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

namespace Elcodi\Bundle\ProductBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Elcodi\Bundle\CoreBundle\DataFixtures\ORM\ElcodiFixture;
use Elcodi\Bundle\ProductBundle\DataFixtures\ORM\Traits\ProductWithImagesTrait;
use Elcodi\Component\Core\Services\ObjectDirector;
use Elcodi\Component\Currency\Entity\Interfaces\CurrencyInterface;
use Elcodi\Component\Currency\Entity\Money;
use Elcodi\Component\Product\ElcodiProductStock;
use Elcodi\Component\Product\Entity\Interfaces\CategoryInterface;
use Elcodi\Component\Product\Entity\Interfaces\ManufacturerInterface;

/**
 * Class PackData.
 */
class PackData extends ElcodiFixture implements DependentFixtureInterface
{
    use ProductWithImagesTrait;

    /**
     * Load data fixtures with the passed EntityManager.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /**
         * Pack.
         *
         * @var CategoryInterface     $category
         * @var ManufacturerInterface $manufacturer
         * @var CurrencyInterface     $currency
         * @var ObjectDirector        $packDirector
         */
        $category = $this->getReference('category');
        $manufacturer = $this->getReference('manufacturer');
        $product = $this->getReference('product');
        $productReduced = $this->getReference('product-reduced');
        $variant = $this->getReference('variant-red-small');
        $currency = $this->getReference('currency-dollar');
        $packDirector = $this->getDirector('purchasable_pack');

        // Id assigned = 9
        $pack = $packDirector->create();
        $pack->setName('pack');
        $pack->setSlug('pack');
        $pack->setDescription('my pack description');
        $pack->setShortDescription('my pack short description');
        $pack->addCategory($category);
        $pack->setPrincipalCategory($category);
        $pack->setManufacturer($manufacturer);
        $pack->addPurchasable($product);
        $pack->addPurchasable($productReduced);
        $pack->addPurchasable($variant);
        $pack->setStockType(ElcodiProductStock::SPECIFIC_STOCK);
        $pack->setStock(10);
        $pack->setPrice(Money::create(5000, $currency));
        $pack->setSku('pack-sku-code-1');
        $pack->setHeight(30);
        $pack->setWidth(30);
        $pack->setDepth(30);
        $pack->setWeight(200);
        $pack->setEnabled(true);

        $packDirector->save($pack);
        $this->addReference('pack', $pack);

        // Id assigned = 10
        $packInherit = $packDirector->create();
        $packInherit->setName('pack-inherit');
        $packInherit->setSlug('pack-inherit');
        $packInherit->setDescription('my pack inherit description');
        $packInherit->setShortDescription('my pack inherit short description');
        $packInherit->addCategory($category);
        $packInherit->setPrincipalCategory($category);
        $packInherit->setManufacturer($manufacturer);
        $packInherit->addPurchasable($product);
        $packInherit->addPurchasable($productReduced);
        $packInherit->addPurchasable($variant);
        $packInherit->setStockType(ElcodiProductStock::INHERIT_STOCK);
        $packInherit->setPrice(Money::create(5000, $currency));
        $packInherit->setSku('pack-inherit-sku-code-1');
        $packInherit->setHeight(30);
        $packInherit->setWidth(30);
        $packInherit->setDepth(30);
        $packInherit->setWeight(200);
        $packInherit->setEnabled(true);

        $this->storeProductImage(
            $packInherit,
            'pack.jpg'
        );

        $packDirector->save($packInherit);
        $this->addReference('pack-inherit', $packInherit);
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on.
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            'Elcodi\Bundle\ProductBundle\DataFixtures\ORM\ProductData',
            'Elcodi\Bundle\ProductBundle\DataFixtures\ORM\VariantData',
            'Elcodi\Bundle\CurrencyBundle\DataFixtures\ORM\CurrencyData',
            'Elcodi\Bundle\ProductBundle\DataFixtures\ORM\CategoryData',
            'Elcodi\Bundle\ProductBundle\DataFixtures\ORM\ManufacturerData',
            'Elcodi\Bundle\StoreBundle\DataFixtures\ORM\StoreData',
        ];
    }
}