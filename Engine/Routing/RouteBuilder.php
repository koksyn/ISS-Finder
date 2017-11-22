<?php

namespace Engine\Routing;

use Engine\Configuration\Config;
use Engine\Routing\Validators\RouteValidator;

class RouteBuilder
{
    /** @var RouteValidator $routeValidator */
    private $routeValidator;

    /**
     * RouteBuilder constructor.
     * @param RouteValidator $routeValidator
     */
    public function __construct(RouteValidator $routeValidator)
    {
        $this->routeValidator = $routeValidator;
    }

    /**
     * @param string $pattern
     * @return Route
     * @throws \Exception
     */
    public function fromPattern(string $pattern)
    {
        /** @var array $configRoute */
        $configRoute = $this->findConfigurationForPattern($pattern);

        return $this->buildFromConfigRoute($configRoute);
    }

    /**
     * @param string $pattern
     * @return array
     * @throws \Exception
     */
    private function findConfigurationForPattern(string $pattern)
    {
        /** @var array $routes */
        $routes = $this->getRoutingConfiguration();

        foreach($routes as $route) {
            if($pattern === $route['pattern']) {
                return $route;
            }
        }

        throw new \Exception('Route "' . $pattern . '" not found');
    }

    /**
     * @return array
     */
    private function getRoutingConfiguration()
    {
        /** @var array $routingConfiguration */
        $routingConfiguration = Config::getData('routes');

        $this->routeValidator->validate($routingConfiguration);

        return $routingConfiguration;
    }

    /**
     * @param array $configRoute
     * @return Route
     */
    private function buildFromConfigRoute(array $configRoute)
    {
        /** @var Route $route */
        $route = new Route();

        $route->setPattern($configRoute['pattern']);
        $route->setClassPrefix($configRoute['classPrefix']);
        $route->setMethodPrefix($configRoute['methodPrefix']);

        return $route;
    }
}