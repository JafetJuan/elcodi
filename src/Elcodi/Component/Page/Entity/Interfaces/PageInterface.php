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

namespace Elcodi\Component\Page\Entity\Interfaces;

use DateTime;

use Elcodi\Component\Core\Entity\Interfaces\DateTimeInterface;
use Elcodi\Component\Core\Entity\Interfaces\EnabledInterface;
use Elcodi\Component\Core\Entity\Interfaces\IdentifiableInterface;
use Elcodi\Component\Core\Entity\Interfaces\TaggableInterface;
use Elcodi\Component\Core\Entity\Interfaces\WithSpecialWordsInterface;
use Elcodi\Component\Media\Entity\Interfaces\ImagesContainerWithPrincipalImageInterface;
use Elcodi\Component\MetaData\Entity\Interfaces\MetaDataInterface;
use Elcodi\Component\Store\Entity\Interfaces\WithStoresInterface;
use Elcodi\Component\User\Entity\Interfaces\AdminUserInterface;

/**
 * Interface PageInterface.
 */
interface PageInterface extends
    IdentifiableInterface,
    MetaDataInterface,
    DateTimeInterface,
    EnabledInterface,
    TaggableInterface,
    WithSpecialWordsInterface,
    WithStoresInterface,
    ImagesContainerWithPrincipalImageInterface
{
    /**
     * Get Name.
     *
     * @return string Name
     */
    public function getName();

    /**
     * Sets Name.
     *
     * @param string $name
     */
    public function setName($name);

    /**
     * Get the path.
     *
     * @return string
     */
    public function getPath();

    /**
     * Set the path.
     *
     * @param string $path
     */
    public function setPath($path);

    /**
     * Get the title.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set the title.
     *
     * @param string $title
     */
    public function setTitle($title);

    /**
     * Get the content.
     *
     * @return string
     */
    public function getContent();

    /**
     * Set the content.
     *
     * @param string $content
     */
    public function setContent($content);

    /**
     * Get Type.
     *
     * @return int Type
     */
    public function getType();

    /**
     * Sets Type.
     *
     * @param int $type
     */
    public function setType($type);

    /**
     * Get PublicationDate.
     *
     * @return DateTime PublicationDate
     */
    public function getPublicationDate();

    /**
     * Sets PublicationDate.
     *
     * @param DateTime $publicationDate
     */
    public function setPublicationDate(DateTime $publicationDate);

    /**
     * Sets the persistence property.
     *
     * @param bool $persistent
     */
    public function setPersistent($persistent);

    /**
     * Gets the page persistence.
     *
     * @return bool
     */
    public function isPersistent();

    /**
     * Set created by
     *
     * @param null|AdminUserInterface $adminUser
     */
    public function setCreatedBy(?AdminUserInterface $adminUser);

    /**
     * Get created by
     *
     * @return null|AdminUserInterface
     */
    public function getCreatedBy() : ? AdminUserInterface;

    /**
     * Set updated by
     *
     * @param null|AdminUserInterface $adminUser
     */
    public function setUpdatedBy(?AdminUserInterface $adminUser);

    /**
     * Get updated by
     *
     * @return null|AdminUserInterface
     */
    public function getUpdatedBy() : ? AdminUserInterface;

    /**
     * Get Author
     *
     * @return null|string
     */
    public function getAuthor() : ? string;

    /**
     * Set Author
     *
     * @param null|string $author
     */
    public function setAuthor(?string $author);
}
