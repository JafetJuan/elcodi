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

namespace Elcodi\Component\Banner\Entity\Interfaces;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Elcodi\Component\Core\Entity\Interfaces\DateTimeInterface;
use Elcodi\Component\Core\Entity\Interfaces\EnabledInterface;
use Elcodi\Component\Core\Entity\Interfaces\IdentifiableInterface;
use Elcodi\Component\Language\Entity\Interfaces\LanguageInterface;
use Elcodi\Component\Store\Entity\Interfaces\WithStoresInterface;

/**
 * Interface BannerZoneInterfaceInterface.
 */
interface BannerZoneInterface extends IdentifiableInterface, EnabledInterface, DateTimeInterface
{
    /**
     * Set banner name.
     *
     * @param string $name
     */
    public function setName(string $name);

    /**
     * Get banner name.
     *
     * @return string|null
     */
    public function getName() : ? string;

    /**
     * Set code.
     *
     * @param string $code
     */
    public function setCode(string $code);

    /**
     * Get code.
     *
     * @return string|null
     */
    public function getCode() : ? string;

    /**
     * Add banner into banner zone.
     *
     * @param BannerInterface $banner
     */
    public function addBanner(BannerInterface $banner);

    /**
     * Remove banner from banner zone.
     *
     * @param BannerInterface $banner
     */
    public function removeBanner(BannerInterface $banner);

    /**
     * Set banners into banner zone.
     *
     * @param Collection $banners
     */
    public function setBanners(Collection $banners);

    /**
     * Get banners.
     *
     * @return Collection
     */
    public function getBanners() : Collection;

    /**
     * Get enabled banners.
     *
     * @return Collection
     */
    public function getEnabledBanners() : Collection;

    /**
     * Get sorted images.
     *
     * @return Collection
     */
    public function getSortedEnabledBanners() : Collection;

    /**
     * Get BannersSort.
     *
     * @return string|null
     */
    public function getBannersSort() : ? string;

    /**
     * Sets BannersSort.
     *
     * @param string|null $bannersSort
     */
    public function setBannersSort(?string $bannersSort);
}
