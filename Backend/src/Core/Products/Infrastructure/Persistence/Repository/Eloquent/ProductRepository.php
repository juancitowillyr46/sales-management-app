<?php


namespace App\Core\Products\Infrastructure\Persistence\Repository\Eloquent;


use App\Core\Products\Domain\Entity\Product;
use App\Core\Products\Domain\Repository\ProductRepositoryInterface;


class ProductRepository implements ProductRepositoryInterface
{

    protected ProductModel $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function addProduct(Product $product): bool
    {
        $productObject = $this->productModel::create($product->transformEntityToModel($product));
        return ($productObject->id > 0);
    }

    public function editProductById(int $id, Product $product): bool
    {
        $productObject = $this->productModel::find($id);
        $productObject->update($product->transformEntityToModel($product));
        return ($productObject->id > 0);
    }

    public function findProductById(int $id): Product
    {

        $productModel = $this->productModel::find($id);

        $product = new Product();
        $product->setName($productModel->name);
        $product->setSkuCode($productModel->sku_code);
        $product->setDescription($productModel->description);
        $product->setImage($productModel->image);
        $product->setPrice($productModel->price);
        $product->setCost($productModel->cost);
        $product->setCategoryId($productModel->category_id);
        $product->setMeasureId($productModel->measure_id);
        $product->setPresentation($productModel->presentation);
        $product->setStock($productModel->stock);
        $product->setFeatured($productModel->featured);
        $product->setStateId($productModel->state_id);

        return $product;
    }

    public function findProductByIdList(object $productModel): Product
    {
        $product = new Product();
        $product->setName($productModel->name);
        $product->setSkuCode($productModel->sku_code);
        $product->setDescription($productModel->description);
        $product->setImage($productModel->image);
        $product->setPrice($productModel->price);
        $product->setCost($productModel->cost);
        $product->setCategoryId($productModel->category_id);
        $product->setMeasureId($productModel->measure_id);
        $product->setPresentation($productModel->presentation);
        $product->setStock($productModel->stock);
        $product->setFeatured($productModel->featured);
        $product->setStateId($productModel->state_id);

        return $product;
    }

    public function deleteProductById(int $id): bool
    {
        $productModel = $this->productModel::find($id);
        return ($productModel->delete());
    }

    public function findProducts(array $queries): array
    {
        $lstProducts = [];
        $lst = $this->productModel::all()->toArray();
        foreach ($lst as $item) {
            $lstProducts[] = $this->findProductByIdList((object)$item);
        }
        return $lstProducts;
    }
}