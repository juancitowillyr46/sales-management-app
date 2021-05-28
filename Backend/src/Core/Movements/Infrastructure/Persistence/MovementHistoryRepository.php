<?php


namespace App\Core\Movements\Infrastructure\Persistence;


use App\Core\Movements\Domain\MovementHistoryRepositoryInterface;

class MovementHistoryRepository implements MovementHistoryRepositoryInterface
{

    public function getMovementHistoryByProductId(string $uuid): array
    {
        $movementHistory = [
            'dateIssue' => '2021-05-27',
            'concept' => 'SALE',
            'quantity' => 1,
            'unitPrice' => 15.50,
            'totalPrice' => 31.00
        ];

        return [$movementHistory];
    }
}