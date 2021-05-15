<?php


namespace App\Core\Products\Infrastructure\Controller\Slim\Management;


use App\Core\Products\Domain\Entity\ProductPaginateParams;
use App\Core\Products\Infrastructure\Controller\Slim\Abstracts\ProductActionAbstract;
use Psr\Http\Message\ResponseInterface as Response;

class FindProductsAction extends ProductActionAbstract
{
    /**
     * @OA\Get(
     *   tags={"Product"},
     *   path="/products",
     *   operationId="findProducts",
     *   @OA\Parameter(
     *       name="size",
     *       in="query",
     *       required=false,
     *       description="Num. size",
     *       @OA\Schema(
     *          type="string"
     *       ),
     *   ),
     *   @OA\Parameter(
     *       name="page",
     *       in="query",
     *       required=false,
     *       description="Num. page",
     *       @OA\Schema(
     *          type="string"
     *       ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Find products"
     *   )
     * )
     */
    protected function action(): Response
    {
        $query = $this->request->getQueryParams();

        $paginateParams = new ProductPaginateParams();
        $paginateParams->setSize($query['size']);
        $paginateParams->setPage($query['page']);

        $products = $this->productUseCase->findProducts($paginateParams);

        return $this->respondWithData($products, 200);
    }
}