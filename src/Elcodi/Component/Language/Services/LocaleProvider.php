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

namespace Elcodi\Component\Language\Services;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

use Elcodi\Component\Language\Entity\Locale;

/**
 * Class LocaleProvider.
 */
class LocaleProvider
{
    /**
     * @var RequestStack
     *
     * Request stack
     */
    private $requestStack;

    /**
     * @var string
     *
     * Default locale
     */
    private $defaultLocale;

    /**
     * Construct method.
     *
     * @param RequestStack $requestStack
     * @param string       $defaultLocale
     */
    public function __construct(
        RequestStack $requestStack,
        string $defaultLocale
    ) {
        $this->requestStack = $requestStack;
        $this->defaultLocale = $defaultLocale;
    }

    /**
     * Get usable locale from current request environment.
     *
     * @return Locale Locale loaded
     */
    public function getLocale()
    {
        $locale = $this->requestStack->getCurrentRequest() instanceof Request
            ? $this->requestStack->getCurrentRequest()->getLocale()
            : $this->defaultLocale;

        return Locale::create($locale);
    }
}
