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

namespace Elcodi\Bundle\LanguageBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;

use Elcodi\Bundle\CoreBundle\DataFixtures\ORM\ElcodiFixture;
use Elcodi\Component\Core\Services\ObjectDirector;
use Elcodi\Component\Language\Entity\Interfaces\LanguageInterface;

/**
 * AdminData class.
 *
 * Load fixtures of admin entities
 */
class LanguageData extends ElcodiFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        /**
         * @var ObjectDirector    $languageDirector
         * @var LanguageInterface $language
         */
        $languageDirector = $this->getDirector('language');

        foreach ($this->getLanguages() as $iso => $name) {
            $language = $languageDirector->create();
            $language->setIso($iso);
            $language->setName($name);
            $language->enable();

            $languageDirector->save($language);
            $this->addReference('language-' . $iso, $language);
        }
    }

    /**
     * Get languages.
     *
     * @return array
     */
    private function getLanguages() : array
    {
        return [
            'es' => 'Español',
            'en' => 'English',
            'fr' => 'Français',
            'it' => 'Italiano',
            'de' => 'Deutch',
        ];
    }
}
