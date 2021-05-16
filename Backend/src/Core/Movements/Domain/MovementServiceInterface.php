<?php


namespace App\Core\Movements\Domain;


use App\Core\Movements\Application\MovementRequest;

interface MovementServiceInterface
{
    public function addMovement(MovementRequest $productRequest): bool;
}