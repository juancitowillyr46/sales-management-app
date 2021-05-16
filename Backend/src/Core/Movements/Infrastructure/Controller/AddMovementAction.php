<?php


namespace App\Core\Movements\Infrastructure\Controller;


use App\Core\Movements\Application\MovementRequest;
use Psr\Http\Message\ResponseInterface as Response;
use stdClass;

class AddMovementAction extends MovementActionAbstract
{
    /**
     * @OA\Post(
     *   tags={"Movement"},
     *   path="/movements",
     *   operationId="addMovement",
     *     @OA\RequestBody(
     *         description="Movement object that needs to be added to the store",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/Movement")
     *         )
     *     ),
     *   @OA\Response(
     *     response=200,
     *     description="Add Movement"
     *   )
     * )
     */
    protected function action(): Response
    {
        $this->movementRequest = new MovementRequest((object)$this->request->getParsedBody());

        $this->movementUseCase->addMovement($this->movementRequest);

        return $this->respondWithData(new StdClass(), 201);
    }
}