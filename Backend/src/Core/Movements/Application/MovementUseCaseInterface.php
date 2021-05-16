<?php


namespace App\Core\Movements\Application;


interface MovementUseCaseInterface
{
    public function addMovement(MovementRequest $movementRequest): void;
}