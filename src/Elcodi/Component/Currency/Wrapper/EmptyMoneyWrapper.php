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

namespace Elcodi\Component\Currency\Wrapper;

use Elcodi\Component\Core\Wrapper\Interfaces\WrapperInterface;
use Elcodi\Component\Currency\Entity\Interfaces\CurrencyInterface;
use Elcodi\Component\Currency\Entity\Money;

/**
 * Class EmptyMoneyWrapper.
 */
class EmptyMoneyWrapper implements WrapperInterface
{
    /**
     * @var CurrencyInterface
     *
     * Default currency
     */
    private $defaultCurrency;

    /**
     * Currency wrapper constructor.
     *
     * @param CurrencyInterface $defaultCurrency
     */
    public function __construct(CurrencyInterface $defaultCurrency)
    {
        $this->defaultCurrency = $defaultCurrency;
    }

    /**
     * Get empty money value, created with default language.
     *
     * @return Money Empty-valued money
     */
    public function get()
    {
        return Money::create(
            0,
            $this->defaultCurrency
        );
    }

    /**
     * Clean loaded object in order to reload it again.
     */
    public function clean()
    {
    }
}
