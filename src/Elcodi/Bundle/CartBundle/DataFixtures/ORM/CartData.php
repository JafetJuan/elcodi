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

namespace Elcodi\Bundle\CartBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Elcodi\Bundle\CoreBundle\DataFixtures\ORM\ElcodiFixture;
use Elcodi\Component\Cart\Entity\Interfaces\CartInterface;
use Elcodi\Component\Cart\Entity\Interfaces\CartLineInterface;
use Elcodi\Component\Core\Services\ObjectDirector;
use Elcodi\Component\Geo\Entity\Interfaces\AddressInterface;
use Elcodi\Component\Product\Entity\Interfaces\ProductInterface;
use Elcodi\Component\User\Entity\Interfaces\CustomerInterface;

/**
 * Class CartData.
 */
class CartData extends ElcodiFixture implements DependentFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /**
         * Carts.
         *
         * @var CartInterface     $emptyCart
         * @var CartInterface     $fullCart
         * @var CustomerInterface $customer1
         * @var CustomerInterface $customer2
         * @var ProductInterface  $product
         * @var ProductInterface  $productReduced
         * @var CartLineInterface $cartLine1
         * @var CartLineInterface $cartLine2
         * @var ObjectDirector    $cartDirector
         * @var ObjectDirector    $cartLineDirector
         * @var AddressInterface  $address1
         * @var AddressInterface  $address2
         */
        $cartDirector = $this->getDirector('cart');
        $cartLineDirector = $this->getDirector('cart_line');

        $customer1 = $this->getReference('customer-1');
        $customer2 = $this->getReference('customer-2');
        $product = $this->getReference('product');
        $productReduced = $this->getReference('product-reduced');

        $address1 = $this->getReference('address-sant-celoni');
        $address2 = $this->getReference('address-viladecavalls');

        /**
         * Empty cart.
         */
        $emptyCart = $cartDirector->create();
        $emptyCart->setCustomer($customer1);

        $cartDirector->save($emptyCart);
        $this->addReference('empty-cart', $emptyCart);

        /**
         * Full cart.
         */
        $fullCart = $cartDirector->create();
        $fullCart->setCustomer($customer2);

        $cartLine1 = $cartLineDirector->create();
        $cartLine1->setPurchasable($product);
        $cartLine1->setPurchasableAmount($product->getPrice());
        $cartLine1->setAmount($product->getPrice());
        $cartLine1->setQuantity(2);
        $cartLine1->setCart($fullCart);

        $cartLine2 = $cartLineDirector->create();
        $cartLine2->setPurchasable($productReduced);
        $cartLine2->setPurchasableAmount($productReduced->getPrice());
        $cartLine2->setAmount($productReduced->getPrice());
        $cartLine2->setQuantity(2);
        $cartLine2->setCart($fullCart);

        $fullCart->addCartLine($cartLine1);
        $fullCart->addCartLine($cartLine2);

        $fullCart->setBillingAddress($address1);
        $fullCart->setDeliveryAddress($address2);

        $cartDirector->save($fullCart);
        $this->addReference('full-cart', $fullCart);
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
            'Elcodi\Bundle\UserBundle\DataFixtures\ORM\CustomerData',
            'Elcodi\Bundle\GeoBundle\DataFixtures\ORM\AddressData',
            'Elcodi\Bundle\CurrencyBundle\DataFixtures\ORM\CurrencyData',
        ];
    }
}
