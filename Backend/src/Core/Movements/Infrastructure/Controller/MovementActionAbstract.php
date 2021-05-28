<?php


namespace App\Core\Movements\Infrastructure\Controller;


use App\Core\Movements\Application\MovementHistoryUseCaseInterface;
use App\Core\Movements\Application\MovementRequest;
use App\Core\Movements\Application\MovementUseCaseInterface;
use App\Shared\Application\Slim\Action\Action;
use Psr\Log\LoggerInterface;

abstract class MovementActionAbstract extends Action
{
    protected MovementUseCaseInterface $movementUseCase;
    protected MovementHistoryUseCaseInterface $movementHistoryUseCase;
    protected LoggerInterface $logger;
    protected MovementRequest $movementRequest;

    public function __construct(LoggerInterface $logger, MovementUseCaseInterface $movementRequest, MovementHistoryUseCaseInterface $movementHistoryUseCase)
    {
        $this->movementUseCase = $movementRequest;
        $this->movementHistoryUseCase = $movementHistoryUseCase;
        parent::__construct($logger);
    }
}