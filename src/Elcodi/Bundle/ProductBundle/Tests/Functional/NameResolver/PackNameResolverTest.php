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

namespace Elcodi\Bundle\ProductBundle\Tests\Functional\NameResolver;

use Elcodi\Bundle\ProductBundle\Tests\Functional\ElcodiProductFunctionalTest;

/**
 * Class PackNameResolverTest.
 */
class PackNameResolverTest extends ElcodiProductFunctionalTest
{
    /**
     * Test resolve name.
     */
    public function testResolveName()
    {
        $pack = $this->find('elcodi:purchasable_pack', 9);
        $this->assertEquals(
            'pack',
            $this
                ->get('elcodi.name_resolver.purchasable_pack')
                ->resolveName($pack)
        );
        $this->assertEquals(
            'pack',
            $this
                ->get('elcodi.name_resolver.purchasable')
                ->resolveName($pack)
        );
    }
}
