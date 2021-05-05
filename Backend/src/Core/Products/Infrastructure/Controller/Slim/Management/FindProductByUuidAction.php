<?php


namespace App\Core\Products\Infrastructure\Controller\Slim\Management;


use App\Core\Products\Infrastructure\Controller\Slim\Abstracts\ProductActionAbstract;
use App\Shared\Application\Slim\Action\ActionError;
use Exception;
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
     *         in="query",
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

//        try {

            $productCode = $this->resolveArg('uuid');

            $productDto = $this->productUseCase->findProductByUuid($productCode);

            return $this->respondWithData($productDto, 200);

//        } catch (Exception $e) {
//
//            $error = new ActionError(ActionError::RESOURCE_NOT_FOUND, $e->getMessage());
//
//            return $this->respondWithData($error, 404);
//
//        }

    }
}