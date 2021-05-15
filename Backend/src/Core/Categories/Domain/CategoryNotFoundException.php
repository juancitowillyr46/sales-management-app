<?php


namespace App\Core\Categories\Domain;


use App\Shared\Domain\DomainException\DomainRecordNotFoundException;

class CategoryNotFoundException extends DomainRecordNotFoundException
{
    protected $message = "CATEGORY NOT FOUND";
}