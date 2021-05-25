<?php


namespace App\Core\Products\Domain\Service;


use App\Core\Products\Application\Dto\ProductDto;
use App\Core\Products\Application\Request\ProductRequest;
use App\Core\Products\Domain\Entity\Product;
use App\Core\Products\Domain\Entity\ProductPaginateParams;
use App\Core\Products\Domain\Entity\ProductPaginateResponse;
use App\Shared\Helpers\PaginateParams;

interface ProductServiceInterface
{
    public function addProduct(ProductRequest $productRequest): bool;
    public function updateProductByUuid(string $uuid, ProductRequest $productRequest): bool;
    public function findProductByUuid(string $uuid): ProductDto;
    public function deleteProductByUuid(string $uuid): bool;
    public function findProducts(ProductPaginateParams $queries): ProductPaginateResponse;
    public function findProductSelectIdByUid(string $uuid): Product;
}