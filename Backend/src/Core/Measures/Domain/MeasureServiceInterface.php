<?php


namespace App\Core\Measures\Domain;


use App\Core\Measures\Application\MeasureDto;

interface MeasureServiceInterface
{
    public function findMeasureByUuid(string $uuid): MeasureDto;
    public function findMeasureById(int $id): MeasureDto;
}