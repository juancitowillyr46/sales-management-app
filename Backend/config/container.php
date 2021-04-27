<?php declare(strict_types=1);

use App\Shared\Application\Slim\Settings\Settings;
use App\Shared\Application\Slim\Settings\SettingsInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Selective\Config\Configuration;
use Slim\Factory\AppFactory;
use Slim\App;

return [
    SettingsInterface::class => function () {
        return new Settings([
            'displayErrorDetails' => true, // Should be set to false in production
            'logError'            => false,
            'logErrorDetails'     => false,
            'logger' => [
                'name' => 'slim-app',
                'path' => '/../logs/app.log',
                'level' => Logger::DEBUG,
            ],
        ]);
   },
   Configuration::class => function() {
        return new Configuration(require __DIR__ . '/settings.php' );
   },
   App::class => function(ContainerInterface $container) {
        AppFactory::setContainer($container);
        return AppFactory::create();
   },
   LoggerInterface::class => function (ContainerInterface $c) {
        $settings = $c->get(SettingsInterface::class);

        $loggerSettings = $settings->get('logger');
        $logger = new Logger($loggerSettings['name']);

        $processor = new UidProcessor();
        $logger->pushProcessor($processor);

        $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
        $logger->pushHandler($handler);

        return $logger;
    }
];