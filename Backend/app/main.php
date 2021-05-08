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
            $app = AppFactory::create();

            /* Eloquent */
            $settings['db'] = [
                'username' => 'root',
                'password' => '',
                'host' => 'localhost',
                'database' => 'db_management_app',
                'driver' => 'mysql',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                // Enable identifier quoting
                'quoteIdentifiers' => true,
                // Set to null to use MySQL servers timezone
                'timezone' => null,
                // Disable meta data cache
                'cacheMetadata' => false,
                // Disable query logging
                'log' => false,
                // PDO options
                'flags' => [
                    // Turn off persistent connections
                    PDO::ATTR_PERSISTENT => false,
                    // Enable exceptions
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    // Emulate prepared statements
                    PDO::ATTR_EMULATE_PREPARES => true,
                    // Set default fetch mode to array
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ],
            ];
            $capsule = new \Illuminate\Database\Capsule\Manager;
            $capsule->addConnection($settings['db']);
            $capsule->setAsGlobal();
            $capsule->bootEloquent();
            return $app;
        },
    ]);
};