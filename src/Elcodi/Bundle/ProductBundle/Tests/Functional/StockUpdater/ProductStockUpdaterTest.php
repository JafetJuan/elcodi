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
 * Class ProductStockUpdaterTest.
 */
class ProductStockUpdaterTest extends ElcodiProductFunctionalTest
{
    /**
     * Test update stock.
     */
    public function testUpdateStock()
    {
        $product = $this->find('elcodi:product', 1);
        $this->get('elcodi.stock_updater.product')->updateStock(
            $product,
            2
        );
        $this->clear('elcodi:product');
        $product = $this->find('elcodi:product', 1);
        $this->assertEquals(
            8,
            $product->getStock()
        );
    }
}
