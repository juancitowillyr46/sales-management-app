<?php


namespace App\Core\Movements\Infrastructure\Persistence;


use App\Core\Movements\Domain\MovementEntity;
use App\Core\Movements\Domain\MovementRepositoryInterface;

class MovementRepository implements MovementRepositoryInterface
{

    public function addMovement(MovementEntity $product): bool
    {
        return true;
    }
}