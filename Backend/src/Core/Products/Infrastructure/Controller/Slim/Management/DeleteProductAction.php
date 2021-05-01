<?php


namespace App\Core\Products\Infrastructure\Controller\Slim\Management;


use App\Core\Products\Infrastructure\Controller\Slim\Abstracts\ProductActionAbstract;
use Psr\Http\Message\ResponseInterface as Response;
use stdClass;

class DeleteProductAction extends ProductActionAbstract
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
        $productCode = $this->resolveArg('uuid');

        $this->productUseCase->deleteProductByUuid($productCode);

        return $this->respondWithData(new StdClass(), 200);
    }
}