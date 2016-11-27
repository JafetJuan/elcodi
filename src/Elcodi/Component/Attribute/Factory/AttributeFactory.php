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

namespace Elcodi\Component\Attribute\Factory;

use Doctrine\Common\Collections\ArrayCollection;

use Elcodi\Component\Attribute\Entity\Interfaces\AttributeInterface;
use Elcodi\Component\Core\Factory\Abstracts\AbstractFactory;

/**
 * Factory for Attribute entities.
 */
class AttributeFactory extends AbstractFactory
{
    /**
     * Creates an Attribute instance.
     *
     * @return AttributeInterface New Attribute entity
     */
    public function create()
    {
        /**
         * @var AttributeInterface $attribute
         */
        $classNamespace = $this->getEntityNamespace();
        $attribute = new $classNamespace();
        $attribute->enable();
        $attribute->setValues(new ArrayCollection());
        $attribute->setCreatedAt($this->now());

        return $attribute;
    }
}
