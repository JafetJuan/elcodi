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
     * Extra
     */
    protected $extra;

    /**
     * @var string
     *
     * Url
     */
    protected $url;

    /**
     * @var string
     *
     * Button text
     */
    protected $buttonText;

    /**
     * @var bool
     *
     * Open in new tab
     */
    protected $newTab;

    /**
     * @var bool
     *
     * Full width
     */
    protected $fullWidth;

    /**
     * @var bool
     *
     * Special
     */
    protected $special;

    /**
     * @var Collection
     *
     * Banner zones
     */
    private $bannerZones;

    /**
     * @var ImageInterface|null
     *
     * Principal image
     */
    protected $mobileImage;

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
     * @param null|string $description
     */
    public function setDescription(?string $description)
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
     * Set banner extra.
     *
     * @param null|string $extra
     */
    public function setExtra(?string $extra)
    {
        $this->extra = $extra;
    }

    /**
     * Get banner extra.
     *
     * @return string|null
     */
    public function getExtra() : ? string
    {
        return $this->extra;
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
     * Get ButtonText
     *
     * @return null|string
     */
    public function getButtonText(): ?string
    {
        return $this->buttonText;
    }

    /**
     * Set ButtonText
     *
     * @param null|string $buttonText
     */
    public function setButtonText(?string $buttonText)
    {
        $this->buttonText = $buttonText;
    }

    /**
     * Set banner new tab.
     *
     * @param null|bool $newTab
     */
    public function setNewTab(?bool $newTab)
    {
        $this->newTab = $newTab;
    }

    /**
     * Get banner new tab.
     *
     * @return bool
     */
    public function getNewTab() : bool
    {
        return $this->newTab ?? false;
    }

    /**
     * Set banner new tab.
     *
     * @param null|bool $fullWidth
     */
    public function setFullWidth(?bool $fullWidth)
    {
        $this->fullWidth = $fullWidth;
    }

    /**
     * Get banner new tab.
     *
     * @return bool
     */
    public function getFullWidth() : bool
    {
        return $this->fullWidth ?? false;
    }

    /**
     * Get Special
     *
     * @return boolean
     */
    public function isSpecial(): bool
    {
        return $this->special ?? false;
    }

    /**
     * Set Special
     *
     * @param null|boolean $special
     */
    public function setSpecial(?bool $special)
    {
        $this->special = $special;
    }

    /**
     * Set banner zones to banner.
     *
     * @param Collection $bannerZones
     */
    public function setBannerZones(Collection $bannerZones)
    {
        $bannerZones
            ->map(function(BannerZoneInterface $bannerZone) {
                $bannerZone->addBanner($this);
            });
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

        $bannerZone->addBanner($this);
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

        $bannerZone->removeBanner($this);
    }

    /**
     * Set the mobileImage.
     *
     * @param ImageInterface|null $mobileImage
     */
    public function setMobileImage(?ImageInterface $mobileImage = null)
    {
        $this->mobileImage = $mobileImage;
    }

    /**
     * Get the mobileImage.
     *
     * @return ImageInterface|null
     */
    public function getMobileImage() : ? ImageInterface
    {
        return $this->mobileImage;
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
