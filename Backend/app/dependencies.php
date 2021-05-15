<?php declare(strict_types=1);

use App\Core\Products\Application\UseCase\IProductManagerUseCase;
use App\Core\Products\Application\UseCase\ProductManagerUseCase;
use App\Core\Products\Domain\Repository\IProductManagerRepository;
use App\Core\Products\Domain\Service\IProductManagerService;
use App\Core\Products\Domain\Service\ProductManagerService;
use App\Core\Products\Infrastructure\Persistence\Repository\Eloquent\ProductManagerRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {

    $containerBuilder->addDefinitions([
        IProductManagerRepository::class => \DI\autowire(ProductManagerRepository::class),
        IProductManagerService::class => \DI\autowire(ProductManagerService::class),
        IProductManagerUseCase::class => \DI\autowire(ProductManagerUseCase::class),
    ]);
};