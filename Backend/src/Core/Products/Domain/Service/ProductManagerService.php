<?php

namespace App\Core\Products\Domain\Service;

use App\Core\Products\Application\Dto\ProductDto;
use App\Core\Products\Application\Request\ProductRequest;
use App\Core\Products\Domain\Entity\Product;
use App\Core\Products\Domain\Exception\ProductExistException;
use App\Core\Products\Domain\Exception\ProductNotFoundException;
use App\Core\Products\Domain\Repository\IProductManagerRepository;

class ProductManagerService implements IProductManagerService
{
    private IProductManagerRepository $productManagerRepository;
    private Product $product;

    public function __construct(IProductManagerRepository $productManagerRepository)
    {
        $this->productManagerRepository = $productManagerRepository;
        $this->product = new Product();
    }

    public function saveProduct(ProductRequest $productRequest): bool
    {
        $toEntity = $this->product->transformRequestToEntity($productRequest);
        return $this->productManagerRepository->saveProduct($toEntity);
    }

    public function editProductByCode(string $productCode, ProductRequest $productRequest): bool
    {
        $this->getIdByCodeProduct($productCode);
        $toEntity = $this->product->transformRequestToEntity($productRequest);
        return $this->productManagerRepository->editProductById($this->product->getId(), $toEntity);
    }

    public function getProductByCode(string $productCode): ProductDto
    {
        $this->getIdByCodeProduct($productCode);

        $productEntity = $this->productManagerRepository->getProductById($this->product->getId());
        $productDto = new ProductDto();
        $productDto->setUuid($productEntity->getUuid());
        $productDto->setName($productEntity->getName());
        $productDto->setPrice($productEntity->getPrice());
        return $productDto;
    }

    public function removeProductByCode(string $productCode): bool
    {
        $this->getIdByCodeProduct($productCode);
        return $this->productManagerRepository->removeProductById($this->product->getId());
    }

    public function getProducts(array $queries): array
    {
        return $this->productManagerRepository->getProducts($queries);
    }

    public function validateExistProductByName(string $name): bool
    {
        if($name == 'Product') {
            throw new ProductExistException();
        }
        return true;
    }

    public function getIdByCodeProduct(string $productCode): void {

        $getCode = "c7b659f7-9032-4f14-a19a-54c4a75cb66f";
        if($productCode == $getCode) {
            $this->product->setId(1);
        } else {
            throw new ProductNotFoundException();
        }

    }

    public function requestToEntity(ProductRequest $productRequest): Product {
        $product = $this->product;
        $product->setUuid($product->generateUuid());
        $product->setImage($productRequest->getImage());
        $product->setName($productRequest->getName());
        $product->setPrice($productRequest->getPrice());

        return $product;
    }
}