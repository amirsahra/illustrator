<?php

namespace Amirsahra\Illustrator\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class Illustrator
 *
 * @method static string test()
 *
 * @package Amirsahra\Illustrator\Facade
 * @see \Amirsahra\Illustrator\
 */
class Illustrator extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Illustrator';
    }
}