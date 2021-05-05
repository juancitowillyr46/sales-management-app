<?php


namespace App\Core\Products\Domain\Service;


class ResourceGetIdService implements ResourceServiceInterface
{

    public function returnIdResource(string $uuid): int
    {
        return 1;
    }
}