<?php


namespace App\Core\Movements\Domain;

use App\Core\Movements\Application\MovementDetailRequest;
use App\Core\Movements\Application\MovementRequest;
use App\Core\Products\Domain\Entity\Product;
use App\Shared\Domain\Entity\BaseEntity;

class MovementDetailEntity extends BaseEntity
{
    public int $movementId;
    public int $productId;
    public int $quantity;
    public float $unitPrice;
    public float $totalPrice;

    public function __construct()
    {
        parent::__construct();
        $this->movementId = 0;
        $this->productId = 0;
        $this->quantity = 0;
        $this->unitPrice = 0;
        $this->totalPrice = 0;
    }

    /**
     * @return int
     */
    public function getMovementId(): int
    {
        return $this->movementId;
    }

    /**
     * @param int $movementId
     */
    public function setMovementId(int $movementId): void
    {
        $this->movementId = $movementId;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     */
    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return float
     */
    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    /**
     * @param float $unitPrice
     */
    public function setUnitPrice(float $unitPrice): void
    {
        $this->unitPrice = $unitPrice;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    /**
     * @param float $totalPrice
     */
    public function setTotalPrice(float $totalPrice): void
    {
        $this->totalPrice = $totalPrice;
    }

    public function transformRequestToEntity(MovementDetailRequest $detail, int $movementId, Product $product): MovementDetailEntity {
        $this->setUuid($this->generateUuid());
        $this->setQuantity($detail->getQuantity());
        $this->setUnitPrice($detail->getUnitPrice());
        $this->setTotalPrice($detail->getTotalPrice());
        $this->setProductId($product->getId());
        $this->setMovementId($movementId);
        return $this;
    }

    public function transformEntityToModel(MovementDetailEntity $movementDetail): array {
        $fields = [
            'uuid' => $movementDetail->getUuid(),
            'movement_id' => $movementDetail->getMovementId(),
            'product_id' => $movementDetail->getProductId(),
            'quantity' => $movementDetail->getQuantity(),
            'unit_price' => $movementDetail->getUnitPrice(),
            'total_price' => $movementDetail->getTotalPrice(),
            'state_id' => $movementDetail->getStateId(),
            'created_by' => $movementDetail->getCreatedBy()
        ];
        return $fields;
    }

}