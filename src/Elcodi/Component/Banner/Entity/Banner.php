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

namespace Elcodi\Component\Banner\Entity;

use Doctrine\Common\Collections\Collection;

use Elcodi\Component\Banner\Entity\Interfaces\BannerInterface;
use Elcodi\Component\Banner\Entity\Interfaces\BannerZoneInterface;
use Elcodi\Component\Core\Entity\Traits\DateTimeTrait;
use Elcodi\Component\Core\Entity\Traits\EnabledTrait;
use Elcodi\Component\Core\Entity\Traits\IdentifiableTrait;
use Elcodi\Component\Media\Entity\Interfaces\ImageInterface;
use Elcodi\Component\Media\Entity\Traits\PrincipalImageTrait;

/**
 * Banner.
 */
class Banner implements BannerInterface
{
    use IdentifiableTrait,
        DateTimeTrait,
        EnabledTrait,
        PrincipalImageTrait;

    /**
     * @var string
     *
     * Name
     */
    protected $name;

    /**
     * @var string
     *
     * Description
     */
    protected $description;

    /**
     * @var string
     *
     * Url
     */
    protected $url;

    /**
     * @var int
     *
     * Position
     */
    protected $position;

    /**
     * @var ImageInterface
     *
     * Banner image
     */
    protected $image;

    /**
     * @var Collection
     *
     * Banner zones
     */
    protected $bannerZones;

    /**
     * Set banner name.
     *
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get banner name.
     *
     * @return string|null Name
     */
    public function getName() : ? string
    {
        return $this->name;
    }

    /**
     * Set banner description.
     *
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * Get banner description.
     *
     * @return string|null
     */
    public function getDescription() : ? string
    {
        return $this->description;
    }

    /**
     * Set banner url.
     *
     * @param string $url
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    /**
     * Get banner url.
     *
     * @return string|null
     */
    public function getUrl() : ? string
    {
        return $this->url;
    }

    /**
     * Set banner zones to banner.
     *
     * @param Collection $bannerZones
     */
    public function setBannerZones(Collection $bannerZones)
    {
        $this->bannerZones = $bannerZones;
    }

    /**
     * Get banner zones from banner.
     *
     * @return Collection
     */
    public function getBannerZones() : Collection
    {
        return $this->bannerZones;
    }

    /**
     * Add banner zone to banner.
     *
     * @param BannerZoneInterface $bannerZone
     */
    public function addBannerZone(BannerZoneInterface $bannerZone)
    {
        if ($this
            ->bannerZones
            ->contains($bannerZone)
        ) {
            return;
        }

        $this
            ->bannerZones
            ->add($bannerZone);
    }

    /**
     * Remove banner zone from banner.
     *
     * @param BannerZoneInterface $bannerZone
     */
    public function removeBannerZone(BannerZoneInterface $bannerZone)
    {
        $this
            ->bannerZones
            ->removeElement($bannerZone);
    }

    /**
     * To string.
     *
     * @return string
     */
    public function __toString() : string
    {
        return $this->getId() . ' - ' . $this->getName();
    }
}
