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

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Elcodi\Bundle\CoreBundle\DataFixtures\ORM\ElcodiFixture;
use Elcodi\Component\Core\Services\ObjectDirector;
use Elcodi\Component\Geo\Entity\Address;

/**
 * Class AddressData.
 */
class AddressData extends ElcodiFixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        /**
         * @var ObjectDirector $addressDirector
         */
        $addressDirector = $this->getDirector('address');

        $addressSantCeloni = $addressDirector->create();
        $addressSantCeloni->setName('Some address');
        $addressSantCeloni->setRecipientName('user name');
        $addressSantCeloni->setRecipientSurname('user surname');
        $addressSantCeloni->setAddress('Some street 123');
        $addressSantCeloni->setAddressMore('1-2');
        $addressSantCeloni->setPhone('123-456789');
        $addressSantCeloni->setMobile('000-123456');
        $addressSantCeloni->setComments('Some comments');
        $addressSantCeloni->setCity($this->getReference('location-sant-celoni')->getId());
        $addressSantCeloni->setPostalcode('08021');
        $addressSantCeloni->setEnabled(true);

        $addressDirector->save($addressSantCeloni);
        $this->addReference('address-sant-celoni', $addressSantCeloni);

        $addressViladecavalls = $addressDirector->create();
        $addressViladecavalls->setName('Some other address');
        $addressViladecavalls->setRecipientName('user2 name');
        $addressViladecavalls->setRecipientSurname('user2 surname');
        $addressViladecavalls->setAddress('Some other street 123');
        $addressViladecavalls->setAddressMore('3-4');
        $addressViladecavalls->setPhone('123-456789');
        $addressViladecavalls->setMobile('000-123456');
        $addressViladecavalls->setComments('Some other comments');
        $addressViladecavalls->setCity($this->getReference('location-viladecavalls')->getId());
        $addressViladecavalls->setPostalcode('08232');
        $addressViladecavalls->setEnabled(true);

        $addressDirector->save($addressViladecavalls);
        $this->addReference('address-viladecavalls', $addressViladecavalls);
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on.
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            'Elcodi\Bundle\GeoBundle\DataFixtures\ORM\LocationData',
        ];
    }
}
