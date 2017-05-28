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

namespace Elcodi\Component\Geo\Entity;

use Elcodi\Component\Core\Entity\Traits\DateTimeTrait;
use Elcodi\Component\Core\Entity\Traits\EnabledTrait;
use Elcodi\Component\Core\Entity\Traits\IdentifiableTrait;
use Elcodi\Component\Geo\Entity\Interfaces\AddressInterface;

/**
 * Class Address.
 */
class Address implements AddressInterface
{
    use IdentifiableTrait, DateTimeTrait, EnabledTrait;

    /**
     * @var string
     *
     * Name
     */
    protected $name;

    /**
     * @var string
     *
     * Recipient name
     */
    protected $recipientName;

    /**
     * @var string
     *
     * Recipient surname
     */
    protected $recipientSurname;

    /**
     * @var string
     *
     * Phone
     */
    protected $phone;

    /**
     * @var string
     *
     * Mobile
     */
    protected $mobile;

    /**
     * @var string
     *
     * Comments
     */
    protected $comments;

    /**
     * @var string
     *
     * Country
     */
    protected $country;

    /**
     * @var string
     *
     * State
     */
    protected $state;

    /**
     * @var string
     *
     * Province
     */
    protected $province;

    /**
     * @var string
     *
     * City
     */
    protected $city;

    /**
     * @var string
     *
     * Postalcode
     */
    protected $postalCode;

    /**
     * @var string
     *
     * Address
     */
    protected $address;

    /**
     * @var string
     *
     * Address more
     */
    protected $addressMore;

    /**
     * @var string
     *
     * Formatted address
     */
    protected $formattedAddress;

    /**
     * @var string
     *
     * Longitude
     */
    protected $longitude;

    /**
     * @var string
     *
     * Latitude
     */
    protected $latitude;

    /**
     * Sets Address.
     *
     * @param null|string $address
     */
    public function setAddress(?string $address)
    {
        $this->address = $address;
    }

    /**
     * Get Address.
     *
     * @return null|string Address
     */
    public function getAddress() : ? string
    {
        return $this->address;
    }

    /**
     * Sets AddressMore.
     *
     * @param null|string $addressMore
     */
    public function setAddressMore(?string $addressMore)
    {
        $this->addressMore = $addressMore;
    }

    /**
     * Get AddressMore.
     *
     * @return null|string AddressMore
     */
    public function getAddressMore() : ? string
    {
        return $this->addressMore;
    }

    /**
     * Get FormattedAddress
     *
     * @return null|string
     */
    public function getFormattedAddress() : ? string
    {
        return $this->formattedAddress;
    }

    /**
     * Set FormattedAddress
     *
     * @param null|string $formattedAddress
     */
    public function setFormattedAddress(?string $formattedAddress)
    {
        $this->formattedAddress = $formattedAddress;
    }

    /**
     * Sets Comments.
     *
     * @param null|string $comments
     */
    public function setComments(?string $comments)
    {
        $this->comments = $comments;
    }

    /**
     * Get Comments.
     *
     * @return null|string Comments
     */
    public function getComments() : ? string
    {
        return $this->comments;
    }

    /**
     * Sets Mobile.
     *
     * @param null|string $mobile
     */
    public function setMobile(?string $mobile)
    {
        $this->mobile = $mobile;
    }

    /**
     * Get Mobile.
     *
     * @return null|string Mobile
     */
    public function getMobile() : ? string
    {
        return $this->mobile;
    }

    /**
     * Sets Name.
     *
     * @param null|string $name
     */
    public function setName(?string $name)
    {
        $this->name = $name;
    }

    /**
     * Get Name.
     *
     * @return null|string Name
     */
    public function getName() : ? string
    {
        return $this->name;
    }

    /**
     * Sets Phone.
     *
     * @param null|string $phone
     */
    public function setPhone(?string $phone)
    {
        $this->phone = $phone;
    }

    /**
     * Get Phone.
     *
     * @return null|string Phone
     */
    public function getPhone() : ? string
    {
        return $this->phone;
    }

    /**
     * Sets RecipientName.
     *
     * @param null|string $recipientName
     */
    public function setRecipientName(?string $recipientName)
    {
        $this->recipientName = $recipientName;
    }

    /**
     * Get RecipientName.
     *
     * @return null|string RecipientName
     */
    public function getRecipientName() : ? string
    {
        return $this->recipientName;
    }

    /**
     * Sets RecipientSurname.
     *
     * @param null|string $recipientSurname
     */
    public function setRecipientSurname(?string $recipientSurname)
    {
        $this->recipientSurname = $recipientSurname;
    }

    /**
     * Get RecipientSurname.
     *
     * @return null|string RecipientSurname
     */
    public function getRecipientSurname() : ? string
    {
        return $this->recipientSurname;
    }

    /**
     * Get Country
     *
     * @return null|string
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * Set Country
     *
     * @param null|string $country
     */
    public function setCountry(?string $country)
    {
        $this->country = $country;
    }

    /**
     * Get State
     *
     * @return null|string
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * Set State
     *
     * @param null|string $state
     */
    public function setState(?string $state)
    {
        $this->state = $state;
    }

    /**
     * Get Province
     *
     * @return null|string
     */
    public function getProvince(): ?string
    {
        return $this->province;
    }

    /**
     * Set Province
     *
     * @param null|string $province
     */
    public function setProvince(?string $province)
    {
        $this->province = $province;
    }

    /**
     * Sets City.
     *
     * @param null|string $city
     */
    public function setCity(?string $city)
    {
        $this->city = $city;
    }

    /**
     * Get City.
     *
     * @return null|string City
     */
    public function getCity() : ? string
    {
        return $this->city;
    }

    /**
     * Sets Postalcode.
     *
     * @param null|string $postalCode
     */
    public function setPostalcode(?string $postalCode)
    {
        $this->postalCode = $postalCode;
    }

    /**
     * Get Postalcode.
     *
     * @return null|string Postalcode
     */
    public function getPostalcode() : ? string
    {
        return $this->postalCode;
    }

    /**
     * Get Longitude
     *
     * @return null|string
     */
    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    /**
     * Set Longitude
     *
     * @param null|string $longitude
     */
    public function setLongitude(?string $longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * Get Latitude
     *
     * @return null|string
     */
    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    /**
     * Set Latitude
     *
     * @param null|string $latitude
     */
    public function setLatitude(?string $latitude)
    {
        $this->latitude = $latitude;
    }
}
