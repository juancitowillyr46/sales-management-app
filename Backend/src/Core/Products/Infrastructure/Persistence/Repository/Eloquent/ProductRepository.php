<?php


namespace App\Core\Products\Infrastructure\Persistence\Repository\Eloquent;


use App\Core\Products\Domain\Entity\Product;
use App\Core\Products\Domain\Repository\ProductRepositoryInterface;


class ProductRepository implements ProductRepositoryInterface
{

    public function addProduct(Product $product): bool
    {
        $productModel = new ProductModel();
        $productObject = $productModel::create($product->transformEntityToModel($product));
        return ($productObject->id > 0);
    }

    public function editProductById(int $id, Product $product): bool
    {
        return true;
    }

    public function findProductById(int $id): Product
    {
        $product = new Product();
        $product->setUuid('c7b659f7-9032-4f14-a19a-54c4a75cb66f');
        $product->setName('dsds');
        $product->setPrice(150);
        return $product;
    }

    public function deleteProductById(int $id): bool
    {
        return true;
    }

    public function findProducts(array $queries): array
    {
        return [];
    }
}