<?php declare(strict_types=1);

use App\Shared\Application\Slim\Handlers\HttpErrorHandler;
use App\Shared\Application\Slim\Handlers\ShutdownHandler;
use App\Shared\Application\Slim\ResponseEmitter\ResponseEmitter;
use App\Shared\Application\Slim\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Psr\Log\LoggerInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Factory\ServerRequestCreatorFactory;

require_once __DIR__ . '/../vendor/autoload.php';

try {

    $containerBuilder = new ContainerBuilder();

    // Global Settings Object
    $containerc = require __DIR__ . '/../config/container.php';
    $containerc($containerBuilder);

    // Set up settings
    $settings = require __DIR__ . '/../config/settings.php';
    $settings($containerBuilder);

    // Set up dependencies
    $dependencies = require __DIR__ . '/../config/dependencies.php';
    $dependencies($containerBuilder);

    // Build PHP-DI Container instance
    $container = $containerBuilder->build();


    $app = $container->get(App::class);
//    AppFactory::setContainer($container);
//    $app = AppFactory::create();
    $callableResolver = $app->getCallableResolver();

    // Register Middleware
    $middleware = require __DIR__ . '/../config/middleware.php';
    $middleware($app);

    // Register Routes
    $routes = require __DIR__ . '/../config/routes.php';
    $routes($app);

    $settings = $container->get(SettingsInterface::class);


    $displayErrorDetails = $settings->get('displayErrorDetails');
    $logError = $settings->get('logError');
    $logErrorDetails = $settings->get('logErrorDetails');

    // Create Request object from globals
    $serverRequestCreator = ServerRequestCreatorFactory::create();
    $request = $serverRequestCreator->createServerRequestFromGlobals();

    // Create Error Handler
    $responseFactory = $app->getResponseFactory();
    $errorHandler = new HttpErrorHandler($callableResolver, $responseFactory);

    // Create Shutdown Handler
    $shutdownHandler = new ShutdownHandler($request, $errorHandler, $displayErrorDetails);
    register_shutdown_function($shutdownHandler);

    $app->addRoutingMiddleware();

    // Add Error Middleware
    $errorMiddleware = $app->addErrorMiddleware($displayErrorDetails, $logError, $logErrorDetails);
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
} catch (Exception $e) {
    throw new Exception($e->getMessage());
}
