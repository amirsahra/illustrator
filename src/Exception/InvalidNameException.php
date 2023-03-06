<?php

namespace Amirsahra\Illustrator\Exception;

use Exception;

class InvalidNameException extends Exception
{
    protected $message = 'An image with this name exists in the selected directory. Enter a different name for the image';
}