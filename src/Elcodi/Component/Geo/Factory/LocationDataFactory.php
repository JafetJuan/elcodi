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

use Elcodi\Component\Geo\ValueObject\LocationData;

/**
 * Class LocationDataFactory.
 */
class LocationDataFactory
{
    /**
     * Create new Location.
     *
     * @param string $locationId   Location id
     * @param string $locationName Location name
     * @param string $locationCode Location code
     * @param string $locationType Location type
     *
     * @return LocationData
     */
    public function create(
        $locationId,
        $locationName,
        $locationCode,
        $locationType
    ) : LocationData {
        return new LocationData(
            $locationId,
            $locationName,
            $locationCode,
            $locationType
        );
    }
}
