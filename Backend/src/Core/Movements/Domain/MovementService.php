<?php


namespace App\Core\Movements\Domain;


use App\Core\Movements\Application\MovementRequest;

class MovementService implements MovementServiceInterface
{
    protected MovementRepositoryInterface $movementRepository;
    protected MovementEntity $movementEntity;

    public function __construct(MovementRepositoryInterface $movementRepository)
    {
        $this->movementRepository = $movementRepository;
        $this->movementEntity = new MovementEntity();
    }

    public function addMovement(MovementRequest $productRequest): bool
    {
        $toEntity = $this->movementEntity->transformRequestToEntity($productRequest);
        return $this->movementRepository->addMovement($toEntity);
    }
}