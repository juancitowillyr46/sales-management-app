<?php


namespace App\Core\Products\Application\UseCase;


use App\Core\Products\Application\Dto\ProductDto;
use App\Core\Products\Application\Request\ProductRequest;
use App\Core\Products\Domain\Entity\ProductPaginateParams;
use App\Core\Products\Domain\Entity\ProductPaginateResponse;
use App\Core\Products\Domain\Service\ProductServiceInterface;


class ProductUseCase implements ProductUseCaseInterface
{
    protected ProductServiceInterface $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;

    }

    public function addProduct(ProductRequest $productRequest): void
    {
        $this->productService->addProduct($productRequest);
    }

    public function updateProductByUuid(string $uuid, ProductRequest $productRequest): void
    {
        $this->productService->updateProductByUuid($uuid, $productRequest);
    }

    public function findProductByUuid(string $uuid): ProductDto
    {
        return $this->productService->findProductByUuid($uuid);
    }

    public function deleteProductByUuid(string $uuid): bool
    {
        return $this->productService->deleteProductByUuid($uuid);
    }

    public function findProducts(ProductPaginateParams $queries): ProductPaginateResponse
    {
        return $this->productService->findProducts($queries);
    }
}