<?php declare(strict_types=1);


use App\Core\Products\Domain\Service\IProductManagerService;
use App\Core\Products\Domain\Service\ProductManagerService;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        IProductManagerService::class => \DI\autowire(ProductManagerService::class),
    ]);
};