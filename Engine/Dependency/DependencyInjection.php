<?php

namespace Engine\Dependency;

/**
 *  Inversion of control pattern
 *
 *  This class is a Container, which resolve Dependency Injection
 */
class DependencyInjection
{
    /** @var array $registry */
    protected static $registry = [];

    /**
     * @param string $name
     * @param \Closure $closure
     */
    public static function register(string $name, \Closure $closure)
    {
        static::$registry[$name] = $closure;
    }

    /**
     * @param string $name
     * @return bool
     */
    public static function registered(string $name)
    {
        return array_key_exists($name, static::$registry);
    }

    /**
     * @param string $name
     * @return mixed
     * @throws \Exception
     */
    public static function resolve(string $name)
    {
        if (!self::registered($name)) {
            throw new \Exception('You can not call unregistered ' . $name);
        }

        /** @var \Closure $closure */
        $closure = static::$registry[$name];

        return $closure(new self);
    }
}