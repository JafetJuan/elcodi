<?php

namespace Elcodi\Component\Tag\Entity\Interfaces;

/**
 * File header placeholder
 */
interface TagInterface
{
    /**
     * Set name
     */
    public function setName(string $name);

    /**
     * get name
     *
     * @return string
     */
    public function getName() : string;
}