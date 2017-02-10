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

namespace Elcodi\Component\Geo\Transformer;

use Elcodi\Component\Geo\Adapter\LocationProvider\Interfaces\LocationProviderAdapterInterface;
use Elcodi\Component\Geo\Entity\Location;

/**
 * Class LocationsToString.
 */
class LocationsToString
{
    /**
     * @var LocationProviderAdapterInterface
     *
     * Location provider
     */
    private $locationProvider;

    /**
     * LocationExtension constructor.
     *
     * @param LocationProviderAdapterInterface $locationProvider
     */
    public function __construct(LocationProviderAdapterInterface $locationProvider)
    {
        $this->locationProvider = $locationProvider;
    }

    /**
     * Get the children given a location id.
     *
     * @param string $locationId
     *
     * @return string
     */
    public function printChildren(string $locationId) : string
    {
        $locations = $this
            ->locationProvider
            ->getChildren($locationId);

        return $this->printLocations($locations);
    }

    /**
     * Get the parents given a location id.
     *
     * @param string $locationId
     *
     * @return string
     */
    public function printParents(string $locationId) : string
    {
        $locations = $this
            ->locationProvider
            ->getParents($locationId);

        return $this->printLocations($locations);
    }

    /**
     * Get the full location info given it's id.
     *
     * @param string $locationId
     *
     * @return string
     */
    public function printLocation(string $locationId) : string
    {
        return $this
            ->locationProvider
            ->getLocation($locationId)
            ->getName();
    }

    /**
     * Get the hierarchy given a location sorted from root to the given
     * location.
     *
     * @param string $locationId
     *
     * @return string
     */
    public function printHierarchy(string $locationId) : string
    {
        $locations = $this
            ->locationProvider
            ->getHierarchy($locationId);

        return $this->printLocations($locations);
    }

    /**
     * Print a set of locations
     *
     * @param Location[] $locations
     *
     * @return string
     */
    private function printLocations(array $locations) : string
    {
        $data = [];
        foreach ($locations as $location) {
            $data[] = $location->getName();
        }

        return implode(', ', $data);
    }
}
