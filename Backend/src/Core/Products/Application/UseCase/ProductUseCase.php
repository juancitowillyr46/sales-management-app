<?php


namespace App\Core\Products\Application\UseCase;


use App\Core\Products\Application\Dto\ProductDto;
use App\Core\Products\Application\Request\ProductRequest;
use App\Core\Products\Domain\Service\ProductServiceInterface;
use App\Core\Products\Domain\Service\ResourceServiceInterface;

class ProductUseCase implements ProductUseCaseInterface
{
    protected ProductServiceInterface $productService;
    protected ResourceServiceInterface $categoryGetIdService;
    protected ResourceServiceInterface $measureGetIdService;

    public function __construct(ProductServiceInterface $productService, ResourceServiceInterface $categoryGetIdService, ResourceServiceInterface $measureGetIdService)
    {
        $this->productService = $productService;
        $this->categoryGetIdService = $categoryGetIdService;
        $this->measureGetIdService = $measureGetIdService;
    }

    public function addProduct(ProductRequest $productRequest): void
    {

        $this->categoryGetIdService->returnIdResource($productRequest->getCategoryId());
        $this->measureGetIdService->returnIdResource($productRequest->getMeasureId());

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

    public function findProducts(array $queries): array
    {
        return $this->productService->findProducts($queries);
    }
}