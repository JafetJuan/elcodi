<?php
/*
 * This file is part of the {Package name}.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 */

namespace Elcodi\Component\Core\Entity\Traits;

/**
 * Class TaggableTrait
 */
trait TaggableTrait
{
    /**
     * @var string
     *
     * Tags
     */
    protected $tags;

    /**
     * Set tags
     *
     * @param null|string $tags
     */
    public function setTags(?string $tags)
    {
        $this->tags = $tags;
    }

    /**
     * Get tags
     *
     * @return null|string
     */
    public function getTags() : ? string
    {
        return $this->tags;
    }
}