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

namespace Elcodi\Component\Store\Entity;

use Elcodi\Component\Core\Entity\Traits\DateTimeTrait;
use Elcodi\Component\Core\Entity\Traits\EnabledTrait;
use Elcodi\Component\Core\Entity\Traits\IdentifiableTrait;
use Elcodi\Component\Currency\Entity\Interfaces\CurrencyInterface;
use Elcodi\Component\Currency\Entity\Traits\WithCurrenciesTrait;
use Elcodi\Component\Geo\Entity\Interfaces\AddressInterface;
use Elcodi\Component\Language\Entity\Interfaces\LanguageInterface;
use Elcodi\Component\Language\Entity\Traits\WithLanguagesTrait;
use Elcodi\Component\Media\Entity\Interfaces\ImageInterface;
use Elcodi\Component\MetaData\Entity\Traits\MetaDataTrait;
use Elcodi\Component\Store\Entity\Interfaces\StoreInterface;

/**
 * Class Store.
 */
class Store implements StoreInterface
{
    use IdentifiableTrait,
        DateTimeTrait,
        MetaDataTrait,
        EnabledTrait;

    /**
     * @var string
     *
     * Name
     */
    protected $name;

    /**
     * @var string
     *
     * Slug
     */
    protected $slug;

    /**
     * @var string
     *
     * Leitmotiv
     */
    protected $leitmotiv;

    /**
     * @var string
     *
     * Description
     */
    protected $description;

    /**
     * @var string
     *
     * Short Description
     */
    protected $shortDescription;

    /**
     * @var string
     *
     * Schedules
     */
    protected $schedules;

    /**
     * @var string
     *
     * Code
     */
    protected $code;

    /**
     * @var string
     *
     * Email
     */
    protected $email;

    /**
     * @var bool
     *
     * Is company
     */
    protected $isCompany;

    /**
     * @var string
     *
     * NIF/CIF
     */
    protected $cif;

    /**
     * @var string
     *
     * Tracker
     */
    protected $tracker;

    /**
     * @var string
     *
     * Template
     */
    protected $template;

    /**
     * @var bool
     *
     * Use stock
     */
    protected $useStock;

    /**
     * @var string
     *
     * Domains
     */
    protected $domains;

    /**
     * @var AddressInterface
     *
     * Address
     */
    protected $address;

    /**
     * @var LanguageInterface
     *
     * Default language
     */
    protected $defaultLanguage;

    /**
     * @var CurrencyInterface
     *
     * Default currency
     */
    protected $defaultCurrency;

    /**
     * @var ImageInterface
     *
     * Logo
     */
    protected $logo;

    /**
     * @var ImageInterface
     *
     * Secondary logo
     */
    protected $secondaryLogo;

    /**
     * @var ImageInterface
     *
     * Logo for mobile
     */
    protected $mobileLogo;

    /**
     * @var ImageInterface
     *
     * Header image
     */
    protected $headerImage;

    /**
     * @var ImageInterface
     *
     * Background image
     */
    protected $backgroundImage;

    /**
     * Get Name.
     *
     * @return null|string Name
     */
    public function getName() : ? string
    {
        return $this->name;
    }

    /**
     * Sets Name.
     *
     * @param null|string $name
     */
    public function setName(?string $name)
    {
        $this->name = $name;
        $this
            ->address
            ->setName($name);
    }

    /**
     * Get Slug.
     *
     * @return null|string Slug
     */
    public function getSlug() : ? string
    {
        return $this->slug;
    }

