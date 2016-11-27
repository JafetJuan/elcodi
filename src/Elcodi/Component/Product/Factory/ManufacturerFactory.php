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

namespace Elcodi\Component\Product\Factory;

use Doctrine\Common\Collections\ArrayCollection;

use Elcodi\Component\Core\Factory\Abstracts\AbstractFactory;
use Elcodi\Component\Product\Entity\Interfaces\ManufacturerInterface;
use Elcodi\Component\Product\Entity\Manufacturer;

/**
 * Class ManufacturerFactory.
 */
class ManufacturerFactory extends AbstractFactory
{
    /**
     * Creates an instance of Manufacturer.
     *
     * @return ManufacturerInterface New Manufacturer entity
     */
    public function create()
    {
        /**
         * @var ManufacturerInterface $manufacturer
         */
        $classNamespace = $this->getEntityNamespace();
        $manufacturer = new $classNamespace();
        $manufacturer->setImages(new ArrayCollection());
        $manufacturer->setImagesSort('');
        $manufacturer->enable();
        $manufacturer->setCreatedAt($this->now());

        return $manufacturer;
    }
}
