<?php
/**
 * File header placeholder
 */

namespace Elcodi\Component\User\Entity\Interfaces;

use Elcodi\Component\Core\Entity\Interfaces\EnabledInterface;
use Elcodi\Component\Core\Entity\Interfaces\IdentifiableInterface;

/**
 * Interface PermissionGroupInterface
 */
interface PermissionGroupInterface extends IdentifiableInterface, EnabledInterface
{
    /**
     * Get Name
     *
     * @return string
     */
    public function getName() : ? string;

    /**
     * Set Name
     *
     * @param string $name
     */
    public function setName(string $name);

    /**
     * Get Description
     *
     * @return string
     */
    public function getDescription() : string;

    /**
     * Set Description
     *
     * @param string $description
     */
    public function setDescription(string $description);

    /**
     * Get Permissions
     *
     * @return array
     */
    public function getPermissions() : array;

    /**
     * Set Permissions
     *
     * @param array $permissions
     */
    public function setPermissions(array $permissions);

    /**
     * Has permission
     *
     * @param string $route
     *
     * @return bool
     */
    public function hasPermission(string $route) : bool;
}