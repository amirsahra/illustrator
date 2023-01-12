<?php

namespace Amirsahra\Illustrator\Core\Enums;

/**
 * We use this class as an enum to name all types of disks.
 * Types of disks that can be supported.
 */
abstract class Disks
{
    const PUBLIC = 'public';
    const LOCAL = 'local';
    const S3 = 's3';

    /**
     * In order to have the values together,
     * we return them as an array with this method.
     *
     * @return string[]
     */
    public static function list()
    {
        return array(
            self::PUBLIC,
            self::LOCAL,
            self::S3
        );
    }
}