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

namespace Elcodi\Component\Geo\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class CityExists.
 *
 * @Annotation
 */
class CityExists extends Constraint
{
    /**
     * @var string
     *
     * Constraint message
     */
    public $message = 'The city does not exist.';

    /**
     * Returns the name of the class that validates this constraint.
     *
     * @return string
     */
    public function validatedBy()
    {
        return 'city_exists';
    }
}
