<?php


namespace App\Core\Movements\Application;


interface MovementHistoryUseCaseInterface
{
    public function getMovementHistoryByProductId(string $uuid): array;
}