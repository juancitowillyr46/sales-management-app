<?php declare(strict_types=1);

use App\Core\Products\Domain\Service\ProductService;
use App\Core\Products\Domain\Service\ProductServiceInterface;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        ProductServiceInterface::class => \DI\autowire(ProductService::class),
    ]);
};