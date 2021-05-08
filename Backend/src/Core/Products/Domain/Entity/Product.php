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
    public int $categoryId;
    public string $skuCode;
    public int $measureId;
    public bool $featured;
    public float $cost;
    public int $stock;
    public float $promotionPrice;
    public string $presentation;

    public function __construct()
    {
        $this->uuid = $this->generateUuid();
        $this->image = "";
        $this->name = "";
        $this->description = "";
        $this->categoryId = 0;
        $this->skuCode = "";
        $this->cost = 0.0;
        $this->measureId = 0;
        $this->featured = false;
        $this->promotionPrice = 0.0;
        $this->presentation = "";
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
    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    /**
     * @param int $categoryId
     */
    public function setCategoryId(int $categoryId): void
    {
        $this->categoryId = $categoryId;
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
    public function getMeasureId(): int
    {
        return $this->measureId;
    }

    /**
     * @param int $measureId
     */
    public function setMeasureId(int $measureId): void
    {
        $this->measureId = $measureId;
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

    /**
     * @return string
     */
    public function getPresentation(): string
    {
        return $this->presentation;
    }

    /**
     * @param string $presentation
     */
    public function setPresentation(string $presentation): void
    {
        $this->presentation = $presentation;
    }

    public function transformRequestToEntity(ProductRequest $productRequest): Product {

        $this->setImage($productRequest->getImage());
        $this->setName($productRequest->getName());
        $this->setPrice($productRequest->getPrice());
        $this->setDescription($productRequest->getDescription());
        //$this->setCategoryId($productRequest->getCategoryId());
        $this->setSkuCode($productRequest->getSkuCode());
        //$this->setMeasureId($productRequest->getMeasureId());
        $this->setFeatured($productRequest->getFeatured());
        $this->setCost($productRequest->getCost());
        $this->setPromotionPrice($productRequest->getPromotionPrice());
        $this->setStock($productRequest->getStock());
        $this->setPresentation($productRequest->getPresentation());

        return $this;
    }

    public function transformEntityToModel(Product $product): array {
        $fields = [
            'uuid' => $product->getUuid(),
            'sku_code' => $product->getSkuCode(),
            'description' => $product->getDescription(),
            'name' => $product->getName(),
            'image' => $product->getImage(),
            'price' => $product->getPrice(),
            'cost' => $product->getCost(),
            'promotion_price' => $product->getPromotionPrice(),
            'measure_id' => $product->getMeasureId(),
            'category_id' => $product->getCategoryId(),
            'presentation'=> $product->getPresentation(),
            'stock' => $product->getStock(),
            'featured' => $product->getFeatured(),
            'state_id' => 1,
            'created_by' => 'JUAN'
        ];
        return $fields;
    }

}

