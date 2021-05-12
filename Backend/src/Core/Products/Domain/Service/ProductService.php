<?php


namespace App\Core\Products\Domain\Service;


use App\Core\Products\Application\Dto\ProductDto;
use App\Core\Products\Application\Request\ProductRequest;
use App\Core\Products\Domain\Entity\Product;
use App\Core\Products\Domain\Exception\ProductExistException;
use App\Core\Products\Domain\Exception\ProductNotFoundException;
use App\Core\Products\Domain\Repository\ProductRepositoryInterface;

class ProductService implements ProductServiceInterface
{

    protected ProductRepositoryInterface $productRepository;
    protected ResourceServiceInterface $categoryGetIdService;
    protected ResourceServiceInterface $measureGetIdService;
    protected Product $product;

    public function __construct(ProductRepositoryInterface $productRepository, ResourceServiceInterface $categoryGetIdService, ResourceServiceInterface $measureGetIdService)
    {
        $this->productRepository = $productRepository;
        $this->categoryGetIdService = $categoryGetIdService;
        $this->measureGetIdService = $measureGetIdService;
        $this->product = new Product();
    }


    public function addProduct(ProductRequest $productRequest): bool
    {
        $categoryId = $this->categoryGetIdService->getIdByUuid($productRequest->getCategoryId());
        $measureId = $this->measureGetIdService->getIdByUuid($productRequest->getMeasureId());

        $toEntity = $this->product->transformRequestToEntity($productRequest);
        $toEntity->setCategoryId($categoryId);
        $toEntity->setMeasureId($measureId);

        return $this->productRepository->addProduct($toEntity);
    }

    public function updateProductByUuid(string $uuid, ProductRequest $productRequest): bool
    {
        $this->findProductByUuid($uuid);
        $categoryId = $this->categoryGetIdService->getIdByUuid($productRequest->getCategoryId());
        $measureId = $this->measureGetIdService->getIdByUuid($productRequest->getMeasureId());

        $toEntity = $this->product->transformRequestToEntity($productRequest);
        $toEntity->setCategoryId($categoryId);
        $toEntity->setMeasureId($measureId);
        $toEntity->setUuid($uuid);

        return $this->productRepository->editProductById($this->product->getId(), $toEntity);
    }

    public function findProductByUuid(string $uuid): ProductDto
    {
        $product = $this->productRepository->findProductByUuid($uuid);

        $this->product = $product;

        $productDto = new ProductDto();
        $productDto->setUuid($this->product->getUuid());
        $productDto->setName($this->product->getName());
        $productDto->setPrice($this->product->getPrice());
        $productDto->setImage($this->product->getImage());

        return $productDto;
    }

    public function deleteProductByUuid(string $uuid): bool
    {
        $this->findProductByUuid($uuid);
        return $this->productRepository->deleteProductById($this->product->getId());
    }

    public function findProducts(array $queries): array
    {
        return $this->productRepository->findProducts($queries);
    }

}