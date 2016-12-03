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

namespace Elcodi\Bundle\AttributeBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;

use Elcodi\Bundle\CoreBundle\DataFixtures\ORM\ElcodiFixture;
use Elcodi\Component\Attribute\Entity\Interfaces\AttributeInterface;
use Elcodi\Component\Core\Services\ObjectDirector;

/**
 * Class AttributeData.
 */
class AttributeData extends ElcodiFixture
{
    /**
     * Loads sample fixtures for Attribute entities.
     *
     * @param ObjectManager $objectManager
     */
    public function load(ObjectManager $objectManager)
    {
        /**
         * @var ObjectDirector $attributeDirector
         * @var ObjectDirector $attributeValueDirector
         */
        $attributeDirector = $this->getDirector('attribute');
        $attributeValueDirector = $this->getDirector('attribute_value');

        foreach ($this->getAttributesData() as $attributeName => $values) {

            /**
             * @var AttributeInterface $attribute
             */
            $attribute = $attributeDirector->create();
            $attribute->setName($attributeName);
            $attribute->enable();
            $attributeDirector->save($attribute);
            $this->addReference("attribute-$attributeName", $attribute);

            foreach ($values as $valueName) {
                $value = $attributeValueDirector->create();
                $value->setValue($valueName);
                $value->setAttribute($attribute);
                $attributeValueDirector->save($value);
                $this->addReference("value-$attributeName-$valueName", $value);
            }
        }
    }

    /**
     * Get attributes data.
     *
     * @return array
     */
    private function getAttributesData() : array
    {
        return [
            'size' => [
                'small',
                'medium',
                'large',
            ],
            'color' => [
                'blue',
                'white',
                'red',
            ],
        ];
    }
}
