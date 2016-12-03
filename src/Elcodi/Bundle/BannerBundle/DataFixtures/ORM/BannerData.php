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

namespace Elcodi\Bundle\BannerBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Elcodi\Bundle\CoreBundle\DataFixtures\ORM\ElcodiFixture;
use Elcodi\Component\Banner\Entity\Interfaces\BannerZoneInterface;
use Elcodi\Component\Core\Services\ObjectDirector;

/**
 * AdminData class.
 *
 * Load fixtures of admin entities
 */
class BannerData extends ElcodiFixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        /**
         * @var ObjectDirector $bannerDirector
         */
        $bannerDirector = $this->getDirector('banner');

        /**
         * Banner.
         *
         * @var BannerZoneInterface $bannerZone
         */
        $bannerZone = $this->getReference('banner-zone');
        $banner = $bannerDirector->create();
        $banner->setName('banner');
        $banner->setDescription('Simple banner');
        $banner->addBannerZone($bannerZone);
        $banner->setUrl('http://myurl.com');

        $bannerDirector->save($banner);
        $this->addReference('banner', $banner);

        /**
         * Banner no language.
         *
         * @var BannerZoneInterface $bannerZoneNoLanguage
         */
        $bannerZoneNoLanguage = $this->getReference('banner-zone-nolanguage');
        $bannerNoLanguage = $bannerDirector->create();
        $bannerNoLanguage->setName('banner-nolanguage');
        $bannerNoLanguage->setDescription('Simple banner no language');
        $bannerNoLanguage->addBannerZone($bannerZoneNoLanguage);
        $bannerNoLanguage->setUrl('http://myurl.com');

        $bannerDirector->save($bannerNoLanguage);
        $this->addReference('banner-nolanguage', $bannerNoLanguage);
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
            'Elcodi\Bundle\BannerBundle\DataFixtures\ORM\BannerZoneData',
        ];
    }
}
