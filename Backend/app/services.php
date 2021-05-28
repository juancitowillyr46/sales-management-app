<?php declare(strict_types=1);

use App\Core\Categories\Domain\CategoryService;
use App\Core\Categories\Domain\CategoryServiceInterface;
use App\Core\Measures\Domain\MeasureService;
use App\Core\Measures\Domain\MeasureServiceInterface;
use App\Core\Movements\Domain\MovementHistoryService;
use App\Core\Movements\Domain\MovementHistoryServiceInterface;
use App\Core\Movements\Domain\MovementService;
use App\Core\Movements\Domain\MovementServiceInterface;
use App\Core\Products\Domain\Service\ProductService;
use App\Core\Products\Domain\Service\ProductServiceInterface;
use App\Core\Products\Domain\Service\ProductStockService;
use App\Core\Products\Domain\Service\ProductStockServiceInterface;
use App\Core\Products\Domain\Service\ResourceGetIdService;
use App\Core\Products\Domain\Service\ResourceServiceInterface;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        ResourceServiceInterface::class => \DI\autowire(ResourceGetIdService::class),
        ProductServiceInterface::class => \DI\autowire(ProductService::class),
        CategoryServiceInterface::class=> \DI\autowire(CategoryService::class),
        MeasureServiceInterface::class => \DI\autowire(MeasureService::class),
        MovementServiceInterface::class => \DI\autowire(MovementService::class),
        ProductStockServiceInterface::class => \DI\autowire(ProductStockService::class),
        MovementHistoryServiceInterface::class => \DI\autowire(MovementHistoryService::class)
    ]);
};