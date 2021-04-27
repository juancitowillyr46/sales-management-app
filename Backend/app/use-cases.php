<?php declare(strict_types=1);

use App\Core\Products\Application\UseCase\IProductManagerUseCase;
use App\Core\Products\Application\UseCase\ProductManagerUseCase;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        IProductManagerUseCase::class => \DI\autowire(ProductManagerUseCase::class),
    ]);
};