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

use Elcodi\Component\Product\Entity\Interfaces\ValueInterface;
use Elcodi\Component\Core\Factory\Abstracts\AbstractFactory;

/**
 * Factory for Value entities.
 */
class ValueFactory extends AbstractFactory
{
    /**
     * Creates a Value instance.
     *
     * @return ValueInterface New Value entity
     */
    public function create()
    {
        /**
         * @var ValueInterface $value
         */
        $classNamespace = $this->getEntityNamespace();
        $value = new $classNamespace();

        return $value;
    }
}
