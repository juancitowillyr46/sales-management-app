<?php

namespace App\Core\Products\Domain\Service;

use App\Core\Products\Application\Dto\ProductDto;
use App\Core\Products\Application\Request\ProductRequest;
use App\Core\Products\Domain\Entity\Product;

interface IProductManagerService
{
    public function saveProduct(ProductRequest $productRequest): bool;
    public function editProductByCode(string $productCode, ProductRequest $productRequest): bool;
    public function getProductByCode(string $productCode): ProductDto;
    public function removeProductByCode(string $productCode): bool;
    public function getProducts(array $queries): array;

    public function validateExistProductByName(string $name): bool;
    public function getIdByCodeProduct(string $productCode): void;
}