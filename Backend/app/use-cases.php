<?php declare(strict_types=1);

use App\Core\Categories\Application\CategoryUseCase;
use App\Core\Categories\Application\CategoryUseCaseInterface;
use App\Core\Measures\Application\MeasureUseCase;
use App\Core\Measures\Application\MeasureUseCaseInterface;
use App\Core\Movements\Application\MovementHistoryUseCase;
use App\Core\Movements\Application\MovementHistoryUseCaseInterface;
use App\Core\Movements\Application\MovementUseCase;
use App\Core\Movements\Application\MovementUseCaseInterface;
use App\Core\Movements\Domain\MovementHistoryService;
use App\Core\Movements\Domain\MovementHistoryServiceInterface;
use App\Core\Products\Application\UseCase\ProductUseCase;
use App\Core\Products\Application\UseCase\ProductUseCaseInterface;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        ProductUseCaseInterface::class => \DI\autowire(ProductUseCase::class),
        CategoryUseCaseInterface::class => \DI\autowire(CategoryUseCase::class),
        MeasureUseCaseInterface::class => \DI\autowire(MeasureUseCase::class),
        MovementUseCaseInterface::class => \DI\autowire(MovementUseCase::class),
        MovementHistoryUseCaseInterface::class => \DI\autowire(MovementHistoryUseCase::class),
    ]);
};