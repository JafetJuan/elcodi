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

use Elcodi\Component\Comment\Entity\Interfaces\VoteInterface;
use Elcodi\Component\Comment\Entity\Vote;
use Elcodi\Component\Core\Factory\Abstracts\AbstractFactory;

/**
 * Class VoteFactory.
 */
class VoteFactory extends AbstractFactory
{
    /**
     * Creates an instance of Vote.
     *
     * @return VoteInterface New Vote entity
     */
    public function create()
    {
        /**
         * @var VoteInterface $vote
         */
        $classNamespace = $this->getEntityNamespace();
        $vote = new $classNamespace();
        $vote->setCreatedAt($this->now());

        return $vote;
    }

    /**
     * Creates an instance of Up Vote.
     *
     * @return VoteInterface New Up Vote entity
     */
    public function createUp()
    {
        $voteUp = $this->create();
        $voteUp->setType(Vote::UP);

        return $voteUp;
    }

    /**
     * Creates an instance of Down Vote.
     *
     * @return VoteInterface New Down Vote entity
     */
    public function createDown()
    {
        $voteUp = $this->create();
        $voteUp->setType(Vote::DOWN);

        return $voteUp;
    }
}
