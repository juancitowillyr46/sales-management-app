<?php


namespace App\Core\Products\Domain\Exception;


use Exception;
use Throwable;

class ProductValidateRequestException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct(json_encode($message), 003, $previous);
    }
}