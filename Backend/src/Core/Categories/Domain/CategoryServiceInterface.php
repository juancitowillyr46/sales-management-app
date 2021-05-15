<?php


namespace App\Core\Categories\Domain;


use App\Core\Categories\Application\CategoryDto;

interface CategoryServiceInterface
{
    public function findCategoryByUuid(string $uuid): CategoryDto;
    public function findCategoryById(int $id): CategoryDto;
}