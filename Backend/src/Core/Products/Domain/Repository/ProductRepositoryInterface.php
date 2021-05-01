<?php


namespace App\Core\Products\Domain\Repository;



use App\Core\Products\Domain\Entity\Product;

interface ProductRepositoryInterface
{
    public function addProduct(Product $product): bool;
    public function editProductById(int $id, Product $product): bool;
    public function findProductById(int $id): Product;
    public function deleteProductById(int $id): bool;
    public function findProducts(array $queries): array;
}