<?php


namespace App\Core\Categories\Domain;


interface CategoryRepositoryInterface
{
    public function findCategoryByUuid(string $uuid): CategoryEntity;
    public function findCategoryById(int $id): CategoryEntity;
}