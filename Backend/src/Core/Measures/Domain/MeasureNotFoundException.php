<?php


namespace App\Core\Measures\Domain;


use App\Shared\Domain\DomainException\DomainRecordNotFoundException;

class MeasureNotFoundException extends DomainRecordNotFoundException
{
    protected $message = "MEASURE NOT FOUND";
}