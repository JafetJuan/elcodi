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

namespace Elcodi\Component\Comment\Factory;

use Doctrine\Common\Collections\ArrayCollection;

use Elcodi\Component\Comment\Entity\Interfaces\CommentInterface;
use Elcodi\Component\Core\Factory\Abstracts\AbstractFactory;

/**
 * Class CommentFactory.
 */
class CommentFactory extends AbstractFactory
{
    /**
     * Creates an instance of Comment.
     *
     * @return CommentInterface New Cart entity
     */
    public function create()
    {
        /**
         * @var CommentInterface $comment
         */
        $classNamespace = $this->getEntityNamespace();
        $comment = new $classNamespace();
        $comment->setParent(null);
        $comment->setChildren(new ArrayCollection());
        $comment->enable();
        $comment->setCreatedAt($this->now());

        return $comment;
    }
}
