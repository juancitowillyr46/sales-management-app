<?php declare(strict_types=1);

use App\Core\Categories\Domain\CategoryRepositoryInterface;
use App\Core\Categories\Infrastructure\Persistence\CategoryRepository;
use App\Core\Measures\Domain\MeasureRepositoryInterface;
use App\Core\Measures\Infrastructure\Persistence\MeasureRepository;
use App\Core\Movements\Domain\MovementRepositoryInterface;
use App\Core\Movements\Infrastructure\Persistence\MovementRepository;
use App\Core\Products\Domain\Repository\ProductRepositoryInterface;
use App\Core\Products\Infrastructure\Persistence\Repository\Eloquent\ProductRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        ProductRepositoryInterface::class => \DI\autowire(ProductRepository::class),
        CategoryRepositoryInterface::class => \DI\autowire(CategoryRepository::class),
        MeasureRepositoryInterface::class => \DI\autowire(MeasureRepository::class),
        MovementRepositoryInterface::class => \DI\autowire(MovementRepository::class),
    ]);
};