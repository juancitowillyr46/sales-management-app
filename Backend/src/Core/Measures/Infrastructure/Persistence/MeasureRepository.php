<?php


namespace App\Core\Measures\Infrastructure\Persistence;


use App\Core\Measures\Domain\MeasureEntity;
use App\Core\Measures\Domain\MeasureNotFoundException;
use App\Core\Measures\Domain\MeasureRepositoryInterface;

class MeasureRepository implements MeasureRepositoryInterface
{
    protected MeasureModel $measureModel;
    protected MeasureEntity $measureEntity;

    public function __construct()
    {
        $this->measureModel = new MeasureModel();
        $this->measureEntity = new MeasureEntity();
    }

    public function findMeasureByUuid(string $uuid): MeasureEntity
    {
        $MeasureModel = $this->measureModel::where("uuid", "=", $uuid)->first();
        if(is_null($MeasureModel)) {
            throw new MeasureNotFoundException();
        }
        return $this->measureEntity->transformModelToEntity((object)$MeasureModel);
    }

    public function findMeasureById(int $id): MeasureEntity
    {
        $MeasureModel = $this->measureModel::find($id)->first();
        if(is_null($MeasureModel)) {
            throw new MeasureNotFoundException();
        }
        return $this->measureEntity->transformModelToEntity((object)$MeasureModel);
    }
}