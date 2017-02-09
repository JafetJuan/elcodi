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

use Elcodi\Component\EntityTranslator\Services\Interfaces\EntityTranslationProviderInterface;
use Elcodi\Component\EntityTranslator\Services\Interfaces\EntityTranslatorInterface;

/**
 * Class EntityTranslator.
 */
class EntityTranslator implements EntityTranslatorInterface
{
    /**
     * @var EntityTranslationProviderInterface
     *
     * Translation Provider
     */
    private $entityTranslationProvider;

    /**
     * @var array
     *
     * Configuration
     */
    private $configuration;

    /**
     * @var bool
     *
     * Fallback is enabled.
     *
     * If a field is required and the fallback flag is enabled, all translations
     * will not be required anymore, but just the translation with same language
     * than master
     */
    private $fallback;

    /**
     * Construct method.
     *
     * @param EntityTranslationProviderInterface $entityTranslationProvider
     * @param array                              $configuration
     * @param bool                               $fallback
     */
    public function __construct(
        EntityTranslationProviderInterface $entityTranslationProvider,
        array $configuration,
        bool $fallback
    ) {
        $this->entityTranslationProvider = $entityTranslationProvider;
        $this->configuration = $configuration;
        $this->fallback = $fallback;
    }

    /**
     * Translate object.
     *
     * @param object $object
     * @param string $locale
     */
    public function translate(
        $object,
        string $locale
    )
    {
        $classStack = $this->getNamespacesFromClass(get_class($object));

        foreach ($classStack as $classNamespace) {
            if (!array_key_exists($classNamespace, $this->configuration)) {
                continue;
            }

            $configuration = $this->configuration[$classNamespace];
            $idGetter = $configuration['idGetter'];
            $entityId = $object->$idGetter();

            foreach ($configuration['fields'] as $fieldName => $fieldConfiguration) {
                $setter = $fieldConfiguration['setter'];
                $translation = $this
                    ->entityTranslationProvider
                    ->getTranslation(
                        $configuration['alias'],
                        (string) $entityId,
                        $fieldName,
                        $locale
                    );

                if ($translation || !$this->fallback) {
                    $object->$setter($translation);
                }
            }
        }
    }

    /**
     * Saves object translations.
     *
     * $translations = array(
     *      'es' => array(
     *          'name' => 'Nombre del producto',
     *          'description' => 'Descripción del producto',
     *      ),
     *      'fr' => array(
     *          'name' => 'Nom du produit',
     *          'description' => 'Description du produit',
     *      ),
     * );
     *
     * @param object $object
     * @param array  $translations
     */
    public function save(
        $object,
        array $translations
    )
    {
        $classStack = $this->getNamespacesFromClass(get_class($object));

        foreach ($classStack as $classNamespace) {
            if (!array_key_exists($classNamespace, $this->configuration)) {
                continue;
            }

            $configuration = $this->configuration[$classNamespace];
            $idGetter = $configuration['idGetter'];
            $entityId = $object->$idGetter();

            foreach ($translations as $locale => $translation) {
                foreach ($configuration['fields'] as $fieldName => $fieldConfiguration) {
                    if (isset($translation[$fieldName])) {
                        $this
                            ->entityTranslationProvider
                            ->setTranslation(
                                $configuration['alias'],
                                (string) $entityId,
                                $fieldName,
                                $translation[$fieldName],
                                $locale
                            );
                    }
                }
            }
        }

        $this
            ->entityTranslationProvider
            ->flushTranslations();
    }

    /**
     * Get all possible classes given an object.
     *
     * @param string $namespace
     *
     * @return string[]
     */
    private function getNamespacesFromClass($namespace) : array
    {
        $classStack = [$namespace];
        $classStack = array_merge($classStack, class_parents($namespace));
        $classStack = array_merge($classStack, class_implements($namespace));

        return $classStack;
    }
}
