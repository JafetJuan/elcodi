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

namespace Elcodi\Component\EntityTranslator\Services;

use Elcodi\Component\Core\Wrapper\Abstracts\AbstractCacheWrapper;
use Elcodi\Component\EntityTranslator\Entity\Interfaces\EntityTranslationInterface;
use Elcodi\Component\EntityTranslator\Repository\EntityTranslationRepository;
use Elcodi\Component\EntityTranslator\Services\Interfaces\EntityTranslationProviderInterface;

/**
 * Class CachedEntityTranslationProvider.
 */
class CachedEntityTranslationProvider extends AbstractCacheWrapper implements EntityTranslationProviderInterface
{
    /**
     * @var EntityTranslationProviderInterface
     *
     * Entity Translation Provider
     */
    private $entityTranslatorProvider;

    /**
     * @var EntityTranslationRepository
     *
     * Entity Translation repository
     */
    private $entityTranslationRepository;

    /**
     * @var string
     *
     * Cache key
     */
    private $cachePrefix;

    /**
     * Construct method.
     *
     * @param EntityTranslationProviderInterface $entityTranslationProvider
     * @param EntityTranslationRepository        $entityTranslationRepository
     * @param string                             $cachePrefix
     */
    public function __construct(
        EntityTranslationProviderInterface $entityTranslationProvider,
        EntityTranslationRepository $entityTranslationRepository,
        string $cachePrefix
    ) {
        $this->entityTranslatorProvider = $entityTranslationProvider;
        $this->entityTranslationRepository = $entityTranslationRepository;
        $this->cachePrefix = $cachePrefix;
    }

    /**
     * Get translation.
     *
     * @param string $entityType
     * @param string $entityId
     * @param string $entityField
     * @param string $locale
     *
     * @return string
     */
    public function getTranslation(
        string $entityType,
        string $entityId,
        string $entityField,
        string $locale
    ) : string {
        $cacheKey = $this->buildKey(
            $entityType,
            $entityId,
            $entityField,
            $locale
        );

        $translation = $this
            ->cache
            ->fetch($cacheKey);

        if ($translation === false) {
            $translation = $this
                ->entityTranslatorProvider
                ->getTranslation(
                    $entityType,
                    (string) $entityId,
                    $entityField,
                    $locale
                );

            $this
                ->cache
                ->save(
                    $cacheKey,
                    $translation
                );
        }

        return $translation;
    }

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
    ) {
        $cacheKey = $this->buildKey(
            $entityType,
            $entityId,
            $entityField,
            $locale
        );

        $this
            ->cache
            ->save(
                $cacheKey,
                $translationValue
            );

        $this
            ->entityTranslatorProvider
            ->setTranslation(
                $entityType,
                (string) $entityId,
                $entityField,
                $translationValue,
                $locale
            );
    }

    /**
     * Flush all previously set translations.
     */
    public function flushTranslations()
    {
        $this
            ->entityTranslatorProvider
            ->flushTranslations();
    }

    /**
     * Warm-up translations.
     */
    public function warmUp()
    {
        $translations = $this
            ->entityTranslationRepository
            ->findAll();

        /**
         * @var EntityTranslationInterface $translation
         */
        foreach ($translations as $translation) {
            $cacheKey = $this->buildKey(
                $translation->getEntityType(),
                $translation->getEntityId(),
                $translation->getEntityField(),
                $translation->getLocale()
            );

            $this
                ->cache
                ->save(
                    $cacheKey,
                    $translation->getTranslation()
                );
        }
    }

    /**
     * Get translation.
     *
     * @param string $entityType  Type of entity
     * @param string $entityId    Id of entity
     * @param string $entityField Field of entity
     * @param string $locale      Locale
     *
     * @return string Key
     */
    private function buildKey(
        $entityType,
        $entityId,
        $entityField,
        $locale
    ) {
        return $this->cachePrefix . '_' .
        $entityType . '_' .
        $entityId . '_' .
        $entityField . '_' .
        $locale;
    }
}
