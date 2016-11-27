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

namespace Elcodi\Component\Core\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Class ReferrerSessionEventListener.
 */
class ReferrerSessionEventListener
{
    /**
     * Update referrer from session.
     *
     * @param GetResponseEvent $event Event
     */
    public function updateSessionReferrer(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $server = $event
            ->getRequest()
            ->server;

        $httpReferrer = $server->get('HTTP_REFERER', false);
        $httpHost = $server->get('HTTP_HOST', false);

        if (
            false === $httpReferrer ||
            false === $httpHost
        ) {
            return;
        }

        $referrer = parse_url($httpReferrer, PHP_URL_HOST);
        $host = parse_url($httpHost, PHP_URL_HOST);

        if ($referrer != $host) {
            $event
                ->getRequest()
                ->getSession()
                ->set('referrer', $referrer);
        }
    }
}
