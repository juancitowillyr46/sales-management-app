<?php


namespace App\Core\Products\Domain\Service;


interface ResourceServiceInterface
{
    public function returnIdResource(string $uuid): int;
}