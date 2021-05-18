<?php


namespace App\Core\Movements\Application;


use App\Shared\Domain\DomainException\DomainFormDataValidateException;
use Selective\Validation\Converter\SymfonyValidationConverter;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

/**
 * @OA\Schema(
 *     schema="MovementDetail",
 *     title="MovementDetail",
 *     description="Request MovementDetail",
 *     required={"productId", "quantity", "unitPrice", "totalPrice"}
 * )
 */
class MovementDetailRequest
{
    /**
     * @OA\Property(type="string", example="ca809fdc-b199-11eb-a426-00fffff3cb1e")
     */
    public string $productId;

    /**
     * @OA\Property(type="number", example="1")
     */
    public int $quantity;

    /**
     * @OA\Property(type="number", example="99.9")
     */
    public float $unitPrice;

    /**
     * @OA\Property(type="number", example="99.9")
     */
    public float $totalPrice;

    public function __construct(object $requestBody)
    {
        $this->validateRequest($requestBody);
        $this->productId = $requestBody->productId;
        $this->quantity = $requestBody->quantity;
        $this->unitPrice = $requestBody->unitPrice;
        $this->totalPrice = $requestBody->totalPrice;
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

    public function validateRequest(object $requestBody): void {

        $formData = (array)$requestBody;

        $validator = Validation::createValidator();

        $constraint = new Assert\Collection(
            [
                'productId' => [
                    new Assert\Required(),
                ],
                'quantity' => [
                    new Assert\Required(),
                ],
                'unitPrice' => [
                    new Assert\Optional(),
                    new Assert\Type('float')
                ],
                'totalPrice' => [
                    new Assert\Required(),
                    new Assert\Type('float')
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


}