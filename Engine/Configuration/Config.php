<?php

namespace Engine\Configuration;

/**
 * Class Config
 * using Singleton pattern to load data from file only once
 */
class Config
{
    /** @var array $configCollection */
    private $configCollection;
    /** @var Config $instance */
    private static $instance;

    /**
     * Avoid object cloning outside a class
     */
    private function __clone() {}

    /**
     * Avoid object creation outside a class
     * using private constructor
     */
    private function __construct() {
        $this->configCollection = [];
        $this->loadConfigFile();
    }

    /**
     * @param string $fileName
     * @param string $name
     * @throws \Exception
     */
    public function loadConfigFile(string $fileName = 'config.json', string $name = 'config')
    {
        $configFilePath = __DIR__ . '/../../Configuration/' . $fileName;

        /** @var string $content */
        $content = file_get_contents($configFilePath);

        if(!$content) {
            throw new \Exception('Configuration load failure. File "' . $configFilePath . '" does not exist.');
        }

        $this->configCollection[$name] = json_decode($content, true);
    }

    /**
     * Create self-instance (if don't exists)
     * @return Config
     */
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Config();
        }

        return self::$instance;
    }

    /**
     * @param string $name
     * @param string $property
     * @return mixed
     * @throws \Exception
     */
    public static function get(string $property, string $name = 'config')
    {
        /** @var array $data */
        $data = self::getData($name);

        if(!array_key_exists($property, $data)) {
            throw new \Exception('Configuration property "' . $property . '" does not exist.');
        }

        return $data[$property];
    }

    /**
     * @param string $name
     * @return array
     * @throws \Exception
     */
    public static function getData(string $name = 'config')
    {
        /** @var Config $instance */
        $instance = self::getInstance();

        if(!array_key_exists($name, $instance->configCollection)) {
            throw new \Exception('Configuration with name "' . $name . '" does not exist.');
        }

        return $instance->configCollection[$name];
    }
}