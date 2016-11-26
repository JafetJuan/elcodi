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
 * @author Elcodi Team <tech@elcodi.com>
 */

namespace Elcodi\Bundle\FixturesBoosterBundle\DependencyInjection;

use Mmoreram\BaseBundle\DependencyInjection\BaseExtension;

/**
 * Class ElcodiFixturesBoosterExtension.
 */
class ElcodiFixturesBoosterExtension extends BaseExtension
{
    /**
     * Returns the extension alias, same value as extension name.
     *
     * @return string The alias
     */
    public function getAlias()
    {
        return 'fixtures_booster';
    }

    /**
     * @return string
     */
    public function getConfigFilesLocation() : string
    {
        return __DIR__ . '/../Resources/config';
    }

    /**
     * @param array $config
     *
     * @return array
     */
    public function getConfigFiles(array $config) : array
    {
        return [
            'commands',
        ];
    }
}
