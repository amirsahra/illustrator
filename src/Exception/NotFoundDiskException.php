<?php

namespace Amirsahra\Illustrator\Exception;

use Exception;

class NotFoundDiskException extends Exception
{
    protected $message = 'The selected disk was not found, The selected disk must be supported.';
}