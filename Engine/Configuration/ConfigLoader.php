<?php

namespace Engine\Configuration;

class ConfigLoader
{
    public function loadConfiguration()
    {
        /** @var array $files */
        $files = self::getConfigFiles();
        /** @var Config $config */
        $config = Config::getInstance();

        foreach($files as $fileName => $configName) {
            $config->loadConfigFile($fileName, $configName);
        }
    }

    /**
     * @return array
     */
    private static function getConfigFiles()
    {
        /** @var array $engineFiles */
        $engineFiles = self::getEngineConfigFiles();
        /** @var array $userFiles */
        $userFiles = self::getUserConfigFiles();

        return array_merge($engineFiles, $userFiles);
    }

    /**
     * @return array
     */
    private static function getEngineConfigFiles()
    {
        return [
            'routes.json' => 'routes'
        ];
    }

    /**
     * @return array
     */
    protected static function getUserConfigFiles()
    {
        return [
            // Please put your extra configuration files here
            // 'yourFile.json' => 'config name'
        ];
    }
}