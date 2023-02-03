<?php

namespace Amirsahra\Illustrator\Exception;

use Exception;

class NotFoundConfigKeyException extends Exception
{
    protected $message = 'The required configuration was not found.';
}