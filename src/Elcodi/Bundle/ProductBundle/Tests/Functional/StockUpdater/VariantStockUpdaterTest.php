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

namespace Elcodi\Bundle\ProductBundle\Tests\Functional\StockUpdater;

use Elcodi\Bundle\ProductBundle\Tests\Functional\ElcodiProductFunctionalTest;

/**
 * Class VariantStockUpdaterTest.
 */
class VariantStockUpdaterTest extends ElcodiProductFunctionalTest
{
    /**
     * Test update stock.
     */
    public function testUpdateStock()
    {
        $variant = $this->find('elcodi:product_variant', 6);
        $this->get('elcodi.stock_updater.product_variant')->updateStock(
            $variant,
            20
        );
        $this->clear('elcodi:product_variant');
        $variant = $this->find('elcodi:product_variant', 6);
        $this->assertEquals(
            80,
            $variant->getStock()
        );
    }
}
