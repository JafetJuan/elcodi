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

namespace Elcodi\Component\Language\Entity;

use Elcodi\Component\Language\Entity\Interfaces\LocaleInterface;

/**
 * Class Locale.
 */
class Locale implements LocaleInterface
{
    /**
     * @var string
     *
     * Locale iso
     */
    protected $localeIso;

    /**
     * Construct method.
     *
     * @param string $localeIso
     */
    public function __construct(string $localeIso)
    {
        $this->localeIso = $localeIso;
    }

    /**
     * Get Iso.
     *
     * @return string
     */
    public function getIso() : string
    {
        return $this->localeIso;
    }

    /**
     * Create new instance.
     *
     * @param string $localeIso
     *
     * @return Locale
     */
    public static function create(string $localeIso)
    {
        return new Locale($localeIso);
    }
}
