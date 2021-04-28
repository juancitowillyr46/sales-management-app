<?php


namespace App\Core\Products\Infrastructure\Controller\Slim;


use Psr\Http\Message\ResponseInterface as Response;

class AllProductsManagerAction extends ProductManagerAction
{
    protected function action(): Response
    {
        $products = $this->productManagerUseCase->getProducts([]);

        return $this->respondWithData($products, 200);
    }
}