<?php

namespace Elcodi\Component\Store\Entity\Traits;

use Doctrine\Common\Collections\Collection;
use Elcodi\Component\Store\Entity\Interfaces\StoreInterface;

/**
 * Trait WithStoresTrait
 */
trait WithStoresTrait
{
    /**
     * @var Collection
     *
     * Stores
     */
    private $stores;

    /**
     * Get Stores
     *
     * @return null|Collection
     */
    public function getStores(): ?Collection
    {
        return $this->stores;
    }

    /**
     * Set Stores
     *
     * @param Collection $stores
     */
    public function setStores(Collection $stores)
    {
        $this->stores = $stores;
    }

    /**
     * Add store
     *
     * @param StoreInterface $store
     */
    public function addStore(StoreInterface $store)
    {
        if ($this
            ->stores
            ->contains($store)
        ) {
            return;
        }

        $this
            ->stores
            ->add($store);
    }

    /**
     * Remove store
     *
     * @param StoreInterface $store
     */
    public function removeStore(StoreInterface $store)
    {
        $this
            ->stores
            ->removeElement($store);
    }
}