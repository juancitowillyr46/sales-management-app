<?php


namespace App\Core\Products\Domain\Exception;


use App\Shared\Domain\DomainException\DomainRecordNotFoundException;
use Exception;
use Throwable;

class ProductCurrentStockException extends DomainRecordNotFoundException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct("NO STOCK", 002, $previous);
    }
}