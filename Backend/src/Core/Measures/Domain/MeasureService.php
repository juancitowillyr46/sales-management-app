<?php


namespace App\Core\Measures\Domain;


use App\Core\Measures\Application\MeasureDto;

class MeasureService implements MeasureServiceInterface
{
    protected MeasureRepositoryInterface $measureRepository;
    protected MeasureEntity $measureEntity;

    public function __construct(MeasureRepositoryInterface $measureRepository)
    {
        $this->measureRepository = $measureRepository;
        $this->measureEntity = new MeasureEntity();
    }

    public function findMeasureByUuid(string $uuid): MeasureDto
    {
        $Measure = $this->measureRepository->findMeasureByUuid($uuid);
        $this->measureEntity = $Measure;

        $measureDto = new MeasureDto();
        $measureDto->setId($this->measureEntity->getUuid());
        $measureDto->setName($this->measureEntity->getName());

        return $measureDto;
    }

    public function findMeasureById(int $id): MeasureDto
    {
        $measure = $this->measureRepository->findMeasureById($id);
        $this->measureEntity = $measure;

        $measureDto = new MeasureDto();
        $measureDto->setId($this->measureEntity->getUuid());
        $measureDto->setName($this->measureEntity->getName());

        return $measureDto;
    }
}