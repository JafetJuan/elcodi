<?php
/**
 * File header placeholder
 */

namespace Elcodi\Component\User\Entity;

use Elcodi\Component\Core\Entity\Traits\EnabledTrait;
use Elcodi\Component\Core\Entity\Traits\IdentifiableTrait;
use Elcodi\Component\User\Entity\Interfaces\PermissionGroupInterface;

/**
 * Class PermissionGroup
 */
class PermissionGroup implements PermissionGroupInterface
{
    use IdentifiableTrait, EnabledTrait;

    /**
     * @param string
     *
     * Name
     */
    protected $name;

    /**
     * @param string
     *
     * Description
     */
    protected $description;

    /**
     * @param array
     *
     * Permissions
     */
    protected $permissions;

    /**
     * Get Name
     *
     * @return string
     */
    public function getName() : ? string
    {
        return $this->name;
    }

    /**
     * Set Name
     *
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get Description
     *
     * @return string
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * Set Description
     *
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * Get Permissions
     *
     * @return array
     */
    public function getPermissions() : array
    {
        return $this->permissions;
    }

    /**
     * Set Permissions
     *
     * @param array $permissions
     */
    public function setPermissions(array $permissions)
    {
        $this->permissions = $permissions;
    }
}