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

namespace Elcodi\Component\Core\Entity\Traits;

use DateTime;

/**
 * trait for DateTime common variables and methods.
 */
trait DateTimeTrait
{
    /**
     * @var DateTime
     *
     * Created at
     */
    protected $createdAt;

    /**
     * @var DateTime
     *
     * Updated at
     */
    protected $updatedAt;

    /**
     * Set locally created at value.
     *
     * @param DateTime $createdAt Created at value
     */
    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Return created_at value.
     *
     * @return DateTime
     */
    public function getCreatedAt() : ? DateTime
    {
        return $this->createdAt;
    }

    /**
     * Set locally updated at value.
     *
     * @param DateTime $updatedAt Updated at value
     *
     * @return $this Self object
     */
    public function setUpdatedAt(DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Return updated_at value.
     *
     * @return DateTime
     */
    public function getUpdatedAt() : ? DateTime
    {
        return $this->updatedAt;
    }

    /**
     * Method triggered by LifeCycleEvent.
     * Sets or updates $this->updatedAt.
     */
    public function loadUpdateAt()
    {
        $this->setUpdatedAt(new DateTime());
    }
}
