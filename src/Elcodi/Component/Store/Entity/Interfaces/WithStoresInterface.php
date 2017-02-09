<?php

/**
 * File header placeholder
 */

namespace Elcodi\Component\Store\Entity\Interfaces;

use Doctrine\Common\Collections\Collection;

/**
 * Interface WithStoresInterface
 */
interface WithStoresInterface
{
    /**
     * Get Stores
     *
     * @return null|Collection
     */
    public function getStores(): ?Collection;

    /**
     * Set Stores
     *
     * @param Collection $stores
     */
    public function setStores(Collection $stores);

    /**
     * Add store
     *
     * @param StoreInterface $store
     */
    public function addStore(StoreInterface $store);
    /**
     * Remove store
     *
     * @param StoreInterface $store
     */
    public function removeStore(StoreInterface $store);
}