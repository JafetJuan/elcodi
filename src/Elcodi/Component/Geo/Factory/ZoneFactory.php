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

namespace Elcodi\Component\Geo\Factory;

use Elcodi\Component\Core\Factory\Abstracts\AbstractFactory;
use Elcodi\Component\Geo\Entity\Interfaces\ZoneInterface;

/**
 * Factory for Zone entities.
 */
class ZoneFactory extends AbstractFactory
{
    /**
     * Creates an Zone instance.
     *
     * @return ZoneInterface New Zone entity
     */
    public function create()
    {
        /**
         * @var ZoneInterface $zone
         */
        $classNamespace = $this->getEntityNamespace();
        $zone = new $classNamespace();
        $zone->setLocations([]);
        $zone->enable();
        $zone->setCreatedAt($this->now());

        return $zone;
    }
}
