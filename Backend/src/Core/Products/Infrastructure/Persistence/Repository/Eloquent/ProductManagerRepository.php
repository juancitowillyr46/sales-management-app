<?php
namespace App\Core\Products\Infrastructure\Persistence\Repository\Eloquent;

use App\Core\Products\Domain\Entity\Product;
use App\Core\Products\Domain\Repository\IProductManagerRepository;

class ProductManagerRepository implements IProductManagerRepository
{
    //private $model;

    public function __construct()
    {
        //$this->model = $model;
    }

    public function saveProduct(Product $product): bool
    {
        return true;
    }

    public function editProductById(int $id, Product $product): bool
    {
        return true;
    }

    public function getProductById(int $id): Product
    {
        $product = new Product();
        $product->setUuid('c7b659f7-9032-4f14-a19a-54c4a75cb66f');
        $product->setName('Product');
        $product->setImage('dsdsds');
        $product->setPrice(150.00);
        $product->setCategory(1);
        $product->setDescription('Lorem Ipsum is simply dummy text of the printing and typesetting industry');
        $product->setSkuCode('1515151515151515151');
        $product->setCost(200.00);
        $product->setUnitOfMeasurement(1);
        $product->setFeatured(true);
        $product->setPromotionPrice(0.00);

        return $product;
    }

    public function removeProductById(int $id): bool
    {
        return true;
    }

    public function getProducts(array $queries): array
    {
        $product = new Product();
        $product->setUuid('12312312312');
        $product->setName('Product');
        $product->setPrice(150.00);
        $product->setCategory(1);
        $product->setDescription('Lorem Ipsum is simply dummy text of the printing and typesetting industry');
        $product->setSkuCode('1515151515151515151');
        $product->setCost(200.00);
        $product->setUnitOfMeasurement(1);
        $product->setFeatured(true);
        $product->setPromotionPrice(0.00);

        return [
            $product,
            $product,
            $product,
            $product,
            $product,
            $product
        ];
    }
}