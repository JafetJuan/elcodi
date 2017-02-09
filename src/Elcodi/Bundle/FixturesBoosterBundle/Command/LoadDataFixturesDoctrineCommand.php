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

namespace Elcodi\Bundle\FixturesBoosterBundle\Command;

use Doctrine\Bundle\FixturesBundle\Command\LoadDataFixturesDoctrineCommand as OriginalCommand;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class LoadDataFixturesDoctrineCommand.
 *
 * Wrapper of original Doctrine. In order to boost all the fixtures, this
 * command tries to reuse sqlite instances.
 *
 * This strategy takes in account all defined fixture paths (or all if fixtures
 * are not specified) and the Kernel
 */
class LoadDataFixturesDoctrineCommand extends OriginalCommand
{
    /**
     * @var KernelInterface
     *
     * Kernel
     */
    protected $kernel;

    /**
     * @var ManagerRegistry
     *
     * Manager
     */
    protected $doctrine;

    /**
     * @var string
     *
     * Database file path
     */
    protected $databaseFilePath;

    /**
     * Construct.
     *
     * @param KernelInterface $kernel
     * @param ManagerRegistry $doctrine
     * @param string          $databaseFilePath
     */
    public function __construct(
        KernelInterface $kernel,
        ManagerRegistry $doctrine,
        $databaseFilePath
    ) {
        parent::__construct();

        $this->kernel = $kernel;
        $this->doctrine = $doctrine;
        $this->databaseFilePath = $databaseFilePath;
    }

    /**
     * Configure command.
     */
    protected function configure()
    {
        parent::configure();

        $this
            ->addOption(
                'no-booster',
                null,
                InputOption::VALUE_OPTIONAL,
                'Disables the booster'
            );
    }

    /**
     * Executes the current command.
     *
     * This method is not abstract because you can use this class
     * as a concrete class. In this case, instead of defining the
     * execute() method, you set the code to execute by passing
     * a Closure to the setCode() method.
     *
     * @param InputInterface  $input  An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     *
     * @return null|int null or 0 if everything went fine, or an error code
     *
     * @throws \LogicException When this abstract method is not implemented
     *
     * @see setCode()
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (
            empty($this->databaseFilePath) ||
            $input->getOption('no-booster')
        ) {
            parent::execute($input, $output);

            return 0;
        }

        /**
         * Same code as parent implementation.
         */
        $dirOrFile = $input->getOption('fixtures');
        $paths = [];

        if ($dirOrFile) {
            $paths = is_array($dirOrFile)
                ? $dirOrFile :
                [$dirOrFile];
        } else {
            foreach ($this->kernel->getBundles() as $bundle) {
                $paths[] = $bundle->getPath() . '/DataFixtures/ORM';
            }
        }

        $kernel = $this->kernel;

        /**
         * In order to take in account the kernel as well we add as part of the
         * signature the root dir of the kernel.
         */
        $paths[] = $kernel->getRootDir();
        $boosterPath = $kernel->getCacheDir() . '/booster/';
        @mkdir($boosterPath);

        sort($paths, SORT_STRING);
        $backupFileName = $boosterPath . md5(json_encode($paths)) . '.backup.database';
        if (file_exists($backupFileName)) {
            copy($backupFileName, $this->databaseFilePath);
            $this->clearAllManagers();
            chmod($this->databaseFilePath, 0755);

            return 0;
        }

        parent::execute($input, $output);
        chmod($this->databaseFilePath, 0755);

        /**
         * If new file has been created, copy it with generated hash value. Now
         * this backup will be reusable for next iterations.
         */
        if (file_exists($this->databaseFilePath)) {
            copy($this->databaseFilePath, $backupFileName);
        }

        return 0;
    }

    /**
     * Clear all managers.
     */
    private function clearAllManagers()
    {
        array_map(function (ObjectManager $manager) {
            $manager->clear();
        }, $this->doctrine->getManagers());
    }
}
