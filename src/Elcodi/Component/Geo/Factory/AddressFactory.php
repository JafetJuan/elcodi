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
use Elcodi\Component\Geo\Entity\Interfaces\AddressInterface;

/**
 * Class AddressFactory.
 */
class AddressFactory extends AbstractFactory
{
    /**
     * Creates an instance of an entity.
     *
     * This method must return always an empty instance
     *
     * @return AddressInterface Empty entity
     */
    public function create()
    {
        /**
         * @var AddressInterface $address
         */
        $classNamespace = $this->getEntityNamespace();
        $address = new $classNamespace();
        $address->setAddressMore('');
        $address->enable();
        $address->setCreatedAt($this->now());

        return $address;
    }
}
