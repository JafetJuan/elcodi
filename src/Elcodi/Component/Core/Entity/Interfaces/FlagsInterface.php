<?php
/**
 * File header placeholder
 */

namespace Elcodi\Component\Core\Entity\Interfaces;

/**
 * Interface FlagsInterface
 */
interface FlagsInterface
{
    /**
     * Get Recommended
     *
     * @return bool
     */
    public function isRecommended() : bool;

    /**
     * Set Recommended
     *
     * @param null|boolean $recommended
     */
    public function setRecommended(?bool $recommended);

    /**
     * Get Novelty
     *
     * @return bool
     */
    public function isNovelty() : bool;

    /**
     * Set Novelty
     *
     * @param null|boolean $novelty
     */
    public function setNovelty(?bool $novelty);

    /**
     * Get TopSales
     *
     * @return bool
     */
    public function isTopSales() : bool;

    /**
     * Set TopSales
     *
     * @param null|boolean $topSales
     */
    public function setTopSales(?bool $topSales);
}