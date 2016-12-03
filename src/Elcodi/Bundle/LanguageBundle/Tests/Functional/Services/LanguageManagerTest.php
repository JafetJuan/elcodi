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

namespace Elcodi\Bundle\LanguageBundle\Tests\Functional\Services;

use Elcodi\Bundle\GeoBundle\Tests\Functional\ElcodiLanguageFunctionalTest;

/**
 * Tests LanguageManagerTest class.
 */
class LanguageManagerTest extends ElcodiLanguageFunctionalTest
{
    /**
     * Test get languages.
     */
    public function testGetLanguages()
    {
        $languages = $this
            ->get('elcodi.manager.language')
            ->getLanguages();

        $this->assertCount(5, $languages);
        $this->assertContainsOnlyInstancesOf(
            'Elcodi\Component\Language\Entity\Interfaces\LanguageInterface',
            $languages
        );
        $this->assertEquals(
            'es',
            $languages
                ->first()
                ->getIso()
        );
    }

    /**
     * Test get languages iso.
     */
    public function testGetLanguagesIso()
    {
        $languages = $this
            ->get('elcodi.manager.language')
            ->getLanguagesIso();

        $this->assertEquals(
            ['es', 'en', 'fr', 'it', 'de'],
            $languages->toArray()
        );
    }
}
