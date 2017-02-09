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

namespace Elcodi\Component\Media\Entity\Traits;

use Elcodi\Component\Media\Entity\Interfaces\ImageInterface;

/**
 * Trait PrincipalImageTrait.
 */
trait PrincipalImageTrait
{
    /**
     * @var ImageInterface|null
     *
     * Principal image
     */
    protected $principalImage;

    /**
     * Set the principalImage.
     *
     * @param ImageInterface|null $principalImage
     */
    public function setPrincipalImage(?ImageInterface $principalImage = null)
    {
        $this->principalImage = $principalImage;
    }

    /**
     * Get the principalImage.
     *
     * @return ImageInterface|null
     */
    public function getPrincipalImage() : ? ImageInterface
    {
        return $this->principalImage;
    }
}
