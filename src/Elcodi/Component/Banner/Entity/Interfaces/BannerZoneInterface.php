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

use Doctrine\Common\Collections\Collection;

use Elcodi\Component\Core\Entity\Interfaces\IdentifiableInterface;
use Elcodi\Component\Language\Entity\Interfaces\LanguageInterface;
use Elcodi\Component\Store\Entity\Interfaces\WithStoresInterface;

/**
 * Interface BannerZoneInterfaceInterface.
 */
interface BannerZoneInterface extends IdentifiableInterface, WithStoresInterface
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
     * Set Language.
     *
     * @param LanguageInterface|null $language
     */
    public function setLanguage( ? LanguageInterface $language);

    /**
     * Get Language.
     *
     * @return LanguageInterface|null
     */
    public function getLanguage() : ? LanguageInterface;

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
     * Set the BannerZoneInterface height in pixels.
     *
     * @param int $height
     */
    public function setHeight(int $height);

    /**
     * Get the BannerZoneInterface height in pixels.
     *
     * @return int
     */
    public function getHeight() : ? int;

    /**
     * Set the BannerZoneInterface width in pixels.
     *
     * @param int $width
     */
    public function setWidth(int $width);

    /**
     * Get the BannerZoneInterface width in pixels.
     *
     * @return int Width
     */
    public function getWidth() : ? int;
}
