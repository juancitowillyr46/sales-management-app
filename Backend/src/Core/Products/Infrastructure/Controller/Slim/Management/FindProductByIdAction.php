<?php


namespace App\Core\Products\Infrastructure\Controller\Slim\Management;


use App\Core\Products\Infrastructure\Controller\Slim\Abstracts\ProductManagementActionAbstract;
use App\Shared\Application\Slim\Action\ActionError;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;

class FindProductByIdAction extends ProductManagementActionAbstract
{
    /**
     * @OA\Get(
     *   tags={"Product"},
     *   path="/products/{id}",
     *   operationId="findProductByIdProduct",
     *   @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="Product Code",
     *          @OA\Schema(
     *              type="string"
     *          )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Find product by id"
     *   )
     * )
     */
    protected function action(): Response
    {
        try {

            $productCode = $this->resolveArg('id');

            $productDto = $this->productManagerUseCase->getProductByCode($productCode);
            return $this->respondWithData($productDto, 200);

        } catch (Exception $e) {

            $error = new ActionError(ActionError::RESOURCE_NOT_FOUND, $e->getMessage());

            return $this->respondWithData($error, 404);

        }

    }
}