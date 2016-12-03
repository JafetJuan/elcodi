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

namespace Elcodi\Bundle\MenuBundle\Tests\Functional\Services;

use Elcodi\Bundle\MediaBundle\Tests\Functional\ElcodiMenuFunctionalTest;

/**
 * Class MenuManagerTest.
 */
class MenuManagerTest extends ElcodiMenuFunctionalTest
{
    /**
     * Test load structure.
     */
    public function testLoadAdminMenu()
    {
        $this->assertInstanceOf(
            'Elcodi\Component\Menu\Entity\Interfaces\MenuInterface',
            $this
                ->get('elcodi.manager.menu')
                ->loadMenuByCode('menu-admin')
        );
    }

    /**
     * Test load structure.
     */
    public function testLoadFrontMenu()
    {
        $this->assertInstanceOf(
            'Elcodi\Component\Menu\Entity\Interfaces\MenuInterface',
            $this
                ->get('elcodi.manager.menu')
                ->loadMenuByCode('menu-front')
        );
    }
}
