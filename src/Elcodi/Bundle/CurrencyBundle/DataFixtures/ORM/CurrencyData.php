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

namespace Elcodi\Bundle\CurrencyBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;

use Elcodi\Bundle\CoreBundle\DataFixtures\ORM\Abstracts\AbstractFixture;
use Elcodi\Component\Core\Services\ObjectDirector;

/**
 * Class CurrencyData.
 */
class CurrencyData extends AbstractFixture
{
    /**
     * Load data fixtures with the passed EntityManager.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /**
         * @var ObjectDirector $currencyDirector
         */
        $currencyDirector = $this->getDirector('currency');

        /**
         * Dollar.
         */
        $currencyDollar = $currencyDirector->create();
        $currencyDollar->setName('Dollar');
        $currencyDollar->setSymbol('$');
        $currencyDollar->setIso('USD');

        $currencyDirector->save($currencyDollar);
        $this->setReference('currency-dollar', $currencyDollar);

        /**Euro
         */
        $currencyEuro = $currencyDirector->create();
        $currencyEuro->setName('Euro');
        $currencyEuro->setSymbol('€');
        $currencyEuro->setIso('EUR');

        $currencyDirector->save($currencyEuro);
        $this->setReference('currency-euro', $currencyEuro);

        /**
         * Pound.
         */
        $currencyPound = $currencyDirector->create();
        $currencyPound->setName('Pound');
        $currencyPound->setSymbol('£');
        $currencyPound->setIso('GBP');

        $currencyDirector->save($currencyPound);
        $this->setReference('currency-pound', $currencyPound);

        /**
         * Ien.
         */
        $currencyIen = $currencyDirector->create();
        $currencyIen->setName('Yen');
        $currencyIen->setSymbol('円');
        $currencyIen->setIso('JPY');

        $currencyDirector->save($currencyIen);
        $this->setReference('currency-ien', $currencyIen);
    }
}
