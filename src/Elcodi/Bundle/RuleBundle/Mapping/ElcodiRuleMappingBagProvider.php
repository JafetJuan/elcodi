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

namespace Elcodi\Bundle\RuleBundle\Mapping;

use Mmoreram\BaseBundle\Mapping\MappingBagCollection;
use Mmoreram\BaseBundle\Mapping\MappingBagProvider;

/**
 * Class ElcodiRuleMappingBagProvider.
 */
class ElcodiRuleMappingBagProvider implements MappingBagProvider
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
                'rule' => 'Rule',
            ],
            '@ElcodiRuleBundle',
            'Elcodi\Component\Rule\Entity',
            'elcodi',
            'default',
            'object_manager',
            'repository',
            true
        );
    }
}
