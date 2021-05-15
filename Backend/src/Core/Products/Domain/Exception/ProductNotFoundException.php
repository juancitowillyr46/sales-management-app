<?php

namespace App\Core\Products\Domain\Exception;


use App\Shared\Domain\DomainException\DomainRecordNotFoundException;

class ProductNotFoundException extends DomainRecordNotFoundException
{
    protected $message = "PRODUCT NOT FOUND";
}