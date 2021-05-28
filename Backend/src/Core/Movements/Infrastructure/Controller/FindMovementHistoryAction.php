<?php


namespace App\Core\Movements\Infrastructure\Controller;


use Psr\Http\Message\ResponseInterface as Response;
use stdClass;

class FindMovementHistoryAction extends MovementActionAbstract
{
    /**
     * @OA\Get(
     *   tags={"Movement"},
     *   path="/products/{productId}",
     *   operationId="FinMovementHistory",
     *   @OA\Parameter(
     *         name="productId",
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
     *     description="Find movement history by product id"
     *   )
     * )
     */
    protected function action(): Response
    {
        //$this->movementRequest = new MovementRequest((object)$this->request->getParsedBody());

        //$this->movementUseCase($this->movementRequest);
        $productCode = $this->resolveArg('productId');
        $movementHistory = $this->movementHistoryUseCase->getMovementHistoryByProductId($productCode);

        return $this->respondWithData($movementHistory, 201);
    }
}