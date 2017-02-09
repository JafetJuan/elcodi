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

namespace Elcodi\Bundle\CoreBundle\DependencyInjection;

use Elcodi\Component\Core\Factory\Abstracts\AbstractFactory;
use Elcodi\Component\Core\Services\ObjectDirector;

/**
 * Trait ElcodiContainerAccessor.
 */
trait ElcodiContainerAccessor
{
    /**
     * Create new entity.
     *
     * @param string $entityAlias
     *
     * @return object
     */
    protected function create(string $entityAlias)
    {
        return $this
            ->getFactory($entityAlias)
            ->create();
    }

    /**
     * Get factory given its its entity name.
     *
     * @param string $entityAlias
     *
     * @return AbstractFactory
     */
    protected function getFactory(string $entityAlias) : AbstractFactory
    {
        list($domain, $entityName) = $this->fromMappingFormatToElcodiFormat($entityAlias);

        return $this->get("$domain.factory.$entityName");
    }

    /**
     * Get director given its its entity name.
     *
     * @param string $entityAlias
     *
     * @return ObjectDirector
     */
    protected function getDirector(string $entityAlias) : ObjectDirector
    {
        list($domain, $entityName) = $this->fromMappingFormatToElcodiFormat($entityAlias);

        return $this->get("$domain.director.$entityName");
    }

    /**
     * Transform common mapping format to elcodi format.
     *
     * Possible formats:
     *
     * "elcodi:cart"
     * "elcodi_whatever.more_things:shipping_range"
     * "cart" - Treated as "elcodi:cart"
     *
     * Return an array with the first part and the second part
     *
     * @param string $entityAlias
     *
     * @return array
     */
    private function fromMappingFormatToElcodiFormat(string $entityAlias) : array
    {
        $parts = explode(':', $entityAlias, 2);
        if (count($parts) === 2) {
            return $parts;
        }

        return [
            'elcodi',
            $parts[0]
        ];
    }
}
