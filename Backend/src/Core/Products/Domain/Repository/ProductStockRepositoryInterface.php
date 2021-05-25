<?php


namespace App\Core\Products\Domain\Repository;


interface ProductStockRepositoryInterface
{
    public function updateStock(string $uuid, int $stock): bool;

    public function currentStock(string $uuid): int;
}