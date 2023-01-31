<?php

namespace Amirsahra\Illustrator\Facade;

use Amirsahra\Illustrator\Core\Traits\DirCreator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Facade;

/**
 * Class Illustrator
 *
 * @method static upload(UploadedFile $imageInputRequest)
 * @method static update(UploadedFile $imageInputRequest, string $imagePath)
 * @method static setDir(string $directory)
 * @method static setName(string $name)
 * @method static setDisk(string $diskName)
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