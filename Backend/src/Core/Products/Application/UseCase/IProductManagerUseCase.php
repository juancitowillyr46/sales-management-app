<?php


namespace App\Core\Products\Application\UseCase;


use App\Core\Products\Application\Dto\ProductDto;
use App\Core\Products\Application\Request\ProductRequest;


interface IProductManagerUseCase
{
    public function saveProduct(ProductRequest $productRequest): void;
    public function editProductByCode(string $productCode, ProductRequest $productRequest): void;
    public function getProductByCode(string $productCode): ProductDto;
    public function removeProductByCode(string $uniqueCode): bool;
    public function getProducts(array $queries): array;
}