<?php


namespace App\Core\Movements\Domain;

use App\Shared\Domain\Entity\BaseEntity;

class MovementDetailEntity extends BaseEntity
{
    public int $productMovementId;
    public int $productId;
    public int $quantity;
    public float $unitPrice;
    public float $totalPrice;

    public function __construct()
    {
        parent::__construct();
        $this->productMovementId = 0;
        $this->productId = 0;
        $this->quantity = 0;
        $this->unitPrice = 0;
        $this->totalPrice = 0;
    }


    /**
     * @return int
     */
    public function getProductMovementId(): int
    {
        return $this->productMovementId;
    }

    /**
     * @param int $productMovementId
     */
    public function setProductMovementId(int $productMovementId): void
    {
        $this->productMovementId = $productMovementId;
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



}