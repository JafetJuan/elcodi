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

namespace Elcodi\Component\User\Entity;

use Doctrine\Common\Collections\Collection;
use Elcodi\Component\User\Entity\Interfaces\PermissionGroupInterface;
use Symfony\Component\Security\Core\Role\Role;

use Elcodi\Component\User\Entity\Interfaces\AdminUserInterface;

/**
 * Class AdminUser.
 */
class AdminUser extends AbstractUser implements AdminUserInterface
{
    /**
     * @var Collection
     *
     * Permission groups
     */
    protected $permissionGroups;

    /**
     * Get PermissionGroups
     *
     * @return Collection
     */
    public function getPermissionGroups()
    {
        return $this->permissionGroups;
    }

    /**
     * Set PermissionGroups
     *
     * @param Collection $permissionGroups
     *
     * @return $this self Object
     */
    public function setPermissionGroups(Collection $permissionGroups)
    {
        $this->permissionGroups = $permissionGroups;

        return $this;
    }

    /**
     * Add permission group
     *
     * @param PermissionGroupInterface $permissionGroup
     */
    public function addPermissionGroup(PermissionGroupInterface $permissionGroup)
    {
        if (
            $this
                ->permissionGroups
                ->contains($permissionGroup)
        ) {
            return;
        }

        $this
            ->permissionGroups
            ->add($permissionGroup);
    }

    /**
     * Remove permission group
     *
     * @param PermissionGroupInterface $permissionGroup
     */
    public function removePermissionGroup(PermissionGroupInterface $permissionGroup)
    {
        $this
            ->permissionGroups
            ->removeElement($permissionGroup);
    }

    /**
     * Admin User roles.
     *
     * @return string[] Roles
     */
    public function getRoles()
    {
        return [
            new Role('ROLE_ADMIN'),
        ];
    }
}
