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

namespace Elcodi\Component\Geo\Entity\Interfaces;

use Elcodi\Component\Core\Entity\Interfaces\DateTimeInterface;
use Elcodi\Component\Core\Entity\Interfaces\EnabledInterface;
use Elcodi\Component\Core\Entity\Interfaces\IdentifiableInterface;

/**
 * Interface AddressInterface.
 */
interface AddressInterface extends
    IdentifiableInterface,
    DateTimeInterface,
    EnabledInterface
{
    /**
     * Sets Address.
     *
     * @param null|string $address
     */
    public function setAddress(?string $address);

    /**
     * Get Address.
     *
     * @return null|string Address
     */
    public function getAddress() : ? string;

    /**
     * Sets AddressMore.
     *
     * @param null|string $addressMore
     */
    public function setAddressMore(?string $addressMore);

    /**
     * Get AddressMore.
     *
     * @return null|string AddressMore
     */
    public function getAddressMore() : ? string;

    /**
     * Get FormattedAddress
     *
     * @return null|string
     */
    public function getFormattedAddress() : ? string;

    /**
     * Set FormattedAddress
     *
     * @param null|string $formattedAddress
     */
    public function setFormattedAddress(?string $formattedAddress);

    /**
     * Sets Comments.
     *
     * @param null|string $comments
     */
    public function setComments(?string $comments);

    /**
     * Get Comments.
     *
     * @return null|string Comments
     */
    public function getComments() : ? string;

    /**
     * Sets Mobile.
     *
     * @param null|string $mobile
     */
    public function setMobile(?string $mobile);

    /**
     * Get Mobile.
     *
     * @return null|string Mobile
     */
    public function getMobile() : ? string;

    /**
     * Sets Name.
     *
     * @param null|string $name
     */
    public function setName(?string $name);

    /**
     * Get Name.
     *
     * @return null|string Name
     */
    public function getName() : ? string;

    /**
     * Sets Phone.
     *
     * @param null|string $phone
     */
    public function setPhone(?string $phone);

    /**
     * Get Phone.
     *
     * @return null|string Phone
     */
    public function getPhone() : ? string;

    /**
     * Sets RecipientName.
     *
     * @param null|string $recipientName
     */
    public function setRecipientName(?string $recipientName);

    /**
     * Get RecipientName.
     *
     * @return null|string RecipientName
     */
    public function getRecipientName() : ? string;

    /**
     * Sets RecipientSurname.
     *
     * @param null|string $recipientSurname
     */
    public function setRecipientSurname(?string $recipientSurname);

    /**
     * Get RecipientSurname.
     *
     * @return null|string RecipientSurname
     */
    public function getRecipientSurname() : ? string;

    /**
     * Get Country
     *
     * @return null|string
     */
    public function getCountry(): ?string;

    /**
     * Set Country
     *
     * @param null|string $country
     */
    public function setCountry(?string $country);

    /**
     * Get State
     *
     * @return null|string
     */
    public function getState(): ?string;

    /**
     * Set State
     *
     * @param null|string $state
     */
    public function setState(?string $state);

    /**
     * Get Province
     *
     * @return null|string
     */
    public function getProvince(): ?string;

    /**
     * Set Province
     *
     * @param null|string $province
     */
    public function setProvince(?string $province);

    /**
     * Sets City.
     *
     * @param null|string $city
     */
    public function setCity(?string $city);

    /**
     * Get City.
     *
     * @return null|string City
     */
    public function getCity() : ? string;

    /**
     * Sets Postalcode.
     *
     * @param null|string $postalCode
     */
    public function setPostalcode(?string $postalCode);

    /**
     * Get Postalcode.
     *
     * @return null|string Postalcode
     */
    public function getPostalcode() : ? string;

    /**
     * Get Longitude
     *
     * @return null|string
     */
    public function getLongitude(): ?string;

    /**
     * Set Longitude
     *
     * @param null|string $longitude
     */
    public function setLongitude(?string $longitude);

    /**
     * Get Latitude
     *
     * @return null|string
     */
    public function getLatitude(): ?string;

    /**
     * Set Latitude
     *
     * @param null|string $latitude
     */
    public function setLatitude(?string $latitude);
}
