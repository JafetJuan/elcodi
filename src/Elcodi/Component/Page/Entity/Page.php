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

namespace Elcodi\Component\Page\Entity;

use DateTime;

use Elcodi\Component\Core\Entity\Traits\DateTimeTrait;
use Elcodi\Component\Core\Entity\Traits\EnabledTrait;
use Elcodi\Component\Core\Entity\Traits\IdentifiableTrait;
use Elcodi\Component\Core\Entity\Traits\TaggableTrait;
use Elcodi\Component\Core\Entity\Traits\WithSpecialWordsTrait;
use Elcodi\Component\Media\Entity\Traits\ImagesContainerTrait;
use Elcodi\Component\Media\Entity\Traits\PrincipalImageTrait;
use Elcodi\Component\MetaData\Entity\Traits\MetaDataTrait;
use Elcodi\Component\Page\Entity\Interfaces\PageInterface;
use Elcodi\Component\Store\Entity\Traits\WithStoresTrait;
use Elcodi\Component\User\Entity\Interfaces\AdminUserInterface;

/**
 * Class Page.
 */
class Page implements PageInterface
{
    use IdentifiableTrait,
        MetaDataTrait,
        DateTimeTrait,
        EnabledTrait,
        WithStoresTrait,
        TaggableTrait,
        WithSpecialWordsTrait,
        PrincipalImageTrait,
        ImagesContainerTrait;

    /**
     * @var string
     *
     * Name
     */
    protected $name;

    /**
     * @var string
     *
     * Path from which this page would be accessed
     */
    protected $path;

    /**
     * @var string
     *
     * Title of the page
     */
    protected $title;

    /**
     * @var string
     *
     * Content of the page
     */
    protected $content;

    /**
     * @var int
     *
     * Type
     */
    protected $type;

    /**
     * @var DateTime
     *
     * Publication date
     */
    protected $publicationDate;

    /**
     * @var bool
     *
     * The persistence of the page
     */
    protected $persistent;

    /**
     * @var AdminUserInterface
     *
     * Created by
     */
    protected $createdBy;

    /**
     * @var AdminUserInterface
     *
     * Updated by
     */
    protected $updatedBy;

    /**
     * @var string
     *
     * Author
     */
    protected $author;

    /**
     * Get Name.
     *
     * @return string Name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets Name.
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get the path.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set the path.
     *
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Get the title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the title.
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get the content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the content.
     *
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Get Type.
     *
     * @return int Type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets Type.
     *
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get PublicationDate.
     *
     * @return DateTime PublicationDate
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    /**
     * Sets PublicationDate.
     *
     * @param DateTime $publicationDate
     */
    public function setPublicationDate(DateTime $publicationDate)
    {
        $this->publicationDate = $publicationDate;
    }

    /**
     * Sets the persistence property.
     *
     * @param bool $persistent
     */
    public function setPersistent($persistent)
    {
        $this->persistent = $persistent;
    }

    /**
     * Gets the page persistence.
     *
     * @return bool
     */
    public function isPersistent()
    {
        return $this->persistent;
    }

    /**
     * Set created by
     *
     * @param null|AdminUserInterface $adminUser
     */
    public function setCreatedBy(?AdminUserInterface $adminUser)
    {
        $this->createdBy = $adminUser;
    }

    /**
     * Get created by
     *
     * @return null|AdminUserInterface
     */
    public function getCreatedBy() : ?AdminUserInterface
    {
        return $this->createdBy;
    }

    /**
     * Set updated by
     *
     * @param null|AdminUserInterface $adminUser
     */
    public function setUpdatedBy(?AdminUserInterface $adminUser)
    {
        $this->updatedBy = $adminUser;
    }

    /**
     * Get updated by
     *
     * @return null|AdminUserInterface
     */
    public function getUpdatedBy() : ?AdminUserInterface
    {
        return $this->updatedBy;
    }

    /**
     * Get Author
     *
     * @return null|string
     */
    public function getAuthor() : ? string
    {
        return $this->author;
    }

    /**
     * Set Author
     *
     * @param null|string $author
     */
    public function setAuthor(?string $author)
    {
        $this->author = $author;
    }
}
