<?php


namespace App\Core\Categories\Infrastructure\Persistence;


use App\Core\Categories\Domain\CategoryEntity;
use App\Core\Categories\Domain\CategoryNotFoundException;
use App\Core\Categories\Domain\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected CategoryModel $categoryModel;
    protected CategoryEntity $categoryEntity;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->categoryEntity = new CategoryEntity();
    }

    public function findCategoryByUuid(string $uuid): CategoryEntity
    {
        $categoryModel = $this->categoryModel::where("uuid", "=", $uuid)->first();
        if(is_null($categoryModel)) {
            throw new CategoryNotFoundException();
        }
        return $this->categoryEntity->transformModelToEntity((object)$categoryModel);
    }
}