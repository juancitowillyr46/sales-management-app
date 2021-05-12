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
     *   path="/products/{id}",
     *   operationId="deleteProductById",
     *   @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id product",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *           @OA\Items(type="uuid"),
     *         ),
     *         style="form"
     *    ),
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