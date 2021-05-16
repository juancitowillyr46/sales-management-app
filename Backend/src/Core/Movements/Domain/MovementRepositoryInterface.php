<?php


namespace App\Core\Movements\Domain;


interface MovementRepositoryInterface
{
    public function addMovement(MovementEntity $product): bool;
//    public function editMovementById(int $id, MovementEntity $product): bool;
//    public function findMovementById(int $id): MovementEntity;
//    public function deleteProductById(int $id): bool;
//    public function findProducts(ProductPaginateParams $queries): ProductPaginateResponse;
//
//    public function findProductByUuid(string $uuid): Product;
}