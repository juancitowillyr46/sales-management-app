<?php declare(strict_types=1);

use App\Core\Products\Application\UseCase\IProductManagerUseCase;
use App\Core\Products\Application\UseCase\ProductManagerUseCase;
use App\Core\Products\Domain\Repository\IProductManagerRepository;
use App\Core\Products\Domain\Service\IProductManagerService;
use App\Core\Products\Domain\Service\ProductManagerService;
use App\Core\Products\Infrastructure\Persistence\Repository\Eloquent\ProductManagerRepository;
use App\Shared\Application\Slim\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

return function (ContainerBuilder $containerBuilder) {

    // Global Settings Object
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get(SettingsInterface::class);

            $loggerSettings = $settings->get('logger');
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },
        IProductManagerRepository::class => \DI\autowire(ProductManagerRepository::class),
        IProductManagerService::class => \DI\autowire(ProductManagerService::class),
        IProductManagerUseCase::class => \DI\autowire(ProductManagerUseCase::class),
    ]);
};