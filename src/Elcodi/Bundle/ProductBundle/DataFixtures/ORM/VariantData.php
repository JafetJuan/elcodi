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
use Elcodi\Bundle\CurrencyBundle\DataFixtures\ORM\CurrencyData;
use Elcodi\Bundle\ProductBundle\DataFixtures\ORM\Traits\ProductWithImagesTrait;
use Elcodi\Component\Product\Entity\Interfaces\ValueInterface;
use Elcodi\Component\Core\Services\ObjectDirector;
use Elcodi\Component\Currency\Entity\Interfaces\CurrencyInterface;
use Elcodi\Component\Currency\Entity\Money;
use Elcodi\Component\Product\Entity\Interfaces\ProductInterface;
use Elcodi\Component\Product\Entity\Interfaces\VariantInterface;

/**
 * Class VariantData
 */
class VariantData extends ElcodiFixture implements DependentFixtureInterface
{
    use ProductWithImagesTrait;

    /**
     * Loads sample fixtures for product Variant entities.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /**
         * @var ProductInterface  $productWithVariants
         * @var CurrencyInterface $currency
         * @var ObjectDirector    $variantDirector
         */
        $currency = $this->getReference('currency-dollar');
        $productWithVariants = $this->getReference('product-with-variants');
        $variantDirector = $this->getDirector('product_variant');

        /**
         * @var ValueInterface $optionWhite
         * @var ValueInterface $optionRed
         * @var ValueInterface $optionSmall
         * @var ValueInterface $optionLarge
         */
        $optionWhite = $this->getReference('value-color-white');
        $optionRed = $this->getReference('value-color-red');
        $optionSmall = $this->getReference('value-size-small');
        $optionLarge = $this->getReference('value-size-large');

        /**
         * Variant White-Small.
         *
         * @var VariantInterface $variantWhiteSmall
         */
        $variantWhiteSmall = $variantDirector->create();
        $variantWhiteSmall->setSku('variant-white-small-sku');
        $variantWhiteSmall->setStock(100);
        $variantWhiteSmall->setProduct($productWithVariants);
        $variantWhiteSmall->addOption($optionWhite);
        $variantWhiteSmall->addOption($optionSmall);
        $variantWhiteSmall->setPrice(Money::create(1500, $currency));
        $variantWhiteSmall->setHeight(13);
        $variantWhiteSmall->setWidth(12);
        $variantWhiteSmall->setDepth(19);
        $variantWhiteSmall->setWeight(125);
        $variantWhiteSmall->setEnabled(true);

        $productWithVariants->setPrincipalVariant($variantWhiteSmall);

        $variantDirector->save($variantWhiteSmall);
        $this->addReference('variant-white-small', $variantWhiteSmall);

        /**
         * Variant White-Large.
         *
         * @var VariantInterface $variantWhiteLarge
         */
        $variantWhiteLarge = $variantDirector->create();
        $variantWhiteLarge->setSku('variant-white-large-sku');
        $variantWhiteLarge->setStock(100);
        $variantWhiteLarge->setProduct($productWithVariants);
        $variantWhiteLarge->addOption($optionWhite);
        $variantWhiteLarge->addOption($optionLarge);
        $variantWhiteLarge->setPrice(Money::create(1800, $currency));
        $variantWhiteLarge->setHeight(12);
        $variantWhiteLarge->setWidth(11);
        $variantWhiteLarge->setDepth(45);
        $variantWhiteLarge->setWeight(155);
        $variantWhiteLarge->setEnabled(true);

        $variantDirector->save($variantWhiteLarge);
        $this->addReference('variant-white-large', $variantWhiteLarge);

        /**
         * Variant Red-Small.
         *
         * @var VariantInterface $variantRedSmall
         */
        $variantRedSmall = $variantDirector->create();
        $variantRedSmall->setSku('variant-red-small-sku');
        $variantRedSmall->setStock(100);
        $variantRedSmall->setProduct($productWithVariants);
        $variantRedSmall->addOption($optionRed);
        $variantRedSmall->addOption($optionSmall);
        $variantRedSmall->setPrice(Money::create(1500, $currency));
        $variantRedSmall->setHeight(19);
        $variantRedSmall->setWidth(9);
        $variantRedSmall->setDepth(33);
        $variantRedSmall->setWeight(1000);
        $variantRedSmall->setEnabled(true);

        $this->storeProductImage(
            $variantRedSmall,
            'variant.jpg'
        );

        $variantDirector->save($variantRedSmall);
        $this->addReference('variant-red-small', $variantRedSmall);

        /**
         * Variant Red-Large.
         *
         * @var VariantInterface $variantRedLarge
         */
        $variantRedLarge = $variantDirector->create();
        $variantRedLarge->setSku('variant-red-large-sku');
        $variantRedLarge->setStock(100);
        $variantRedLarge->setProduct($productWithVariants);
        $variantRedLarge->addOption($optionRed);
        $variantRedLarge->addOption($optionLarge);
        $variantRedLarge->setPrice(Money::create(1800, $currency));
        $variantRedLarge->setHeight(50);
        $variantRedLarge->setWidth(30);
        $variantRedLarge->setDepth(18);
        $variantRedLarge->setWeight(70);
        $variantRedLarge->setEnabled(true);

        $variantDirector->save($variantRedLarge);
        $this->addReference('variant-red-large', $variantRedLarge);
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
            CurrencyData::class,
            ProductData::class,
            VariantData::class
        ];
    }
}
