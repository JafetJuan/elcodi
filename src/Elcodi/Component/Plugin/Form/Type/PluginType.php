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

namespace Elcodi\Component\Plugin\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Elcodi\Component\Plugin\Entity\Plugin;

/**
 * Class PluginType.
 */
class PluginType extends AbstractType
{
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired('plugin')
            ->setAllowedTypes('plugin', 'Elcodi\Component\Plugin\Entity\Plugin');
    }

    /**
     * Buildform function.
     *
     * @param FormBuilderInterface $builder the formBuilder
     * @param array                $options the options for this form
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /**
         * @var Plugin $plugin
         */
        $plugin = $options['plugin'];
        foreach ($plugin->getFields() as $fieldName => $field) {
            $builder
                ->remove($fieldName)
                ->add($fieldName, $this->mapFieldType($field['type']), array_merge([
                    'label' => $field['label'],
                    'data' => $field['data'],
                    'required' => $field['required'],
                    'attr' => $field['attr'],
                ], $field['options']), $field);
        }

        $builder->add('save', SubmitType::class);
    }

    /**
     * Map field types
     *
     * @param string $fieldType
     *
     * @return string
     */
    private function mapFieldType(string $fieldType) : string
    {
        if ($fieldType == 'text') {
            return TextType::class;
        }

        if ($fieldType == 'checkbox') {
            return CheckboxType::class;
        }

        if ($fieldType == 'submit') {
            return SubmitType::class;
        }

        return $fieldType;
    }

    /**
     * Returns the prefix of the template block name for this type.
     *
     * The block prefix defaults to the underscored short class name with
     * the "Type" suffix removed (e.g. "UserProfileType" => "user_profile").
     *
     * @return string The prefix of the template block name
     */
    public function getBlockPrefix()
    {
        return 'elcodi_form_type_plugin';
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
