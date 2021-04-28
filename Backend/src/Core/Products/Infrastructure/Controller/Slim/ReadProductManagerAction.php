<?php


namespace App\Core\Products\Infrastructure\Controller\Slim;


use App\Shared\Application\Slim\Action\ActionError;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use stdClass;

class ReadProductManagerAction extends ProductManagerAction
{
    protected function action(): Response
    {
        try {

            $productCode = $this->resolveArg('productCode');

            $productDto = $this->productManagerUseCase->getProductByCode($productCode);
            return $this->respondWithData($productDto, 200);

        } catch (Exception $e) {

            $error = new ActionError(ActionError::RESOURCE_NOT_FOUND, $e->getMessage());

            return $this->respondWithData($error, 404);

        }

    }
}