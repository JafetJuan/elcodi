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

namespace Elcodi\Component\Language\Services;

use Elcodi\Component\Language\Entity\Interfaces\LocaleInterface;
use Elcodi\Component\Language\Entity\Locale;

/**
 * Locale manager service.
 *
 * Manages locale
 */
class LocaleManager
{
    /**
     * @var LocaleInterface
     *
     * Locale
     */
    private $locale;

    /**
     * @var string
     *
     * Encoding
     */
    private $encoding;

    /**
     * @var array
     *
     * Locale information
     */
    private $localeInfo;

    /**
     * @var array
     *
     * Locale to country associations
     */
    private $localeCountryAssociations;

    /**
     * @var array
     *
     * Locale to translation associations
     */
    private $localeTranslationAssociations;

    /**
     * Construct method.
     *
     * @param LocaleInterface $locale
     * @param string          $encoding
     * @param array           $localeCountryAssociations
     * @param array           $localeTranslationAssociations
     */
    public function __construct(
        LocaleInterface $locale,
        string $encoding = '',
        array $localeCountryAssociations = [],
        array $localeTranslationAssociations = []
    ) {
        $this->locale = $locale;
        $this->encoding = $encoding;
        $this->localeCountryAssociations = $localeCountryAssociations;
        $this->localeTranslationAssociations = $localeTranslationAssociations;

        $this->initialize();
    }

    /**
     * Initialize locale.
     */
    public function initialize()
    {
        setlocale(LC_ALL, $this->locale->getIso() . '.' . $this->encoding);
        $this->localeInfo = localeconv();
    }

    /**
     * Returns current locale.
     *
     * @return LocaleInterface
     */
    public function getLocale() : LocaleInterface
    {
        return $this->locale;
    }

    /**
     * Returns current locale.
     *
     * @return string
     */
    public function getLocaleIso() : string
    {
        return $this
            ->getLocale()
            ->getIso();
    }

    /**
     * Sets locale.
     *
     * @param LocaleInterface $locale
     */
    public function setLocale(LocaleInterface $locale)
    {
        $this->locale = $locale;
        $this->initialize();
    }

    /**
     * Returns current encoding.
     *
     * @return string
     */
    public function getEncoding() : string
    {
        return $this->encoding;
    }

    /**
     * Sets encoding.
     *
     * @param string $encoding
     */
    public function setEncoding(string $encoding)
    {
        $this->encoding = $encoding;
        $this->initialize();
    }

    /**
     * Returns current locale info.
     *
     * @return array
     */
    public function getIsoInfo() : array
    {
        return $this->localeInfo;
    }

    /**
     * Returns the 2-letter ISO code of the country according to locale.
     *
     * @return LocaleInterface
     */
    public function getCountryCode() : LocaleInterface
    {
        $localeIso = $this
            ->locale
            ->getIso();

        if (isset($this->localeCountryAssociations[$localeIso])) {
            return Locale::create($this->localeCountryAssociations[$localeIso]);
        }

        $regionLocale = \Locale::getRegion($localeIso);

        return $regionLocale
            ? Locale::create($regionLocale)
            : $this->locale;
    }

    /**
     * Returns the locale used to look for translations, which may not be the
     * same as $this->locale.
     *
     * @return LocaleInterface
     */
    public function getTranslationsLocale()
    {
        $localeIso = $this->locale->getIso();

        if (isset($this->localeTranslationAssociations[$localeIso])) {
            return Locale::create($this->localeTranslationAssociations[$localeIso]);
        }

        return $this->locale;
    }
}
