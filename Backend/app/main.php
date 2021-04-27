<?php declare(strict_types=1);


use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;
use Slim\App;

return function (ContainerBuilder $containerBuilder) {
    // Global Settings Object
    $containerBuilder->addDefinitions([
        App::class => function(ContainerInterface $container) {
            AppFactory::setContainer($container);
            return AppFactory::create();
        },
    ]);
};