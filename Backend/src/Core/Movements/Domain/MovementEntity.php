<?php


namespace App\Core\Movements\Domain;


use App\Core\Movements\Application\MovementRequest;
use App\Shared\Domain\Entity\BaseEntity;
use Cake\Chronos\Date;


class MovementEntity extends BaseEntity
{
    public string $documentTypeId;
    public string $documentNum;
    public string $dateIssue;
    public string $movementType;
    public string $concept;
    public int $quantity;
    public float $totalPrice;
    public string $reference;
    public array $products;

    public function __construct()
    {
        parent::__construct();
        $this->documentTypeId = 'INVOICE';
        $this->documentNum = '';
        $this->dateIssue = date('Y-m-d H:i:s');
        $this->movementType = 'OUTPUT';
        $this->concept = 'SALE';
        $this->quantity = 0;
        $this->totalPrice = 0.0;
        $this->reference = '-';
        $this->products = [];
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
     * @return Date|false|string
     */
    public function getDateIssue()
    {
        return $this->dateIssue;
    }

    /**
     * @param Date|false|string $dateIssue
     */
    public function setDateIssue($dateIssue): void
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
     * @return float|string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param float|string $reference
     */
    public function setReference($reference): void
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

    public function transformRequestToEntity(MovementRequest $productRequest): MovementEntity {
        $this->setDocumentTypeId($productRequest->getDocumentTypeId());
        $this->setDocumentNum($productRequest->getDocumentNum());
        $this->setDateIssue($productRequest->getDateIssue());
        $this->setMovementType($productRequest->getMovementType());
        $this->setConcept($productRequest->getConcept());
        $this->setQuantity($productRequest->getQuantity());
        $this->setTotalPrice($productRequest->getTotalPrice());
        $this->setReference($productRequest->getReference());
        $this->setProducts($productRequest->getProducts());
        return $this;
    }
}