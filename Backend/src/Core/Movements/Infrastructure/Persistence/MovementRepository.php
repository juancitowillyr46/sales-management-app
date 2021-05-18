<?php


namespace App\Core\Movements\Infrastructure\Persistence;


use App\Core\Movements\Domain\MovementDetailEntity;
use App\Core\Movements\Domain\MovementEntity;
use App\Core\Movements\Domain\MovementRepositoryInterface;
use App\Product;

class MovementRepository implements MovementRepositoryInterface
{
    protected MovementModel $movementModel;
    protected MovementEntity $movementEntity;

    public function __construct()
    {
        $this->movementModel = new MovementModel();
        $this->movementEntity = new MovementEntity();
    }

    public function addMovement(MovementEntity $movement): int
    {
        $movementObject = $this->movementModel::create($movement->transformEntityToModel($movement));
        return $movementObject->id;
    }

    public function validateDocumentNum(string $documentNum): bool {
        $count = $this->movementModel::where("document_num", "=", $documentNum)->first();
        return !is_null($count);
    }

    public function addMovementDetail(MovementDetailEntity $movementDetail): bool
    {
        return true;
    }

}