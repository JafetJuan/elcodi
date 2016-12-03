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

namespace Elcodi\Component\User\Event;

use Symfony\Component\EventDispatcher\Event;

use Elcodi\Component\User\Entity\Interfaces\AdminUserInterface;

/**
 * Class AdminUserRegisterEvent.
 */
final class AdminUserRegisterEvent extends Event
{
    /**
     * @var AdminUserInterface
     *
     * AdminUser
     */
    private $adminUser;

    /**
     * Construct method.
     *
     * @param AdminUserInterface $adminUser Admin User
     */
    public function __construct(AdminUserInterface $adminUser)
    {
        $this->adminUser = $adminUser;
    }

    /**
     * Get admin user.
     *
     * @return AdminUserInterface
     */
    public function getAdminUser() : AdminUserInterface
    {
        return $this->adminUser;
    }
}
