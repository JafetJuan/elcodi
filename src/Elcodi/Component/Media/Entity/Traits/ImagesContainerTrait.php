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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Elcodi\Component\Media\Entity\Interfaces\ImageInterface;

/**
 * Trait ImagesContainerTrait.
 */
trait ImagesContainerTrait
{
    /**
     * @var Collection
     *
     * Images
     */
    protected $images;

    /**
     * @var string|null
     *
     * Images sort
     */
    protected $imagesSort;

    /**
     * Set add image.
     *
     * @param ImageInterface $image
     */
    public function addImage(ImageInterface $image)
    {
        $this
            ->images
            ->add($image);
    }

    /**
     * Get if entity is enabled.
     *
     * @param ImageInterface $image
     */
    public function removeImage(ImageInterface $image)
    {
        $this
            ->images
            ->removeElement($image);
    }

    /**
     * Get all images.
     *
     * @return Collection
     */
    public function getImages() : Collection
    {
        return $this->images;
    }

    /**
     * Get sorted images.
     *
     * @return Collection
     */
    public function getSortedImages() : Collection
    {
        $imagesSort = $this->getImagesSort() ?? '';
        $imagesSort = explode(',', $imagesSort);
        $orderCollection = array_reverse($imagesSort);
        $imagesCollection = $this
            ->getImages()
            ->toArray();

        usort(
            $imagesCollection,
            function (
                ImageInterface $a,
                ImageInterface $b
            ) use ($orderCollection) {
                $aPos = array_search($a->getId(), $orderCollection);
                $bPos = array_search($b->getId(), $orderCollection);

                return ($aPos < $bPos)
                    ? 1
                    : -1;
            }
        );

        return new ArrayCollection($imagesCollection);
    }

    /**
     * Set images.
     *
     * @param Collection $images
     */
    public function setImages(Collection $images)
    {
        $this->images = $images;
    }

    /**
     * Set sorted images.
     *
     * @param Collection $images
     */
    public function setSortedImages(Collection $images)
    {
        $this->setImages($images);
    }

    /**
     * Get ImagesSort.
     *
     * @return string|null
     */
    public function getImagesSort() : ? string
    {
        return $this->imagesSort;
    }

    /**
     * Sets ImagesSort.
     *
     * @param string|null $imagesSort
     */
    public function setImagesSort(?string $imagesSort)
    {
        $this->imagesSort = $imagesSort;
    }
}
