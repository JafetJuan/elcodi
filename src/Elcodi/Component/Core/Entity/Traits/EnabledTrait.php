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

/**
 * Trait adding enabled/disabled fields and methods.
 */
trait EnabledTrait
{
    /**
     * @var bool
     *
     * Enabled
     */
    protected $enabled = false;

    /**
     * Set if is enabled.
     *
     * @param bool $enabled enabled value
     */
    public function setEnabled(bool $enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * Get is enabled.
     *
     * This method controls as well when the field is not set yet, treating it
     * as a simple false
     *
     * @return bool is enabled
     */
    public function isEnabled() : bool
    {
        return is_null($this->enabled)
            ? false
            : $this->enabled;
    }

    /**
     * Enable.
     */
    public function enable()
    {
        $this->setEnabled(true);
    }

    /**
     * Disable.
     */
    public function disable()
    {
        $this->setEnabled(false);
    }
}
