<?php


namespace App\Core\Products\Domain\Service;


interface ResourceServiceInterface
{
    public function getIdByUuid(string $uuid): int;
}