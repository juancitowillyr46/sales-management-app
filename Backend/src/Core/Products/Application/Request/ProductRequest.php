<?php
namespace App\Core\Products\Application\Request;

use App\Core\Products\Domain\Exception\ProductValidateRequestException;
use Assert\Assertion;
use Assert\AssertionFailedException;
use Exception;
use Selective\Validation\Converter\SymfonyValidationConverter;
use Selective\Validation\Exception\ValidationException;
use Selective\Validation\ValidationResult;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\RecursiveValidator;
use Symfony\Component\Validator\Validator\TraceableValidator;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\ValidatorBuilder;

/**
 * @OA\Schema(
 *     schema="Product",
 *     title="Product",
 *     description="A simple product model."
 * )
 */
class ProductRequest
{
    /**
     * @OA\Property(type="string", example="uuid")
     */
    public string $uuid;

    /**
     * @OA\Property(type="string", example="image")
     */
    public string $image;

    /**
     * @OA\Property(type="string", example="name")
     */
    public string $name;
    public float $price;
    public string $description;
    public int $category;
    public string $skuCode;
    public int $unitOfMeasurement;
    public bool $featured;
    public float $cost;
    public int $stock;
    public float $promotionPrice;

    public function __construct(object $requestBody)
    {

        $this->validateRequest($requestBody);

        $this->uuid = $requestBody->uuid;
        $this->image = $requestBody->image;
        $this->name = $requestBody->name;
        $this->price = $requestBody->price;
        $this->description = $requestBody->description;
        $this->category = $requestBody->category;
        $this->skuCode = $requestBody->skuCode;
        $this->unitOfMeasurement = $requestBody->unitOfMeasurement;
        $this->featured = $requestBody->featured;
        $this->cost = $requestBody->cost;
        $this->promotionPrice = $requestBody->promotionPrice;

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

    public function validateRequest(object $requestBody): void {

        $formData = (array)$requestBody;

        $validator = Validation::createValidator();

        $constraint = new Assert\Collection(
            [
                'uuid' => [
                    new Assert\Optional(),
                    new Assert\Uuid()
                ],
                'image' => [
                    new Assert\Optional(),
                    new Assert\Url()
                ],
                'name' => [
                    new Assert\Required(),
                ],
                'price' => [
                    new Assert\Required(),
                    new Assert\Type('float')
                ],
                'description' => new Assert\Optional(),
                'category' => new Assert\Optional(),
                'skuCode' => new Assert\Optional(),
                'unitOfMeasurement' => new Assert\Optional(),
                'featured' => [
                    new Assert\Optional(),
                    new Assert\Type('bool')
                ],
                'cost' => [
                    new Assert\Optional(),
                    new Assert\Type('float','El costo debe ser 0.0')
                ],
                'promotionPrice' => new Assert\Optional(),
            ]
        );

        $constraint->missingFieldsMessage = 'Input required';

        $violations = $validator->validate($formData, $constraint);

        $validationResult = SymfonyValidationConverter::createValidationResult($violations);

        $lstErrors = [];
        if ($validationResult->fails()) {

            foreach ($validationResult->getErrors() as $error) {
                $lstErrors[] = [
                    "field" => $error->getField(),
                    "message" => $error->getMessage(),
                ];
            }

            throw new ProductValidateRequestException($lstErrors);
        }

    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

}