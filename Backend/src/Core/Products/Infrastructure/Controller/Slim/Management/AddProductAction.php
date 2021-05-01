<?php


namespace App\Core\Products\Infrastructure\Controller\Slim\Management;


use App\Core\Products\Application\Request\ProductRequest;
use App\Core\Products\Infrastructure\Controller\Slim\Abstracts\ProductActionAbstract;
use Psr\Http\Message\ResponseInterface as Response;
use stdClass;

class AddProductAction extends ProductActionAbstract
{
    /**
     * @OA\Post(
     *   tags={"Product"},
     *   path="/products",
     *   operationId="addProduct",
     *     @OA\RequestBody(
     *         description="Pet object that needs to be added to the store",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/Product")
     *         )
     *     ),
     *   @OA\Response(
     *     response=200,
     *     description="Add products"
     *   )
     * )
     */
    protected function action(): Response
    {
        $this->productRequest = new ProductRequest($this->request->getBody());

        $this->productUseCase->addProduct($this->productRequest);

        return $this->respondWithData(new StdClass(), 201);
    }
}