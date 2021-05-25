<?php


namespace App\Core\Products\Infrastructure\Persistence\Repository\Eloquent;


use App\Core\Products\Domain\Repository\ProductStockRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ProductStockRepository implements ProductStockRepositoryInterface
{
    protected Model $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function updateStock(string $uuid, int $stock): bool
    {
        $productModel = $this->productModel::where("uuid", "=", $uuid)->first();
        $productModel->stock = $stock;
        return $productModel->save();
    }

    public function currentStock(string $uuid): int
    {
        $stockProduct = $this->productModel::where("uuid", "=", $uuid)->value('stock');
        return $stockProduct;
    }
}