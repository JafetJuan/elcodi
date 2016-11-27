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
 * trait for add Entity valid interval.
 */
trait ValidIntervalTrait
{
    /**
     * @var DateTime
     *
     * valid from
     */
    protected $validFrom;

    /**
     * @var DateTime
     *
     * Valid to
     */
    protected $validTo;

    /**
     * Set valid from.
     *
     * @param DateTime $validFrom Valid from
     */
    public function setValidFrom(DateTime $validFrom)
    {
        $this->validFrom = $validFrom;
    }

    /**
     * Get valid from.
     *
     * @return DateTime
     */
    public function getValidFrom() : DateTime
    {
        return $this->validFrom;
    }

    /**
     * Set valid to.
     *
     * @param DateTime|null $validTo Valid to
     */
    public function setValidTo( ? DateTime $validTo)
    {
        $this->validTo = $validTo;
    }

    /**
     * Get valid to.
     *
     * @return DateTime|null Valid to
     */
    public function getValidTo() : ? DateTime
    {
        return $this->validTo;
    }
}
