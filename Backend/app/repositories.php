<?php declare(strict_types=1);

use App\Core\Products\Domain\Repository\IProductManagerRepository;
use App\Core\Products\Infrastructure\Persistence\Repository\Eloquent\ProductManagerRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        IProductManagerRepository::class => \DI\autowire(ProductManagerRepository::class),
    ]);
};