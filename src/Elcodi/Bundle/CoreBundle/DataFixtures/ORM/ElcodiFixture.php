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

namespace Elcodi\Bundle\CoreBundle\DataFixtures\ORM;

use Mmoreram\BaseBundle\DataFixtures\BaseFixture;
use Symfony\Component\Yaml\Parser;

use Elcodi\Bundle\CoreBundle\DependencyInjection\ElcodiContainerAccessor;

/**
 * ElcodiFixture class.
 */
abstract class ElcodiFixture extends BaseFixture
{
    use ElcodiContainerAccessor;

    /**
     * Parse some content using a YAML parser.
     *
     * @param string $filePath File path
     *
     * @return mixed Value parsed
     */
    protected function parseYaml(string $filePath)
    {
        $yaml = new Parser();

        return $yaml->parse(file_get_contents($filePath));
    }
}
