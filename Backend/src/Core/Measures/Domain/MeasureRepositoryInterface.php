<?php


namespace App\Core\Measures\Domain;


interface MeasureRepositoryInterface
{
    public function findMeasureByUuid(string $uuid): MeasureEntity;
    public function findMeasureById(int $id): MeasureEntity;
}