<?php


namespace App\Core\Products\Infrastructure\Controller\Slim\Management;


use App\Core\Products\Infrastructure\Controller\Slim\Abstracts\ProductManagementActionAbstract;
use Psr\Http\Message\ResponseInterface as Response;

class FindProductsAction extends ProductManagementActionAbstract
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
        $products = $this->productManagerUseCase->getProducts([]);

        return $this->respondWithData($products, 200);
    }
}