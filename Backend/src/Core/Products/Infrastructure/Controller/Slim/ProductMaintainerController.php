<?php
namespace App\Core\Products\Infrastructure\Controller\Slim;

use App\Core\Products\Application\Request\ProductRequest;
use App\Core\Products\Application\UseCase\IProductManagerUseCase;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class ProductMaintainerController
{
    private IProductManagerUseCase $productManagerUseCase;

    public function __construct(IProductManagerUseCase $productManagerUseCase)
    {
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
        $productCode = $request->getQueryParams()[0];
        $this->productManagerUseCase->getProductByCode($productCode);
        return $response->withStatus(200);
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
}