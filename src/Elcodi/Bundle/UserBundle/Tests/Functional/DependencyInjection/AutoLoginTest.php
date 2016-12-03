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

namespace Elcodi\Bundle\UserBundle\Tests\Functional\DependencyInjection;

use Mmoreram\BaseBundle\Tests\BaseKernel;
use Symfony\Component\HttpKernel\KernelInterface;

use Elcodi\Bundle\UserBundle\ElcodiUserBundle;
use Elcodi\Bundle\UserBundle\Tests\Functional\ElcodiUserFunctionalTest;

/**
 * File header placeholder.
 */
class AutoLoginTest extends ElcodiUserFunctionalTest
{
    /**
     * Get kernel.
     *
     * @return KernelInterface
     */
    protected static function getKernel() : KernelInterface
    {
        return new BaseKernel([
            new ElcodiUserBundle(),
        ], [
            'imports' => [
                ['resource' => '@BaseBundle/Resources/config/providers.yml'],
                ['resource' => '@BaseBundle/Resources/test/framework.test.yml'],
                ['resource' => '@BaseBundle/Resources/test/doctrine.test.yml'],
                ['resource' => '@ElcodiCoreBundle/Resources/test/filesystem.test.yml'],
            ],
            'elcodi_user' => [
                'auto_login' => [
                    'Namespace\First' => [
                        'enabled' => true,
                        'firewall' => 'firewall1',
                    ],
                    'Namespace\Second' => [
                        'enabled' => false,
                        'firewall' => 'firewall2',
                    ],
                    'Namespace\Third' => [
                        'firewall' => 'firewall3',
                    ],
                ],
            ],
        ]);
    }

    /**
     * Test firewalls are defined.
     */
    public function testFirewallsAreDefined()
    {
        $this->assertEquals([
            'Namespace\First' => 'firewall1',
            'Namespace\Third' => 'firewall3',
        ], $this->getParameter('elcodi.user_auto_login_firewalls'));
    }
}
