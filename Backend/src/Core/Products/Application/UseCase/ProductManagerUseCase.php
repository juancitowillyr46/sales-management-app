<?php
namespace App\Core\Products\Application\UseCase;

use App\Core\Products\Application\Dto\ProductDto;
use App\Core\Products\Application\Request\ProductRequest;
use App\Core\Products\Domain\Service\IProductManagerService;

class ProductManagerUseCase implements IProductManagerUseCase
{
    private IProductManagerService $productManagerService;

    public function  __construct(IProductManagerService $productManagerServiceLogic)
    {
        $this->productManagerService = $productManagerServiceLogic;
    }

    public function saveProduct(ProductRequest $productRequest): void
    {
        $this->productManagerService->saveProduct($productRequest);
    }

    public function editProductByCode(string $productCode, ProductRequest $productRequest): void
    {
        $this->productManagerService->editProductByCode($productCode, $productRequest);
    }

    public function getProductByCode(string $productCode): ProductDto
    {
        return $this->productManagerService->getProductByCode($productCode);
    }

    public function removeProductByCode(string $productCode): bool
    {
        return $this->productManagerService->removeProductByCode($productCode);
    }

    public function getProducts(array $queries): array
    {
        return $this->productManagerService->getProducts($queries);
    }

}