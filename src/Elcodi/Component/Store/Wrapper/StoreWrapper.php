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

namespace Elcodi\Component\Store\Wrapper;

use Elcodi\Component\Core\Wrapper\Interfaces\WrapperInterface;
use Elcodi\Component\Store\Entity\Interfaces\StoreInterface;
use Elcodi\Component\Store\Exception\StoreNotFoundException;
use Elcodi\Component\Store\Repository\StoreRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class StoreWrapper.
 */
class StoreWrapper implements WrapperInterface
{
    /**
     * @var StoreInterface
     *
     * Store
     */
    private $store;

    /**
     * @var StoreRepository
     *
     * Store repository
     */
    private $storeRepository;

    /**
     * @var RequestStack
     *
     * Request stack
     */
    private $requestStack;

    /**
     * Construct.
     *
     * @param RequestStack $requestStack
     * @param StoreRepository $storeRepository
     */
    public function __construct(
        RequestStack $requestStack,
        StoreRepository $storeRepository)
    {
        $this->requestStack = $requestStack;
        $this->storeRepository = $storeRepository;
    }

    /**
     * Load store.
     *
     * @return StoreInterface $store Loaded store
     *
     * @throws StoreNotFoundException Store not found
     */
    public function get()
    {
        if ($this->store instanceof StoreInterface) {
            return $this->store;
        }

        $currentRequest = $this
            ->requestStack
            ->getMasterRequest();

        if (!$currentRequest instanceof Request) {
            return null;
        }

        $currentDomain = $currentRequest->getHost();
        $stores = $this
            ->storeRepository
            ->findAll();

        if (empty($stores)) {
            throw new StoreNotFoundException();
        }

        /**
         * @var StoreInterface $store
         */
        foreach ($stores as $store) {
            $domains = $store->getDomains();
            if(is_null($domains)) {
                continue;
            }
            $domains = explode(',', $domains);
            foreach ($domains as $domain) {
                if (trim($domain) == $currentDomain) {
                    $this->store = $store;
                    return $store;
                }
            }
        }

        if (empty($stores)) {
            throw new StoreNotFoundException();
        }
    }

    /**
     * Clean loaded object in order to reload it again.
     */
    public function clean()
    {
        $this->store = null;
    }
}
