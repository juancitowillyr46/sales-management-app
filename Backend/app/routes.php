<?php declare(strict_types=1);

use App\Core\Products\Infrastructure\Controller\Slim\AllProductsManagerAction;
use App\Core\Products\Infrastructure\Controller\Slim\CreateProductManagerAction;
use App\Core\Products\Infrastructure\Controller\Slim\DeleteProductManagerAction;
use App\Core\Products\Infrastructure\Controller\Slim\ReadProductManagerAction;
use App\Core\Products\Infrastructure\Controller\Slim\UpdateProductManagerAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });
    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello, World!');
        return $response;
    });
    $app->group('/products', function (Group $group) {
        $group->get('', AllProductsManagerAction::class);
        $group->post('/', CreateProductManagerAction::class);
        $group->get('/{productCode}', ReadProductManagerAction::class);
        $group->put('/{productCode}', UpdateProductManagerAction::class);
        $group->delete('/{productCode}', DeleteProductManagerAction::class);
    });
};