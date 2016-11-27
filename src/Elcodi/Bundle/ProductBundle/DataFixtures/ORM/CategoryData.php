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

namespace Elcodi\Bundle\ProductBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;

use Elcodi\Bundle\CoreBundle\DataFixtures\ORM\Abstracts\AbstractFixture;
use Elcodi\Component\Core\Services\ObjectDirector;
use Elcodi\Component\Product\Entity\Interfaces\CategoryInterface;

/**
 * Class CategoryData.
 */
class CategoryData extends AbstractFixture
{
    /**
     * Load data fixtures with the passed EntityManager.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /**
         * @var ObjectDirector $categoryDirector
         */
        $categoryDirector = $this->getDirector('category');

        /**
         * Category.
         *
         * @var CategoryInterface $rootCategory
         */
        $rootCategory = $categoryDirector->create();
        $rootCategory->setName('root-category');
        $rootCategory->setSlug('root-category');
        $rootCategory->setEnabled(true);
        $rootCategory->setRoot(true);

        $categoryDirector->save($rootCategory);
        $this->addReference('rootCategory', $rootCategory);

        /**
         * Category.
         *
         * @var CategoryInterface $category
         */
        $category = $categoryDirector->create();
        $category->setName('category');
        $category->setSlug('category');
        $category->setEnabled(true);
        $category->setParent($rootCategory);
        $category->setRoot(false);

        $categoryDirector->save($category);
        $this->addReference('category', $category);

        /**
         * Second level category.
         *
         * @var CategoryInterface $secondLevelCategory
         */
        $secondLevelCategory = $categoryDirector->create();
        $secondLevelCategory->setName('Second level category');
        $secondLevelCategory->setSlug('second-level-category');
        $secondLevelCategory->setEnabled(true);
        $secondLevelCategory->setParent($category);
        $secondLevelCategory->setRoot(false);

        $categoryDirector->save($secondLevelCategory);
        $this->addReference('secondLevelCategory', $secondLevelCategory);
    }
}
