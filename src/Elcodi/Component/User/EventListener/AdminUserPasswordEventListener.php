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

namespace Elcodi\Component\User\EventListener;

use Elcodi\Component\User\Entity\Interfaces\AdminUserInterface;
use Elcodi\Component\User\EventListener\Abstracts\AbstractPasswordEventListener;

/**
 * Class AdminUserPasswordEventListener.
 */
class AdminUserPasswordEventListener extends AbstractPasswordEventListener
{
    /**
     * Check entity type and return if the entity is ready for being encoded.
     *
     * @param object $entity
     *
     * @return bool
     */
    public function checkEntityType($entity) : bool
    {
        return $entity instanceof AdminUserInterface;
    }
}
