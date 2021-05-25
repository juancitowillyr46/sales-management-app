<?php


namespace App\Core\Products\Domain\Service;


use App\Core\Products\Domain\Exception\ProductCurrentStockException;
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

    public function currentStock(string $uuid): int
    {
        $productStock = $this->productStockRepository->currentStock($uuid);
        if($productStock == 0) {
            throw new ProductCurrentStockException();
        }
        return $productStock;
    }
}