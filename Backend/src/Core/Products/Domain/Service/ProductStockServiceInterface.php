<?php


namespace App\Core\Products\Domain\Service;


interface ProductStockServiceInterface
{
    public function updateStock(string $uuid, int $stock): bool;

    public function currentStock(string $uuid): int;
}