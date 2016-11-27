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

namespace Elcodi\Bundle\MenuBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;

use Elcodi\Bundle\CoreBundle\DataFixtures\ORM\Abstracts\AbstractFixture;
use Elcodi\Component\Core\Services\ObjectDirector;

/**
 * Class NodeData.
 */
class NodeData extends AbstractFixture
{
    /**
     * Load data fixtures with the passed EntityManager.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /**
         * @var ObjectDirector $menuNodeDirector
         */
        $menuNodeDirector = $this->getDirector('menu_node');

        $menuNodeHim = $menuNodeDirector->create();
        $menuNodeHim->setName('him');
        $menuNodeHim->setCode('him');
        $menuNodeHim->setUrl('elcodi.dev/him');
        $menuNodeHim->setActiveUrls([]);
        $menuNodeHim->enable(true);

        $menuNodeHer = $menuNodeDirector->create();
        $menuNodeHer->setName('her');
        $menuNodeHer->setCode('her');
        $menuNodeHer->setUrl('elcodi.dev/her');
        $menuNodeHer->setActiveUrls(
            [
                'her_products_list_route',
                'her_offers_list_route',
            ]
        );
        $menuNodeHer->enable();

        $menuNodeVogue = $menuNodeDirector->create();
        $menuNodeVogue->setName('vogue');
        $menuNodeVogue->setCode('vogue');
        $menuNodeVogue->enable(true);
        $menuNodeVogue->setActiveUrls([]);
        $menuNodeVogue->addSubnode($menuNodeHim);
        $menuNodeVogue->addSubnode($menuNodeHer);

        $menuNodeDirector->save($menuNodeVogue);
        $this->addReference('menu-node-him', $menuNodeHim);
        $this->addReference('menu-node-her', $menuNodeHer);
        $this->addReference('menu-node-vogue', $menuNodeVogue);
    }
}
