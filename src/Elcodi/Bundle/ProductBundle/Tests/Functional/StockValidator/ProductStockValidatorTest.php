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

namespace Elcodi\Bundle\ProductBundle\Tests\Functional\StockValidator;

use Elcodi\Bundle\ProductBundle\Tests\Functional\ElcodiProductFunctionalTest;

/**
 * Class ProductStockValidatorTest.
 */
class ProductStockValidatorTest extends ElcodiProductFunctionalTest
{
    /**
     * Test product validator.
     */
    public function testIsStockAvailable()
    {
        $product = $this->find('elcodi:product', 1);
        $productStockValidator = $this->get('elcodi.stock_validator.product');
        $this->assertTrue(
            $productStockValidator->isStockAvailable(
                $product,
                1,
                true
            )
        );

        $this->assertEquals(
            10,
            $productStockValidator->isStockAvailable(
                $product,
                11,
                true
            )
        );

        $purchasableStockValidator = $this->get('elcodi.stock_validator.purchasable');

        $this->assertTrue(
            $purchasableStockValidator->isStockAvailable(
                $product,
                1,
                true
            )
        );

        $this->assertEquals(
            10,
            $purchasableStockValidator->isStockAvailable(
                $product,
                11,
                true
            )
        );
    }
}
