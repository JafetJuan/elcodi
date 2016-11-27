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

namespace Elcodi\Component\Product\Tests\UnitTest\Services;

use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit_Framework_TestCase;

use Elcodi\Component\Attribute\Entity\Value;
use Elcodi\Component\Product\Services\ProductOptionsResolver;

/**
 * Class ProductOptionsResolverTest
 */
class ProductOptionsResolverTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test for Product twig extension
     */
    public function testAvailableOptions()
    {
        $product = $this->createMock('Elcodi\Component\Product\Entity\Product');
        $variant = $this->createMock('Elcodi\Component\Product\Entity\Variant');
        $attribute = $this->createMock('Elcodi\Component\Attribute\Entity\Attribute');

        $option = new Value();
        $option->setId(111);
        $option->setAttribute($attribute);

        $product
            ->expects($this->once())
            ->method('getVariants')
            ->willReturn(new ArrayCollection([$variant]));

        $variant
            ->expects($this->once())
            ->method('getStock')
            ->willReturn(100);
        $variant
            ->expects($this->once())
            ->method('IsEnabled')
            ->willReturn(true);
        $variant
            ->expects($this->once())
            ->method('getOptions')
            ->willReturn(new ArrayCollection([$option]));

        $productOptionsResolver = new ProductOptionsResolver();
        $this->assertEquals(
            new ArrayCollection([$option]),
            $productOptionsResolver->getAvailableOptions(
                $product,
                $attribute
            )
        );
    }
}
