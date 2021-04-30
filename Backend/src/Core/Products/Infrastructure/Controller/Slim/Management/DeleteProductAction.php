<?php


namespace App\Core\Products\Infrastructure\Controller\Slim\Management;


use App\Core\Products\Infrastructure\Controller\Slim\Abstracts\ProductManagementActionAbstract;
use Psr\Http\Message\ResponseInterface as Response;
use stdClass;

class DeleteProductAction extends ProductManagementActionAbstract
{

    /**
     * @OA\Delete (
     *   tags={"Product"},
     *   path="/products",
     *   operationId="deleteProducts",
     *   @OA\Response(
     *     response=200,
     *     description="Delete products"
     *   )
     * )
     */
    protected function action(): Response
    {
        $productCode = $this->resolveArg('productCode');

        $this->productManagerUseCase->removeProductByCode($productCode);

        return $this->respondWithData(new StdClass(), 200);
    }
}