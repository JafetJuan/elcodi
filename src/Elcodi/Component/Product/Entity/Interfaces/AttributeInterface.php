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

namespace Elcodi\Component\Product\Entity\Interfaces;

use Doctrine\Common\Collections\Collection;

use Elcodi\Component\Core\Entity\Interfaces\DateTimeInterface;
use Elcodi\Component\Core\Entity\Interfaces\EnabledInterface;
use Elcodi\Component\Core\Entity\Interfaces\IdentifiableInterface;

/**
 * Interface AttributeInterface.
 *
 * Attributes are a key-value structure used to describe
 * product features or options.
 */
interface AttributeInterface extends
    IdentifiableInterface,
    EnabledInterface,
    DateTimeInterface
{
    /**
     * Sets attribute name.
     *
     * @param string $name
     */
    public function setName(string $name);

    /**
     * Return attribute name.
     *
     * @return string
     */
    public function getName() : ? string;

    /**
     * Sets attribute values.
     *
     * @param Collection $values
     */
    public function setValues(Collection $values);

    /**
     * Gets attribute values.
     *
     * @return Collection
     */
    public function getValues() : Collection;

    /**
     * Adds a value to this attribute collection.
     *
     * @param ValueInterface $value
     */
    public function addValue(ValueInterface $value);

    /**
     * Removes a value from this attribute collection.
     *
     * @param ValueInterface $value
     */
    public function removeValue(ValueInterface $value);
}
