<?php

namespace Engine\DTO;

use Engine\Utils\SetterGenerator;

class DTOBuilder
{
    /**
     * @param string $className
     * @param array $objectCollection
     * @return array
     */
    public static function buildCollection(string $className, array $objectCollection): array
    {
        foreach($objectCollection as $key => $object) {
            $objectCollection[$key] = self::build($className, $object);
        }

        return $objectCollection;
    }

    /**
     * @param string $className
     * @param \stdClass $object
     * @return mixed
     */
    public static function build(string $className, \stdClass $object)
    {
        $objectDTO = new $className();

        /** @var array $objectVars */
        $objectVars = get_object_vars($object);

        foreach($objectVars as $property => $value) {
            $property = SetterGenerator::convertToCamelCase($property);

            if(property_exists($className, $property)) {
                /** @var string $setter */
                $setter = SetterGenerator::generatePropertySetter($property);
                $value = self::buildHintedMethodArguments($className, $setter, $value);

                $objectDTO->$setter($value);
            }
        }

        return $objectDTO;
    }

    /**
     * This mechanism isn't perfect - don't work with array's of objects (in arguments)
     * because in PHP7 we cannot declare method argument as 'SomeClass[]' like in other languages like C#, Java
     * only construction 'array' is allowed
     *
     * @param string $className
     * @param string $methodName
     * @param mixed $value
     * @return mixed|\stdClass
     */
    protected static function buildHintedMethodArguments(string $className, string $methodName, $value)
    {
        /** @var \ReflectionClass $reflector */
        $reflector = new \ReflectionClass($className);
        /** @var \ReflectionMethod $method */
        $method = $reflector->getMethod($methodName);
        /** @var \ReflectionParameter[] $params */
        $params = $method->getParameters();

        foreach($params as $param) {
            /** @var \ReflectionClass $paramClass */
            $paramClass = $param->getClass();

            if(!is_null($paramClass)) {
                $value = self::build($paramClass->getName(), $value);
            }
        }

        return $value;
    }
}