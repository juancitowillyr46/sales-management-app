<?php declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Selective\Config\Configuration;
use Slim\Factory\AppFactory;
use Slim\App;

return [
   Configuration::class => function() {
        return new Configuration(require __DIR__ . '/settings.php' );
   },
   App::class => function(ContainerInterface $container) {
        AppFactory::setContainer($container);
        return AppFactory::create();
   }
];