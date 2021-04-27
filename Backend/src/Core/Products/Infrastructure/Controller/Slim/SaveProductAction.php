<?php


namespace App\Core\Products\Infrastructure\Controller\Slim;


use App\Core\Products\Application\UseCase\IProductManagerUseCase;
use App\Shared\Application\Slim\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class SaveProductAction extends Action
{
    private IProductManagerUseCase $productManagerUseCase;
    protected LoggerInterface $logger;

    public function __construct(LoggerInterface $logger, IProductManagerUseCase $productManagerUseCase)
    {
        parent::__construct($logger);
        $this->logger = $logger;
        $this->productManagerUseCase = $productManagerUseCase;
    }

    protected function action(): Response
    {
        $productCode = "c7b659f7-9032-4f14-a19a-54c4a75cb66f";
        $productDto = $this->productManagerUseCase->getProductByCode($productCode);
        $this->logger->error('Ok');
        return $this->respondWithData($productDto);
    }
}