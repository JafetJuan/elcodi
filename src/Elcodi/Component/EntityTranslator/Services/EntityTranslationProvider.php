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

use Doctrine\Common\Persistence\ObjectManager;

use Elcodi\Component\EntityTranslator\Entity\Interfaces\EntityTranslationInterface;
use Elcodi\Component\EntityTranslator\Factory\EntityTranslationFactory;
use Elcodi\Component\EntityTranslator\Repository\EntityTranslationRepository;
use Elcodi\Component\EntityTranslator\Services\Interfaces\EntityTranslationProviderInterface;

/**
 * Class EntityTranslationProvider.
 */
class EntityTranslationProvider implements EntityTranslationProviderInterface
{
    /**
     * @var EntityTranslationRepository
     *
     * Entity Translation repository
     */
    private $entityTranslationRepository;

    /**
     * @var ObjectManager
     *
     * Entity Translation entity manager
     */
    private $entityTranslationObjectManager;

    /**
     * @var EntityTranslationFactory
     *
     * Entity Translation factory
     */
    private $entityTranslationFactory;

    /**
     * @var array
     *
     * Translations to be flushed
     */
    private $translationsToBeFlushed = [];

    /**
     * Construct method.
     *
     * @param EntityTranslationRepository $entityTranslationRepository
     * @param EntityTranslationFactory    $entityTranslationFactory
     * @param ObjectManager               $entityTranslationObjectManager
     */
    public function __construct(
        EntityTranslationRepository $entityTranslationRepository,
        EntityTranslationFactory $entityTranslationFactory,
        ObjectManager $entityTranslationObjectManager
    ) {
        $this->entityTranslationRepository = $entityTranslationRepository;
        $this->entityTranslationFactory = $entityTranslationFactory;
        $this->entityTranslationObjectManager = $entityTranslationObjectManager;
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
        $translation = $this
            ->entityTranslationRepository
            ->findOneBy([
                'entityType' => $entityType,
                'entityId' => $entityId,
                'entityField' => $entityField,
                'locale' => $locale,
            ]);

        return $translation instanceof EntityTranslationInterface
            ? $translation->getTranslation()
            : '';
    }

    /**
     * Set translation.
     *
     * @param string $entityType
     * @param string $entityId
     * @param string $entityField
     * @param string $translationValue
     * @param string $locale
     *
     * @return $this Self object
     */
    public function setTranslation(
        string $entityType,
        string $entityId,
        string $entityField,
        string $translationValue,
        string $locale
    ) {
        $translation = $this
            ->entityTranslationRepository
            ->findOneBy([
                'entityType' => $entityType,
                'entityId' => $entityId,
                'entityField' => $entityField,
                'locale' => $locale,
            ]);

        if (!($translation instanceof EntityTranslationInterface)) {
            $translation = $this
                ->entityTranslationFactory
                ->create()
                ->setEntityType($entityType)
                ->setEntityId($entityId)
                ->setEntityField($entityField)
                ->setLocale($locale);

            $this
                ->entityTranslationObjectManager
                ->persist($translation);
        }

        $translation->setTranslation($translationValue);

        $this->translationsToBeFlushed[] = $translation;
    }

    /**
     * Flush all previously set translations.
     *
     * @return $this Self object
     */
    public function flushTranslations()
    {
        $this
            ->entityTranslationObjectManager
            ->flush($this->translationsToBeFlushed);

        $this->translationsToBeFlushed = [];

        return $this;
    }
}
