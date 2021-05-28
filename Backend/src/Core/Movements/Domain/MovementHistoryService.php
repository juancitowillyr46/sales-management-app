<?php


namespace App\Core\Movements\Domain;


class MovementHistoryService implements MovementHistoryServiceInterface
{
    protected MovementHistoryRepositoryInterface $movementHistoryRepository;

    public function __construct(MovementHistoryRepositoryInterface $movementHistoryRepository)
    {
        $this->movementHistoryRepository = $movementHistoryRepository;
    }

    public function getMovementHistoryByProductId(string $uuid): array
    {
        return $this->movementHistoryRepository->getMovementHistoryByProductId($uuid);
    }
}