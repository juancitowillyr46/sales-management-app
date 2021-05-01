<?php


namespace App\Core\Products\Infrastructure\Controller\Slim\Management;


use App\Core\Products\Infrastructure\Controller\Slim\Abstracts\ProductActionAbstract;
use Psr\Http\Message\ResponseInterface as Response;

class FindProductsAction extends ProductActionAbstract
{
    /**
     * @OA\Get(
     *   tags={"Product"},
     *   path="/products",
     *   operationId="findProducts",
     *   @OA\Response(
     *     response=200,
     *     description="Find products"
     *   )
     * )
     */
    protected function action(): Response
    {
        $products = $this->productUseCase->findProducts([]);

        return $this->respondWithData($products, 200);
    }
}