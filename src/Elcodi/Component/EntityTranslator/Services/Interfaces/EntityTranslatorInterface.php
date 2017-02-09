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
 * Interface EntityTranslatorInterface.
 */
interface EntityTranslatorInterface
{
    /**
     * Translate object.
     *
     * @param object $object
     * @param string $locale
     */
    public function translate(
        $object,
        string $locale
    );

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
    );
}
