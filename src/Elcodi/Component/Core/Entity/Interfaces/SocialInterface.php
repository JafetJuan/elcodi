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

namespace Elcodi\Component\Core\Entity\Interfaces;

/**
 * interface for Social links.
 */
interface SocialInterface
{
    /**
     * Get UrlFacebook
     *
     * @return null|string
     */
    public function getUrlFacebook(): ?string;

    /**
     * Set UrlFacebook
     *
     * @param null|string $urlFacebook
     */
    public function setUrlFacebook(?string $urlFacebook);

    /**
     * Get UrlTwitter
     *
     * @return null|string
     */
    public function getUrlTwitter(): ?string;

    /**
     * Set UrlTwitter
     *
     * @param null|string $urlTwitter
     */
    public function setUrlTwitter(?string $urlTwitter);

    /**
     * Get UrlPinterest
     *
     * @return null|string
     */
    public function getUrlPinterest(): ?string;

    /**
     * Set UrlPinterest
     *
     * @param null|string $urlPinterest
     */
    public function setUrlPinterest(?string $urlPinterest);

    /**
     * Get UrlInstagram
     *
     * @return null|string
     */
    public function getUrlInstagram(): ?string;

    /**
     * Set UrlInstagram
     *
     * @param null|string $urlInstagram
     */
    public function setUrlInstagram(?string $urlInstagram);
}
