<?php


namespace App\Core\Movements\Application;


use App\Core\Movements\Domain\MovementHistoryService;

class MovementHistoryUseCase implements MovementHistoryUseCaseInterface
{
    protected MovementHistoryService $movementHistoryService;

    public function __construct(MovementHistoryService $movementHistoryService)
    {
        $this->movementHistoryService  = $movementHistoryService;
    }

    public function getMovementHistoryByProductId(string $uuid): array
    {
        return $this->movementHistoryService->getMovementHistoryByProductId($uuid);
    }
}