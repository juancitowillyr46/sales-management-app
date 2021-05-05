<?php


namespace App\Core\Products\Domain\Exception;


use App\Shared\Domain\DomainException\DomainRecordNotFoundException;

class MeasureNotFoundException extends DomainRecordNotFoundException
{
    protected $message = "MEASURE NOT FOUND";
}