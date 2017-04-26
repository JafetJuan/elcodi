<?php
/**
 * File header placeholder
 */

namespace Elcodi\Component\Core\Entity\Traits;

/**
 * Class WithSpecialWordsTrait
 */
trait WithSpecialWordsTrait
{
    /**
     * @var string
     *
     * Special words
     */
    protected $specialWords;

    /**
     * Get special words.
     *
     * @return null|string
     */
    public function getSpecialWords() : ? string
    {
        return $this->specialWords;
    }

    /**
     * Set special words.
     *
     * @param null|string $specialWords
     */
    public function setSpecialWords( ? string $specialWords)
    {
        $this->specialWords = $specialWords;
    }
}