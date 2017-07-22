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
 * Trait adding flags
 */
trait FlagsTrait
{
    /**
     * @var bool
     *
     * Recommended
     */
    protected $recommended = false;

    /**
     * @var bool
     *
     * Novelty
     */
    protected $novelty = false;

    /**
     * @var bool
     *
     * Top sales
     */
    protected $topSales = false;

    /**
     * Get Recommended
     *
     * @return bool
     */
    public function isRecommended() : bool
    {
        return is_null($this->recommended)
            ? false
            : $this->recommended;
    }

    /**
     * Set Recommended
     *
     * @param null|boolean $recommended
     */
    public function setRecommended(?bool $recommended)
    {
        $this->recommended = $recommended;
    }

    /**
     * Get Novelty
     *
     * @return bool
     */
    public function isNovelty() : bool
    {
        return is_null($this->novelty)
            ? false
            : $this->novelty;
    }

    /**
     * Set Novelty
     *
     * @param null|boolean $novelty
     */
    public function setNovelty(?bool $novelty)
    {
        $this->novelty = $novelty;
    }

    /**
     * Get TopSales
     *
     * @return bool
     */
    public function isTopSales() : bool
    {
        return is_null($this->topSales)
            ? false
            : $this->topSales;
    }

    /**
     * Set TopSales
     *
     * @param null|boolean $topSales
     */
    public function setTopSales(?bool $topSales)
    {
        $this->topSales = $topSales;
    }
}
