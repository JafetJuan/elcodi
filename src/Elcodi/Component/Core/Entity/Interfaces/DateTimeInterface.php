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

namespace Elcodi\Component\Core\Entity\Interfaces;

use DateTime;

/**
 * Interface DateTimeInterface.
 */
interface DateTimeInterface
{
    /**
     * Set locally created at value.
     *
     * @param DateTime $createdAt Created at value
     */
    public function setCreatedAt(DateTime $createdAt);

    /**
     * Return created_at value.
     *
     * @return DateTime
     */
    public function getCreatedAt() : ? DateTime;

    /**
     * Set locally updated at value.
     *
     * @param DateTime $updatedAt Updated at value
     */
    public function setUpdatedAt(DateTime $updatedAt);

    /**
     * Return updated_at value.
     *
     * @return DateTime
     */
    public function getUpdatedAt() : ? DateTime;
}
