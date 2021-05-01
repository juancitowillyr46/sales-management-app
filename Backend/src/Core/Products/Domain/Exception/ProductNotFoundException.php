<?php

namespace App\Core\Products\Domain\Exception;


use App\Shared\Domain\DomainException\DomainRecordNotFoundException;
use Exception;
use Throwable;

class ProductNotFoundException extends DomainRecordNotFoundException
{
    protected $message = "PRODUCT NOT FOUNDx";
}