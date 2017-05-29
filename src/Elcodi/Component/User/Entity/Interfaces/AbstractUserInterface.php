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

namespace Elcodi\Component\User\Entity\Interfaces;

use DateTime;
use Symfony\Component\Security\Core\User\UserInterface;

use Elcodi\Component\Core\Entity\Interfaces\DateTimeInterface;
use Elcodi\Component\Core\Entity\Interfaces\EnabledInterface;
use Elcodi\Component\Core\Entity\Interfaces\IdentifiableInterface;
use Elcodi\Component\User\Exception\InvalidPasswordException;

/**
 * Interface AbstractUserInterface.
 */
interface AbstractUserInterface extends
    IdentifiableInterface,
    UserInterface,
    LastLoginInterface,
    DateTimeInterface,
    EnabledInterface
{
    /**
     * Sets a hash so it can be used to login once without the need to use the password.
     *
     * @param string|null $oneTimeLoginHash
     */
    public function setOneTimeLoginHash( ? string $oneTimeLoginHash);

    /**
     * Gets the one time login hash.
     *
     * @return string|null
     */
    public function getOneTimeLoginHash() : ? string;

    /**
     * Set recovery hash.
     *
     * @param string|null $recoveryHash
     */
    public function setRecoveryHash( ? string $recoveryHash);

    /**
     * Get recovery hash.
     *
     * @return string|null
     */
    public function getRecoveryHash() : ? string;

    /**
     * Sets Firstname.
     *
     * @param string|null $firstname
     */
    public function setFirstname( ? string $firstname);

    /**
     * Get Firstname.
     *
     * @return string|null
     */
    public function getFirstname() : ? string;

    /**
     * Sets Lastname.
     *
     * @param string|null $lastname
     */
    public function setLastname( ? string $lastname);

    /**
     * Get Lastname.
     *
     * @return string|null
     */
    public function getLastname() : ? string;

    /**
     * Set gender.
     *
     * @param null|int $gender
     */
    public function setGender(?int $gender);

    /**
     * Get gender.
     *
     * @return null|int
     */
    public function getGender() : ? int;

    /**
     * Set email.
     *
     * @param string|null $email
     */
    public function setEmail( ? string $email);

    /**
     * Return email.
     *
     * @return string|null
     */
    public function getEmail() : ? string;

    /**
     * Set birthday.
     *
     * @param DateTime|null $birthday
     */
    public function setBirthday( ? DateTime $birthday);

    /**
     * Get birthday.
     *
     * @return DateTime|null
     */
    public function getBirthday() : ? DateTime;

    /**
     * Get user full name.
     *
     * @return string
     */
    public function getFullName() : string;

    /**
     * Set password.
     *
     * @param string|null $password
     *
     * @throws InvalidPasswordException
     */
    public function setPassword( ? string $password);

    /**
     * Sets Token.
     *
     * @param null|string $token
     */
    public function setToken(?string $token);

    /**
     * Get Token.
     *
     * @return null|string Token
     */
    public function getToken() : ? string;
}
