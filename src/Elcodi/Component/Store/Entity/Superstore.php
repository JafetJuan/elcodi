<?php
/**
 * File header placeholder
 */

namespace Elcodi\Component\Store\Entity;

use Elcodi\Component\Core\Entity\Traits\IdentifiableTrait;
use Elcodi\Component\Currency\Entity\Traits\WithCurrenciesTrait;
use Elcodi\Component\Language\Entity\Traits\WithLanguagesTrait;
use Elcodi\Component\Store\Entity\Interfaces\SuperstoreInterface;

/**
 * Class Superstore
 */
class Superstore implements SuperstoreInterface
{
    use IdentifiableTrait,
        WithLanguagesTrait,
        WithCurrenciesTrait;

    /**
     * @var string
     *
     * Rouring strategy
     */
    protected $routingStrategy;

    /**
     * Get RoutingStrategy.
     *
     * @return null|string
     */
    public function getRoutingStrategy() : ? string
    {
        return $this->routingStrategy;
    }

    /**
     * Sets RoutingStrategy.
     *
     * @param string $routingStrategy
     */
    public function setRoutingStrategy(string $routingStrategy)
    {
        $this->routingStrategy = $routingStrategy;
    }
}