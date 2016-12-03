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
     * @param string $entityName
     *
     * @return object
     */
    protected function create(string $entityName)
    {
        return $this
            ->getFactory($entityName)
            ->create();
    }

    /**
     * Get factory given its its entity name.
     *
     * @param string $entityName
     *
     * @return AbstractFactory
     */
    protected function getFactory(string $entityName) : AbstractFactory
    {
        return $this->get('elcodi.factory.' . $this->fromMappingFormatToElcodiFormat($entityName));
    }

    /**
     * Get director given its its entity name.
     *
     * @param string $entityName
     *
     * @return ObjectDirector
     */
    protected function getDirector(string $entityName) : ObjectDirector
    {
        return $this->get('elcodi.director.' . $this->fromMappingFormatToElcodiFormat($entityName));
    }

    /**
     * Transform common mapping format to elcodi format.
     *
     * @param string $entityAlias
     *
     * @return string
     */
    private function fromMappingFormatToElcodiFormat(string $entityAlias) : string
    {
        if (preg_match('~^elcodi\:.*+$~', $entityAlias)) {
            return str_replace('elcodi:', '', $entityAlias);
        }

        return $entityAlias;
    }
}
