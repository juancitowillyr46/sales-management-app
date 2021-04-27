<?php


namespace App\Core\Products\Domain\Exception;


use Exception;
use Throwable;

class ProductExistException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct("THE PRODUCT ALREADY EXISTS", 002, $previous);
    }
}