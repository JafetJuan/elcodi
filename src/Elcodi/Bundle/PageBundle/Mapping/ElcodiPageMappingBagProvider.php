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
 * @author Elcodi Team <tech@elcodi.com>
 */

namespace Elcodi\Bundle\PageBundle\Mapping;

use Mmoreram\BaseBundle\Mapping\MappingBagCollection;
use Mmoreram\BaseBundle\Mapping\MappingBagProvider;

/**
 * Class ElcodiPageMappingBagProvider.
 */
class ElcodiPageMappingBagProvider implements MappingBagProvider
{
    /**
     * Get mapping bag collection.
     *
     * @return MappingBagCollection
     */
    public function getMappingBagCollection() : MappingBagCollection
    {
        return MappingBagCollection::create(
            [
                'page' => 'Page',
            ],
            '@ElcodiPageBundle',
            'Elcodi\Component\Page\Entity',
            'elcodi',
            'default',
            'object_manager',
            'repository',
            true
        );
    }
}
