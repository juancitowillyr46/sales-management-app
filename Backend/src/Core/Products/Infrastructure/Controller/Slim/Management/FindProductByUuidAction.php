<?php


namespace App\Core\Products\Infrastructure\Controller\Slim\Management;


use App\Core\Products\Infrastructure\Controller\Slim\Abstracts\ProductActionAbstract;
use Psr\Http\Message\ResponseInterface as Response;

class FindProductByUuidAction extends ProductActionAbstract
{
    /**
     * @OA\Get(
     *   tags={"Product"},
     *   path="/products/{uuid}",
     *   operationId="FindProductByUuidAction",
     *   @OA\Parameter(
     *         name="uuid",
     *         in="path",
     *         description="Unique resource identifier",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *           @OA\Items(type="string"),
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
        $productCode = $this->resolveArg('uuid');
        $productDto = $this->productUseCase->findProductByUuid($productCode);
        return $this->respondWithData($productDto, 200);
    }
}