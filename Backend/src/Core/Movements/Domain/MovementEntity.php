<?php


namespace App\Core\Movements\Domain;


use App\Core\Movements\Application\MovementRequest;
use App\Core\Products\Domain\Entity\Product;
use App\Shared\Domain\Entity\BaseEntity;
use Cake\Chronos\Date;


class MovementEntity extends BaseEntity
{
    public string $documentTypeId;
    public string $documentNum;
    public string $dateIssue;
    public string $concept;
    public array $products;

    public function __construct()
    {
        parent::__construct();
        $this->documentTypeId = 'INVOICE';
        $this->documentNum = '';
        $this->dateIssue = date('Y-m-d H:i:s');
        $this->concept = 'SALE';
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

    public function transformRequestToEntity(MovementRequest $productRequest): MovementEntity {
        $this->setDocumentTypeId($productRequest->getDocumentTypeId());
        $this->setDocumentNum($productRequest->getDocumentNum());
        $this->setDateIssue($productRequest->getDateIssue());
        $this->setConcept($productRequest->getConcept());
        $this->setProducts($productRequest->getProducts());
        return $this;
    }

    public function transformEntityToModel(MovementEntity $movement): array {
        $fields = [
            'uuid' => $movement->getUuid(),
            'document_type_id' => $movement->getDocumentTypeId(),
            'document_num' => $movement->getDocumentNum(),
            'date_issue' => $movement->getDateIssue(),
            'concept' => $movement->getConcept(),
            'state_id' => $movement->getStateId(),
            'created_by' => $movement->getCreatedBy()
        ];
        return $fields;
    }

    public function incrementStock(Product $product, int $requestQuantityStock): Product {
        $product->setStock($product->getStock() + $requestQuantityStock);
        return $product;
    }

    public function diminishStock(Product $product, int $requestQuantityStock): Product {
        $product->setStock($product->getStock() - $requestQuantityStock);
        return $product;
    }
}