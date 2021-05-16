<?php


namespace App\Core\Movements\Application;


use App\Shared\Domain\DomainException\DomainFormDataValidateException;
use Cake\Chronos\Date;
use Selective\Validation\Converter\SymfonyValidationConverter;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

/**
 * @OA\Schema(
 *     schema="Movement",
 *     title="Movement",
 *     description="Request Movement",
 *     required={"documentTypeId", "documentNum", "dateIssue", "movementType", "concept", "quantity", "totalPrice", "totalPrice"}
 * )
 */
class MovementRequest
{
    /**
     * @OA\Property(type="string", example="INVOICE")
     */
    public string $documentTypeId;

    /**
     * @OA\Property(type="string", example="FA001")
     */
    public string $documentNum;

    /**
     * @OA\Property(type="string", example="2021-05-15")
     */
    public string $dateIssue;

    /**
     * @OA\Property(type="string", example="INPUT")
     */
    public string $movementType;

    /**
     * @OA\Property(type="string", example="SALE")
     */
    public string $concept;

    /**
     * @OA\Property(type="number", example="1")
     */
    public int $quantity;

    /**
     * @OA\Property(type="number", example="20.00")
     */
    public float $totalPrice;

    /**
     * @OA\Property(type="string", example="-")
     */
    public string $reference;

    /**
     * @OA\Property(property="products", type="array", @OA\Items(ref="#/components/schemas/MovementDetail"))
     */
    public array $products;


    public function __construct(object $requestBody)
    {
        $this->validateRequest($requestBody);
        $this->documentTypeId = $requestBody->documentTypeId;
        $this->documentNum = $requestBody->documentNum;
        $this->dateIssue = $requestBody->dateIssue;
        $this->movementType = $requestBody->movementType;
        $this->concept = $requestBody->concept;
        $this->quantity = $requestBody->quantity;
        $this->totalPrice = $requestBody->totalPrice;
        $this->reference = $requestBody->reference;
        $this->products = $requestBody->products;
    }


    /**
     * @return string
     */
    public function getDocumentTypeId(): string
    {
        return $this->documentTypeId;
    }

    /**
     * @param string $documentTypeId
     */
    public function setDocumentTypeId(string $documentTypeId): void
    {
        $this->documentTypeId = $documentTypeId;
    }

    /**
     * @return string
     */
    public function getDocumentNum(): string
    {
        return $this->documentNum;
    }

    /**
     * @param string $documentNum
     */
    public function setDocumentNum(string $documentNum): void
    {
        $this->documentNum = $documentNum;
    }

    /**
     * @return string
     */
    public function getDateIssue(): string
    {
        return $this->dateIssue;
    }

    /**
     * @param string $dateIssue
     */
    public function setDateIssue(string $dateIssue): void
    {
        $this->dateIssue = $dateIssue;
    }

    /**
     * @return string
     */
    public function getMovementType(): string
    {
        return $this->movementType;
    }

    /**
     * @param string $movementType
     */
    public function setMovementType(string $movementType): void
    {
        $this->movementType = $movementType;
    }

    /**
     * @return string
     */
    public function getConcept(): string
    {
        return $this->concept;
    }

    /**
     * @param string $concept
     */
    public function setConcept(string $concept): void
    {
        $this->concept = $concept;
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

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference(string $reference): void
    {
        $this->reference = $reference;
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param array $products
     */
    public function setProducts(array $products): void
    {
        $this->products = $products;
    }

    public function validateRequest(object $requestBody): void {

        $formData = (array)$requestBody;

        $validator = Validation::createValidator();

        $constraint = new Assert\Collection(
            [
                'documentTypeId' => [
                    new Assert\Required(),
                ],
                'documentNum' => [
                    new Assert\Required(),
                ],
                'dateIssue' => [
                    new Assert\Optional(),
                ],
                'movementType' => [
                    new Assert\Required(),
                ],
                'concept' => [
                    new Assert\Required(),
                ] ,
                'quantity' => [
                    new Assert\Required(),
                ],
                'totalPrice' => [
                    new Assert\Required(),
                ],
                'reference' => [
                    new Assert\Required(),
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