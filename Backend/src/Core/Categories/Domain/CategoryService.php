<?php


namespace App\Core\Categories\Domain;


use App\Core\Categories\Application\CategoryDto;

class CategoryService implements CategoryServiceInterface
{
    protected CategoryRepositoryInterface $categoryRepository;
    protected CategoryEntity $categoryEntity;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryEntity = new CategoryEntity();
    }

    public function findCategoryByUuid(string $uuid): CategoryDto
    {
        $category = $this->categoryRepository->findCategoryByUuid($uuid);
        $this->categoryEntity = $category;

        $categoryDto = new CategoryDto();
        $categoryDto->setId($this->categoryEntity->getUuid());
        $categoryDto->setName($this->categoryEntity->getName());

        return $categoryDto;
    }

    public function findCategoryById(int $id): CategoryDto
    {
        $category = $this->categoryRepository->findCategoryById($id);
        $this->categoryEntity = $category;

        $categoryDto = new CategoryDto();
        $categoryDto->setId($this->categoryEntity->getUuid());
        $categoryDto->setName($this->categoryEntity->getName());

        return $categoryDto;
    }
}