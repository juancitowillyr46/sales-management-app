<?php


namespace App\Shared\Infrastructure;


class BuildingCodeUnique
{
    public function __construct()
    {

    }

    public function generateCodeUnique(): string {
        return \Ramsey\Uuid\Uuid::uuid1();
    }
}