<?php
namespace App\Core\Products\Infrastructure\Controller\Slim;

use App\Core\Products\Application\Request\ProductRequest;
use App\Core\Products\Application\UseCase\IProductManagerUseCase;
use App\Shared\Application\Slim\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;


class ProductMaintainerController extends Action
{
    private IProductManagerUseCase $productManagerUseCase;
    protected LoggerInterface $logger;
    public function __construct(LoggerInterface $logger, IProductManagerUseCase $productManagerUseCase)
    {
        parent::__construct($logger);
        $this->logger = $logger;
        $this->productManagerUseCase = $productManagerUseCase;
    }

    public function saveProduct(Request $request, Response $response, $args) {
        $productRequest = new ProductRequest($request->getBody());
        $this->productManagerUseCase->saveProduct($productRequest);
        return $response->withStatus(201);
    }

    public function editProductByCode(Request $request, Response $response, $args) {
        $productRequest = new ProductRequest($request->getBody());
        $this->productManagerUseCase->editProductByCode($args['productCode'], $productRequest);
        return $response->withStatus(201);
    }

    public function getProductByCode(Request $request, Response $response, $args) {
        $productCode = "c7b659f7-9032-4f14-a19a-54c4a75cb66f";
        //$request->getQueryParams()[0];
        $productDto = $this->productManagerUseCase->getProductByCode($productCode);
        $this->respondWithData($productDto);
            //$response->withStatus(200);
    }

    public function removeProductByCode(Request $request, Response $response, $args) {
        $productCode = $request->getQueryParams()[0];
        $this->productManagerUseCase->removeProductByCode($productCode);
        return $response->withStatus(200);
    }

    public function getProducts(Request $request, Response $response, $args) {
        $this->productManagerUseCase->getProducts([]);
        return $response->withStatus(200);
    }

    protected function action(): Response
    {
        // TODO: Implement action() method.
        return $this->respondWithData([]);
    }
}