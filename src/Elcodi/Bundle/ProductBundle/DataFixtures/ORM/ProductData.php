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

use Elcodi\Bundle\CoreBundle\DataFixtures\ORM\Abstracts\AbstractFixture;
use Elcodi\Bundle\ProductBundle\DataFixtures\ORM\Traits\ProductWithImagesTrait;
use Elcodi\Component\Core\Services\ObjectDirector;
use Elcodi\Component\Currency\Entity\Interfaces\CurrencyInterface;
use Elcodi\Component\Currency\Entity\Money;
use Elcodi\Component\Product\Entity\Interfaces\CategoryInterface;
use Elcodi\Component\Product\Entity\Interfaces\ManufacturerInterface;
use Elcodi\Component\Product\Entity\Interfaces\ProductInterface;

/**
 * Class ProductData.
 */
class ProductData extends AbstractFixture implements DependentFixtureInterface
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
         * Product.
         *
         * @var CategoryInterface     $category
         * @var ManufacturerInterface $manufacturer
         * @var CurrencyInterface     $currency
         * @var ObjectDirector        $productDirector
         */
        $category = $this->getReference('category');
        $rootCategory = $this->getReference('rootCategory');
        $manufacturer = $this->getReference('manufacturer');
        $currency = $this->getReference('currency-dollar');
        $productDirector = $this->getDirector('product');

        /**
         * Product.
         *
         * @var ProductInterface $product
         */
        $product = $productDirector->create();
        $product->setName('product');
        $product->setSlug('product');
        $product->setDescription('my product description');
        $product->setShortDescription('my product short description');
        $product->addCategory($category);
        $product->setPrincipalCategory($category);
        $product->setManufacturer($manufacturer);
        $product->setStock(10);
        $product->setPrice(Money::create(1000, $currency));
        $product->setSku('product-sku-code-1');
        $product->setHeight(10);
        $product->setWidth(15);
        $product->setDepth(20);
        $product->setWeight(100);
        $product->setEnabled(true);

        $productDirector->save($product);
        $this->addReference('product', $product);

        /**
         * Reduced Product.
         *
         * @var ProductInterface $productReduced
         */
        $productReduced = $productDirector->create();
        $productReduced->setName('product-reduced');
        $productReduced->setSlug('product-reduced');
        $productReduced->setDescription('my product-reduced description');
        $productReduced->setShortDescription('my product-reduced short description');
        $productReduced->setShowInHome(true);
        $productReduced->setStock(5);
        $productReduced->setPrice(Money::create(1000, $currency));
        $productReduced->setReducedPrice(Money::create(500, $currency));
        $productReduced->setHeight(25);
        $productReduced->setWidth(30);
        $productReduced->setDepth(35);
        $productReduced->setWeight(200);
        $productReduced->setEnabled(true);

        $this->storeProductImage(
            $productReduced,
            'product.jpg'
        );

        $productDirector->save($productReduced);
        $this->addReference('product-reduced', $productReduced);

        /**
         * Product with variants.
         *
         * @var ProductInterface $productWithVariants
         */
        $productWithVariants = $productDirector->create();
        $productWithVariants->setName('Product with variants');
        $productWithVariants->setSku('product-sku-code-variant-1');
        $productWithVariants->setSlug('product-with-variants');
        $productWithVariants->setDescription('my product with variants description');
        $productWithVariants->setShortDescription('my product with variants short description');
        $productWithVariants->addCategory($category);
        $productWithVariants->setPrincipalCategory($category);
        $productWithVariants->setManufacturer($manufacturer);
        $productWithVariants->setStock(10);
        $productWithVariants->setPrice(Money::create(1000, $currency));
        $productWithVariants->setHeight(40);
        $productWithVariants->setWidth(45);
        $productWithVariants->setDepth(50);
        $productWithVariants->setWeight(500);
        $productWithVariants->setEnabled(true);

        $productDirector->save($productWithVariants);
        $this->addReference('product-with-variants', $productWithVariants);

        /**
         * Root category product.
         *
         * @var ProductInterface $rootCategoryProduct
         */
        $rootCategoryProduct = $productDirector->create();
        $productWithVariants->setName('Root category product');
        $productWithVariants->setSlug('root-category-product');
        $productWithVariants->setDescription('my product description');
        $productWithVariants->setShortDescription('my product short description');
        $productWithVariants->addCategory($rootCategory);
        $productWithVariants->setPrincipalCategory($rootCategory);
        $productWithVariants->setManufacturer($manufacturer);
        $productWithVariants->setStock(10);
        $productWithVariants->setPrice(Money::create(500, $currency));
        $productWithVariants->setSku('product-sku-code-3');
        $productWithVariants->setHeight(10);
        $productWithVariants->setWidth(15);
        $productWithVariants->setDepth(20);
        $productWithVariants->setWeight(100);
        $productWithVariants->setEnabled(true);

        $productDirector->save($rootCategoryProduct);
        $this->addReference('rootCategoryProduct', $rootCategoryProduct);
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
            'Elcodi\Bundle\CurrencyBundle\DataFixtures\ORM\CurrencyData',
            'Elcodi\Bundle\ProductBundle\DataFixtures\ORM\CategoryData',
            'Elcodi\Bundle\ProductBundle\DataFixtures\ORM\ManufacturerData',
            'Elcodi\Bundle\StoreBundle\DataFixtures\ORM\StoreData',
        ];
    }
}
