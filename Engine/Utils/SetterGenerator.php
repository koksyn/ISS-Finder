<?php

namespace Engine\Utils;

class SetterGenerator
{
    private static $needle = '_';

    /**
     * @param string $property
     * @return string
     */
    public static function generatePropertySetter(string $property)
    {
        $property = ucfirst(strtolower($property));

        return 'set' . $property;
    }

    /**
     * @param string $property
     * @return string
     */
    public static function convertToCamelCase(string $property)
    {
        /** @var integer $position */
        $position = strpos($property, self::$needle);

        if($position > 0) {
            /** @var string $pattern */
            $pattern = '/' . self::$needle . '(.)/';

            $property = preg_replace_callback($pattern, 'self::firstMatchToUpper', $property);
            $property = str_replace(self::$needle, '', $property);
        }

        return $property;
    }

    /**
     * @param array $matches
     * @return string
     */
    private static function firstMatchToUpper(array $matches)
    {
        /** @var string $match */
        $match = array_shift($matches);

        return strtoupper($match);
    }
}