<?php

namespace Engine\Routing;

use Engine\Controller;
use Engine\Http\Request;
use Engine\Http\Response;
use Engine\Routing\Validators\ResponseValidator;

class Router
{
    /** @var RouteBuilder $routeBuilder */
    private $routeBuilder;
    /** @var ResponseValidator $responseValidator */
    private $responseValidator;
    /** @var string $controllerNamespace */
    private static $controllerNamespace = 'Controllers\\';

    /**
     * Router constructor.
     * @param RouteBuilder $routeBuilder
     * @param ResponseValidator $responseValidator
     */
    public function __construct(RouteBuilder $routeBuilder, ResponseValidator $responseValidator)
    {
        $this->routeBuilder = $routeBuilder;
        $this->responseValidator = $responseValidator;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function resolve(Request $request)
    {
        /** @var Route $route */
        $route = $this->match($request);

        return $this->execute($route, $request);
    }

    /**
     * @param Request $request
     * @return Route
     */
    private function match(Request $request)
    {
        /** @var string $pattern */
        $pattern = $request->getPattern();

        return $this->routeBuilder->fromPattern($pattern);
    }

    /**
     * @param Route $route
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    private function execute(Route $route, Request $request)
    {
        /** @var Controller $controller */
        $controller = $this->createController($route, $request);
        /** @var string $controllerMethod */
        $controllerMethod = $route->getMethod();

        /** @var Response $response */
        $response = $controller->$controllerMethod();

        $this->responseValidator->validate($response);

        return $response;
    }

    /**
     * @param Route $route
     * @param Request $request
     * @return mixed
     */
    private function createController(Route $route, Request $request)
    {
        /** @var string $controllerClass */
        $controllerClass = $route->getClass();

        $this->loadController($controllerClass);

        /** @var string $controllerClassWithNamespace */
        $controllerClassWithNamespace = self::$controllerNamespace . $controllerClass;

        return new $controllerClassWithNamespace($request);
    }

    /**
     * @param string $controllerClass
     * @throws \Exception
     */
    private function loadController(string $controllerClass)
    {
        /** @var string $controllerClassPath */
        $controllerClassPath = self::getControllerClassPath($controllerClass);

        if (!file_exists($controllerClassPath)) {
            throw new \Exception('Controller "' . $controllerClass . '" file in path "' . $controllerClassPath . '" does not exist.');
        }

        require_once $controllerClassPath;
    }

    /**
     * @param string $controllerClass
     * @return string
     */
    public static function getControllerClassPath(string $controllerClass)
    {
        return __DIR__ . '/../../Controllers/' . $controllerClass . '.php';
    }
}