<?php


namespace App\Core\Products\Domain\Service;


use App\Core\Products\Domain\Repository\ProductStockRepositoryInterface;

class ProductStockService implements ProductStockServiceInterface
{
    protected ProductStockRepositoryInterface $productStockRepository;

    public function __construct(ProductStockRepositoryInterface $productStockRepository)
    {
        $this->productStockRepository = $productStockRepository;
    }

    public function updateStock(string $uuid, int $stock): bool
    {
        $this->productStockRepository->updateStock($uuid, $stock);

        return true;
    }
}