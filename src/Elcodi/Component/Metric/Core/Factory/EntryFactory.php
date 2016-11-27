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

namespace Elcodi\Component\Metric\Core\Factory;

use DateTime;

use Elcodi\Component\Metric\Core\Entity\Entry;
use Elcodi\Component\Metric\Core\Entity\Interfaces\EntryInterface;

/**
 * Class EntryFactory.
 */
class EntryFactory
{
    /**
     * Create entry.
     *
     * @param string   $token     Token
     * @param string   $event     Event
     * @param string   $uniqueId  Unique id
     * @param int      $type      Type
     * @param DateTime $createdAt Created At
     *
     * @return EntryInterface new entry instance
     */
    public function create(
        $token,
        $event,
        $uniqueId,
        $type,
        DateTime $createdAt
    ) : EntryInterface {
        return new Entry(
            $token,
            $event,
            $uniqueId,
            $type,
            $createdAt
        );
    }
}
