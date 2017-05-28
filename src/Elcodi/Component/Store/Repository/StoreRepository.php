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

namespace Elcodi\Component\Store\Repository;

use Doctrine\ORM\EntityRepository;
use Elcodi\Component\Store\Entity\Interfaces\StoreInterface;

/**
 * Class StoreRepository.
 */
class StoreRepository extends EntityRepository
{
    /**
     * Finds a single entity by a set of criteria.
     *
     * @param array $criteria
     * @param array|null $orderBy
     *
     * @return object|null The entity instance or NULL if the entity can not be found.
     */
    public function findOneBy(array $criteria, array $orderBy = null)
    {
        $store = parent::findOneBy($criteria, $orderBy);
        if ($store instanceof StoreInterface) {
            $store->getAddress();
        }

        return $store;
    }
}
