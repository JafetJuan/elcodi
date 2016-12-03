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

namespace Elcodi\Bundle\CartCouponBundle\Tests\Functional;

use Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle;
use Mmoreram\BaseBundle\Tests\BaseKernel;
use Symfony\Component\HttpKernel\KernelInterface;

use Elcodi\Bundle\CoreBundle\Tests\ElcodiFunctionalTest;
use Elcodi\Bundle\EntityTranslatorBundle\ElcodiEntityTranslatorBundle;
use Elcodi\Bundle\FixturesBoosterBundle\ElcodiFixturesBoosterBundle;

/**
 * Class ElcodiEntityTranslatorFunctionalTest.
 */
abstract class ElcodiEntityTranslatorFunctionalTest extends ElcodiFunctionalTest
{
    /**
     * Get kernel.
     *
     * @return KernelInterface
     */
    protected static function getKernel() : KernelInterface
    {
        return new BaseKernel([
            new DoctrineFixturesBundle(),
            new ElcodiFixturesBoosterBundle(),
            new ElcodiEntityTranslatorBundle(),
        ], [
            'imports' => [
                ['resource' => '@BaseBundle/Resources/config/providers.yml'],
                ['resource' => '@BaseBundle/Resources/test/framework.test.yml'],
                ['resource' => '@BaseBundle/Resources/test/doctrine.test.yml'],
                ['resource' => '@ElcodiCoreBundle/Resources/test/cache.test.yml'],
            ],
            'elcodi_entity_translator' => [
                'configuration' => [
                    'Elcodi\Component\EntityTranslator\Tests\Fixtures\TranslatableProduct' => [
                        'alias' => 'translatable_product',
                        'idGetter' => 'getId',
                        'fields' => [
                            'name' => [
                                'getter' => 'getName',
                                'setter' => 'setName',
                            ],
                        ],
                    ],
                ],
            ],
        ]);
    }

    /**
     * Schema must be loaded in all test cases.
     *
     * @return bool
     */
    protected static function loadSchema() : bool
    {
        return true;
    }
}
