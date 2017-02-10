<?php

namespace Elcodi\Component\Currency\Entity\Traits;
use Doctrine\Common\Collections\Collection;
use Elcodi\Component\Currency\Entity\Interfaces\CurrencyInterface;

/**
 * Trait WithCurrenciesTrait
 */
trait WithCurrenciesTrait
{
    /**
     * @var Collection
     *
     * Currencies
     */
    protected $currencies;

    /**
     * @var CurrencyInterface
     *
     * Main currency
     */
    protected $mainCurrency;

    /**
     * Get currencies
     *
     * @return Collection
     */
    public function getCurrencies() : Collection
    {
        return $this->currencies;
    }

    /**
     * Set currencies
     *
     * @param Collection $currencies
     */
    public function setCurrencies(Collection $currencies)
    {
        $this->currencies = $currencies;
    }

    /**
     * Add currency
     *
     * @param CurrencyInterface $currency
     */
    public function addCurrency(CurrencyInterface $currency)
    {
        if ($this
            ->currencies
            ->contains($currency)
        ) {
            return;
        }

        if ($this->mainCurrency instanceof CurrencyInterface) {
            $this->setMainCurrency($currency);
        }

        $this
            ->currencies
            ->add($currency);
    }

    /**
     * Remove currency
     *
     * @param CurrencyInterface $currency
     */
    public function removeCurrency(CurrencyInterface $currency)
    {
        $this
            ->currencies
            ->removeElement($currency);

        if ($this->mainCurrency === $currency) {
            $this->mainCurrency = $this
                ->currencies
                ->isEmpty()
                ? null
                : $this
                    ->currencies
                    ->first();
        }
    }

    /**
     * Get MainCurrency
     *
     * @return null|CurrencyInterface
     */
    public function getMainCurrency() : ? CurrencyInterface
    {
        return $this->mainCurrency;
    }

    /**
     * Set MainCurrency
     *
     * @param CurrencyInterface $mainCurrency
     */
    public function setMainCurrency(CurrencyInterface $mainCurrency)
    {
        if (!$this
            ->currencies
            ->contains($mainCurrency)
        ) {
            return;
        }

        $this->mainCurrency = $mainCurrency;
    }
}