<?php


namespace App\Shared\Application\Slim\Settings;


interface SettingsInterface
{
    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key = '');
}