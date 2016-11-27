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

namespace Elcodi\Bundle\RuleBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;

use Elcodi\Bundle\CoreBundle\DataFixtures\ORM\Abstracts\AbstractFixture;
use Elcodi\Component\Core\Services\ObjectDirector;

/**
 * Class RuleData.
 */
class RuleData extends AbstractFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        /**
         * @var ObjectDirector $ruleDirector
         */
        $ruleDirector = $this->getDirector('rule');

        $cartOver1000Euros = $ruleDirector->create();
        $cartOver1000Euros->setName('cart_over_1000euros');
        $cartOver1000Euros->setExpression('cart.getAmount() > 1000');

        $ruleDirector->save($cartOver1000Euros);

        $cartUnder10Products = $ruleDirector->create();
        $cartUnder10Products->setName('cart_under_10products');
        $cartUnder10Products->setExpression('cart.getTotalItemNumber() < 10');

        $ruleDirector->save($cartUnder10Products);

        $cartValuableItems = $ruleDirector->create();
        $cartValuableItems->setName('cart_valuable_items');
        $cartValuableItems->setExpression('rule("cart_over_1000euros") and rule("cart_under_10products")');

        $ruleDirector->save($cartValuableItems);
    }
}
