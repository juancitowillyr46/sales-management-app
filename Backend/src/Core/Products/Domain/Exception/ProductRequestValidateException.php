<?php


namespace App\Core\Products\Domain\Exception;


use App\Shared\Domain\DomainException\DomainRecordNotFoundException;
use Throwable;

class ProductRequestValidateException extends DomainRecordNotFoundException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}