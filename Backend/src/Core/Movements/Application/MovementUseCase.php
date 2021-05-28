<?php


namespace App\Core\Movements\Application;


use App\Core\Movements\Domain\MovementServiceInterface;

class MovementUseCase implements MovementUseCaseInterface
{
    protected MovementServiceInterface $movementService;

    public function __construct(MovementServiceInterface $movementService)
    {
        $this->movementService = $movementService;
    }

    public function addMovement(MovementRequest $movementRequest): void
    {
        $this->movementService->validateProductStock($movementRequest);

        $this->movementService->addMovement($movementRequest);
    }
}