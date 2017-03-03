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
use Elcodi\Component\Currency\Exception\CurrencyNotAvailableException;
use Elcodi\Component\Currency\Repository\CurrencyRepository;
use Elcodi\Component\Currency\Services\CurrencySessionManager;

/**
 * Class CurrencyWrapper.
 */
class CurrencyWrapper implements WrapperInterface
{
    /**
     * @var CurrencySessionManager
     *
     * Currency Session Manager
     */
    private $currencySessionManager;

    /**
     * @var CurrencyRepository
     *
     * Currency repository
     */
    private $currencyRepository;

    /**
     * @var CurrencyInterface
     *
     * Default currency
     */
    private $defaultCurrency;

    /**
     * @var CurrencyInterface
     *
     * Currency
     */
    private $currency;

    /**
     * Currency wrapper constructor.
     *
     * @param CurrencySessionManager $currencySessionManager
     * @param CurrencyRepository     $currencyRepository
     * @param CurrencyInterface $defaultCurrency
     */
    public function __construct(
        CurrencySessionManager $currencySessionManager,
        CurrencyRepository $currencyRepository,
        CurrencyInterface $defaultCurrency
    ) {
        $this->currencySessionManager = $currencySessionManager;
        $this->currencyRepository = $currencyRepository;
        $this->defaultCurrency = $defaultCurrency;
    }

    /**
     * Get loaded object. If object is not loaded yet, then load it and save it
     * locally. Otherwise, just return the pre-loaded object.
     *
     * The currency is loaded from session if exists. Otherwise will return the
     * default currency and saves it to session.
     *
     * @return CurrencyInterface Loaded object
     *
     * @throws CurrencyNotAvailableException No currency available
     */
    public function get()
    {
        if ($this->currency instanceof CurrencyInterface) {
            return $this->currency;
        }

        $this->currency = $this->loadCurrencyFromSession();

        if ($this->currency instanceof CurrencyInterface) {
            return $this->currency;
        }

        $this->currency = $this->defaultCurrency;
        $this->saveCurrencyToSession($this->currency);

        return $this->currency;
    }

    /**
     * Clean loaded object in order to reload it again.
     */
    public function clean()
    {
        $this->currency = null;
    }

    /**
     * Load currency from session.
     *
     * @return CurrencyInterface|null Currency
     *
     * @throws CurrencyNotAvailableException No currency available
     */
    private function loadCurrencyFromSession()
    {
        $currencyIdInSession = $this
            ->currencySessionManager
            ->get();

        return $currencyIdInSession
            ? $this->currency = $this
                ->currencyRepository
                ->find($currencyIdInSession)
            : null;
    }

    /**
     * Save currency to session.
     *
     * @param CurrencyInterface $currency
     */
    private function saveCurrencyToSession(CurrencyInterface $currency)
    {
        $this
            ->currencySessionManager
            ->set($currency);
    }
}
