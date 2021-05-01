<?php


namespace App\Core\Products\Domain\Service;


use App\Core\Products\Application\Dto\ProductDto;
use App\Core\Products\Application\Request\ProductRequest;

interface ProductServiceInterface
{
    public function addProduct(ProductRequest $productRequest): bool;
    public function updateProductByUuid(string $uuid, ProductRequest $productRequest): bool;
    public function findProductByUuid(string $uuid): ProductDto;
    public function deleteProductByUuid(string $uuid): bool;
    public function findProducts(array $queries): array;

    public function validateExistProductByName(string $name): bool;
    public function getIdByUuidProduct(string $productCode): void;
}