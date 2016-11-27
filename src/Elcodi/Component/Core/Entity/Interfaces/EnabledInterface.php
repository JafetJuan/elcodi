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

/**
 * Interface EnabledInterface.
 */
interface EnabledInterface
{
    /**
     * Set isEnabled.
     *
     * @param bool|null $enabled enabled value
     */
    public function setEnabled(bool $enabled);

    /**
     * Get if entity is enabled.
     *
     * @return bool|null Enabled
     */
    public function isEnabled() : ? bool;

    /**
     * Enable.
     */
    public function enable();

    /**
     * Disable.
     */
    public function disable();
}
