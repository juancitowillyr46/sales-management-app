<?php


namespace App\Core\Products\Infrastructure\Controller\Slim;


use App\Core\Products\Application\Request\ProductRequest;
use Psr\Http\Message\ResponseInterface as Response;
use stdClass;

class DeleteProductManagerAction extends ProductManagerAction
{
    protected function action(): Response
    {
        $productCode = $this->resolveArg('productCode');

        $this->productManagerUseCase->removeProductByCode($productCode);

        return $this->respondWithData(new StdClass(), 200);
    }
}