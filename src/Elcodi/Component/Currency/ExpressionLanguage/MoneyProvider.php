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

namespace Elcodi\Component\Currency\ExpressionLanguage;

use RuntimeException;
use Symfony\Component\ExpressionLanguage\ExpressionFunction;
use Symfony\Component\ExpressionLanguage\ExpressionFunctionProviderInterface;

use Elcodi\Component\Currency\Entity\Interfaces\CurrencyInterface;
use Elcodi\Component\Currency\Entity\Money;
use Elcodi\Component\Currency\Repository\CurrencyRepository;

/**
 * Class MoneyProvider.
 *
 * Extends ExpressionLanguage to create money objects
 */
class MoneyProvider implements ExpressionFunctionProviderInterface
{
    /**
     * @var CurrencyInterface
     *
     * Currency wrapper to get the default currency
     */
    private $defaultCurrency;

    /**
     * @var CurrencyRepository
     *
     * Currency repository
     */
    private $currencyRepository;

    /**
     * Construct.
     *
     * @param CurrencyInterface   $defaultCurrency
     * @param CurrencyRepository $currencyRepository
     */
    public function __construct(
        CurrencyInterface $defaultCurrency,
        CurrencyRepository $currencyRepository
    ) {
        $this->defaultCurrency = $defaultCurrency;
        $this->currencyRepository = $currencyRepository;
    }

    /**
     * Return functions.
     *
     * @return ExpressionFunction[] An array of Function instances
     */
    public function getFunctions()
    {
        return [
            /**
             * Evaluate a rule by name.
             */
            new ExpressionFunction(
                'money',
                function () {
                    throw new RuntimeException(
                        'Function "money" can\'t be compiled.'
                    );
                },
                function (array $context, $amount, $currencyIso = null) {
                    if ($currencyIso === null) {
                        $currency = $this->defaultCurrency;
                    } else {
                        /**
                         * @var CurrencyInterface $currency
                         */
                        $currency = $this
                            ->currencyRepository
                            ->findOneBy([
                                'iso' => $currencyIso,
                            ]);
                    }

                    return Money::create(
                        $amount * 100,
                        $currency
                    );
                }
            ),
        ];
    }
}
