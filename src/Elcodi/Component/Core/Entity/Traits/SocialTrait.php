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

namespace Elcodi\Component\Core\Entity\Traits;

/**
 * trait for Social links.
 */
trait SocialTrait
{
    /**
     * @var string
     *
     * Facebook url
     */
    protected $urlFacebook;

    /**
     * @var string
     *
     * Facebook url
     */
    protected $urlTwitter;

    /**
     * @var string
     *
     * Facebook url
     */
    protected $urlPinterest;

    /**
     * @var string
     *
     * Facebook url
     */
    protected $urlInstagram;

    /**
     * Get UrlFacebook
     *
     * @return null|string
     */
    public function getUrlFacebook(): ?string
    {
        return $this->urlFacebook;
    }

    /**
     * Set UrlFacebook
     *
     * @param null|string $urlFacebook
     */
    public function setUrlFacebook(?string $urlFacebook)
    {
        $this->urlFacebook = $urlFacebook;
    }

    /**
     * Get UrlTwitter
     *
     * @return null|string
     */
    public function getUrlTwitter(): ?string
    {
        return $this->urlTwitter;
    }

    /**
     * Set UrlTwitter
     *
     * @param null|string $urlTwitter
     */
    public function setUrlTwitter(?string $urlTwitter)
    {
        $this->urlTwitter = $urlTwitter;
    }

    /**
     * Get UrlPinterest
     *
     * @return null|string
     */
    public function getUrlPinterest(): ?string
    {
        return $this->urlPinterest;
    }

    /**
     * Set UrlPinterest
     *
     * @param null|string $urlPinterest
     */
    public function setUrlPinterest(?string $urlPinterest)
    {
        $this->urlPinterest = $urlPinterest;
    }

    /**
     * Get UrlInstagram
     *
     * @return null|string
     */
    public function getUrlInstagram(): ?string
    {
        return $this->urlInstagram;
    }

    /**
     * Set UrlInstagram
     *
     * @param null|string $urlInstagram
     */
    public function setUrlInstagram(?string $urlInstagram)
    {
        $this->urlInstagram = $urlInstagram;
    }
}
