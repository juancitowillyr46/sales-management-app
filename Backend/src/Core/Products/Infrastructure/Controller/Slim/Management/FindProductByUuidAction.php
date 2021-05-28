<?php


namespace App\Core\Products\Infrastructure\Controller\Slim\Management;


use App\Core\Products\Infrastructure\Controller\Slim\Abstracts\ProductActionAbstract;
use Psr\Http\Message\ResponseInterface as Response;

class FindProductByUuidAction extends ProductActionAbstract
{
    /**
     * @OA\Get(
     *   tags={"Product"},
     *   path="/product/{id}",
     *   operationId="FindProductById",
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
     *     description="Find product by id"
     *   )
     * )
     */
    protected function action(): Response
    {
        $productCode = $this->resolveArg('id');
        $productDto = $this->productUseCase->findProductByUuid($productCode);
        return $this->respondWithData($productDto, 200);
    }
}