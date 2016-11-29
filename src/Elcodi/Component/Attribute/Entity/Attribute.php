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

namespace Elcodi\Component\Attribute\Entity;

use Doctrine\Common\Collections\Collection;

use Elcodi\Component\Attribute\Entity\Interfaces\AttributeInterface;
use Elcodi\Component\Attribute\Entity\Interfaces\ValueInterface;
use Elcodi\Component\Core\Entity\Traits\DateTimeTrait;
use Elcodi\Component\Core\Entity\Traits\EnabledTrait;
use Elcodi\Component\Core\Entity\Traits\IdentifiableTrait;

/**
 * Class Attribute.
 */
class Attribute implements AttributeInterface
{
    use IdentifiableTrait,
        DateTimeTrait,
        EnabledTrait;

    /**
     * @var string
     *
     * Attribute name
     */
    protected $name;

    /**
     * @var Collection
     *
     * Values for this Attribute
     */
    protected $values;

    /**
     * Sets attribute name.
     *
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Return attribute name.
     *
     * @return string
     */
    public function getName() : ? string
    {
        return $this->name;
    }

    /**
     * Gets attribute values.
     *
     * @return Collection
     */
    public function getValues() : Collection
    {
        return $this->values;
    }

    /**
     * Sets attribute values.
     *
     * @param Collection $values
     */
    public function setValues(Collection $values)
    {
        $this->values = $values;
    }

    /**
     * Adds a value to this attribute collection.
     *
     * @param ValueInterface $value
     */
    public function addValue(ValueInterface $value)
    {
        if ($this
            ->values
            ->contains($value)
        ) {
            return;
        }

        $this
            ->values
            ->add($value);
    }

    /**
     * Removes a value from this attribute collection.
     *
     * @param ValueInterface $value
     */
    public function removeValue(ValueInterface $value)
    {
        $this
            ->values
            ->removeElement($value);
    }

    /**
     * Returns the attribute name.
     *
     * @return string
     */
    public function __toString() : string
    {
        return $this->name;
    }
}
