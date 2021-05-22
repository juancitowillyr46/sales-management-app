<?php


namespace App\Core\Movements\Domain;


use App\Core\Movements\Application\MovementRequest;
use App\Core\Movements\Domain\Exception\DocNumDuplicateException;
use App\Core\Products\Domain\Repository\ProductRepositoryInterface;
use App\Core\Products\Domain\Service\ProductStockServiceInterface;

class MovementService implements MovementServiceInterface
{
    protected MovementRepositoryInterface $movementRepository;
    protected MovementEntity $movementEntity;
    protected MovementDetailEntity $movementDetailEntity;
    protected ProductRepositoryInterface $productRepository;
    protected ProductStockServiceInterface $productStockService;

    public function __construct(
        MovementRepositoryInterface $movementRepository,
        ProductRepositoryInterface $productRepository,
        ProductStockServiceInterface $productStockService
    )
    {
        $this->movementRepository = $movementRepository;
        $this->productRepository = $productRepository;
        $this->movementEntity = new MovementEntity();
        $this->movementDetailEntity = new MovementDetailEntity();
        $this->productStockService = $productStockService;
    }

    public function addMovement(MovementRequest $movementRequest): bool
    {
        $this->validateDocumentNum($movementRequest);

        $toEntity = $this->movementEntity->transformRequestToEntity($movementRequest);

        $movementId = $this->movementRepository->addMovement($toEntity);

        $this->addMovementDetail($movementRequest, $movementId);

        return true;

    }

    public function addMovementDetail(MovementRequest $movementRequest, int $movementId): bool //array $movementDetailRequest
    {
        foreach ($movementRequest->getProducts() as $detail) {

            $objProduct = $this->productRepository->findProductSelectIdByUid($detail->productId);

            $toEntity = $this->movementDetailEntity->transformRequestToEntity($detail, $movementId, $objProduct);

            $success = $this->movementRepository->addMovementDetail($toEntity);

            if($success) {

                if($movementRequest->getConcept() == "SALE") {
                    $objProduct = $this->movementEntity->diminishStock($objProduct, $this->movementDetailEntity->getQuantity());
                } else if($this->movementEntity->getConcept() == "PURCHASE") {
                    $objProduct = $this->movementEntity->incrementStock($objProduct, $this->movementDetailEntity->getQuantity());
                } else if($$this->movementEntity->getConcept() == "INITIAL_STOCK") {
                    $objProduct->setStock($this->movementDetailEntity->getQuantity());
                }

                $this->productStockService->updateStock($detail->productId, $objProduct->getStock());
            }
        }

        return true;
    }

    public function validateDocumentNum(MovementRequest $productRequest): bool
    {
        if($this->movementRepository->validateDocumentNum($productRequest->getDocumentNum())) {
            throw new DocNumDuplicateException();
        }
        return false;
    }
}