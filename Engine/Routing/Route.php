<?php

namespace Engine\Routing;

class Route
{
    /** @var string $classPostfix */
    private static $classPostfix = 'Controller';

    /** @var string $methodPostfix */
    private static $methodPostfix = 'Action';

    /** @var string $pattern */
    private $pattern;

    /** @var string $classPrefix */
    private $classPrefix;

    /** @var string $methodPrefix */
    private $methodPrefix;

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return $this->pattern;
    }

    /**
     * @param string $pattern
     */
    public function setPattern(string $pattern)
    {
        $this->pattern = $pattern;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->classPrefix . self::$classPostfix;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->methodPrefix .  self::$methodPostfix;
    }

    /**
     * @return string
     */
    public function getClassPrefix(): string
    {
        return $this->classPrefix;
    }

    /**
     * @param string $classPrefix
     */
    public function setClassPrefix(string $classPrefix)
    {
        $this->classPrefix = $classPrefix;
    }

    /**
     * @return string
     */
    public function getMethodPrefix(): string
    {
        return $this->methodPrefix;
    }

    /**
     * @param string $methodPrefix
     */
    public function setMethodPrefix(string $methodPrefix)
    {
        $this->methodPrefix = $methodPrefix;
    }
}