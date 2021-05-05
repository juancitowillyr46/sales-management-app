<?php


namespace App\Core\Products\Domain\Exception;


use App\Shared\Domain\DomainException\DomainRecordNotFoundException;
use Throwable;

class ProductRequestValidateException  extends DomainRecordNotFoundException
{
    protected $message = "Existen campos requeridos";
}