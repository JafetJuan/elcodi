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

namespace Elcodi\Component\Geo\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class LocationRepository.
 */
class LocationRepository extends EntityRepository
{
    /**
     * Return all the root locations.
     *
     * @return array
     */
    public function findAllRoots() : array
    {
        return $this
            ->createQueryBuilder('l')
            ->leftJoin('l.parents', 'p')
            ->andWhere('p.id is NULL')
            ->getQuery()
            ->getResult();
    }

    /**
     * Return locations by their ids
     *
     * @param array $ids
     *
     * @return array
     */
    public function findLocationsByIds(array $ids) : array
    {
        return $this
            ->createQueryBuilder('l')
            ->where('l.id in (:ids)')
            ->setParameter('ids', $ids)
            ->getQuery()
            ->getResult();
    }
}
