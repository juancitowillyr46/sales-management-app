<?php


namespace App\Core\Movements\Domain;


use App\Core\Movements\Application\MovementDetailRequest;
use App\Core\Movements\Application\MovementRequest;

interface MovementServiceInterface
{
    public function addMovement(MovementRequest $productRequest): bool;
    public function addMovementDetail(MovementRequest $movementEntity, int $movementId): bool;

    public function validateDocumentNum(MovementRequest $productRequest): bool;

}