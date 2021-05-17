<?php declare(strict_types=1);

use App\Core\Movements\Infrastructure\Controller\AddMovementAction;
use App\Core\Products\Infrastructure\Controller\Slim\Management\AddProductAction;
use App\Core\Products\Infrastructure\Controller\Slim\Management\DeleteProductAction;
use App\Core\Products\Infrastructure\Controller\Slim\Management\FindProductByUuidAction;
use App\Core\Products\Infrastructure\Controller\Slim\Management\FindProductsAction;
use App\Core\Products\Infrastructure\Controller\Slim\Management\UpdateProductAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.+}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });
    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello, World!');
        return $response;
    });

    $app->group('/products', function (Group $group) {
        $group->get('', FindProductsAction::class);
        $group->post('', AddProductAction::class);
        $group->get('/{id}', FindProductByUuidAction::class);
        $group->put('/{id}', UpdateProductAction::class);
        $group->delete('/{id}', DeleteProductAction::class);
    });

    $app->group('/movements', function (Group $group) {
        //$group->get('', FindProductsAction::class);
        $group->post('', AddMovementAction::class);
//        $group->get('/{id}', FindProductByUuidAction::class);
//        $group->put('/{id}', UpdateProductAction::class);
//        $group->delete('/{id}', DeleteProductAction::class);
    });
};