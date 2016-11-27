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

namespace Elcodi\Component\Newsletter\Factory;

use Elcodi\Component\Core\Factory\Abstracts\AbstractFactory;
use Elcodi\Component\Newsletter\Entity\Interfaces\NewsletterSubscriptionInterface;

/**
 * Class NewsletterSubscriptionFactory.
 */
class NewsletterSubscriptionFactory extends AbstractFactory
{
    /**
     * Creates an instance of an entity.
     *
     * This method must return always an empty instance
     *
     * @return NewsletterSubscriptionInterface Empty entity
     */
    public function create()
    {
        /**
         * @var NewsletterSubscriptionInterface $newsletterSubscription
         */
        $classNamespace = $this->getEntityNamespace();
        $newsletterSubscription = new $classNamespace();
        $newsletterSubscription->enable();
        $newsletterSubscription->setCreatedAt($this->now());

        return $newsletterSubscription;
    }
}
