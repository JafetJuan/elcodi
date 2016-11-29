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

use Elcodi\Component\Attribute\Entity\Interfaces\AttributeInterface;
use Elcodi\Component\Attribute\Entity\Interfaces\ValueInterface;
use Elcodi\Component\Core\Entity\Traits\IdentifiableTrait;

/**
 * Class Value.
 */
class Value implements ValueInterface
{
    use IdentifiableTrait;

    /**
     * @var string
     *
     * Value content
     */
    protected $value;

    /**
     * @var AttributeInterface
     *
     * Attribute
     */
    protected $attribute;

    /**
     * Get Value.
     *
     * @return string|null Value
     */
    public function getValue() : ? string
    {
        return $this->value;
    }

    /**
     * Sets Value.
     *
     * @param string $value
     */
    public function setValue(string $value)
    {
        $this->value = $value;
    }

    /**
     * Get Attribute.
     *
     * @return AttributeInterface|null
     */
    public function getAttribute() : ? AttributeInterface
    {
        return $this->attribute;
    }

    /**
     * Sets Attribute.
     *
     * @param AttributeInterface $attribute
     */
    public function setAttribute(AttributeInterface $attribute)
    {
        $this->attribute = $attribute;
    }

    /**
     * String representation of a value.
     *
     * @return string
     */
    public function __toString() : string
    {
        return $this->getValue();
    }
}
