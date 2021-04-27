<?php declare(strict_types=1);

use DI\ContainerBuilder;
use Slim\App;

require_once __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions(__DIR__ . '/container.php');

try {

    $container = $containerBuilder->build();

    $app = $container->get(App::class);

    (require __DIR__ . '/routes.php') ($app);

    (require __DIR__ . '/middleware.php') ($app);

    return $app->run();

} catch (Exception $e) {

    throw new Exception($e->getMessage());

}
