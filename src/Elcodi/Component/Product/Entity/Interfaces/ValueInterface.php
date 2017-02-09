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

use Elcodi\Component\Core\Entity\Interfaces\IdentifiableInterface;

/**
 * Interface ValueInterface.
 */
interface ValueInterface extends IdentifiableInterface
{
    /**
     * Get Value.
     *
     * @return string|null
     */
    public function getValue() : ? string;

    /**
     * Sets Value.
     *
     * @param string $value
     */
    public function setValue(string $value);

    /**
     * Get Attribute.
     *
     * @return AttributeInterface|null
     */
    public function getAttribute() : ? AttributeInterface;

    /**
     * Sets Attribute.
     *
     * @param AttributeInterface $attribute
     */
    public function setAttribute(AttributeInterface $attribute);
}
