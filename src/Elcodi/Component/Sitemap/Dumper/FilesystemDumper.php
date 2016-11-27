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

namespace Elcodi\Component\Sitemap\Dumper;

use Elcodi\Component\Sitemap\Dumper\Interfaces\SitemapDumperInterface;

/**
 * Class FilesystemDumper.
 */
class FilesystemDumper implements SitemapDumperInterface
{
    /**
     * Dumps a sitemap given a path.
     *
     * @param string $path    Path
     * @param string $sitemap Sitemap
     *
     * @return $this Self object
     */
    public function dump($path, $sitemap)
    {
        file_put_contents(
            $path,
            $sitemap
        );

        return $this;
    }
}
