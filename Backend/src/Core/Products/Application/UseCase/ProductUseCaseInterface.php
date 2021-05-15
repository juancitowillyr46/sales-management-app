<?php


namespace App\Core\Products\Application\UseCase;


use App\Core\Products\Application\Dto\ProductDto;
use App\Core\Products\Application\Request\ProductRequest;
use App\Core\Products\Domain\Entity\ProductPaginateParams;
use App\Core\Products\Domain\Entity\ProductPaginateResponse;

interface ProductUseCaseInterface
{
    public function addProduct(ProductRequest $productRequest): void;
    public function updateProductByUuid(string $uuid, ProductRequest $productRequest): void;
    public function findProductByUuid(string $uuid): ProductDto;
    public function deleteProductByUuid(string $uuid): bool;
    public function findProducts(ProductPaginateParams $queries): ProductPaginateResponse;
}