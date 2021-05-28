<?php


namespace App\Core\Movements\Domain;


interface MovementHistoryRepositoryInterface
{
    public function getMovementHistoryByProductId(string $uuid): array;
}