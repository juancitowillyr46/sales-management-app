<?php


namespace App\Shared\Application\Slim\Settings;


class Settings implements SettingsInterface
{
    /**
     * @var array
     */
    private $settings;

    /**
     * Settings constructor.
     * @param array $settings
     */
    public function __construct(array $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key = '')
    {
        return (empty($key)) ? $this->settings : $this->settings[$key];
    }
}