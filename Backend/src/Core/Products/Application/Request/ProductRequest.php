<?php
namespace App\Core\Products\Application\Request;

use App\Core\Products\Domain\Exception\ProductNotFoundException;
use App\Shared\Domain\DomainException\DomainFormDataValidateException;
use Selective\Validation\Converter\SymfonyValidationConverter;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

/**
 * @OA\Schema(
 *     schema="Product",
 *     title="Product",
 *     description="Request Product",
 *     required={"name", "price"}
 * )
 */
class ProductRequest
{
    /**
     * @OA\Property(type="string", example="http://w.image.com")
     */
    public string $image;

    /**
         * @OA\Property(type="string", example="Tornillo")
     */
    public string $name;

    /**
     * @OA\Property(type="number", example="99.9")
     */
    public float $price;

    /**
     * @OA\Property(type="string", example="Lorem Ipsum is simply dummy text of the printing and typesetting industry")
     */
    public string $description;

    /**
     * @OA\Property(type="string", example="b075dbf1-6d06-4915-9367-982b59769d82")
     */
    public string $categoryId;

    /**
     * @OA\Property(type="string", example="TSH-MED-WHI-COT")
     */
    public string $skuCode;

    /**
     * @OA\Property(type="string", example="cad2a220-d411-4c07-8056-c027b2be6d6e")
     */
    public string $measureId;

    /**
     * @OA\Property(type="boolean", example="true")
     */
    public bool $featured;

    /**
     * @OA\Property(type="number", example="9.99")
     */
    public float $cost;

    /**
     * @OA\Property(type="integer", example="9")
     */
    public int $stock;

    /**
     * @OA\Property(type="number", example="9.99")
     */
    public float $promotionPrice;

    /**
     * @OA\Property(type="string", example="Lorem Ipsum is simply dummy text")
     */
    public string $presentation;

    public function __construct(object $requestBody)
    {

        $this->validateRequest($requestBody);

        $this->skuCode = $requestBody->skuCode;
        $this->name = $requestBody->name;
        $this->description = $requestBody->description;
        $this->image = $requestBody->image;
        $this->price = $requestBody->price;
        $this->cost = $requestBody->cost;
        $this->promotionPrice = $requestBody->promotionPrice;
        $this->measureId = $requestBody->measureId;
        $this->categoryId = $requestBody->categoryId;
        $this->presentation = $requestBody->presentation;
        $this->stock = $requestBody->stock;
        $this->featured = $requestBody->featured;
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
     * @return string
     */
    public function getCategoryId(): string
    {
        return $this->categoryId;
    }

    /**
     * @param string $categoryId
     */
    public function setCategory(string $categoryId): void
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
     * @return string
     */
    public function getMeasureId(): string
    {
        return $this->measureId;
    }

    /**
     * @param string $measureId
     */
    public function setMeasureId(string $measureId): void
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

    public function validateRequest(object $requestBody): void {

        $formData = (array)$requestBody;

        $validator = Validation::createValidator();

        $constraint = new Assert\Collection(
            [
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
                'description' => [
                    new Assert\Optional(),
                    new Assert\Length([
                        'min' => 0,
                        'max' => 250
                    ])
                ],
                'categoryId' => [
                    new Assert\Optional(),
                    new Assert\Uuid()
                ] ,
                'skuCode' => new Assert\Optional(),
                'measureId' => [
                    new Assert\Optional(),
                    new Assert\Uuid()
                ],
                'featured' => [
                    new Assert\Optional(),
                    new Assert\Type('bool')
                ],
                'cost' => [
                    new Assert\Optional(),
                    new Assert\Type('float')
                ],
                'stock' => [
                    new Assert\Required(),
                    new Assert\Type('int')
                ],
                'promotionPrice' => [
                    new Assert\Optional(),
                    new Assert\Type('float')
                ],
                'presentation' => [
                    new Assert\Optional(),
                    new Assert\Type('string')
                ]
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
            $errors = json_encode($lstErrors);
            throw new DomainFormDataValidateException($errors);
        }

    }

    public function validateArgUuid(string $argUuid) {

        $formData = [
            'uuid' => $argUuid
        ];

        $validator = Validation::createValidator();
        $constraint = new Assert\Collection(
            [
                'uuid' => [
                    new Assert\Uuid()
                ]
            ]
        );
        $violations = $validator->validate($formData, $constraint);

        $validationResult = SymfonyValidationConverter::createValidationResult($violations);

        if ($validationResult->fails()) {
            throw new ProductNotFoundException();
        }
    }
}