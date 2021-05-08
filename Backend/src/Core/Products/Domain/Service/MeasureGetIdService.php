<?php


namespace App\Core\Products\Domain\Service;


use App\Core\Products\Domain\Exception\ProductNotFoundException;

class MeasureGetIdService extends ResourceGetIdService
{
    public function getIdByUuid(string $uuid): int
    {
        if($uuid != "cad2a220-d411-4c07-8056-c027b2be6d6e") {
            throw new ProductNotFoundException();
        }
        return 1;
    }
}