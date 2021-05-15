<?php


namespace App\Core\Products\Domain\Repository;



use App\Core\Products\Domain\Entity\Product;
use App\Core\Products\Domain\Entity\ProductPaginateParams;
use App\Core\Products\Domain\Entity\ProductPaginateResponse;

interface ProductRepositoryInterface
{
    public function addProduct(Product $product): bool;
    public function editProductById(int $id, Product $product): bool;
    public function findProductById(int $id): Product;
    public function deleteProductById(int $id): bool;
    public function findProducts(ProductPaginateParams $queries): ProductPaginateResponse;

    public function findProductByUuid(string $uuid): Product;
}