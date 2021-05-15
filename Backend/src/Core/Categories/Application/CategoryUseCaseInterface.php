<?php


namespace App\Core\Categories\Application;


interface CategoryUseCaseInterface
{
    public function findCategoryByUuid(string $uuid): CategoryDto;
}