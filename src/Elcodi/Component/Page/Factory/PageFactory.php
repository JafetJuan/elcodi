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

namespace Elcodi\Component\Page\Factory;

use Doctrine\Common\Collections\ArrayCollection;
use Elcodi\Component\Core\Factory\Abstracts\AbstractFactory;
use Elcodi\Component\Page\Entity\Interfaces\PageInterface;

/**
 * Class PageFactory.
 *
 * @author Cayetano Soriano <neoshadybeat@gmail.com>
 * @author Jordi Grados <planetzombies@gmail.com>
 * @author Damien Gavard <damien.gavard@gmail.com>
 * @author Berny Cantos <be@rny.cc>
 */
class PageFactory extends AbstractFactory
{
    /**
     * Creates an instance of an entity.
     *
     * Queries should be implemented in a repository class
     *
     * @return PageInterface entity
     */
    public function create()
    {
        $now = $this->now();

        /**
         * @var PageInterface $page
         */
        $classNamespace = $this->getEntityNamespace();
        $page = new $classNamespace();
        $page->enable();
        $page->setPersistent(false);
        $page->setPublicationDate($now);
        $page->setCreatedAt($now);
        $page->setUpdatedAt($now);
        $page->setImages(new ArrayCollection());
        $page->setStores(new ArrayCollection());

        return $page;
    }
}
