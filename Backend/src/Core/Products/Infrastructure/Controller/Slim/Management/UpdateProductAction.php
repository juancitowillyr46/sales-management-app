<?php


namespace App\Core\Products\Infrastructure\Controller\Slim\Management;


use App\Core\Products\Application\Request\ProductRequest;
use App\Core\Products\Infrastructure\Controller\Slim\Abstracts\ProductActionAbstract;
use Psr\Http\Message\ResponseInterface as Response;
use stdClass;

class UpdateProductAction extends ProductActionAbstract
{
    /**
     * @OA\Put(
     *   tags={"Product"},
     *   path="/products/{uuid}",
     *   operationId="updateProduct",
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
     *     @OA\RequestBody(
     *         description="Product object that needs to be added to the store",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/Product")
     *         ),
     *
     *     ),
     *   @OA\Response(
     *     response=200,
     *     description="Update product"
     *   )
     * )
     */
    protected function action(): Response
    {
        $this->productRequest = new ProductRequest((object)$this->request->getParsedBody());
        $productCode = $this->resolveArg('uuid');
        $this->productUseCase->updateProductByUuid($productCode, $this->productRequest);

        return $this->respondWithData(new StdClass(), 200);
    }
}