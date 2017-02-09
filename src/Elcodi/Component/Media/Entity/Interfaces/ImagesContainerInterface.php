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

namespace Elcodi\Component\Media\Entity\Interfaces;

use Doctrine\Common\Collections\Collection;

/**
 * Interface ImagesContainerInterface.
 */
interface ImagesContainerInterface
{
    /**
     * Set add image.
     *
     * @param ImageInterface $image
     */
    public function addImage(ImageInterface $image);

    /**
     * Get if entity is enabled.
     *
     * @param ImageInterface $image
     */
    public function removeImage(ImageInterface $image);

    /**
     * Get all images.
     *
     * @return Collection
     */
    public function getImages() : Collection;

    /**
     * Set images.
     *
     * @param Collection $images
     */
    public function setImages(Collection $images);

    /**
     * Get sorted images.
     *
     * @return Collection
     */
    public function getSortedImages() : Collection;

    /**
     * Get ImagesSort.
     *
     * @return string|null
     */
    public function getImagesSort() : ? string;

    /**
     * Sets ImagesSort.
     *
     * @param string|null $imagesSort
     */
    public function setImagesSort(?string $imagesSort);
}
