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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Elcodi\Component\Banner\Entity\Interfaces\BannerInterface;
use Elcodi\Component\Banner\Entity\Interfaces\BannerZoneInterface;
use Elcodi\Component\Core\Entity\Traits\DateTimeTrait;
use Elcodi\Component\Core\Entity\Traits\EnabledTrait;
use Elcodi\Component\Core\Entity\Traits\IdentifiableTrait;
use Elcodi\Component\Language\Entity\Interfaces\LanguageInterface;
use Elcodi\Component\Store\Entity\Traits\WithStoresTrait;

/**
 * BannerZone.
 */
class BannerZone implements BannerZoneInterface
{
    use IdentifiableTrait;
    use WithStoresTrait;
    use EnabledTrait;
    use DateTimeTrait;

    /**
     * @var string
     *
     * Name
     */
    protected $name;

    /**
     * @var string
     *
     * Code
     */
    protected $code;

    /**
     * @var LanguageInterface
     *
     * Language
     */
    protected $language;

    /**
     * @var Collection
     *
     * Banners
     */
    protected $banners;

    /**
     * @var int
     *
     * Height of item in cm
     */
    protected $height;

    /**
     * @var int
     *
     * Width of item in cm
     */
    protected $width;

    /**
     * @var string|null
     *
     * Banners sort
     */
    protected $bannersSort;

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
     * Set code.
     *
     * @param string $code
     */
    public function setCode(string $code)
    {
        $this->code = $code;
    }

    /**
     * Get code.
     *
     * @return string|null Code
     */
    public function getCode() : ? string
    {
        return $this->code;
    }

    /**
     * Set Language.
     *
     * @param LanguageInterface $language
     */
    public function setLanguage( ? LanguageInterface $language)
    {
        $this->language = $language;
    }

    /**
     * Get Language.
     *
     * @return LanguageInterface
     */
    public function getLanguage() : ? LanguageInterface
    {
        return $this->language;
    }

    /**
     * Add banner into banner zone.
     *
     * @param BannerInterface $banner
     */
    public function addBanner(BannerInterface $banner)
    {
        if ($this
            ->banners
            ->contains($banner)
        ) {
            return;
        }

        $this
            ->banners
            ->add($banner);
    }

    /**
     * Remove banner from banner zone.
     *
     * @param BannerInterface $banner
     */
    public function removeBanner(BannerInterface $banner)
    {
        $this
            ->banners
            ->removeElement($banner);
    }

    /**
     * Set banners into banner zone.
     *
     * @param Collection $banners
     */
    public function setBanners(Collection $banners)
    {
        $this->banners = $banners;
    }

    /**
     * Get banners.
     *
     * @return Collection
     */
    public function getBanners() : Collection
    {
        return $this->banners;
    }

    /**
     * Get enabled banners.
     *
     * @return Collection
     */
    public function getEnabledBanners() : Collection
    {
        return $this
            ->banners
            ->filter(function(BannerInterface $banner) {
                return $banner->isEnabled();
            });
    }

    /**
     * Get sorted images.
     *
     * @return ArrayCollection
     */
    public function getSortedEnabledBanners() : ArrayCollection
    {
        $bannersSort = $this->getBannersSort() ?? '';
        $bannersSort = explode(',', $bannersSort);
        $orderCollection = array_reverse($bannersSort);
        $bannersCollection = $this
            ->getEnabledBanners()
            ->toArray();

        usort(
            $bannersCollection,
            function (
                BannerInterface $a,
                BannerInterface $b
            ) use ($orderCollection) {
                $aPos = array_search($a->getId(), $orderCollection);
                $bPos = array_search($b->getId(), $orderCollection);

                return ($aPos < $bPos)
                    ? 1
                    : -1;
            }
        );

        return new ArrayCollection($bannersCollection);
    }

    /**
     * Set the BannerZoneInterface height in pixels.
     *
     * @param int $height
     */
    public function setHeight(int $height)
    {
        $this->height = $height;
    }

    /**
     * Get the BannerZoneInterface height in pixels.
     *
     * @return int
     */
    public function getHeight() : ? int
    {
        return $this->height;
    }

    /**
     * Set the BannerZoneInterface width in pixels.
     *
     * @param int $width
     */
    public function setWidth(int $width)
    {
        $this->width = $width;
    }

    /**
     * Get the BannerZoneInterface width in pixels.
     *
     * @return int
     */
    public function getWidth() : ? int
    {
        return $this->width;
    }

    /**
     * Get BannersSort.
     *
     * @return string|null
     */
    public function getBannersSort() : ? string
    {
        return $this->bannersSort;
    }

    /**
     * Sets BannersSort.
     *
     * @param string|null $bannersSort
     */
    public function setBannersSort(?string $bannersSort)
    {
        $this->bannersSort = $bannersSort;
    }

    /**
     * To string method.
     *
     * @return string
     */
    public function __toString() : string
    {
        $isoLang = 'all languages';

        if ($this->getLanguage() instanceof LanguageInterface) {
            $isoLang = $this->getLanguage()->getIso();
        }

        return $this->getName() . ' - ' . $isoLang;
    }
}
