<?php

namespace Engine\Routing\Validators;

use Engine\ValidatorInterface;

class RouteValidator implements ValidatorInterface
{
    /** @var array $requiredRouteKeys */
    private static $requiredRouteKeys = [
        'pattern',
        'classPrefix',
        'methodPrefix'
    ];

    /**
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function validate($data): bool
    {
        foreach($data as $route) {
            /** @var array $routeKeys */
            $routeKeys = array_keys($route);

            if($routeKeys != self::$requiredRouteKeys) {
                throw new \Exception('Parse error : invalid routes JSON file');
            }
        }

        return true;
    }
}