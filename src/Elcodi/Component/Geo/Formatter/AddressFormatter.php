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

namespace Elcodi\Component\Geo\Formatter;

use Elcodi\Component\Geo\Adapter\LocationProvider\Interfaces\LocationProviderAdapterInterface;
use Elcodi\Component\Geo\Entity\Interfaces\AddressInterface;
use Elcodi\Component\Geo\ValueObject\LocationData;

/**
 * Class AddressFormatter.
 */
class AddressFormatter
{
    /**
     * @var LocationProviderAdapterInterface
     *
     * The location provider interface
     */
    private $locationProvider;

    /**
     * Builds a new address formatter.
     *
     * @param LocationProviderAdapterInterface $locationProvider A location provider
     */
    public function __construct(LocationProviderAdapterInterface $locationProvider)
    {
        $this->locationProvider = $locationProvider;
    }

    /**
     * Formats an address on an array.
     *
     * @param AddressInterface $address The address to format
     *
     * @return array
     */
    public function toArray(AddressInterface $address)
    {
        $locationId = $address->getProvince() ?: $address->getCountry();
        $hierarchy = $this
            ->locationProvider
            ->getHierarchy($locationId);
        $hierarchyAsc = array_reverse($hierarchy);

        $addressArray = [
            'id' => $address->getId(),
            'name' => $address->getName(),
            'recipientName' => $address->getRecipientName(),
            'recipientSurname' => $address->getRecipientSurname(),
            'address' => $address->getAddress(),
            'addressMore' => $address->getAddressMore(),
            'postalCode' => $address->getPostalcode(),
            'phone' => $address->getPhone(),
            'mobile' => $address->getMobile(),
            'comment' => $address->getComments(),
        ];

        foreach ($hierarchyAsc as $locationNode) {
            /**
             * @var LocationData $cityLocationNode
             */
            $addressArray['location'][$locationNode->getType()]
                = $locationNode->getName();
        }

        $addressArray['fullAddress'] =
            $this->buildFullAddressString(
                $address,
                $addressArray['location']
            );

        return $addressArray;
    }

    /**
     * Builds a full address string.
     *
     * @param AddressInterface $address       The address
     * @param array            $location The full location hierarchy
     *
     * @return string
     */
    private function buildFullAddressString(
        AddressInterface $address,
        array $location
    ) {
        $locationString = implode(', ', $location);

        return sprintf(
            '%s %s, %s %s',
            $address->getAddress(),
            $address->getAddressMore(),
            $locationString,
            $address->getPostalcode()
        );
    }
}
