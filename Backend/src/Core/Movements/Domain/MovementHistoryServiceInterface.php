<?php


namespace App\Core\Movements\Domain;


interface MovementHistoryServiceInterface
{
    public function getMovementHistoryByProductId(string $uuid): array;
}