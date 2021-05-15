<?php


namespace App\Core\Measures\Domain;


use App\Shared\Domain\Entity\BaseEntity;

class MeasureEntity extends BaseEntity
{
    public string $name;
    public string $description;
    public int $stateId;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getStateId(): int
    {
        return $this->stateId;
    }

    /**
     * @param int $stateId
     */
    public function setStateId(int $stateId): void
    {
        $this->stateId = $stateId;
    }

    public function transformModelToEntity(object $measureModel): MeasureEntity {
        $measure = $this;
        $measure->setId($measureModel->id);
        $measure->setUuid($measureModel->uuid);
        $measure->setName($measureModel->name);
        $measure->setDescription($measureModel->description);
        $measure->setStateId($measureModel->state_id);
        return $measure;
    }
}