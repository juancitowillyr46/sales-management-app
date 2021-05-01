<?php


namespace App\Core\Products\Application\UseCase;


use App\Core\Products\Application\Dto\ProductDto;
use App\Core\Products\Application\Request\ProductRequest;

interface ProductUseCaseInterface
{
    public function addProduct(ProductRequest $productRequest): void;
    public function updateProductByUuid(string $uuid, ProductRequest $productRequest): void;
    public function findProductByUuid(string $uuid): ProductDto;
    public function deleteProductByUuid(string $uuid): bool;
    public function findProducts(array $queries): array;
}