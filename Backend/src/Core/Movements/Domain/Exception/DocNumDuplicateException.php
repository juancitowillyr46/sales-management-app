<?php


namespace App\Core\Movements\Domain\Exception;


use App\Shared\Domain\DomainException\DomainRecordNotFoundException;

class DocNumDuplicateException extends DomainRecordNotFoundException
{
    protected $message = "Repeated document number";
}