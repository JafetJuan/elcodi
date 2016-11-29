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

namespace Elcodi\Component\Banner\Services;

use Doctrine\Common\Collections\Collection;

use Elcodi\Component\Banner\Entity\Interfaces\BannerZoneInterface;
use Elcodi\Component\Banner\Repository\BannerRepository;
use Elcodi\Component\Language\Entity\Interfaces\LanguageInterface;

/**
 * BannerManager.
 */
class BannerManager
{
    /**
     * @var BannerRepository
     *
     * Banner Repository
     */
    private $bannerRepository;

    /**
     * Construct method.
     *
     * @param BannerRepository $bannerRepository Banner repository
     */
    public function __construct(BannerRepository $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    /**
     * Get banners from a bannerZone code, given a language.
     *
     * @param string                 $bannerZoneCode
     * @param LanguageInterface|null $language
     *
     * @return Collection
     */
    public function getBannersFromBannerZoneCode(
        string $bannerZoneCode,
        LanguageInterface $language = null
    ) : Collection {
        return $this
            ->bannerRepository
            ->getBannerByZone($bannerZoneCode, $language);
    }

    /**
     * Get banners from a bannerZone, given a language.
     *
     * @param BannerZoneInterface $bannerZone
     * @param LanguageInterface   $language
     *
     * @return Collection
     */
    public function getBannersFromBannerZone(
        BannerZoneInterface $bannerZone,
        LanguageInterface $language = null
    ) : Collection {
        return $this->getBannersFromBannerZoneCode(
            $bannerZone->getCode(),
            $language
        );
    }
}
