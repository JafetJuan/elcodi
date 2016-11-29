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

/**
 * Interface BannerInterface.
 */
interface BannerInterface extends
    IdentifiableInterface,
    EnabledInterface,
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
}
