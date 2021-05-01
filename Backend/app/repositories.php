<?php declare(strict_types=1);

use App\Core\Products\Domain\Repository\ProductRepositoryInterface;
use App\Core\Products\Infrastructure\Persistence\Repository\Eloquent\ProductRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        ProductRepositoryInterface::class => \DI\autowire(ProductRepository::class),
    ]);
};