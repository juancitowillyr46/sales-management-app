<?php declare(strict_types=1);

use App\Shared\Application\Slim\Handlers\HttpErrorHandler;
use App\Shared\Application\Slim\Handlers\ShutdownHandler;
use App\Shared\Application\Slim\ResponseEmitter\ResponseEmitter;
use DI\ContainerBuilder;
use Psr\Log\LoggerInterface;
use Slim\App;
use Slim\Factory\ServerRequestCreatorFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions(__DIR__ . '/container.php');

try {

    // Build PHP-DI Container instance
    $container = $containerBuilder->build();

    $app = $container->get(App::class);
    $callableResolver = $app->getCallableResolver();
    $displayErrorDetails = false;

    // Register Middleware
    (require __DIR__ . '/middleware.php') ($app);

    // Register Routes
    (require __DIR__ . '/routes.php') ($app);

    // Create Request object from globals
    $serverRequestCreator = ServerRequestCreatorFactory::create();
    $request = $serverRequestCreator->createServerRequestFromGlobals();

    // Create Error Handler
    $responseFactory = $app->getResponseFactory();
    $errorHandler = new HttpErrorHandler($callableResolver, $responseFactory, $container->get(LoggerInterface::class));

    // Create Shutdown Handler
    $shutdownHandler = new ShutdownHandler($request, $errorHandler, $displayErrorDetails);
    register_shutdown_function($shutdownHandler);

    // Add Error Middleware
    $errorMiddleware = $app->addErrorMiddleware($displayErrorDetails, false, false);
    $errorMiddleware->setDefaultErrorHandler($errorHandler);

    // Run App & Emit Response
    $response = $app->handle($request);
    $responseEmitter = new ResponseEmitter();
    $responseEmitter->emit($response);

    // return $app->run();

} catch (\DI\DependencyException $e) {
    throw new Exception($e->getMessage());
} catch (\DI\NotFoundException $e) {
    throw new Exception($e->getMessage());
}
