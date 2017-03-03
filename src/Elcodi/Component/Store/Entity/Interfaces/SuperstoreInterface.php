<?php
/**
 * File header placeholder
 */

namespace Elcodi\Component\Store\Entity\Interfaces;

use Elcodi\Component\Core\Entity\Interfaces\IdentifiableInterface;
use Elcodi\Component\Currency\Entity\Interfaces\WithCurrenciesInterface;
use Elcodi\Component\Language\Entity\Interfaces\WithLanguagesInterface;

/**
 * Interface SuperstoreInterface
 */
interface SuperstoreInterface extends IdentifiableInterface, WithLanguagesInterface, WithCurrenciesInterface
{
    /**
     * Get RoutingStrategy.
     *
     * @return null|string
     */
    public function getRoutingStrategy() : ? string;

    /**
     * Sets RoutingStrategy.
     *
     * @param string $routingStrategy
     */
    public function setRoutingStrategy(string $routingStrategy);
}