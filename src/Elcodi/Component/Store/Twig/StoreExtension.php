<?php

namespace Elcodi\Component\Store\Twig;

use Elcodi\Component\Store\Wrapper\StoreWrapper;
use Twig_Extension;
use Twig_SimpleFunction;

/**
 * File header placeholder
 */
class StoreExtension extends Twig_Extension
{
    /**
     * @var StoreWrapper
     *
     * Store wrapper
     */
    private $storeWrapper;

    /**
     * StoreExtension constructor.
     *
     * @param StoreWrapper $storeWrapper
     */
    public function __construct(StoreWrapper $storeWrapper)
    {
        $this->storeWrapper = $storeWrapper;
    }

    /**
     * Return all filters.
     *
     * @return Twig_SimpleFunction[] Filters
     */
    public function getFilters()
    {
        return [
            new Twig_SimpleFunction('store', [
                $this->storeWrapper,
                'get',
            ]),
        ];
    }

    /**
     * return extension name.
     *
     * @return string extension name
     */
    public function getName()
    {
        return 'store_extension';
    }
}