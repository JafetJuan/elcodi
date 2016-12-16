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
 * @author Elcodi Team <tech@elcodi.com>
 */

namespace Elcodi\Component\User\Entity\Interfaces;
use Doctrine\Common\Collections\Collection;

/**
 * Interface AdminUserInterface.
 */
interface AdminUserInterface extends AbstractUserInterface
{
    /**
     * Get PermissionGroups
     *
     * @return Collection
     */
    public function getPermissionGroups();

    /**
     * Set PermissionGroups
     *
     * @param Collection $permissionGroups
     *
     * @return $this self Object
     */
    public function setPermissionGroups(Collection $permissionGroups);

    /**
     * Add permission group
     *
     * @param PermissionGroupInterface $permissionGroup
     */
    public function addPermissionGroup(PermissionGroupInterface $permissionGroup);

    /**
     * Remove permission group
     *
     * @param PermissionGroupInterface $permissionGroup
     */
    public function removePermissionGroup(PermissionGroupInterface $permissionGroup);
}
