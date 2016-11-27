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

namespace Elcodi\Component\Core\Factory\Traits;

use Elcodi\Component\Core\Factory\Abstracts\AbstractFactory;

/**
 * Trait FactoryTrait.
 */
trait FactoryTrait
{
    /**
     * @var AbstractFactory
     *
     * Factory
     */
    private $factory;

    /**
     * Sets Factory.
     *
     * @param AbstractFactory $factory Factory
     */
    public function setFactory(AbstractFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Get Factory.
     *
     * @return AbstractFactory Factory
     */
    public function getFactory() : AbstractFactory
    {
        return $this->factory;
    }
}
