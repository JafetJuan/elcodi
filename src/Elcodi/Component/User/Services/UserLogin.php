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

namespace Elcodi\Component\User\Services;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Http\SecurityEvents;

use Elcodi\Component\User\Entity\Interfaces\AbstractUserInterface;

/**
 * Class UserLogin.
 */
class UserLogin
{
    /**
     * @var RequestStack
     *
     * Request stack
     */
    private $requestStack;

    /**
     * @var TokenStorageInterface
     *
     * Token storage
     */
    private $tokenStorage;

    /**
     * @var EventDispatcherInterface
     *
     * Event dispatcher
     */
    private $eventDispatcher;

    /**
     * @var array
     *
     * Firewalls
     */
    private $firewalls;

    /**
     * Constructor.
     *
     * @param RequestStack             $requestStack
     * @param TokenStorageInterface    $tokenStorage
     * @param EventDispatcherInterface $eventDispatcher
     * @param array                    $firewalls
     */
    public function __construct(
        RequestStack $requestStack,
        TokenStorageInterface $tokenStorage,
        EventDispatcherInterface $eventDispatcher,
        array $firewalls
    ) {
        $this->requestStack = $requestStack;
        $this->tokenStorage = $tokenStorage;
        $this->eventDispatcher = $eventDispatcher;
        $this->firewalls = $firewalls;
    }

    /**
     * Login user.
     *
     * @param AbstractUserInterface $user
     */
    public function loginUser(AbstractUserInterface $user)
    {
        /**
         * Given type of user is not enabled for autologin.
         */
        $firewall = $this->getUserFirewall($user);
        if (is_null($firewall)) {
            return;
        }

        /**
         * Not on Request scope.
         */
        $masterRequest = $this
            ->requestStack
            ->getMasterRequest();

        if (!($masterRequest instanceof Request)) {
            return;
        }

        /**
         * Already a token defined, so already logged.
         */
        if (null === $this
                ->tokenStorage
                ->getToken()
        ) {
            return;
        }

        $token = $this
            ->createNewToken(
                $user,
                $firewall
            );

        $this
            ->tokenStorage
            ->setToken($token);

        $event = new InteractiveLoginEvent(
            $masterRequest,
            $token
        );

        $this
            ->eventDispatcher
            ->dispatch(
                SecurityEvents::INTERACTIVE_LOGIN,
                $event
            );
    }

    /**
     * Generate and return new token given a user.
     *
     * @param AbstractUserInterface $user
     * @param string                $firewallName
     *
     * @return UsernamePasswordToken
     */
    private function createNewToken(
        AbstractUserInterface $user,
        string $firewallName
    ) : UsernamePasswordToken {
        return new UsernamePasswordToken(
            $user,
            null,
            $firewallName,
            $user->getRoles()
        );
    }

    /**
     * Get firewall given a user instance. If none firewall defined for this
     * user, return null
     *
     * @param AbstractUserInterface $user
     *
     * @return string|null
     */
    private function getUserFirewall(AbstractUserInterface $user) : ? string
    {
        $possibleClasses = array_merge(
            [get_class($user)],
            class_implements($user),
            class_parents($user)
        );

        foreach ($possibleClasses as $class) {
            if (isset($this->firewalls[$class])) {
                return $this->firewalls[$class];
            }
        }

        return null;
    }
}
