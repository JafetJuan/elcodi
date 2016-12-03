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
 * Class VariantStockValidatorTest.
 */
class VariantStockValidatorTest extends ElcodiProductFunctionalTest
{
    /**
     * Test product validator.
     */
    public function testIsStockAvailable()
    {
        $variant = $this->find('elcodi:product_variant', 6);
        $variantStockValidator = $this->get('elcodi.stock_validator.product_variant');
        $this->assertTrue(
            $variantStockValidator->isStockAvailable(
                $variant,
                1,
                true
            )
        );

        $this->assertEquals(
            100,
            $variantStockValidator->isStockAvailable(
                $variant,
                101,
                true
            )
        );

        $purchasableStockValidator = $this->get('elcodi.stock_validator.purchasable');

        $this->assertTrue(
            $purchasableStockValidator->isStockAvailable(
                $variant,
                1,
                true
            )
        );

        $this->assertEquals(
            100,
            $purchasableStockValidator->isStockAvailable(
                $variant,
                101,
                true
            )
        );
    }
}
