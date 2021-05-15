<?php


namespace App\Core\Products\Infrastructure\Controller\Slim\Abstracts;


use App\Core\Products\Application\Request\ProductRequest;
use App\Core\Products\Application\UseCase\ProductUseCaseInterface;
use App\Shared\Application\Slim\Action\Action;
use Psr\Log\LoggerInterface;

abstract class ProductActionAbstract extends Action
{
    protected ProductUseCaseInterface $productUseCase;
    protected LoggerInterface $logger;
    protected ProductRequest $productRequest;

    public function __construct(LoggerInterface $logger, ProductUseCaseInterface $productUseCase)
    {
        $this->productUseCase = $productUseCase;
        parent::__construct($logger);
    }
}