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

namespace Elcodi\Component\Menu\Factory;

use Doctrine\Common\Collections\ArrayCollection;

use Elcodi\Component\Core\Factory\Abstracts\AbstractFactory;
use Elcodi\Component\Menu\Entity\Interfaces\NodeInterface;

/**
 * Class NodeFactory.
 */
class NodeFactory extends AbstractFactory
{
    /**
     * Creates an instance of Node entity.
     *
     * @return NodeInterface Empty entity
     */
    public function create()
    {
        /**
         * @var NodeInterface $node
         */
        $classNamespace = $this->getEntityNamespace();
        $node = new $classNamespace();
        $node->setSubnodes(new ArrayCollection());
        $node->setPriority(0);
        $node->setActiveUrls([]);
        $node->enable();

        return $node;
    }
}