    /**
     * Sets Slug.
     *
     * @param null|string $slug
     */
    public function setSlug(?string $slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get Leitmotiv.
     *
     * @return null|string Leitmotiv
     */
    public function getLeitmotiv() : ? string
    {
        return $this->leitmotiv;
    }

    /**
     * Sets Leitmotiv.
     *
     * @param null|string $leitmotiv
     */
    public function setLeitmotiv(?string $leitmotiv)
    {
        $this->leitmotiv = $leitmotiv;
    }

    /**
     * Get Description
     *
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set Description
     *
     * @param null|string $description
     */
    public function setDescription(?string $description)
    {
        $this->description = $description;
    }

    /**
     * Get ShortDescription
     *
     * @return null|string
     */
    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    /**
     * Set ShortDescription
     *
     * @param null|string $shortDescription
     */
    public function setShortDescription(?string $shortDescription)
    {
        $this->shortDescription = $shortDescription;
    }

    /**
     * Get Schedules
     *
     * @return null|string
     */
    public function getSchedules(): ?string
    {
        return $this->schedules;
    }

    /**
     * Set Schedules
     *
     * @param null|string $schedules
     */
    public function setSchedules(?string $schedules)
    {
        $this->schedules = $schedules;
    }

    /**
     * Get Code
     *
     * @return null|string
     */
    public function getCode() : ? string
    {
        return $this->code;
    }

    /**
     * Set Code
     *
     * @param null|string $code
     */
    public function setCode(?string $code)
    {
        $this->code = $code;
    }

    /**
     * Get Email.
     *
     * @return null|string Email
     */
    public function getEmail() : ? string
    {
        return $this->email;
    }

    /**
     * Sets Email.
     *
     * @param null|string $email
     */
    public function setEmail(?string $email)
    {
        $this->email = $email;
    }

    /**
     * Get Cif.
     *
     * @return null|string Cif
     */
    public function getCif() : ? string
    {
        return $this->cif;
    }

    /**
     * Sets Cif.
     *
     * @param null|string $cif
     */
    public function setCif(?string $cif)
    {
        $this->cif = $cif;
    }

    /**
     * Get Tracker.
     *
     * @return null|string Tracker
     */
    public function getTracker() : ? string
    {
        return $this->tracker;
    }

    /**
     * Sets Tracker.
     *
     * @param null|string $tracker
     */
    public function setTracker(?string $tracker)
    {
        $this->tracker = $tracker;
    }

    /**
     * Get Template.
     *
     * @return null|string Template
     */
    public function getTemplate() : ? string
    {
        return $this->template;
    }

    /**
     * Sets Template.
     *
     * @param null|string $template
     */
    public function setTemplate(?string $template)
    {
        $this->template = $template;
    }

    /**
     * Get UseStock.
     *
     * @return bool UseStock
     */
    public function getUseStock() : bool
    {
        return is_null($this->useStock)
            ? false
            : $this->useStock;
    }

    /**
     * Sets UseStock.
     *
     * @param null|bool $useStock
     */
    public function setUseStock(?bool $useStock)
    {
        $this->useStock = $useStock;
    }

    /**
     * Get the domains
     *
     * @return null|string
     */
    public function getDomains() : ? string
    {
        return $this->domains;
    }

    /**
     * Set domains
     *
     * @param null|string $domains
     */
    public function setDomains(?string $domains)
    {
        $this->domains = $domains;
    }

    /**
     * Get Address.
     *
     * @return null|AddressInterface Address
     */
    public function getAddress() :? AddressInterface
    {
        return $this->address;
    }

    /**
     * Sets Address.
     *
     * @param null|AddressInterface $address
     */
    public function setAddress(?AddressInterface $address)
    {
        $this->address = $address;
    }

    /**
     * Get DefaultLanguage.
     *
     * @return null|LanguageInterface DefaultLanguage
     */
    public function getDefaultLanguage() :? LanguageInterface
    {
        return $this->defaultLanguage;
    }

    /**
     * Sets DefaultLanguage.
     *
     * @param null|LanguageInterface $defaultLanguage
     */
    public function setDefaultLanguage(?LanguageInterface $defaultLanguage)
    {
        $this->defaultLanguage = $defaultLanguage;
    }

    /**
     * Get DefaultCurrency.
     *
     * @return null|CurrencyInterface DefaultCurrency
     */
    public function getDefaultCurrency() :? CurrencyInterface
    {
        return $this->defaultCurrency;
    }

    /**
     * Sets DefaultCurrency.
     *
     * @param null|CurrencyInterface $defaultCurrency
     */
    public function setDefaultCurrency(CurrencyInterface $defaultCurrency)
    {
        $this->defaultCurrency = $defaultCurrency;
    }

    /**
     * Get Logo.
     *
     * @return null|ImageInterface Logo
     */
    public function getLogo() :? ImageInterface
    {
        return $this->logo;
    }

    /**
     * Sets Logo.
     *
     * @param null|ImageInterface $logo
     */
    public function setLogo(?ImageInterface $logo)
    {
        $this->logo = $logo;
    }

    /**
     * Get SecondaryLogo.
     *
     * @return null|ImageInterface SecondaryLogo
     */
    public function getSecondaryLogo() :? ImageInterface
    {
        return $this->secondaryLogo;
    }

    /**
     * Sets SecondaryLogo.
     *
     * @param null|ImageInterface $secondaryLogo
     */
    public function setSecondaryLogo(?ImageInterface $secondaryLogo)
    {
        $this->secondaryLogo = $secondaryLogo;
    }

    /**
     * Get MobileLogo.
     *
     * @return null|ImageInterface MobileLogo
     */
    public function getMobileLogo() :? ImageInterface
    {
        return $this->mobileLogo;
    }

    /**
     * Sets MobileLogo.
     *
     * @param null|ImageInterface $mobileLogo
     */
    public function setMobileLogo(?ImageInterface $mobileLogo)
    {
        $this->mobileLogo = $mobileLogo;
    }

    /**
     * Get HeaderImage.
     *
     * @return null|ImageInterface HeaderImage
     */
    public function getHeaderImage() :? ImageInterface
    {
        return $this->headerImage;
    }

    /**
     * Sets HeaderImage.
     *
     * @param null|ImageInterface $headerImage
     */
    public function setHeaderImage(?ImageInterface $headerImage)
    {
        $this->headerImage = $headerImage;
    }

    /**
     * Get BackgroundImage.
     *
     * @return null|ImageInterface BackgroundImage
     */
    public function getBackgroundImage() :? ImageInterface
    {
        return $this->backgroundImage;
    }

    /**
     * Sets BackgroundImage.
     *
     * @param null|ImageInterface $backgroundImage
     */
    public function setBackgroundImage(?ImageInterface $backgroundImage)
    {
        $this->backgroundImage = $backgroundImage;
    }
}
