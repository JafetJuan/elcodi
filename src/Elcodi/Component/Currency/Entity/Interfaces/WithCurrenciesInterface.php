<?php
/**
 * File header placeholder
 */

namespace Elcodi\Component\Currency\Entity\Interfaces;

use Doctrine\Common\Collections\Collection;

/**
 * Interface WithCurrenciesInterface
 */
interface WithCurrenciesInterface
{
    /**
     * Get currencies
     *
     * @return Collection
     */
    public function getCurrencies() : Collection;

    /**
     * Set currencies
     *
     * @param Collection $currencies
     */
    public function setCurrencies(Collection $currencies);

    /**
     * Add currency
     *
     * @param CurrencyInterface $currency
     */
    public function addCurrency(CurrencyInterface $currency);

    /**
     * Remove currency
     *
     * @param CurrencyInterface $currency
     */
    public function removeCurrency(CurrencyInterface $currency);

    /**
     * Get MainCurrency
     *
     * @return null|CurrencyInterface
     */
    public function getMainCurrency() : ? CurrencyInterface;

    /**
     * Set MainCurrency
     *
     * @param CurrencyInterface $mainCurrency
     */
    public function setMainCurrency(CurrencyInterface $mainCurrency);
}