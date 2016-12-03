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

namespace Elcodi\Bundle\ProductBundle\Tests\Functional\EventListener;

use Elcodi\Bundle\ProductBundle\Tests\Functional\ElcodiProductFunctionalTest;
use Elcodi\Component\Product\Entity\Interfaces\CategoryInterface;

/**
 * Class CategoryRepositoryTest.
 */
class RootCategoryEventListenerTest extends ElcodiProductFunctionalTest
{
    /**
     * Test that creating a new root category the parent category should be null.
     */
    public function testNewRootCategoryIsSavedWithoutParent()
    {
        $categoryDirector = $this->get('elcodi.director.category');

        /**
         * @var $rootCategory CategoryInterface
         * @var $category     CategoryInterface
         */
        $rootCategory = $categoryDirector->findOneBy(['slug' => 'root-category']);

        $category = $categoryDirector->create();
        $category->setRoot(true);
        $category->setParent($rootCategory);
        $category->setName('New root category');
        $category->setSlug('new-root-category');

        $this->save($category);

        /**
         * @var $category CategoryInterface
         */
        $category = $categoryDirector->findOneBy(['slug' => 'new-root-category']);

        $this->assertNull(
            $category->getParent(),
            'The parent for a root category should always be null'
        );
    }

    /**
     * Test that modifying a new root category the parent category should be
     * null.
     */
    public function testEditRootCategoryIsSavedWithoutParent()
    {
        $categoryDirector = $this->get('elcodi.director.category');

        /**
         * @var $rootCategory    CategoryInterface
         * @var $anotherCategory CategoryInterface
         */
        $rootCategory = $categoryDirector->findOneBy(['slug' => 'root-category']);
        $anotherCategory = $categoryDirector->findOneBy(['slug' => 'category']);

        $rootCategory->setParent($anotherCategory);

        $this->save($rootCategory);

        /**
         * @var $category CategoryInterface
         */
        $category = $categoryDirector->findOneBy(['slug' => 'root-category']);

        $this->assertNull(
            $category->getParent(),
            'The parent for a root category should always be null'
        );
    }
}
