<?php

namespace App\Core\Products\Domain\Exception;


use Exception;
use Throwable;

class ProductNotFoundException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct("PRODUCT NOT FOUND", 001, $previous);
    }
}