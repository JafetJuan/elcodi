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

namespace Elcodi\Component\Core\Encoder\Interfaces;

/**
 * Interface EncoderInterface.
 */
interface EncoderInterface
{
    /**
     * Encode incoming data.
     *
     * @param mixed $data
     *
     * @return string|bool
     */
    public function encode($data);

    /**
     * Decode incoming data.
     *
     * @param string $serializedData
     *
     * @return mixed
     */
    public function decode(string $serializedData);
}
