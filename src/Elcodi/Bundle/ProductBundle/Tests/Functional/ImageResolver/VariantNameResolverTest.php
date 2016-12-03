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

namespace Elcodi\Bundle\ProductBundle\Tests\Functional\ImageResolver;

use Elcodi\Bundle\ProductBundle\Tests\Functional\ElcodiProductFunctionalTest;

/**
 * Class VariantNameResolverTest.
 */
class VariantNameResolverTest extends ElcodiProductFunctionalTest
{
    /**
     * Test resolve image.
     */
    public function testResolveImage()
    {
        $variant = $this->find('elcodi:product_variant', 7);
        $this->assertEquals(
            'variant.jpg',
            $this
                ->get('elcodi.image_resolver.purchasable')
                ->getValidImage($variant)
                ->getName()
        );
    }

    /**
     * Test resolve image.
     */
    public function testResolveImageEmpty()
    {
        $variant = $this->find('elcodi:product_variant', 6);
        $this->assertFalse(
            $this
                ->get('elcodi.image_resolver.purchasable')
                ->getValidImage($variant)
        );
    }
}
