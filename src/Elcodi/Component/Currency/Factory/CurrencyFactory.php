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

namespace Elcodi\Component\Currency\Factory;

use Elcodi\Component\Core\Factory\Abstracts\AbstractFactory;
use Elcodi\Component\Currency\Entity\Interfaces\CurrencyInterface;

/**
 * Class CurrencyFactory.
 */
class CurrencyFactory extends AbstractFactory
{
    /**
     * Creates an instance of Currency entity.
     *
     * @return CurrencyInterface Empty entity
     */
    public function create()
    {
        /**
         * @var CurrencyInterface $currency
         */
        $classNamespace = $this->getEntityNamespace();
        $currency = new $classNamespace();
        $currency->enable();
        $currency->setCreatedAt($this->now());

        return $currency;
    }
}
