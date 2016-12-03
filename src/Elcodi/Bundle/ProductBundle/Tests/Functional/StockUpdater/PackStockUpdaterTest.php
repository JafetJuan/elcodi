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
 * Class PackStockUpdaterTest.
 */
class PackStockUpdaterTest extends ElcodiProductFunctionalTest
{
    /**
     * Test update stock.
     */
    public function atestUpdateStockNonInherit()
    {
        $pack = $this->find('elcodi:purchasable_pack', 9);
        $this->get('elcodi.stock_updater.purchasable_pack')->updateStock(
            $pack,
            4
        );
        $this->getObjectManager('elcodi:purchasable_pack')->clear();
        $pack = $this->find('elcodi:purchasable_pack', 9);
        $this->assertEquals(
            6,
            $pack->getStock()
        );
    }

    /**
     * Test update stock.
     */
    public function testUpdateStockInherit()
    {
        $this->reloadFixtures();

        $pack = $this->find('elcodi:purchasable_pack', 10);
        $this->get('elcodi.stock_updater.purchasable_pack')->updateStock(
            $pack,
            3
        );
        $this->clear('elcodi:purchasable_pack');
        $pack = $this->find('elcodi:purchasable_pack', 10);
        $this->assertEquals(
            2,
            $pack->getStock()
        );
        $purchasables = $pack->getPurchasables()->toArray();

        $this->assertEquals(
            7,
            $purchasables[0]->getStock()
        );

        $this->assertEquals(
            2,
            $purchasables[1]->getStock()
        );

        $this->assertEquals(
            97,
            $purchasables[2]->getStock()
        );
    }

    /**
     * Test update stock.
     */
    public function testUpdateStockInheritWithStockFinish()
    {
        $this->reloadFixtures();

        $pack = $this->find('elcodi:purchasable_pack', 10);
        $this->get('elcodi.stock_updater.purchasable_pack')->updateStock(
            $pack,
            9
        );
        $this->clear('elcodi:purchasable_pack');
        $pack = $this->find('elcodi:purchasable_pack', 10);
        $this->assertEquals(
            0,
            $pack->getStock()
        );
        $purchasables = $pack->getPurchasables()->toArray();

        $this->assertEquals(
            1,
            $purchasables[0]->getStock()
        );

        $this->assertEquals(
            0,
            $purchasables[1]->getStock()
        );

        $this->assertEquals(
            91,
            $purchasables[2]->getStock()
        );
    }
}
