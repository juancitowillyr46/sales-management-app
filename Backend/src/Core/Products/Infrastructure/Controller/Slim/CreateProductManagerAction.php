<?php

namespace App\Core\Products\Infrastructure\Controller\Slim;

use App\Core\Products\Application\Request\ProductRequest;
use Psr\Http\Message\ResponseInterface as Response;
use stdClass;

class CreateProductManagerAction extends ProductManagerAction
{
    protected function action(): Response
    {
        $this->productRequest = new ProductRequest($this->request->getBody());

        $this->productManagerUseCase->saveProduct($this->productRequest);

        return $this->respondWithData(new StdClass(), 201);
    }
}