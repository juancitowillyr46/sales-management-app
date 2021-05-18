<?php


namespace App\Core\Movements\Domain;


interface MovementRepositoryInterface
{
    public function addMovement(MovementEntity $movement): int;
    public function addMovementDetail(MovementDetailEntity $movementDetail): bool;
    public function validateDocumentNum(string $documentNum): bool;
    //public function findMovementByUuid(string $uuid): MovementEntity;
}