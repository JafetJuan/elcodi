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

namespace Elcodi\Component\Tax\Factory;

use Elcodi\Component\Core\Factory\Abstracts\AbstractFactory;
use Elcodi\Component\Tax\Entity\Interfaces\TaxInterface;

/**
 * Class TaxFactory.
 */
class TaxFactory extends AbstractFactory
{
    /**
     * Creates an instance of an entity.
     *
     * This method must return always an empty instance
     *
     * @return TaxInterface Empty entity
     */
    public function create()
    {
        /**
         * @var TaxInterface $tax
         */
        $classNamespace = $this->getEntityNamespace();
        $tax = new $classNamespace();
        $tax->setName('');
        $tax->setDescription('');
        $tax->setValue(0);
        $tax->disable();

        return $tax;
    }
}
