<?php declare(strict_types=1);

use App\Core\Products\Application\UseCase\ProductUseCase;
use App\Core\Products\Application\UseCase\ProductUseCaseInterface;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        ProductUseCaseInterface::class => \DI\autowire(ProductUseCase::class),
    ]);
};