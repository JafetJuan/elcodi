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

namespace Elcodi\Component\Store\Entity\Interfaces;

use Elcodi\Component\Core\Entity\Interfaces\DateTimeInterface;
use Elcodi\Component\Core\Entity\Interfaces\EnabledInterface;
use Elcodi\Component\Core\Entity\Interfaces\IdentifiableInterface;
use Elcodi\Component\Currency\Entity\Interfaces\CurrencyInterface;
use Elcodi\Component\Currency\Entity\Interfaces\WithCurrenciesInterface;
use Elcodi\Component\Geo\Entity\Interfaces\AddressInterface;
use Elcodi\Component\Language\Entity\Interfaces\LanguageInterface;
use Elcodi\Component\Language\Entity\Interfaces\WithLanguagesInterface;
use Elcodi\Component\Media\Entity\Interfaces\ImageInterface;
use Elcodi\Component\Media\Entity\Interfaces\ImagesContainerInterface;
use Elcodi\Component\MetaData\Entity\Interfaces\MetaDataInterface;

/**
 * Interface StoreInterface.
 */
interface StoreInterface extends
    IdentifiableInterface,
    DateTimeInterface,
    MetaDataInterface,
    ImagesContainerInterface,
    EnabledInterface
{
    /**
     * Get Name.
     *
     * @return null|string Name
     */
    public function getName() : ? string;

    /**
     * Sets Name.
     *
     * @param null|string $name
     */
    public function setName(?string $name);

    /**
     * Get Slug.
     *
     * @return null|string Slug
     */
    public function getSlug() : ? string;

    /**
     * Sets Slug.
     *
     * @param null|string $slug
     */
    public function setSlug(?string $slug);

    /**
     * Get Leitmotiv.
     *
     * @return null|string Leitmotiv
     */
    public function getLeitmotiv() : ? string;

    /**
     * Sets Leitmotiv.
     *
     * @param null|string $leitmotiv
     */
    public function setLeitmotiv(?string $leitmotiv);

    /**
     * Get Description
     *
     * @return null|string
     */
    public function getDescription(): ?string;
    /**
     * Set Description
     *
     * @param null|string $description
     */
    public function setDescription(?string $description);

    /**
     * Get ShortDescription
     *
     * @return null|string
     */
    public function getShortDescription(): ?string;

    /**
     * Set ShortDescription
     *
     * @param null|string $shortDescription
     */
    public function setShortDescription(?string $shortDescription);

    /**
     * Get Schedules
     *
     * @return null|string
     */
    public function getSchedules(): ?string;

    /**
     * Set Schedules
     *
     * @param null|string $schedules
     */
    public function setSchedules(?string $schedules);

    /**
     * Get Code
     *
     * @return null|string
     */
    public function getCode() : ? string;

    /**
     * Set Code
     *
     * @param null|string $code
     */
    public function setCode(?string $code);

    /**
     * Get Email.
     *
     * @return null|string Email
     */
    public function getEmail() : ? string;

    /**
     * Sets Email.
     *
     * @param null|string $email
     */
    public function setEmail(?string $email);

    /**
     * Get Cif.
     *
     * @return null|string Cif
     */
    public function getCif() : ? string;

    /**
     * Sets Cif.
     *
     * @param string $cif
     */
    public function setCif(?string $cif);

    /**
     * Get Tracker.
     *
     * @return null|string Tracker
     */
    public function getTracker() : ? string;

    /**
     * Sets Tracker.
     *
     * @param null|string $tracker
     */
    public function setTracker(?string $tracker);

    /**
     * Get Template.
     *
     * @return null|string Template
     */
    public function getTemplate() : ? string;

    /**
     * Sets Template.
     *
     * @param null|string $template
     */
    public function setTemplate(?string $template);

    /**
     * Get UseStock.
     *
     * @return bool UseStock
     */
    public function getUseStock() : bool;

    /**
     * Sets UseStock.
     *
     * @param bool $useStock
     */
    public function setUseStock(?bool $useStock);

    /**
     * Get the domains
     *
     * @return null|string
     */
    public function getDomains() : ? string;

    /**
     * Set domains
     *
     * @param null|string $domains
     */
    public function setDomains(?string $domains);

    /**
     * Get Address.
     *
     * @return null|AddressInterface Address
     */
    public function getAddress() : ? AddressInterface;

    /**
     * Sets Address.
     *
     * @param null|AddressInterface $address
     */
    public function setAddress(?AddressInterface $address);

    /**
     * Get Logo.
     *
     * @return null|ImageInterface Logo
     */
    public function getLogo() : ? ImageInterface;

    /**
     * Sets Logo.
     *
     * @param null|ImageInterface $logo
     */
    public function setLogo(?ImageInterface $logo);

    /**
     * Get SecondaryLogo.
     *
     * @return null|ImageInterface SecondaryLogo
     */
    public function getSecondaryLogo() : ? ImageInterface;

    /**
     * Sets SecondaryLogo.
     *
     * @param null|ImageInterface $secondaryLogo
     */
    public function setSecondaryLogo(?ImageInterface $secondaryLogo);

    /**
     * Get MobileLogo.
     *
     * @return null|ImageInterface MobileLogo
     */
    public function getMobileLogo() : ? ImageInterface;

    /**
     * Sets MobileLogo.
     *
     * @param null|ImageInterface $mobileLogo
     */
    public function setMobileLogo(?ImageInterface $mobileLogo);

    /**
     * Get HeaderImage.
     *
     * @return null|ImageInterface HeaderImage
     */
    public function getHeaderImage() : ? ImageInterface;

    /**
     * Sets HeaderImage.
     *
     * @param null|ImageInterface $headerImage
     */
    public function setHeaderImage(?ImageInterface $headerImage);

    /**
     * Get BackgroundImage.
     *
     * @return null|ImageInterface BackgroundImage
     */
    public function getBackgroundImage() : ? ImageInterface;

    /**
     * Sets BackgroundImage.
     *
     * @param null|ImageInterface $backgroundImage
     */
    public function setBackgroundImage(?ImageInterface $backgroundImage);
}
