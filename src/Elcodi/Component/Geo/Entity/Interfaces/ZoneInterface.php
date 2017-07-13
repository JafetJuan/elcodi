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

namespace Elcodi\Component\Geo\Entity\Interfaces;

use Elcodi\Component\Core\Entity\Interfaces\DateTimeInterface;
use Elcodi\Component\Core\Entity\Interfaces\EnabledInterface;
use Elcodi\Component\Core\Entity\Interfaces\IdentifiableInterface;

/**
 * Interface ZoneInterface.
 */
interface ZoneInterface extends IdentifiableInterface, DateTimeInterface, EnabledInterface
{
    /**
     * Get Name.
     *
     * @return string Name
     */
    public function getName();

    /**
     * Sets Name.
     *
     * @param string $name Name
     *
     * @return $this Self object
     */
    public function setName($name);

    /**
     * Get Code.
     *
     * @return string Code
     */
    public function getCode();

    /**
     * Sets Code.
     *
     * @param string $code Code
     *
     * @return $this Self object
     */
    public function setCode($code);

    /**
     * Sets Locations.
     *
     * @param array $locations Locations
     *
     * @return $this Self object
     */
    public function setLocations(array $locations);

    /**
     * Get Locations.
     *
     * @return array Locations
     */
    public function getLocations();

    /**
     * Add location.
     *
     * @param string $location Location
     *
     * @return $this Self object
     */
    public function addLocation($location);

    /**
     * Remove location.
     *
     * @param string $location Location
     *
     * @return $this Self object
     */
    public function removeLocation($location);
}
