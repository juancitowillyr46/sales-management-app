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
 *     required={"documentTypeId", "documentNum", "dateIssue", "concept"}
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
     * @OA\Property(type="string", example="SALE")
     */
    public string $concept;

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
        $this->concept = $requestBody->concept;
        $this->products = $this->collectionMovementDetail((object) $requestBody->products);
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
                'concept' => [
                    new Assert\Required(),
                ],
                'products' => [
                    new Assert\Required(),
                    new Assert\Type('array')
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

    public function collectionMovementDetail(object $movementDetail): array {
        $lst = [];
        foreach ($movementDetail as $item) {
            $lst[] = new MovementDetailRequest((object) $item);
        }
        return $lst;
    }
}