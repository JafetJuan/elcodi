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

namespace Elcodi\Component\Menu\Services;

use Doctrine\Common\Persistence\ObjectManager;
use Exception;

use Elcodi\Component\Core\Wrapper\Abstracts\AbstractCacheWrapper;
use Elcodi\Component\Menu\ElcodiMenuStages;
use Elcodi\Component\Menu\Entity\Interfaces\MenuInterface;
use Elcodi\Component\Menu\Repository\MenuRepository;
use Elcodi\Component\Menu\Services\Interfaces\MenuChangerInterface;

/**
 * Class MenuManager.
 */
class MenuManager extends AbstractCacheWrapper
{
    /**
     * @var MenuRepository
     *
     * Menu Repository
     */
    private $menuRepository;

    /**
     * @var ObjectManager
     *
     * Menu Object manager
     */
    private $menuObjectManager;

    /**
     * @var MenuChangerInterface[]
     *
     * Menu changers
     */
    private $menuChangers = [];

    /**
     * @var string
     *
     * key
     */
    private $key;

    /**
     * @var array
     *
     * menus
     */
    private $menus = [];

    /**
     * Construct method.
     *
     * @param MenuRepository $menuRepository    Menu Repository
     * @param ObjectManager  $menuObjectManager Menu Object Manager
     * @param string         $key               Key
     */
    public function __construct(
        MenuRepository $menuRepository,
        ObjectManager $menuObjectManager,
        $key
    ) {
        $this->menuRepository = $menuRepository;
        $this->menuObjectManager = $menuObjectManager;
        $this->key = $key;
    }

    /**
     * Add menu changer.
     *
     * @param MenuChangerInterface $menuChanger Menu changer
     *
     * @return $this Self object
     */
    public function addMenuChanger(MenuChangerInterface $menuChanger)
    {
        $this->menuChangers[] = $menuChanger;

        return $this;
    }

    /**
     * Load menu hydration given the code.
     *
     * If the menu is already loaded in local variable, return it.
     * Otherwise, if is saved into cache, load it and save it locally
     * Otherwise, generate the data, save it into cache and save it locally
     *
     * @param string $menuCode
     *
     * @return MenuInterface
     *
     * @throws Exception
     */
    public function loadMenuByCode(string $menuCode) : MenuInterface
    {
        $menu = $this->loadFromMemory($menuCode);
        if (!($menu instanceof MenuInterface)) {

            /**
             * Menu generation and caching block.
             */
            $key = $this->getCacheKey($menuCode);
            $menu = $this->loadFromCache($key);
            if (!($menu instanceof MenuInterface)) {
                $menu = $this->buildMenuFromRepository($menuCode);

                $this->applyMenuChangers(
                    $menu,
                    ElcodiMenuStages::BEFORE_CACHE
                );

                $this->saveToCache(
                    $key,
                    $menu
                );
            }

            $this->applyMenuChangers(
                $menu,
                ElcodiMenuStages::AFTER_CACHE
            );

            $this->saveToMemory($menu);
        }

        return $menu;
    }

    /**
     * Save menu configuration to memory.
     *
     * @param string $menuCode
     */
    public function removeFromCache(string $menuCode)
    {
        $key = $this->getCacheKey($menuCode);
        $this
            ->cache
            ->delete($key);
    }

    /**
     * Try to get menu configuration from memory.
     *
     * @param string $menuCode
     *
     * @return MenuInterface|null
     */
    private function loadFromMemory(string $menuCode)
    {
        return isset($this->menus[$menuCode])
            ? $this->menus[$menuCode]
            : null;
    }

    /**
     * Save menu configuration to memory.
     *
     * @param MenuInterface $menu
     */
    private function saveToMemory(MenuInterface $menu)
    {
        $this->menus[$menu->getCode()] = $menu;
    }

    /**
     * Try to get menu configuration from cache.
     *
     * @param string $key
     *
     * @return MenuInterface|null
     */
    private function loadFromCache(string $key)
    {
        $encoded = (string) $this
            ->cache
            ->fetch($key);

        try {
            return is_string($encoded)
                ? $this
                    ->encoder
                    ->decode($encoded)
                : null;
        } catch (Exception $e) {
            // Silent pass
        }

        return null;
    }

    /**
     * Save menu configuration to memory.
     *
     * @param string        $key
     * @param MenuInterface $menu
     */
    private function saveToCache(
        string $key,
        MenuInterface $menu
    )
    {
        $encodedMenu = $this
            ->encoder
            ->encode($menu);

        $this
            ->cache
            ->save($key, $encodedMenu);
    }

    /**
     * Build menu.
     *
     * @param string $menuCode
     *
     * @return MenuInterface Menu
     *
     * @throws Exception Menu not found
     */
    private function buildMenuFromRepository(string $menuCode) : MenuInterface
    {
        $menu = $this
            ->menuRepository
            ->findOneBy([
                'code' => $menuCode,
                'enabled' => true,
            ]);

        if (!($menu instanceof MenuInterface)) {
            throw new Exception(sprintf(
                'Menu "%s" not found',
                $menuCode
            ));
        }

        $this
            ->menuObjectManager
            ->detach($menu);

        return $menu;
    }

    /**
     * Apply menu changers to Menu.
     *
     * @param MenuInterface $menu
     * @param string        $stage
     */
    private function applyMenuChangers(
        MenuInterface $menu,
        string $stage
    ) {
        foreach ($this->menuChangers as $menuChanger) {
            $menuChanger
                ->applyChange(
                    $menu,
                    $stage
                );
        }
    }

    /**
     * Build menu key for cache.
     *
     * @param string $menuCode
     *
     * @return string
     */
    private function getCacheKey(string $menuCode) : string
    {
        return "{$this->key}-{$menuCode}";
    }
}
