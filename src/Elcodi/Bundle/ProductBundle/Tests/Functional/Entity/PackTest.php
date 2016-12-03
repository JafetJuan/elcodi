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

namespace Elcodi\Bundle\ProductBundle\Tests\Functional\Entity;

use Elcodi\Bundle\ProductBundle\Tests\Functional\ElcodiProductFunctionalTest;

/**
 * Class PackTest.
 */
class PackTest extends ElcodiProductFunctionalTest
{
    /**
     * Test get stock with specific stock.
     */
    public function testGetStockSpecificStock()
    {
        $this->assertEquals(10, $this
            ->find('elcodi:purchasable_pack', 9)
            ->getStock()
        );
    }

    /**
     * Test get stock with inherit stock.
     */
    public function testGetStockInheritStock()
    {
        $this->assertEquals(5, $this
            ->find('elcodi:purchasable_pack', 10)
            ->getStock()
        );
    }
}
