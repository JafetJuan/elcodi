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

namespace Elcodi\Component\User\Entity;

use DateTime;
use Symfony\Component\Security\Core\Role\Role;

use Elcodi\Component\Core\Entity\Traits\DateTimeTrait;
use Elcodi\Component\Core\Entity\Traits\EnabledTrait;
use Elcodi\Component\Core\Entity\Traits\IdentifiableTrait;
use Elcodi\Component\User\Entity\Interfaces\AbstractUserInterface;
use Elcodi\Component\User\Entity\Traits\LastLoginTrait;
use Elcodi\Component\User\Exception\InvalidPasswordException;

/**
 * AbstractUser is the building block for simple User entities,
 * consisting of username, password, email.
 */
abstract class AbstractUser implements AbstractUserInterface
{
    use IdentifiableTrait,
        LastLoginTrait,
        DateTimeTrait,
        EnabledTrait;

    /**
     * Gender not defined (automatically created user or privacy preferences).
     *
     * @var int
     */
    const GENDER_UNDEFINED = 0;

    /**
     * Gender male.
     *
     * @var int
     */
    const GENDER_MALE = 1;

    /**
     * Gender female.
     *
     * @var int
     */
    const GENDER_FEMALE = 2;

    /**
     * Allowed user genders.
     *
     * @var array
     */
    private static $genders = [
        self::GENDER_UNDEFINED,
        self::GENDER_MALE,
        self::GENDER_FEMALE,
    ];

    /**
     * @var string
     *
     * Password
     */
    protected $password;

    /**
     * @var string
     *
     * Email
     */
    protected $email;

    /**
     * @var string
     *
     * Token
     */
    protected $token;

    /**
     * @var string
     *
     * Firstname
     */
    protected $firstname;

    /**
     * @var string
     *
     * Lastname
     */
    protected $lastname;

    /**
     * User gender, by default undefined.
     *
     * @var int
     */
    protected $gender = self::GENDER_UNDEFINED;

    /**
     * @var DateTime
     *
     * Birthday
     */
    protected $birthday;

    /**
     * @var string
     *
     * Recovery hash
     */
    protected $recoveryHash;

    /**
     * @var string
     *
     * One time login hash
     */
    protected $oneTimeLoginHash;

    /**
     * User roles.
     *
     * @return string[] Roles
     */
    public function getRoles()
    {
        return [
            new Role('IS_AUTHENTICATED_ANONYMOUSLY'),
        ];
    }

    /**
     * Sets Firstname.
     *
     * @param string|null $firstname
     */
    public function setFirstname( ? string $firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * Get Firstname.
     *
     * @return string|null Firstname
     */
    public function getFirstname() : ? string
    {
        return $this->firstname;
    }

    /**
     * Sets Lastname.
     *
     * @param string|null $lastname
     */
    public function setLastname( ? string $lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * Get Lastname.
     *
     * @return string|null Lastname
     */
    public function getLastname() : ? string
    {
        return $this->lastname;
    }

    /**
     * Set gender, if the gender is allowed.
     *
     * @param int $gender
     */
    public function setGender(int $gender)
    {
        if (!in_array($gender, self::$genders, true)) {
            return;
        }

        $this->gender = $gender;
    }

    /**
     * Get gender.
     *
     * @return int
     */
    public function getGender() : int
    {
        return $this->gender;
    }

    /**
     * Set email.
     *
     * @param string|null $email
     */
    public function setEmail( ? string $email)
    {
        $this->email = $email;
    }

    /**
     * Return email.
     *
     * @return string|null
     */
    public function getEmail() : ? string
    {
        return $this->email;
    }

    /**
     * Get Token.
     *
     * @return string
     */
    public function getToken() : string
    {
        return $this->token;
    }

    /**
     * Sets Token.
     *
     * @param string $token
     */
    public function setToken(string $token)
    {
        $this->token = $token;
    }

    /**
     * Get username.
     *
     * Just for symfony security purposes
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * Set birthday.
     *
     * @param DateTime|null $birthday
     */
    public function setBirthday( ? DateTime $birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * Get birthday.
     *
     * @return DateTime|null
     */
    public function getBirthday() : ? DateTime
    {
        return $this->birthday;
    }

    /**
     * Set recovery hash.
     *
     * @param string|null $recoveryHash
     */
    public function setRecoveryHash( ? string $recoveryHash)
    {
        $this->recoveryHash = $recoveryHash;
    }

    /**
     * Get recovery hash.
     *
     * @return string|null
     */
    public function getRecoveryHash() : ? string
    {
        return $this->recoveryHash;
    }

    /**
     * Get user full name.
     *
     * @return string
     */
    public function getFullName() : string
    {
        return trim($this->firstname . ' ' . $this->lastname);
    }

    /**
     * Set password.
     *
     * @param string|null $password
     *
     * @throws InvalidPasswordException
     */
    public function setPassword( ? string $password)
    {
        if (null === $password) {
            return;
        }

        if (!is_string($password) || trim($password) == '') {
            throw new InvalidPasswordException();
        }

        $this->password = $password;
    }

    /**
     * Get password.
     *
     * @return string Password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Gets the one time login hash.
     *
     * @return string|null
     */
    public function getOneTimeLoginHash() : ? string
    {
        return $this->oneTimeLoginHash;
    }

    /**
     * Sets a hash so it can be used to login once without the need to use the
     * password.
     *
     * @param string|null $oneTimeLoginHash
     */
    public function setOneTimeLoginHash( ? string $oneTimeLoginHash)
    {
        $this->oneTimeLoginHash = $oneTimeLoginHash;
    }

    /**
     * Part of UserInterface. Dummy.
     *
     * @return string Salt
     */
    public function getSalt()
    {
        return '';
    }

    /**
     * Dummy function, returns empty string.
     *
     * @return string
     */
    public function eraseCredentials()
    {
        return '';
    }

    /**
     * String representation of the Customer.
     *
     * @return string
     */
    public function __toString() : string
    {
        return $this->getFullName();
    }

    /**
     * Sleep implementation for some reason.
     *
     * @link http://asiermarques.com/2013/symfony2-security-usernamepasswordtokenserialize-must-return-a-string-or-null/
     *
     * @return array
     */
    public function __sleep()
    {
        return ['id', 'email'];
    }
}
