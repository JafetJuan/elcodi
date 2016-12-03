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

namespace Elcodi\Bundle\ProductBundle\Tests\Functional\EventListener;

use Elcodi\Bundle\ProductBundle\Tests\Functional\ElcodiProductFunctionalTest;
use Elcodi\Component\Product\Entity\Interfaces\ProductInterface;

/**
 * Class ProductCategoryIntegrityEventListenerTest.
 */
class ProductCategoryIntegrityEventListenerTest extends ElcodiProductFunctionalTest
{
    /**
     * Test that the principal category is assigned when a product is saved
     * with categories but not principal category.
     */
    public function testProductIsSavedWithoutPrincipalCategoryButCategories()
    {
        $category = $this
            ->get('elcodi.repository.category')
            ->findOneBy(['slug' => 'category']);

        /**
         * @var ProductInterface $product
         */
        $product = $this->getNewProduct();
        $product->addCategory($category);
        $product->setSlug('new-product-1');
        $product->setName('New product 1');

        $this->save($product);

        $product = $this
            ->get('elcodi.repository.product')
            ->findOneBy(['slug' => 'new-product-1']);

        $this->assertEquals(
            $category,
            $product->getPrincipalCategory(),
            'The product does not have the expected principal category'
        );
    }

    /**
     * Test that the principal category is assigned as category when a product
     * is saved only with principal category.
     */
    public function testProductIsSavedOnlyWithPrincipalCategory()
    {
        $category = $this
            ->get('elcodi.repository.category')
            ->findOneBy(['slug' => 'category']);

        /**
         * @var ProductInterface $product
         */
        $product = $this->getNewProduct();
        $product->setPrincipalCategory($category);
        $product->setSlug('new-product-2');
        $product->setName('New product 2');

        $this->save($product);

        $product = $this
            ->get('elcodi.repository.product')
            ->findOneBy(['slug' => 'new-product-2']);

        $this->assertEquals(
            1,
            $product->getCategories()->count(),
            'The product is expected to have one category'
        );

        $this->assertEquals(
            $category,
            $product->getCategories()->first(),
            'The returned category should be the principal category'
        );
    }

    /**
     * Gets a new product entity.
     *
     * @return ProductInterface
     */
    public function getNewProduct()
    {
        return $this
            ->get('elcodi.factory.product')
            ->create();
    }
}
