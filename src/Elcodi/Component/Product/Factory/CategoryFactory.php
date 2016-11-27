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

namespace Elcodi\Component\Product\Factory;

use Doctrine\Common\Collections\ArrayCollection;

use Elcodi\Component\Core\Factory\Abstracts\AbstractFactory;
use Elcodi\Component\Product\Entity\Interfaces\CategoryInterface;

/**
 * Class CategoryFactory.
 */
class CategoryFactory extends AbstractFactory
{
    /**
     * Creates an instance of Category.
     *
     * @return CategoryInterface New Category entity
     */
    public function create()
    {
        /**
         * @var CategoryInterface $category
         */
        $classNamespace = $this->getEntityNamespace();
        $category = new $classNamespace();
        $category->setSubCategories(new ArrayCollection());
        $category->setRoot(true);
        $category->setPosition(0);
        $category->enable();
        $category->setCreatedAt($this->now());

        return $category;
    }
}
