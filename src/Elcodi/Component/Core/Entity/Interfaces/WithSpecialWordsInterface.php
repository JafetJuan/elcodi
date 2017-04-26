<?php
/**
 * File header placeholder
 */

namespace Elcodi\Component\Core\Entity\Interfaces;

/**
 * Interface WithSpecialWordsInterface
 */
interface WithSpecialWordsInterface
{
    /**
     * Get special words.
     *
     * @return null|string
     */
    public function getSpecialWords() : ? string;

    /**
     * Set special words.
     *
     * @param null|string $specialWords
     */
    public function setSpecialWords( ? string $specialWords);
}