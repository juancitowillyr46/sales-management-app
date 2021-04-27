<?php

namespace App\Core\Products\Domain\Repository;

use App\Core\Products\Domain\Entity\Product;

interface IProductManagerRepository
{
    public function saveProduct(Product $product): bool;
    public function editProductById(int $id, Product $product): bool;
    public function getProductById(int $id): Product;
    public function removeProductById(int $id): bool;
    public function getProducts(array $queries): array;
}