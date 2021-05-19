<?php


namespace App\Core\Movements\Domain;


use App\Core\Movements\Application\MovementRequest;
use App\Core\Movements\Domain\Exception\DocNumDuplicateException;
use App\Core\Products\Domain\Repository\ProductRepositoryInterface;

class MovementService implements MovementServiceInterface
{
    protected MovementRepositoryInterface $movementRepository;
    protected MovementEntity $movementEntity;
    protected MovementDetailEntity $movementDetailEntity;
    protected ProductRepositoryInterface $productRepository;


    public function __construct(MovementRepositoryInterface $movementRepository, ProductRepositoryInterface $productRepository)
    {
        $this->movementRepository = $movementRepository;
        $this->productRepository = $productRepository;
        $this->movementEntity = new MovementEntity();
        $this->movementDetailEntity = new MovementDetailEntity();

    }

    public function addMovement(MovementRequest $movementRequest): bool
    {
        $this->validateDocumentNum($movementRequest);

        $toEntity = $this->movementEntity->transformRequestToEntity($movementRequest);

        $movementId = $this->movementRepository->addMovement($toEntity);

        $this->addMovementDetail($movementRequest->getProducts(), $movementId);

        return true;

    }

    public function addMovementDetail(array $movementDetailRequest, int $movementId): bool
    {
        foreach ($movementDetailRequest as $detail) {

            $product = $this->productRepository->findProductSelectIdByUid($detail->productId);
            $this->movementDetailEntity->setProductId($product->getId());

            $toEntity = $this->movementDetailEntity->transformRequestToEntity($detail, $movementId);
            $success = $this->movementRepository->addMovementDetail($toEntity);
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