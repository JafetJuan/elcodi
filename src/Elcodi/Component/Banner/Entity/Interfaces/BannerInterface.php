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

use Elcodi\Component\Core\Entity\Interfaces\DateTimeInterface;
use Elcodi\Component\Core\Entity\Interfaces\EnabledInterface;
use Elcodi\Component\Core\Entity\Interfaces\IdentifiableInterface;
use Elcodi\Component\Media\Entity\Interfaces\ImageInterface;
use Elcodi\Component\Media\Entity\Interfaces\PrincipalImageInterface;

/**
 * Interface BannerInterface.
 */
interface BannerInterface extends
    IdentifiableInterface,
    EnabledInterface,
    PrincipalImageInterface,
    DateTimeInterface
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
     * Set banner description.
     *
     * @param string $description
     */
    public function setDescription(string $description);

    /**
     * Get banner description.
     *
     * @return string|null
     */
    public function getDescription() : ? string;

    /**
     * Set banner extra.
     *
     * @param string $extra
     */
    public function setExtra(string $extra);

    /**
     * Get banner extra.
     *
     * @return string|null
     */
    public function getExtra() : ? string;

    /**
     * Set banner url.
     *
     * @param string $url
     */
    public function setUrl(string $url);

    /**
     * Get banner url.
     *
     * @return string|null
     */
    public function getUrl() : ? string;

    /**
     * Get ButtonText
     *
     * @return null|string
     */
    public function getButtonText(): ?string;

    /**
     * Set ButtonText
     *
     * @param null|string $buttonText
     */
    public function setButtonText(?string $buttonText);

    /**
     * Set banner new tab.
     *
     * @param bool|null $newTab
     */
    public function setNewTab(?bool $newTab);

    /**
     * Get banner new tab.
     *
     * @return bool
     */
    public function getNewTab() : bool;

    /**
     * Set banner new tab.
     *
     * @param bool|null $fullWidth
     */
    public function setFullWidth(?bool $fullWidth);

    /**
     * Get banner new tab.
     *
     * @return bool
     */
    public function getFullWidth() : bool;

    /**
     * Get Special
     *
     * @return boolean
     */
    public function isSpecial(): bool;

    /**
     * Set Special
     *
     * @param null|boolean $special
     */
    public function setSpecial(?bool $special);

    /**
     * Set banner zones to banner.
     *
     * @param Collection $bannerZones
     */
    public function setBannerZones(Collection $bannerZones);

    /**
     * Get banner zones from banner.
     *
     * @return Collection
     */
    public function getBannerZones() : Collection;

    /**
     * Add banner zone to banner.
     *
     * @param BannerZoneInterface $bannerZone
     */
    public function addBannerZone(BannerZoneInterface $bannerZone);

    /**
     * Remove banner zone from banner.
     *
     * @param BannerZoneInterface $bannerZone
     */
    public function removeBannerZone(BannerZoneInterface $bannerZone);

    /**
     * Set the mobileImage.
     *
     * @param ImageInterface|null $mobileImage
     */
    public function setMobileImage(?ImageInterface $mobileImage = null);

    /**
     * Get the mobileImage.
     *
     * @return ImageInterface|null
     */
    public function getMobileImage() : ? ImageInterface;
}
