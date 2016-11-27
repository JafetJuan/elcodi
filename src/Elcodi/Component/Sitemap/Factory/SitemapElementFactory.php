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

namespace Elcodi\Component\Sitemap\Factory;

use Elcodi\Component\Sitemap\Element\SitemapElement;

/**
 * Class SitemapElementFactory.
 */
class SitemapElementFactory
{
    /**
     * Create new SitemapElement.
     *
     * @param string      $location         Location
     * @param string|null $lastModification Last modification
     * @param string|null $changeFrequency  Change frequency
     * @param string|null $priority         Priority
     *
     * @return SitemapElement New instance
     */
    public function create(
        $location,
        $lastModification = null,
        $changeFrequency = null,
        $priority = null
    ) : SitemapElement {
        return new SitemapElement(
            $location,
            $lastModification,
            $changeFrequency,
            $priority
        );
    }
}
