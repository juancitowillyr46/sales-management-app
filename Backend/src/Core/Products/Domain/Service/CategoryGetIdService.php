<?php


namespace App\Core\Products\Domain\Service;


use App\Core\Products\Domain\Exception\CategoryNotFoundException;
use App\Core\Products\Domain\Exception\MeasureNotFoundException;
use App\Core\Products\Domain\Exception\ProductNotFoundException;

class CategoryGetIdService extends ResourceGetIdService
{
    public function getIdByUuid(string $uuid): int
    {
        if($uuid != "b075dbf1-6d06-4915-9367-982b59769d82") {
            throw new MeasureNotFoundException();
        }
        return 1;
    }
}