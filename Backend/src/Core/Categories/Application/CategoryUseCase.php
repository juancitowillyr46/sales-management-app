<?php


namespace App\Core\Categories\Application;


class CategoryUseCase implements CategoryUseCaseInterface
{

    public function findCategoryByUuid(string $uuid): CategoryDto
    {
        return new CategoryDto();
    }
}