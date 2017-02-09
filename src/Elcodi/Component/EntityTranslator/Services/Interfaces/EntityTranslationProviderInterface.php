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

namespace Elcodi\Component\EntityTranslator\Services\Interfaces;

/**
 * Interface EntityTranslationProviderInterface.
 */
interface EntityTranslationProviderInterface
{
    /**
     * Get translation.
     *
     * @param string $entityType  Type of entity
     * @param string $entityId    Id of entity
     * @param string $entityField Field of entity
     * @param string $locale      Locale
     *
     * @return string
     */
    public function getTranslation(
        string $entityType,
        string $entityId,
        string $entityField,
        string $locale
    ) : string;

    /**
     * Set translation.
     *
     * @param string      $entityType
     * @param string      $entityId
     * @param string      $entityField
     * @param string $translationValue
     * @param string      $locale
     */
    public function setTranslation(
        string $entityType,
        string $entityId,
        string $entityField,
        string $translationValue,
        string $locale
    );

    /**
     * Flush all previously set translations.
     *
     * @return $this Self object
     */
    public function flushTranslations();
}
