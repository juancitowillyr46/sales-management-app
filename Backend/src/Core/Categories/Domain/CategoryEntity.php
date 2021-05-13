<?php


namespace App\Core\Categories\Domain;


use App\Shared\Domain\Entity\BaseEntity;

class CategoryEntity extends BaseEntity
{
    public string $name;
    public string $description;
    public string $image;
    public int $stateId;

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
     * @return int
     */
    public function getStateId(): int
    {
        return $this->stateId;
    }

    /**
     * @param int $stateId
     */
    public function setStateId(int $stateId): void
    {
        $this->stateId = $stateId;
    }

    public function transformModelToEntity(object $categoryModel): CategoryEntity {
        $category = $this;
        $category->setId($categoryModel->id);
        $category->setUuid($categoryModel->uuid);
        $category->setName($categoryModel->name);
        $category->setDescription($categoryModel->description);
        $category->setImage($categoryModel->image);
        $category->setStateId($categoryModel->state_id);
        return $category;
    }
}