<?php
namespace App\Core\Products\Domain\Entity;

use App\Core\Products\Application\Request\ProductRequest;
use App\Shared\Domain\Entity\BaseEntity;

class Product extends BaseEntity
{
    public string $name;
    public string $description;
    public string $image;
    public float $price;
    public int $category;
    public string $skuCode;
    public int $unitOfMeasurement;
    public bool $featured;
    public float $cost;
    public int $stock;
    public float $promotionPrice;

    public function __construct()
    {

        $this->uuid = $this->generateUuid();
        $this->promotionPrice = 0;
        $this->category = 0;
        $this->description = "";
        $this->skuCode = "";
        $this->cost = 0;
        $this->unitOfMeasurement = 0;
        $this->featured = false;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getCategory(): int
    {
        return $this->category;
    }

    /**
     * @param int $category
     */
    public function setCategory(int $category): void
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getSkuCode(): string
    {
        return $this->skuCode;
    }

    /**
     * @param string $skuCode
     */
    public function setSkuCode(string $skuCode): void
    {
        $this->skuCode = $skuCode;
    }

    /**
     * @return int
     */
    public function getUnitOfMeasurement(): int
    {
        return $this->unitOfMeasurement;
    }

    /**
     * @param int $unitOfMeasurement
     */
    public function setUnitOfMeasurement(int $unitOfMeasurement): void
    {
        $this->unitOfMeasurement = $unitOfMeasurement;
    }

    /**
     * @return bool
     */
    public function getFeatured(): bool
    {
        return $this->featured;
    }

    /**
     * @param bool $featured
     */
    public function setFeatured(bool $featured): void
    {
        $this->featured = $featured;
    }

    /**
     * @return float
     */
    public function getCost(): float
    {
        return $this->cost;
    }

    /**
     * @param float $cost
     */
    public function setCost(float $cost): void
    {
        $this->cost = $cost;
    }

    /**
     * @return int
     */
    public function getStock(): int
    {
        return $this->stock;
    }

    /**
     * @param int $stock
     */
    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }

    /**
     * @return float
     */
    public function getPromotionPrice(): float
    {
        return $this->promotionPrice;
    }

    /**
     * @param float $promotionPrice
     */
    public function setPromotionPrice(float $promotionPrice): void
    {
        $this->promotionPrice = $promotionPrice;
    }

    public function transformRequestToEntity(ProductRequest $productRequest): Product {
        $this->setImage($productRequest->getImage());
        $this->setName($productRequest->getName());
        $this->setPrice($productRequest->getPrice());
        return $this;
    }

}

