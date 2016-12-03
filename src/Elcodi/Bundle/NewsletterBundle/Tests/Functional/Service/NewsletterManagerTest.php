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

namespace Elcodi\Bundle\NewsletterBundle\Tests\Functional\Service;

use Elcodi\Bundle\NewsletterBundle\Tests\Functional\ElcodiNewsletterFunctionalTest;
use Elcodi\Component\Language\Entity\Interfaces\LanguageInterface;
use Elcodi\Component\Newsletter\Entity\Interfaces\NewsletterSubscriptionInterface;
use Elcodi\Component\Newsletter\Services\NewsletterManager;

/**
 * Class NewsletterManagerTest.
 */
class NewsletterManagerTest extends ElcodiNewsletterFunctionalTest
{
    /**
     * @var NewsletterManager
     *
     * Newsletter manager
     */
    private $newsletterManager;

    /**
     * Set up.
     */
    public function setUp()
    {
        $this->reloadFixtures();

        parent::setUp();

        $this->newsletterManager = $this->get('elcodi.manager.newsletter');
    }

    /**
     * Test subscribe.
     */
    public function testSubscribe()
    {
        $this->assertCount(
            2,
            $this->findBy('elcodi:newsletter_subscription', [
                'enabled' => true,
            ])
        );

        /**
         * @var LanguageInterface $language
         */
        $language = $this->findOneBy('elcodi:language', [
            'iso' => 'es',
        ]);

        $this
            ->newsletterManager
            ->subscribe('hi@hi.org', $language);

        $this->assertCount(
            3,
            $this->findBy('elcodi:newsletter_subscription', [
                'enabled' => true,
            ])
        );

        /**
         * @var NewsletterSubscriptionInterface $newsletterSubscription
         */
        $newsletterSubscription = $this->findOneBy('elcodi:newsletter_subscription', [
            'email' => 'hi@hi.org',
        ]);

        $this->assertNotEmpty($newsletterSubscription->getHash());
    }

    /**
     * Test subscribe.
     */
    public function testSubscribeNoLanguage()
    {
        $this->assertCount(
            2,
            $this->findBy('elcodi:newsletter_subscription', [
                'enabled' => true,
            ])
        );

        $this
            ->newsletterManager
            ->subscribe('hi@hi.org');

        $this->assertCount(
            3,
            $this->findBy('elcodi:newsletter_subscription', [
                'enabled' => true,
            ])
        );
    }

    /**
     * Test subscribe.
     */
    public function testUnsubscribeExisting()
    {
        $this->assertCount(
            2,
            $this->findBy('elcodi:newsletter_subscription', [
                'enabled' => true,
            ])
        );

        $this
            ->newsletterManager
            ->unSubscribe('someemail@something.org', '123456789');

        $this->assertCount(
            2,
            $this->findAll('elcodi:newsletter_subscription')
        );

        /**
         * @var LanguageInterface $language
         */
        $language = $this->findOneBy('elcodi:language', [
            'iso' => 'es',
        ]);

        $reason = 'my reason';
        $this
            ->newsletterManager
            ->unSubscribe('someemail@something.org', '123456789', $language, $reason);

        $this->assertCount(
            1,
            $this->findBy('elcodi:newsletter_subscription', [
                'enabled' => true,
            ])
        );

        $disabledNewsletterSubscription = $this->findOneBy('elcodi:newsletter_subscription', [
            'enabled' => false,
        ]);

        $this->assertEquals(
            $disabledNewsletterSubscription->getReason(),
            $reason
        );
    }

    /**
     * Test subscribe.
     *
     * @expectedException \Elcodi\Component\Newsletter\Exception\NewsletterCannotBeRemovedException
     */
    public function testUnsubscribeMissing()
    {
        $this
            ->newsletterManager
            ->unSubscribe('someemail@another.org', '123456789');
    }

    /**
     * Tests validateEmail method emails acceptance with right emails.
     *
     * @dataProvider dataValidateEmail
     */
    public function testValidateEmail($email, $result)
    {
        $this->assertEquals($this
            ->newsletterManager
            ->validateEmail($email), $result);
    }

    /**
     * Return good emails.
     */
    public function dataValidateEmail()
    {
        return [
            ['a@a.a', true],
            ['a@a', false],
            ['a.a', false],
            ['', false],
            [null, false],
            [false, false],
            [true, false],
            ['lalala', false],
            ['@a.a', false],
        ];
    }

    /**
     * Test isSubscribed.
     */
    public function testIsSubscribed()
    {
        $this->assertTrue($this
            ->newsletterManager
            ->isSubscribed('someemail@something.org'));

        $this->assertFalse($this
            ->newsletterManager
            ->isSubscribed('someemail@another.org'));
    }

    /**
     * Test getSubscription.
     */
    public function testGetSubscription()
    {
        $this->assertInstanceOf('Elcodi\Component\Newsletter\Entity\Interfaces\NewsletterSubscriptionInterface', $this
            ->newsletterManager
            ->getSubscription('someemail@something.org'));

        $this->assertNotInstanceOf('Elcodi\Component\Newsletter\Entity\Interfaces\NewsletterSubscriptionInterface', $this
            ->newsletterManager
            ->getSubscription('someemail@another.org'));
    }
}
