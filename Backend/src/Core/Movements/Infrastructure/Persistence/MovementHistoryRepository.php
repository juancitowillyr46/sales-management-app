<?php


namespace App\Core\Movements\Infrastructure\Persistence;


use App\Core\Movements\Domain\MovementHistoryRepositoryInterface;

class MovementHistoryRepository implements MovementHistoryRepositoryInterface
{

    public function getMovementHistoryByProductId(string $uuid): array
    {

        $data = MovementModel::select('movement.date_issue', 'movement.concept', 'movement_detail.quantity', 'movement_detail.unit_price', 'movement_detail.total_price')
            ->join('movement_detail', 'movement.id', '=', 'movement_detail.movement_id')
            ->join('product', 'product.id', '=', 'movement_detail.product_id')
            ->where('product.uuid', '=', $uuid)
            ->get();

        return $data;

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