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

namespace Elcodi\Component\EntityTranslator\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TranslatableFieldType.
 */
class TranslatableFieldType extends AbstractType
{
    /**
     * Buildform function.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $entityAlias = $options['entityConfiguration']['alias'];
        $entityIdGetter = $options['entityConfiguration']['idGetter'];
        $fieldOptions = $options['formConfig']->getOptions();
        $fieldBlockPrefix = $options['formConfig']
                ->getType()
                ->getBlockPrefix();

        $fieldType = $this->resolveFieldType($fieldBlockPrefix);

        foreach ($options['locales'] as $locale) {
            $translatedFieldName = $locale . '_' . $options['fieldName'];

            $entityId = $options['entity']->$entityIdGetter();
            $translationData = $entityId
                ? $options['entityTranslationProvider']->getTranslation(
                        $entityAlias,
                        $entityId,
                        $options['fieldName'],
                        $locale
                )
                : '';

            $builder->add($translatedFieldName, $fieldType, [
                'required' => isset($fieldOptions['required'])
                    ? $this->evaluateRequired(
                        $fieldOptions['required'],
                        $locale,
                        $options['masterLocale'],
                        $options['fallback']
                    )
                    : false,
                'mapped' => false,
                'label' => $fieldOptions['label'],
                'data' => $translationData,
                'constraints' => $fieldOptions['constraints'],
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'entityTranslationProvider' => null,
            'formConfig' => null,
            'entity' => null,
            'fieldName' => '',
            'entityConfiguration' => [],
            'fieldConfiguration' => [],
            'locales' => [],
            'masterLocale' => '',
            'fallback' => false,
            'mapped' => false,
        ));
    }

    /**
     * Check the require value.
     *
     * @param bool   $required
     * @param string $locale
     * @param string $masterLocale
     * @param bool   $fallback
     *
     * @return bool
     */
    private function evaluateRequired(
        bool $required,
        string $locale,
        string $masterLocale,
        bool $fallback

    ) : bool
    {
        return (boolean) $required
            ? !$fallback || ($masterLocale === $locale)
            : false;
    }

    /**
     * Resolve field type
     *
     * @param string $fieldType
     *
     * @return string
     */
    private function resolveFieldType(string $fieldType) : string
    {
        if ('text' === $fieldType) {
            return TextType::class;
        }
        if ('textarea' === $fieldType) {
            return TextareaType::class;
        }

        return $fieldType;
    }
}
