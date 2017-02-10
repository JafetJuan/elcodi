<?php

namespace Elcodi\Component\Geo\Twig;

use Elcodi\Component\Geo\Transformer\LocationsToString;
use Twig_Extension;
use Twig_SimpleFilter;

/**
 * File header placeholder
 */
class LocationExtension extends Twig_Extension
{
    /**
     * @var LocationsToString
     *
     * Locations to string transformer
     */
    private $locationsToString;

    /**
     * LocationExtension constructor.
     *
     * @param LocationsToString $locationsToString
     */
    public function __construct(LocationsToString $locationsToString)
    {
        $this->locationsToString = $locationsToString;
    }

    /**
     * Return all filters.
     *
     * @return Twig_SimpleFilter[] Filters
     */
    public function getFilters()
    {
        return [
            new Twig_SimpleFilter('location_print_children', [
                $this->locationsToString,
                'printChildren',
            ]),
            new Twig_SimpleFilter('location_print_hierarchy', [
                $this->locationsToString,
                'printHierarchy',
            ]),
        ];
    }

    /**
     * return extension name.
     *
     * @return string extension name
     */
    public function getName()
    {
        return 'location_extension';
    }
}