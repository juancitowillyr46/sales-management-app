<?php


namespace App\Core\Products\Infrastructure\Persistence\Repository\Eloquent;


use App\Core\Products\Domain\Entity\Product;
use App\Core\Products\Domain\Entity\ProductPaginateParams;
use App\Core\Products\Domain\Entity\ProductPaginateResponse;
use App\Core\Products\Domain\Exception\ProductNotFoundException;
use App\Core\Products\Domain\Repository\ProductRepositoryInterface;


class ProductRepository implements ProductRepositoryInterface
{
    protected ProductModel $productModel;
    protected Product $product;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->product = new Product();
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
        return $this->product->transformModelToEntity($productModel);
    }

    public function deleteProductById(int $id): bool
    {
        $productModel = $this->productModel::find($id);
        return ($productModel->delete());
    }

    public function findProducts(ProductPaginateParams $queries): ProductPaginateResponse
    {

        $lstProducts = [];
        $lst = $this->productModel::all()->sortByDesc('id')
            ->skip(($queries->getSize() - 1) * $queries->getSize())
            ->take( $queries->getPage())
            ->toArray();

        foreach ($lst as $item) {
            $lstProducts[] = $this->product->transformModelToEntity((object)$item);
        }

        $paginate = new ProductPaginateResponse();
        $paginate->setRows(array_values($lstProducts));
        $paginate->setTotalRows($this->productModel::all()->count());
        $paginate->setTotalPages(ceil($this->productModel::all()->count()/$queries->getSize()));
        $paginate->setCurrentPage($queries->getPage());

        return $paginate;
    }

    public function findProductByUuid(string $uuid): Product
    {
        $productModel = $this->productModel::where("uuid", "=", $uuid)->first();
        if(is_null($productModel)) {
            throw new ProductNotFoundException();
        }
        return $this->product->transformModelToEntity((object)$productModel);
    }
}