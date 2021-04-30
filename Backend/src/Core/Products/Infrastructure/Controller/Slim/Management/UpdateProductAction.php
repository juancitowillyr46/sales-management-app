<?php


namespace App\Core\Products\Infrastructure\Controller\Slim\Management;


use App\Core\Products\Application\Request\ProductRequest;
use App\Core\Products\Infrastructure\Controller\Slim\Abstracts\ProductManagementActionAbstract;
use Psr\Http\Message\ResponseInterface as Response;
use stdClass;

class UpdateProductAction extends ProductManagementActionAbstract
{

    protected function action(): Response
    {
        $this->productRequest = new ProductRequest($this->request->getBody());
        $productCode = $this->resolveArg('productCode');
        $this->productManagerUseCase->editProductByCode($productCode, $this->productRequest);

        return $this->respondWithData(new StdClass(), 200);
    }
}