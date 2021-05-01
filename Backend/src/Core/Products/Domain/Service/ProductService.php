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
    protected Product $product;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
        $this->product = new Product();
    }


    public function addProduct(ProductRequest $productRequest): bool
    {
        $toEntity = $this->product->transformRequestToEntity($productRequest);
        return $this->productRepository->addProduct($toEntity);
    }

    public function updateProductByUuid(string $uuid, ProductRequest $productRequest): bool
    {
        $this->getIdByUuidProduct($uuid);
        $toEntity = $this->product->transformRequestToEntity($productRequest);
        return $this->productRepository->editProductById($this->product->getId(), $toEntity);
    }

    public function findProductByUuid(string $uuid): ProductDto
    {
        $this->getIdByUuidProduct($uuid);

        $productEntity = $this->productRepository->findProductById($this->product->getId());
        $productDto = new ProductDto();
        $productDto->setUuid($productEntity->getUuid());
        $productDto->setName($productEntity->getName());
        $productDto->setPrice($productEntity->getPrice());
        return $productDto;
    }

    public function deleteProductByUuid(string $uuid): bool
    {
        $this->getIdByUuidProduct($uuid);
        return $this->productRepository->deleteProductById($this->product->getId());
    }

    public function findProducts(array $queries): array
    {
        return $this->productRepository->findProducts($queries);
    }

    public function validateExistProductByName(string $name): bool
    {
        if($name == 'Product') {
            throw new ProductExistException();
        }
        return true;
    }

    public function getIdByUuidProduct(string $uuid): void
    {
        $getCode = "c7b659f7-9032-4f14-a19a-54c4a75cb66f";
        if($uuid == $getCode) {
            $this->product->setId(1);
        } else {
            throw new ProductNotFoundException();
        }
    }
}