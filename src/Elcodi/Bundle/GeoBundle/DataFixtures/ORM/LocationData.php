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

namespace Elcodi\Bundle\GeoBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;

use Elcodi\Bundle\CoreBundle\DataFixtures\ORM\ElcodiFixture;
use Elcodi\Component\Core\Services\ObjectDirector;

/**
 * Class LocationData.
 */
class LocationData extends ElcodiFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        /**
         * @var ObjectDirector $locationDirector
         */
        $locationDirector = $this->getDirector('location');

        $locationSpain = $locationDirector->create();
        $locationSpain->setId('ES');
        $locationSpain->setName('Spain');
        $locationSpain->setCode('ES');
        $locationSpain->setType('country');

        $locationCatalunya = $locationDirector->create();
        $locationCatalunya->setId('ES_CA');
        $locationCatalunya->setName('Catalunya');
        $locationCatalunya->setCode('CA');
        $locationCatalunya->setType('provincia');
        $locationCatalunya->addParent($locationSpain);

        $locationVallesOriental = $locationDirector->create();
        $locationVallesOriental->setId('ES_CA_VO');
        $locationVallesOriental->setName('Valles Oriental');
        $locationVallesOriental->setCode('VO');
        $locationVallesOriental->setType('comarca');
        $locationVallesOriental->addParent($locationCatalunya);

        $locationLaBatlloria = $locationDirector->create();
        $locationLaBatlloria->setId('ES_CA_VO_LaBatlloria');
        $locationLaBatlloria->setName('La batlloria');
        $locationLaBatlloria->setCode('LaBatlloria');
        $locationLaBatlloria->setType('city');
        $locationLaBatlloria->addParent($locationVallesOriental);

        $locationSantCeloni = $locationDirector->create();
        $locationSantCeloni->setId('ES_CA_VO_SantCeloni');
        $locationSantCeloni->setName('Sant Celoni');
        $locationSantCeloni->setCode('SantCeloni');
        $locationSantCeloni->setType('city');
        $locationSantCeloni->addParent($locationVallesOriental);

        $locationViladecavalls = $locationDirector->create();
        $locationViladecavalls->setId('ES_CA_VO_Viladecavalls');
        $locationViladecavalls->setName('Viladecavalls');
        $locationViladecavalls->setCode('Viladecavalls');
        $locationViladecavalls->setType('city');
        $locationViladecavalls->addParent($locationVallesOriental);

        $location08021 = $locationDirector->create();
        $location08021->setId('ES_CA_VO_Viladecavalls_08021');
        $location08021->setName('08021');
        $location08021->setCode('08021');
        $location08021->setType('postalcode');
        $location08021->addParent($locationViladecavalls);

        $location08470 = $locationDirector->create();
        $location08470->setId('ES_CA_VO_SantCeloni_08470');
        $location08470->setName('08470');
        $location08470->setCode('08470');
        $location08470->setType('postalcode');
        $location08470->addParent($locationLaBatlloria);
        $location08470->addParent($locationSantCeloni);

        $locationDirector->save([
            $locationSpain,
            $locationCatalunya,
            $locationVallesOriental,
            $locationLaBatlloria,
            $locationSantCeloni,
            $locationViladecavalls,
            $location08021,
            $location08470,
        ]);

        $this->addReference('location-spain', $locationSpain);
        $this->addReference('location-catalunya', $locationCatalunya);
        $this->addReference('location-valles-oriental', $locationVallesOriental);
        $this->addReference('location-la-batlloria', $locationLaBatlloria);
        $this->addReference('location-sant-celoni', $locationSantCeloni);
        $this->addReference('location-viladecavalls', $locationViladecavalls);
        $this->addReference('location-08021', $location08021);
        $this->addReference('location-08470', $location08470);
    }
}
