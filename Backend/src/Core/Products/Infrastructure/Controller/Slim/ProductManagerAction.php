<?php


namespace App\Core\Products\Infrastructure\Controller\Slim;


use App\Core\Products\Application\Request\ProductRequest;
use App\Core\Products\Application\UseCase\IProductManagerUseCase;
use App\Shared\Application\Slim\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

abstract class ProductManagerAction extends Action
{
    protected IProductManagerUseCase $productManagerUseCase;
    protected LoggerInterface $logger;
    protected ProductRequest $productRequest;

    public function __construct(LoggerInterface $logger, IProductManagerUseCase $productManagerUseCase)
    {

        $this->productManagerUseCase = $productManagerUseCase;
        parent::__construct($logger);
    }
}